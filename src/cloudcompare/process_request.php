<?php
define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT'].'/cms/');
require_once DRUPAL_ROOT . 'includes/bootstrap.inc';
// Bootstrap Drupal at the phase that you need
drupal_bootstrap(DRUPAL_BOOTSTRAP_SESSION);

ini_set('memory_limit', '512M');
ini_set ('max_execution_time', 1200); 
define('ROOT_PATH_AWS', './json/vm/aws/');
define('ROOT_PATH_AZURE', './json/vm/azure/');
define('ROOT_PATH_GOOGLE', './json/vm/google/');
define('ROOT_PATH_VIVO', './json/vm/vivo/');
define('ROOT_PATH_MAPPING', './json/vm/');
define('ROOT_PATH_INDEX', './json/');
define('CLOSEST_RANGE_CPU', 100);
define('CLOSEST_RANGE_MEMORY', 100);
define('CLOSEST_RANGE_DISC', 100);

$region = $_POST['region'] ? $_POST['region'] : 'US East 1';
$os_type = $_POST['os_type']? $_POST['os_type'] : 'Linux';
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
    if(strtoupper($key) == strtoupper($region)){
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


$config_array_google = array('vcpu'=>$vcpu_post, 'memory'=>$memory_post);
arsort($config_array_google);
arsort($config_array_google);

$data_google_final =  array();
// GOOGLE ARRAY SORT START //
$google_filename = "pricelist_google.json";
if (file_exists(ROOT_PATH_GOOGLE.$google_filename)) {
	$google_file = fopen(ROOT_PATH_GOOGLE.$google_filename, "r");
	$google_output = fread($google_file,filesize(ROOT_PATH_GOOGLE.$google_filename));
	$google_json = json_decode($google_output);
	$google_products = $google_json->gcp_price_list;
	$data_google = array();
	foreach ($google_products as $key=>$google_product) {
		if(!in_array($key, array('sustained_use_base', 'sustained_use_tiers'))){
			if (array_key_exists($region_google_cloud,$google_product)){
				$data_google[$key] = $google_product;
			}
                        elseif ($key == 'CP-COMPUTEENGINE-OS') {
                             $windows_price = $google_product->win->low;
                        }
			else{
                            continue;
			}
		}
	}
	if(!empty($data_google)){
	 //Find out the price for google cloud disc 
	 $disc_price = $data_google["CP-COMPUTEENGINE-LOCAL-SSD"]->$region_google_cloud;
	}

	foreach ($config_array_google as $key=>$config) {
		$data_google = getClosestMatchGoogle($config, $key, $data_google);
	}
	$data_google = getRangeMatch('google', $data_google, $memory_post, $vcpu_post, $disc_post);
	$google_data = array();
	
	foreach ($data_google as $key=>$google) {
		$instType = explode('-VMIMAGE-', $key);
		$google_data['vcpu'] = $google->gceu;
		if($os_type == 'Windows'){
                        if(isset($windows_price)){
                            $google_price = $windows_price + $google->$region_google_cloud;
                        }
                        else{
                            $google_price = $google->$region_google_cloud;
                        }
		}
		else{
                    if(isset($google->$region_google_cloud)){	
                        $google_price = $google->$region_google_cloud;
                    }
		}
		$disc_price = ($disc_price * ($disc_post));
		$google_price = ($disc_price + $google_price);
                if($rate_conversion_google_cloud['currency_conversion_required']){
                    $exhange_rate = $rate_conversion_google_cloud['exhange_rate'];
                    $google_price = $google_price*$exhange_rate;
                    $google_data['price'] = round($google_price, 3);
                }else{
                    $google_data['price'] = round($google_price, 3);
                }
                
                if($rate_conversion_google_cloud['currency_conversion_required']){
                    $google_data['currency_symbol'] = $rate_conversion_google_cloud['domain_currency'];
                }else{
                    $google_data['currency_symbol'] = '$';
                }
                
		$google_data['memory'] = $google->memory;
		$google_data['operatingSystem'] = '';
		$google_data['storage'] = $disc_post;
		$google_data['instance_type'] = $instType[1];
		$google_data['type'] = 'google';
		$data_google_final[] = $google_data;
	}
}
// GOOGLE ARRAY SORT COMPLETE //


$data_vivo_final =  array();
// VIVO ARRAY SORT START //
$vivo_filename = "voc-prices-v1.json";
if (file_exists(ROOT_PATH_VIVO.$vivo_filename)) {
	$vivo_file = fopen(ROOT_PATH_VIVO.$vivo_filename, "r");
	$vivo_output = fread($vivo_file,filesize(ROOT_PATH_VIVO.$vivo_filename));
	$vivo_json = json_decode($vivo_output);
	$data_vivo = array();
	foreach ($vivo_json as $key=>$vivo_product) {
            if($os_type == 'Linux'){
                $search_array = array('Linux', 'RHEL', 'Suse', 'ESXi', 'CentOS/Ubuntu','CentOS', 'Redhat' , 'Ubuntu 14.04 LTS', 'CentOS 7', 'BYOL Linux', 'SUSE _ SAP HANA', 'custom');
            }
            else{
                $search_array = array('Windows',  'custom');
            }

            if(isset($vivo_product->so)){
                if(in_array($vivo_product->so, $search_array)){
                    $data_vivo[$key] = $vivo_product;
                }
            }
            elseif(isset($vivo_product->{'baremetal-so'})){
                if(in_array($vivo_product->{'baremetal-so'}, $search_array)){
                    $data_vivo[$key] = $vivo_product;
                }
            }
	}
	
	foreach ($config_array_google as $key=>$config) {
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
		
                $vivo_data['memory'] = $vivo->{'ram-gb'};
		$vivo_data['operatingSystem'] = isset($vivo->so) ? $vivo->so : $vivo->{'baremetal-so'};
		$vivo_data['storage'] = $vivo->storage;
		$vivo_data['instance_type'] = $vivo->{'productname'};
                $vivo_data['productId'] = $vivo->{'productid'};
		$vivo_data['type'] = 'vivo';
		$data_vivo_final[] = $vivo_data;
	}
}
// VIVO ARRAY SORT COMPLETE //

// AWS ARRAY SORT START //
$data_aws_final =  array();
$filename = $region_aws.".json";
if (file_exists(ROOT_PATH_AWS.$filename)) {
	$myfile = fopen(ROOT_PATH_AWS.$filename, "r");
	$output = fread($myfile,filesize(ROOT_PATH_AWS.$filename));
	fclose($myfile);
	$json = json_decode($output);
	$products = $json->products;

	$data = array();
	foreach ($products as $key=>$product) {
		if(isset($product->attributes->operatingSystem) && ($product->attributes->operatingSystem == $os_type)){
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
            if($aws->attributes->tenancy != 'Host'){
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
		$data['memory'] = $memory[0];
		$data['operatingSystem'] = $aws->attributes->operatingSystem;
		$data['storage'] = $aws->attributes->storage;
		$data['instance_type'] = $aws->attributes->instanceType;
		$data['preinstalled'] = $aws->attributes->preInstalledSw;
		$data['license'] = $aws->attributes->licenseModel;
		$data['tenancy']=$aws->attributes->tenancy;
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
}

// AWS ARRAY SORT COMPLETE //


// AZURE ARRAY SORT START //
$data_azure_final =  array();
$azure_filename = "pricelist_azure.json";
if (file_exists(ROOT_PATH_AZURE.$azure_filename)) {
$azure_file = fopen(ROOT_PATH_AZURE.$azure_filename, "r");
$azure_output = fread($azure_file,filesize(ROOT_PATH_AZURE.$azure_filename));
$azure_json = json_decode($azure_output);
$azure_products = $azure_json->gcp_price_list;
$data_azure= array();

if($os_type == 'Windows'){
    $azure_os_type = 'win';
}
else{
    $azure_os_type = 'rhel';
}

foreach ($azure_products as $key=>$azure_product) {
    if(!in_array($key, array('sustained_use_base', 'sustained_use_tiers'))){
            if (array_key_exists($region_azure,$azure_product->$azure_os_type)){
                    $data_azure[$key] = $azure_product->$azure_os_type;
            }
            else{
                    continue;
            }
    }
}
foreach ($config_array as $key=>$config) {
    if($key == 'vcpu'){
        $data_vcpu = array();
        $data_cores = array();
        $config_vcpu = array('cores'=>$vcpu_post, 'vcpu'=>$vcpu_post);
       
        foreach ($config_vcpu as $key_vcpu=>$vcpu) {
            if($key_vcpu == 'vcpu'){
                $data_vcpu = getClosestMatchAzure($vcpu, $key_vcpu, $data_azure);
            }
            else{
                $data_cores = getClosestMatchAzure($vcpu, $key_vcpu, $data_azure);
            }
        }
        $data_azure = array_merge($data_vcpu, $data_cores);
       
    }
    else{
        $data_azure = getClosestMatchAzure($config, $key, $data_azure);

    }
}

$data_azure = getRangeMatch('azure', $data_azure,$memory_post, $vcpu_post, $disc_post);
$azure_data = array();
$data_azure_final =  array();
foreach ($data_azure as $key=>$azure) {
	$azure_data['vcpu'] = $azure->gceu;
        
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
	$azure_data['memory'] = $azure->memory;
        $azure_data['cores'] = $azure->cores;
	$azure_data['operatingSystem'] = '';
	$azure_data['storage'] = $azure->maxPdSize;
	$azure_data['instance_type'] = $key;
	$azure_data['type'] = 'azure';
	$data_azure_final[] = $azure_data;
}
}
// AZURE ARRAY SORT COMPLETE //
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
		$re_arr = array_merge($re_arr, $ebs_arr);
	}
	
   return $re_arr;
}

// FIND THE GOOGLE CLOSET VALUE //
function getClosestMatchAzure($serach, $type, $arr_search) {
	$closest = null;
	$re_arr = array();
	
	foreach ($arr_search as $key=>$item) {
		if($type === 'vcpu'){
			if(isset($item->gceu)){
				$node_search = $item->gceu;
			}
			else{
				continue;
			}
		}
                elseif($type === 'cores'){
			if(isset($item->cores)){
				$node_search = $item->cores;
			}
			else{
				continue;
			}
		}
		elseif($type === 'disc'){
			if(isset($item->maxPdSize)){
				$node_search = $item->maxPdSize;
			}
			else{
				continue;
			}
		}
		else{
			if(isset($item->memory)){
				$node_search = $item->memory;
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

// FIND THE GOOGLE CLOSET VALUE //
function getClosestMatchGoogle($serach, $type, $arr_search) {
	$closest = null;
	$re_arr = array();
	
	foreach ($arr_search as $key=>$item) {
		if($type === 'vcpu'){
			if(isset($item->gceu)){
				$node_search = $item->gceu;
			}
			else{
				continue;
			}
			
		}
		elseif($type === 'disc'){
			if(isset($item->maxPdSize)){
				$node_search = $item->maxPdSize;
			}
			else{
				continue;
			}
		}
		else{
			if(isset($item->memory)){
				$node_search = $item->memory;
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
                    $cpu = $item->attributes->vcpu;
                    $memory = $item->attributes->memory;
                    $storage = $item->attributes->storage;
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
    $output .='<img   src="images/aws.png" class="img" width="120" height="59">';
}
elseif($data_product["type"] == 'google'){
    $output .='<img   src="images/gcp.png" class="img" width="120" height="59">';
}
elseif($data_product["type"] == 'vivo'){
    $output .='<img   src="images/logo-vivo.jpg" class="img" width="120" height="59">';
}
else{
    $output .='<img   src="images/azure.png" class="img" width="120" height="59">';
}

$storage = explode(' ', $data_product['storage']);

if ($data_product['storage']=='EBS only'){
	$data_product['storage']= $data_product['storage'];
}
else if ($data_product['type']=='vivo'){
	$data_product['storage']= 'Storage: '.$data_product['storage'];
}
elseif(!empty($storage[3]) && (($storage[3] == 'SSD') || ($storage[3] == 'HDD') || ($storage[3] == 'NVMe'))){
	$data_product['storage']= $storage[0].''.$storage[1].''.$storage[2].' '.$storage[3];
	if(!empty($storage[4])){
	 $data_product['storage'].= ' '.$storage[4];
	}
}
else{
$data_product['storage']= $data_product['storage'].'GB Disk';
}

if(isset($data_product['preinstalled']) && ($data_product['license'])){
$data_product['tenancy']='/'.$data_product['tenancy'];
$data_product['preinstalled']='Pre Installed: '.$data_product['preinstalled']; 
}
else{
$data_product['license']='&nbsp;';
$data_product['preinstalled']='&nbsp;';
$data_product['tenancy']='&nbsp;';
}
$sku = trim($data_product["instance_type"]).'-'.trim(str_replace(' ', '-', $region)).'-'.trim(str_replace(' ', '-', $os_type));
if($data_product["type"] == 'aws'){
    $sku = $sku.'-'.trim(str_replace(' ', '-', $data_product['sku']));
}
elseif($data_product["type"] == 'vivo'){
    $sku = str_replace(' ', '-', $sku).'-'.$data_product['productId'];
}
$output .='<p class="margin-0 bold padding-top10 list_description"><span class="instanceType">'. $data_product["instance_type"].'' .$data_product['tenancy'].'</span></p>'; 
$output .='<div class="inside_p" id='.$sku.'><p class="margin-0 padding-top10 list_description">'. $data_product["vcpu"] .' CPU / '.$data_product["memory"].'GB RAM</p>' ;
$output .='<p class="margin-0 list_description">';
if(isset($data_product["cores"])){
   $output .= $data_product["cores"] .' Cores / ';
}
$output .= $data_product['storage'].' </p><p data-v-47d9a0be="" class="margin-0 list_description">'.$data_product['preinstalled'].'</p><p data-v-47d9a0be="" class="margin-0 list_description">'.$data_product['license'].'</p></div> <p class="price"><span class="priceText">'.$data_product["currency_symbol"].''.$data_product["price"].'<span class="hour">/hour</span></span>';

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

if($rate_conversion_aws['currency_conversion_required']){
    $exhange_rate = $rate_conversion_aws['exhange_rate'];
    $reserved_upfront = number_format($reserved_upfront*$exhange_rate,2);
    $reserved_hourly = number_format($reserved_hourly*$exhange_rate,2);	
}
$product_conf = trim($data_product["vcpu"]).' CPU /' . $data_product['storage'].' / '. $data_product["memory"].'GB RAM / '. $os_type . ' / ' . strtoupper($reservered_term) . ' / ' . $reserved->paymentoption;
$price = $reserved_hourly + $reserved_upfront;
$product_name = $data_product["instance_type"];
$product_type = 'VM';
$reserved_price = 1;
$sku = $sku.'-'.trim(str_replace(' ', '-', $reservered_term));
$offerButton ='<div class="addcartpopup"><form class="form-item" method="POST" >
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
$product_conf = trim($data_product["vcpu"]).' CPU /' . $data_product['storage'].' / '. $data_product["memory"].'GB RAM / '. $os_type;
$price = $data_product["price"];
$product_name = $data_product["instance_type"];
$product_type = 'VM';
$output .='<div class="addcart"><form class="form-item" method="POST" >
              <p class="formlink">
                <input type="hidden" name="sku" value="'.$sku.'">
                <input type="hidden" name="product_type" value="'.$product_type.'">    
                <input type="hidden" name="product_name" value="'.$product_name.'">
                <input type="hidden" name="product_conf" value="'.$product_conf.'">
                <input type="hidden" name="conf_os" value="'.$os_type.'">
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
    $(".form-item").on("submit",function(e){
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
