<?php
define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT'].'/cms/');
require_once DRUPAL_ROOT . 'includes/bootstrap.inc';
// Bootstrap Drupal at the phase that you need
drupal_bootstrap(DRUPAL_BOOTSTRAP_SESSION);

ini_set('memory_limit', '512M');
ini_set('max_execution_time', 1200); 
define('ROOT_PATH_RDS_AWS', './json/rds/aws/');
define('ROOT_PATH_RDS_AZURE', './json/rds/azure/');
define('ROOT_PATH_RDS_GOOGLE', './json/rds/google/');
define('ROOT_PATH_RDS_VIVO', './json/rds/vivo/');
define('ROOT_PATH_RDS_MAPPING', './json/rds/');
define('ROOT_PATH_INDEX', './json/');

define('CLOSEST_RANGE_CPU', 100);
define('CLOSEST_RANGE_MEMORY', 100);
define('CLOSEST_RANGE_DISC', 100);

$region = $_POST['region'] ? $_POST['region'] : 'US East 1';
$os_type = $_POST['os_type']? $_POST['os_type'] : 'Linux';
$db_type = $_POST['db_type']? $_POST['db_type'] : 'SQL Server';
$vcpu_post = $_POST['cpu_type'] ? $_POST['cpu_type'] : 1;
$memory_post = $_POST['memory_type'] ? $_POST['memory_type'] : 1;
$disc_post = $_POST['disc_type'] ? $_POST['disc_type'] : 1;
$memory_post  = number_format($memory_post , 0, '', ',');

$mapping_filename = "country_mapping.json";
$mapping_file = fopen(ROOT_PATH_INDEX.$mapping_filename, "r");
$output = fread($mapping_file,filesize(ROOT_PATH_INDEX.$mapping_filename));
$output_json = json_decode($output);
$countries = $output_json->country_mapping;
$country_codes = array();
foreach ($countries as $key=>$country) {
    if((strtoupper($key)) === (strtoupper($region))){
        $region_aws = $country->AWS;
        $region_google_cloud = $country->Google_Cloud;
        $region_azure = $country->Azure;
        $region_vivo = $country->Vivo;
        break;
    }
}

$rate_conversion_aws = $_SESSION['rate_conversion_aws'];
$rate_conversion_google_cloud = $_SESSION['rate_conversion_google_cloud'];
$rate_conversion_azure = $_SESSION['rate_conversion_azure'];
$rate_conversion_vivo = $_SESSION['rate_conversion_vivo'];


$config_array = array('disc'=>$disc_post, 'vcpu'=>$vcpu_post, 'memory'=>$memory_post);
arsort($config_array);
arsort($config_array);


