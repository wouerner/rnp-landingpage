<?php
define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT'].'/cms/');
require_once DRUPAL_ROOT . 'includes/bootstrap.inc';
// Bootstrap Drupal at the phase that you need
drupal_bootstrap(DRUPAL_BOOTSTRAP_SESSION);

ini_set('memory_limit', '512M');
ini_set('max_execution_time', 1200); 
define('ROOT_PATH_RDS_AWS', './json/vm/aws/');
define('ROOT_PATH_RDS_AZURE', './json/vm/azure/');
define('ROOT_PATH_RDS_VIVO', './json/vm/vivo/');
define('ROOT_PATH_RDS_MAPPING', './json/vm/');
define('ROOT_PATH_INDEX', './json/');



$region = $_POST['region'] ? $_POST['region'] : 'US East 1';
$lb_type = $_POST['lb_type']? $_POST['lb_type'] : 'Load Balancer-Network';


$mapping_filename = "country_mapping.json";
$mapping_file = fopen(ROOT_PATH_INDEX.$mapping_filename, "r");
$output = fread($mapping_file,filesize(ROOT_PATH_INDEX.$mapping_filename));
$output_json = json_decode($output);
$countries = $output_json->country_mapping;
$country_codes = array();
foreach ($countries as $key=>$country) {
    if(strtoupper($key) == strtoupper($region)){
        $region_aws = $country->AWS;
        //$region_google_cloud = $country->Google_Cloud;
        $region_azure = $country->Azure;
        $region_vivo = $country->Vivo;
        break;
    }
}

$rate_conversion_aws = $_SESSION['rate_conversion_aws'];
$rate_conversion_google_cloud = $_SESSION['rate_conversion_google_cloud'];
$rate_conversion_azure = $_SESSION['rate_conversion_azure'];
$rate_conversion_vivo = $_SESSION['rate_conversion_vivo'];


// AWS ARRAY SORT START //
$data_aws_final =  array();
$filename = $region_aws.".json";
if (file_exists(ROOT_PATH_RDS_AWS.$filename)) {
	$myfile = fopen(ROOT_PATH_RDS_AWS.$filename, "r");
	$output = fread($myfile,filesize(ROOT_PATH_RDS_AWS.$filename));
	fclose($myfile);
	$json = json_decode($output);
	$products = $json->products;
	$data = array();
	foreach ($products as $key=>$product) {
            if($product->productFamily == $lb_type){
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
                                                                                $product->unit = $rateCode->unit;
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
	$data = array();
	foreach ($data_aws as $key=>$aws) {
            $data['sku'] = $aws->sku;
            $data['instance_type'] = $aws->attributes->groupDescription;
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

            $data['price_unit'] = $aws->unit;
            
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


// AZURE ARRAY SORT START //
$data_azure_final =  array();
$azure_filename = "pricelist_azure_elb.json";
if (file_exists(ROOT_PATH_RDS_AZURE.$azure_filename)) {
    $azure_file = fopen(ROOT_PATH_RDS_AZURE.$azure_filename, "r");
    $azure_output = fread($azure_file,filesize(ROOT_PATH_RDS_AZURE.$azure_filename));
    $azure_json = json_decode($azure_output);
    $azure_products = $azure_json->azure_price_list;
    $data_azure= array();

    foreach ($azure_products as $key=>$azure_product) {
        $azure_data = array();
        foreach ($azure_product as $key=>$azure) {
            $azure_data['sku'] = 11111111;
            $azure_data['instance_type'] = $key;
            if($rate_conversion_azure['currency_conversion_required']){
                $exhange_rate = $rate_conversion_azure['exhange_rate'];
                $azure_price = $azure->Data_Processed;
                $azure_price = $azure_price*$exhange_rate;
                $azure_data['price'] = round($azure_price, 3);
            }else{
                $azure_data['price'] = round($azure->Data_Processed, 3);
            }
            
            if($rate_conversion_azure['currency_conversion_required']){
                $azure_data['currency_symbol'] = $rate_conversion_azure['domain_currency'];
            }else{
                $azure_data['currency_symbol'] = '$';
            }

            $azure_data['price_unit'] = $azure->Data_processed_Unit;
            $azure_data['Additional_rule'] = $azure->Additional_rule;
            $azure_data['First_5_rules'] = $azure->First_5_rules;
            
            $azure_data['type'] = 'azure';
            $data_azure_final[] = $azure_data;
        }
    }
}
// AZURE ARRAY SORT COMPLETE //

// VIVO ARRAY SORT START //
$data_vivo_final =  array();
$vivo_filename = "voc-prices-v1.json";
if (file_exists(ROOT_PATH_RDS_VIVO.$vivo_filename)) {
    $vivo_file = fopen(ROOT_PATH_RDS_VIVO.$vivo_filename, "r");
    $vivo_output = fread($vivo_file,filesize(ROOT_PATH_RDS_VIVO.$vivo_filename));
    $vivo_json = json_decode($vivo_output);
    $data_vivo = array();
    foreach ($vivo_json as $key=>$vivo_product) {
        if(isset($vivo_product->specification)){
            if(in_array($vivo_product->specification, array('ELB public', 'ELB private'))){
                $data_vivo[$key] = $vivo_product;
            }
        }
    }

    foreach ($data_vivo as $key=>$vivo) {
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
            $vivo_data['sku'] = $vivo->{'productid'};
            $vivo_data['instance_type'] = $vivo->{'productname'};
            $vivo_data['productId'] = $vivo->{'productid'};
            $vivo_data['price_unit'] = 'Hrs';
            $vivo_data['type'] = 'vivo';
            $data_vivo_final[] = $vivo_data;
    }
}
// VIVO ARRAY SORT COMPLETE //


$data_final = array_merge($data_azure_final, $data_aws_final, $data_vivo_final);

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

if($data_product["type"] == 'aws' || $data_product["type"] == 'azure'){
    $sku = trim(str_replace(' ', '-', $data_product['sku']));
}
$sku = $sku.'-'.trim(str_replace(' ', '-', $region)).'-'.trim(str_replace(' ', '-', $lb_type));

$output .='<p style="width: 100%;" class="margin-0 bold padding-top10 list_description"><span class="instanceType">'. $data_product["instance_type"].'</span></p>'; 
$output .='<div style="min-height: 0px;" class="inside_p" id='.$sku.'>';
if($data_product["type"] == 'azure'){
    $output .='<p class="margin-0 padding-top10 list_description">First 5 Rules : '.$data_product["First_5_rules"].'/hour</p><p data-v-47d9a0be="" class="margin-0 list_description">Additional Rules : '.$data_product["Additional_rule"].'/hour</p>';
}
$output .='</div> <p class="price"><span class="priceText">'.$data_product["currency_symbol"].''.$data_product["price"].'<span class="hour">/'.$data_product["price_unit"].'</span></span>';
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
}
$price = $data_product["price"];
$product_name = $data_product["instance_type"];
if(isset($data_product['price_unit'])){
    $price_unit = $data_product['price_unit'];
}
$product_type = 'ELB';
$output .='<div class="addcart"><form class="form-item-lbs" method="POST" >
              <p class="formlink">
                <input type="hidden" name="sku" value="'.$sku.'">
                <input type="hidden" name="product_type" value="'.$product_type.'">    
                <input type="hidden" name="product_name" value="'.$product_name.'">
                <input type="hidden" name="product_conf" value="'.$price_unit.'">
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
    $(".form-item-lbs").on("submit",function(e){
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