// AWS ARRAY SORT START //
$data_aws_final =  array();
$filename = $region_aws.".json";
if (file_exists(ROOT_PATH_RDS_AWS.$filename)) {
	$myfile = fopen(ROOT_PATH_RDS_AWS.$filename, "r");
	$output = fread($myfile,filesize(ROOT_PATH_RDS_AWS.$filename));
	fclose($myfile);
	$json = json_decode($output);
	$products = $json->products;
        $data_aws = array();
	$data = array();
	foreach ($products as $key=>$product) {
		if(isset($product->attributes->databaseEngine) && ($product->attributes->databaseEngine == $db_type)){
			$price_list = $json->terms->OnDemand;
			$reserved = $json->terms->Reserved;
			foreach ($price_list as $key_price=>$price) {
				if($key_price == $key){
					foreach ($price as $key_offer=>$price_offer) {
						if (is_array($price_offer) || is_object($price_offer)){
							foreach ($price_offer as $key_priceDimensions=>$priceDimensions) {
								if (is_array($priceDimensions) || is_object($priceDimensions)){
									foreach ($priceDimensions as $key_rateCode=>$rateCode) {
										if (is_array($rateCode) || is_object($rateCode)){
											$product->pricePerUnit = $rateCode->pricePerUnit->USD;
										}
									}
								}
							}
						}
					}

				}
			}
			foreach ($reserved as $reserve_price=>$reserve) {
                            if($reserve_price == $key){
                                    $product->reserved_price_list = $reserve;
                            }
			}
			$data_aws[] = $product;
		}
	}
	foreach ($config_array as $key=>$config) {
            $data_aws = getClosestMatch($config, $key, $data_aws);
	}
	$data_aws = getRangeMatch('aws', $data_aws, $memory_post, $vcpu_post, $disc_post);
	$data = array();
	foreach ($data_aws as $key=>$aws) {
            $data['sku'] = $aws->sku;
            $data['vcpu'] = $aws->attributes->vcpu;
            if($rate_conversion_aws['currency_conversion_required']){
                $exhange_rate = $rate_conversion_aws['exhange_rate'];
                $aws_price = $aws->pricePerUnit;
                $aws_price = $aws->pricePerUnit*$exhange_rate;
                $data['price'] = round($aws_price, 3);
            }else{
                $data['price'] = round($aws->pricePerUnit, 3);
            }
            
            if($rate_conversion_aws['currency_conversion_required']){
                $data['currency_symbol'] = $rate_conversion_aws['domain_currency'];
            }else{
                $data['currency_symbol'] = '$';
            }
            $memory = explode(" ",$aws->attributes->memory);
            $data['memory'] = $memory[0]. ' GB RAM';
            $data['databaseEngine'] = $aws->attributes->databaseEngine;
            $data['storage'] = $aws->attributes->storage;
            $data['instance_type'] = $aws->attributes->instanceType;
            if(isset($aws->attributes->databaseEdition)){
                $data['preinstalled'] = $aws->attributes->databaseEdition;
            }
            else{
                $data['preinstalled'] = '';
            }
            $data['license'] = $aws->attributes->licenseModel;
            $data['tenancy'] = $aws->attributes->deploymentOption;
            if(isset($aws->reserved_price_list)){
                $data['reserved_price_list'] = $aws->reserved_price_list;
            }
            else{
                $data['reserved_price_list'] = array();
            }
            $data['type'] = 'aws';
            $data_aws_final[] = $data;
	}
}

// AWS ARRAY SORT COMPLETE //

$data_vivo_final =  array();
$config_array_vivo = array('vcpu'=>$vcpu_post, 'memory'=>$memory_post);
arsort($config_array_vivo);
arsort($config_array_vivo);

// VIVO ARRAY SORT START //
$vivo_filename = "voc-prices-v1.json";
if (file_exists(ROOT_PATH_RDS_VIVO.$vivo_filename)) {
	$vivo_file = fopen(ROOT_PATH_RDS_VIVO.$vivo_filename, "r");
	$vivo_output = fread($vivo_file,filesize(ROOT_PATH_RDS_VIVO.$vivo_filename));
	$vivo_json = json_decode($vivo_output);
	$data_vivo = array();
	foreach ($vivo_json as $key=>$vivo_product) {
            if(isset($vivo_product->rds)){
                if($vivo_product->rds == $db_type){
                    $data_vivo[$key] = $vivo_product;
                }
            }
	}
        
	foreach ($config_array_vivo as $key=>$config) {
            $data_vivo = getClosestMatchVivo($config, $key, $data_vivo);
	}
	$data_vivo = getRangeMatch('vivo', $data_vivo, $memory_post, $vcpu_post, $disc_post);
	$vivo_data = array();
	
	foreach ($data_vivo as $key=>$vivo) {
		$vivo_data['vcpu'] = isset($vivo->vcpu) ? $vivo->vcpu : $vivo->cpu;
		if(isset($vivo->$region_vivo)){	
                    $vivo_price = $vivo->$region_vivo;
                }
                if($rate_conversion_vivo['currency_conversion_required']){
                    $exhange_rate = $rate_conversion_vivo['exhange_rate'];
                    $vivo_price = $vivo_price*$exhange_rate;
                    $vivo_data['price'] = round($vivo_price, 3);
                }else{
                    $vivo_data['price'] = round($vivo_price, 3);
                }
                
                if($rate_conversion_vivo['currency_conversion_required']){
                    $vivo_data['currency_symbol'] = $rate_conversion_vivo['domain_currency'];
                }else{
                    $vivo_data['currency_symbol'] = '$';
                }

                $vivo_data['memory'] = $vivo->{'ram-gb'}. ' GB RAM';
		$vivo_data['sku'] = $vivo->{'productid'};
		$vivo_data['storage'] = $vivo->storage;
		$vivo_data['instance_type'] = $vivo->{'productname'};
                $vivo_data['productId'] = $vivo->{'productid'};
		$vivo_data['type'] = 'vivo';
		$data_vivo_final[] = $vivo_data;
	}
}
// VIVO ARRAY SORT COMPLETE //


$data_google_final = array();
$data_azure_final = array();

$config_array_azure = array('vcpu'=>$vcpu_post);

// AZURE ARRAY SORT START //
$data_azure_final =  array();
$azure_filename = "pricelist_azure_rds.json";
if (file_exists(ROOT_PATH_RDS_AZURE.$azure_filename)) {
$azure_file = fopen(ROOT_PATH_RDS_AZURE.$azure_filename, "r");
$azure_output = fread($azure_file,filesize(ROOT_PATH_RDS_AZURE.$azure_filename));
$azure_json = json_decode($azure_output);
$azure_products = (array) $azure_json->azure_price_list;
$data_azure= array();
if(isset($azure_products[$db_type])){
    $data_azure = (array) $azure_products[$db_type] ;
}


$azure_data = array();
$data_azure_final =  array();
$inc = 0;
foreach ($data_azure as $key_type=>$data) {
    $process_azure = (array) $data;
    foreach ($config_array_azure as $key=>$config) {
        $process_azure = getClosestMatchAzure($config, $key, $process_azure);
    }
    $inc++;
    foreach ($process_azure as $key=>$azure) {
            $azure_data['vcpu'] = $azure->gceu;
            $storage_price = 0;
            $backup_price = 0;
            $io_price = 0;
            if(isset($azure->$region_azure)){
                if($rate_conversion_azure['currency_conversion_required']){
                    $exhange_rate = $rate_conversion_azure['exhange_rate'];
                    $azure_price = $azure->$region_azure;
                    $azure_price = $azure_price*$exhange_rate;
                    $azure_data['price'] = round($azure_price, 3);
                }else{
                    $azure_data['price'] = round($azure->$region_azure, 3);
                }
                
                if($rate_conversion_azure['currency_conversion_required']){
                    $azure_data['currency_symbol'] = $rate_conversion_azure['domain_currency'];
                }else{
                    $azure_data['currency_symbol'] = '$';
                }
            }
            else{
                $azure_data['price'] = 0;
            }
            
            if(isset($azure->storageprice)){
                $storageprice = $azure->storageprice;
                if(isset($data_azure[$storageprice]->$region_azure)){
                    $storage_price = $data_azure[$storageprice]->$region_azure;
                }
            }
            if(isset($azure->backup)){
                $backup = $azure->backup;
                if(isset($data_azure[$backup]->$region_azure)){
                    $backup_price = round($data_azure[$backup]->$region_azure, 3);
                }
            }
            if(isset($azure->io)){
                $io = $azure->io;
                if(isset($data_azure[$io]->$region_azure)){
                    $io_price = round($data_azure[$io]->$region_azure, 3);
                }
            }
            else{
                $io_price = '';
            }

            $azure_data['memory'] = $azure->cores. ' CORES';
            $azure_data['operatingSystem'] = '';
            $azure_data['storage'] = $azure->storage;
            
            if($rate_conversion_azure['currency_conversion_required']){
                $exhange_rate = $rate_conversion_azure['exhange_rate'];
                $azure_data['io_price'] = round($exhange_rate*$io_price, 3);
                $azure_data['backup_price'] = round($exhange_rate*$backup_price, 3);
                $azure_data['storage_price'] = round($exhange_rate*$storage_price, 3);
            }else{
                $azure_data['io_price'] = $io_price;
                $azure_data['backup_price'] = $backup_price;
                $azure_data['storage_price'] = $storage_price;
            }
            $azure_data['instance_type'] = $key_type.'-'.$key;
            $azure_data['type'] = 'azure';
            $data_azure_final[] = $azure_data;
    }
    if(($db_type == "SQL Server") && ($inc == 1)){
        break;
    }
    elseif(($inc == 3)){
         break;
    }
}
}
$data_final = array_merge($data_azure_final, $data_google_final, $data_aws_final, $data_vivo_final);


// FIND THE AWS CLOSET VALUE //
function getClosestMatch($serach, $type, $arr_search) {
	$closest = null;
	$re_arr = array();
	$ebs_arr = array();
	foreach ($arr_search as $key=>$item) {
            if($type === 'vcpu'){
                if(isset($item->attributes->vcpu)){
                    $node_search = $item->attributes->vcpu;
                }
            }
            elseif($type === 'disc'){
                if(isset($item->attributes->storage)){
                    $disc = $item->attributes->storage;
                    $disc = explode(" ",$disc);
                    $node_search = $disc[0];
                    if($node_search == 'EBS'){
                        $ebs_arr[] = $item;
                    }
                    elseif(!empty($disc[2])){
                        $node_search = $disc[0]*$disc[2];
                    }
                }
            }
            else{
                if(isset($item->attributes->memory)){
                    $memory = $item->attributes->memory;
                    $memory = explode(" ",$memory);
                    $node_search = $memory[0];
                }
            }
            if (($closest === null) || (abs($serach - $closest) > abs($node_search - $serach)) || ($closest === $node_search)) {		
                if($closest != $node_search){
                        $closest = $node_search;
                        array_pop($re_arr);
                        $re_arr[] = $item;
                }
                else{
                        $closest = $node_search;
                        $found = false;
                        foreach($re_arr as $key => $re_json) {
                            if($item->sku == $re_json->sku){
                                $found = true;
                            }
                        }
                        if($found == false){
                            $re_arr[] = $item;
                        }
                }
            }
    }
	if($type === 'disc'){
            //$re_arr = array_merge($re_arr, $ebs_arr);
	}
   return $re_arr;
}


// FIND THE GOOGLE CLOSET VALUE //
function getClosestMatchAzure($serach, $type, $arr_search) {
    $closest = null;
    $re_arr = array();

    foreach ($arr_search as $key=>$item) {
        if($type === 'vcpu'){
            if(isset($item->cores)){
                $node_search = $item->cores;
            }
            else{
                continue;
            }
        }
        if ($closest === null || abs($serach - $closest) > abs($node_search - $serach) || $closest === $node_search) {		
             if($closest != $node_search){
                $closest = $node_search;
                $re_arr = array();
                $re_arr[$key] = $item;
             }
             else{
                $closest = $node_search;
                $re_arr[$key] = $item;
             }
        }
    } 
    return $re_arr;
}

// FIND THE VIVO CLOSET VALUE //
function getClosestMatchVivo($serach, $type, $arr_search) {
	$closest = null;
	$re_arr = array();
	foreach ($arr_search as $key=>$item) {
		if(($type === 'vcpu') || ($type === 'cpu')){
			if(isset($item->vcpu)){
				$node_search = $item->vcpu;
			}
                        elseif(isset($item->cpu)){
				$node_search = $item->cpu;
			}
			else{
				continue;
			}
		}
		else{
			if(isset($item->{'ram-gb'})){
				$node_search = $item->{'ram-gb'};
			}
			else{
				continue;
			}
		}
	  if ($closest === null || abs($serach - $closest) > abs($node_search - $serach) || $closest === $node_search) {		
		 if($closest != $node_search){
			$closest = $node_search;
			$re_arr = array();
			$re_arr[$key] = $item;
		 }
		 else{
			 $closest = $node_search;
			 $re_arr[$key] = $item;
		 }
	  }
   } 
   return $re_arr;
}


// FIND THE Range VALUE //
function getRangeMatch($type, $arr_search, $memory_post=0, $cpu_post=0, $disc_post=0) {
	$re_arr = array();
	foreach ($arr_search as $key=>$item) {
		if($type === 'aws'){	
			$cpu = '';
			$memory = '';
			$storage = '';
                        if(isset($item->attributes->vcpu)){
                            $cpu = $item->attributes->vcpu;
                        }
                        if(isset($item->attributes->memory)){
                            $memory = $item->attributes->memory;
                        }
                        if(isset($item->attributes->storage)){
                            $storage = $item->attributes->storage;
                        }
			$storage = explode(" ",$storage);
			$storage_type = $storage[0];
			$CLOSEST_RANGE_MEMORY = abs($memory_post + CLOSEST_RANGE_MEMORY);
			$CLOSEST_RANGE_CPU = abs($cpu_post + CLOSEST_RANGE_CPU);
			
			
			if($storage_type == 'EBS'){
				$disc = 'EBS';
				$CLOSEST_RANGE_DISC = 0;
			}
			elseif(!empty($storage[2])){
				$disc = $storage[0]*$storage[2];
				$CLOSEST_RANGE_DISC = abs($disc_post + CLOSEST_RANGE_DISC);
			}
			
			if((abs($cpu) <= $CLOSEST_RANGE_CPU) && (abs($memory) <= $CLOSEST_RANGE_MEMORY)){
				if(!empty($storage[2]) && (abs($disc) <= $CLOSEST_RANGE_DISC)){
					$re_arr[] = $item;
				}
				elseif($storage_type == 'EBS'){
					$re_arr[] = $item;
				}
			}
		}
		elseif(($type === 'azure')){
			$cpu = $item->gceu;
			$memory = $item->memory; 
			$disc = $item->maxPdSize;
			$CLOSEST_RANGE_MEMORY = abs($memory_post + CLOSEST_RANGE_MEMORY);
			$CLOSEST_RANGE_CPU = abs($cpu_post + CLOSEST_RANGE_CPU);
			$CLOSEST_RANGE_DISC = abs($disc_post + CLOSEST_RANGE_DISC);
			if((abs($cpu) <= $CLOSEST_RANGE_CPU) && (abs($memory) <= $CLOSEST_RANGE_MEMORY) && (abs($disc) <= $CLOSEST_RANGE_DISC)){
				$re_arr[$key] = $item;
			}
		}
                elseif(($type === 'vivo')){
                    $cpu = isset($item->vcpu) ? $item->vcpu : $item->cpu;
                    $memory = $item->{'ram-gb'}; 
                    $CLOSEST_RANGE_MEMORY = abs($memory_post + CLOSEST_RANGE_MEMORY);
                    $CLOSEST_RANGE_CPU = abs($cpu_post + CLOSEST_RANGE_CPU);
                    if((abs($cpu) <= $CLOSEST_RANGE_CPU) && (abs($memory) <= $CLOSEST_RANGE_MEMORY)){
                            $re_arr[$key] = $item;
                    }
                }
		else{
			$cpu = $item->gceu;
			$memory = $item->memory; 
			$CLOSEST_RANGE_MEMORY = abs($memory_post + CLOSEST_RANGE_MEMORY);
			$CLOSEST_RANGE_CPU = abs($cpu_post + CLOSEST_RANGE_CPU);
			if((abs($cpu) <= $CLOSEST_RANGE_CPU) && (abs($memory) <= $CLOSEST_RANGE_MEMORY)){
				$re_arr[$key] = $item;
			}
		}
    }
    return $re_arr;
}
$output = '';
$count = 0;
if(!empty($data_final)){
$output  .='<div class="total_result">Total Results Found: '.count($data_final);
$output  .='</div>';
$output  .='<div class="AppVM mb-1">';
// loop
foreach ($data_final as $key=>$data_product) {
$output .='<div class=" no-gutters">';
$output .='<div class="border-dark">';
if($data_product["type"] == 'aws'){
    $output .='<img src="images/aws.png" class="img" width="120" height="59">';
}
elseif($data_product["type"] == 'google'){
    $output .='<img src="images/gcp.png" class="img" width="120" height="59">';
}
elseif($data_product["type"] == 'vivo'){
    $output .='<img   src="images/logo-vivo.jpg" class="img" width="120" height="59">';
}
else{
    $output .='<img src="images/azure.png" class="img" width="120" height="59">';
}

$storage = explode(' ', $data_product['storage']);

if(($data_product["type"] == 'aws') || !empty($data_product['storage'])){
    if ($data_product['storage'] == 'EBS Only'){
        $data_product['storage']= $data_product['storage'];
    }
    elseif(!empty($storage[3]) && (($storage[3] == 'SSD') || ($storage[3] == 'HDD') || ($storage[3] == 'NVMe'))){
        $data_product['storage']= $storage[0].''.$storage[1].''.$storage[2].' '.$storage[3];
        if(!empty($storage[4])){
            $data_product['storage'].= ' '.$storage[4];
        }
    }
    else if ($data_product['type']=='vivo'){
	$data_product['storage']= 'Storage: '.$data_product['storage'];
    }
    else{
        if($data_product["type"] == 'azure'){
             $data_product['storage']= $data_product['storage'].' GB Storage';
        }
        else{
             $data_product['storage']= $data_product['storage'].' GB Disk';
        }

    }
}

$sku = trim($data_product["instance_type"]).'-'.trim(str_replace(' ', '-', $region)).'-'.trim(str_replace(' ', '-', $db_type));
if($data_product["type"] == 'aws'){
    $sku = $sku.'-'.trim(str_replace(' ', '-', $data_product['sku']));
}

if(!empty($data_product['preinstalled'])){
    $data_product['preinstalled']='Database Edition: '.$data_product['preinstalled']; 
}
else{
    $data_product['preinstalled']='';
    $data_product['tenancy']='';
}

$output .='<p class="margin-0 bold padding-top10 list_description"><span class="instanceType">'. $data_product["instance_type"].'' .$data_product['tenancy'].'</span></p>'; 
$output .='<div style="min-height: 0px;" class="inside_p" id='.$sku.'><p class="margin-0 padding-top10 list_description">'. $data_product["vcpu"] .' CPU / '.$data_product["memory"].'</p>';
if(!empty($data_product['storage'])){
    $output .='<p data-v-47d9a0be="" class="margin-0 list_description">'.$data_product['storage'].' </p>';
}
if(!empty($data_product['preinstalled'])){
    $output .='<p data-v-47d9a0be="" class="margin-0 list_description">'.$data_product['preinstalled'].'</p>';
}
if(isset($data_product['license'])){
    $output .='<p data-v-47d9a0be="" class="margin-0 list_description">'.$data_product['license'].'</p>';
}
$output .='</div>';
if($data_product["type"] == 'azure'){
    $output .='<p class="margin-0 padding-top10 list_description_azure">Backup: <span class="bold">'.$data_product["currency_symbol"].''.$data_product["backup_price"].' GB/month</span></p><p data-v-47d9a0be="" class="margin-0 list_description_azure">Additional Storage: <span class="bold">'.$data_product["currency_symbol"].''.$data_product["storage_price"].' GB/month</span></p>';
    if(!empty($data_product['io_price'])){
        $output .='<p class="margin-0 list_description_azure">IO Price: <span class="bold">'.$data_product["currency_symbol"].''.$data_product["io_price"].'</span></p>';
    }
}
$output .='<p class="price"><span class="priceText">'.$data_product["currency_symbol"].''.$data_product["price"].'<span class="hour">/hour</span></span>';
if($data_product["type"] == 'aws'){
$count++;
$product_res = array();
if(isset($data_product["reserved_price_list"])){
	foreach ($data_product["reserved_price_list"] as $key_offer=>$price_offer) {
		if (is_array($price_offer) || is_object($price_offer)){
			$leaseContractLength = $price_offer->termAttributes->LeaseContractLength;
			$offeringClass = $price_offer->termAttributes->OfferingClass;
			$purchaseOption = $price_offer->termAttributes->PurchaseOption;
			$product_res[$leaseContractLength][$offeringClass][$key_offer]['paymentoption'] = $purchaseOption;
			foreach ($price_offer as $key_priceDimensions=>$priceDimensions) {
				if (is_array($priceDimensions) || is_object($priceDimensions)){
					foreach ($priceDimensions as $key_rateCode=>$rateCode) {
						if (is_array($rateCode) || is_object($rateCode)){
							if($rateCode->unit == 'Quantity'){
                                                            $product_res[$leaseContractLength][$offeringClass][$key_offer]['upfront'] = $rateCode->pricePerUnit->USD;
							}
							if($rateCode->unit == 'Hrs'){
                                                            $product_res[$leaseContractLength][$offeringClass][$key_offer]['hourly'] = $rateCode->pricePerUnit->USD;
							} 
						}
					}
				}
			}
		}
	}
}
$reserved = json_decode(json_encode($product_res));
$reserved_prices = new ArrayObject($reserved);
$reserved_prices->ksort();
$offerPrice = '';
if(!empty($reserved)){
$offerPrice = '<div>';
foreach($reserved_prices as $key_data=>$reserved_price){
foreach($reserved_price as $key_res=>$reserve){
$offerPrice .= '<h3>';
if($key_data == '1yr'){
    $reservered_term = $key_res.' 1-Year Term';
    $offerPrice .= $reservered_term;
}
else{
    $reservered_term = $key_res.' 3-Year Term';
    $offerPrice .= $reservered_term;
}
$offerPrice .= '</h3>';
$offerPrice .= '<table class="tftable" border="1">
<tr><th>Payment Option</th><th>Upfront</th><th>Effective Hourly</th><th></th></tr>';
        
foreach($reserve as $reserved){

$reserved_upfront = isset($reserved->upfront) ? number_format($reserved->upfront, 2) : number_format(0,2);
$reserved_hourly = isset($reserved->hourly) ? number_format($reserved->hourly, 4) : number_format(0,2);

if($rate_conversion_aws['conversion_required']){
    $exhange_rate = $rate_conversion_aws['exhange_rate'];
    $reserved_upfront = number_format($reserved_upfront*$exhange_rate,2);
    $reserved_hourly = number_format($reserved_hourly*$exhange_rate,2);	
}
$product_conf = trim($data_product["vcpu"]).' CPU /' . $data_product['storage'].' / '. $data_product["memory"].'GB RAM / '. $os_type . ' / ' . strtoupper($reservered_term) . ' / ' . $reserved->paymentoption;
$price = $reserved_hourly + $reserved_upfront;
$product_name = $data_product["instance_type"];
$product_type = 'RDS';
$reserved_price = 1;
$sku = $sku.'-'.trim(str_replace(' ', '-', $reservered_term));
$offerButton ='<div class="addcartpopup"><form class="form-item-rds" method="POST" >
              <p class="formlink">
                <input type="hidden" name="sku" value="'.$sku.'">
                <input type="hidden" name="product_type" value="'.$product_type.'">    
                <input type="hidden" name="product_name" value="'.$product_name.'">
                <input type="hidden" name="product_conf" value="'.$product_conf.'">
                <input type="hidden" name="conf_os" value="'.$os_type.'">
                <input type="hidden" name="price" value="'.$price.'">
                <input type="hidden" name="reserved_hourly" value="'.$reserved_hourly.'">
                <input type="hidden" name="reserved_upfront" value="'.$reserved_upfront.'">
                <input type="hidden" name="region" value="'.$region.'">
                <input type="hidden" name="reserved_price" value="'.$reserved_price.'">
                <input type="hidden" name="provider" value="'.$data_product["type"].'">
                <button type="submit" class="btn btn-warning">+ Add To Wishlist</button>
              </p>
            </form></div>';
$offerPrice .= '<tr><td>'.$reserved->paymentoption.'</td><td>'.$data_product["currency_symbol"].''.$reserved_upfront.'</td><td>'.$data_product["currency_symbol"].''.$reserved_hourly.'</td><td>'.$offerButton.'</td></tr>';
}
$offerPrice .= '</table>';
}}
$offerPrice .= '</div>';
$output .='<span class="awslink"><span><a href="javascript:void(0)" style="display:block;" class="opentierwindow" plandiv="tier-'.$count.'">View Reserved Price</a></span></span><div style="display:none" class="reserved_price" id="tier-'.$count.'">'.$offerPrice.'</div>';
}}
$product_conf = trim($data_product["vcpu"]).' CPU';
if(!empty($data_product['storage'])){
   $product_conf .= ' / ' . $data_product['storage']; 
}
$product_conf .= ' / '. $data_product["memory"].' / '. $db_type;

$price = $data_product["price"];
$product_name = $data_product["instance_type"];
if(isset($data_product['tenancy'])){
    $product_name .= $data_product['tenancy'];
}
$product_type = 'RDS';
$output .='<div class="addcart"><form class="form-item-rds" method="POST" >
              <p class="formlink">
                <input type="hidden" name="sku" value="'.$sku.'">
                <input type="hidden" name="product_type" value="'.$product_type.'">    
                <input type="hidden" name="product_name" value="'.$product_name.'">
                <input type="hidden" name="product_conf" value="'.$product_conf.'">
                <input type="hidden" name="conf_db" value="'.$db_type.'">
                <input type="hidden" name="price" value="'.$price.'">
                <input type="hidden" name="region" value="'.$region.'">
                <input type="hidden" name="provider" value="'.$data_product["type"].'">
                <button type="submit" class="btn btn-warning">+ Add To Wishlist</button>
              </p>
            </form></div>';
$output .='</div>';
$output .='</div>';
}
// loop end
$output .='</p></div>';
}
else{
    $output .='<div>We are sorry. It seems we are not able to find any providers that either matches / is close to your selection criteria. Please try with a different combination.</div>';
}
print $output;?>
<script>
    $(".form-item-rds").on("submit",function(e){
            var form_data = $(this).serialize();
            var button_content = $(this).find('button[type=submit]');
            button_content.html('Adding...'); //Loading button text 
            $.ajax({ //make ajax request to cart_process.php
                    url: "addtocart.php",
                    type: "POST",
                    dataType:"json", //expect json value from server
                    data: form_data
            }).done(function(data){ //on Ajax success
                    button_content.html('+ Add To Wishlist'); //reset button text to original text
                    if($(".shopping-cart-box").css("display") == "block"){ //if cart box is still visible     
                        $(".shopping-cart-box").show(); //trigger click to update the cart box.
                        $('.shopping-cart-box .totalcount').html(data.count); //total items in cart-info element
                        $(".shopping-cart-box .totalCalculated").html(data.total_price);
                        $("#wishlist .totalCalculated").html(data.total_price);
                        $("#wishlist .wishlist_details").html(data.cart_details);
                    }
            }) 
            e.preventDefault();
    });
</script>
<?php exit;?>
