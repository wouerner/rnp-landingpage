<?php
define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT'].'/cms/');
require_once DRUPAL_ROOT . 'includes/bootstrap.inc';
// Bootstrap Drupal at the phase that you need
drupal_bootstrap(DRUPAL_BOOTSTRAP_SESSION);

ini_set('memory_limit', '512M');
ini_set('max_execution_time', 1200); 
define('ROOT_PATH_STORAGE_AWS', './json/storage/aws/');
define('ROOT_PATH_STORAGE_AZURE', './json/storage/azure/');
define('ROOT_PATH_RDS_GOOGLE', './json/storage/google/');
define('ROOT_PATH_STORAGE_MAPPING', './json/storage/');
define('ROOT_PATH_INDEX', './json/');

$region = $_POST['region'] ? $_POST['region'] : 'US East 1';
$storage = $_POST['storage'] ? $_POST['storage'] : 1;
$transfer = $_POST['transfer'] ? $_POST['transfer'] : 1;
$get_request = $_POST['get_request']? $_POST['get_request'] : 10000;
$post_request = $_POST['post_request']? $_POST['post_request'] : 1000;
$storage_family_type = 'Storage';
$transfer_family_type = "Data Transfer";
$request_family_type = "API Request";
$request_Post_type = "PUT/COPY/POST API Request";
$request_Get_type = "GET and all other requests API Request";
 
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
        break;
    }
}

$rate_conversion_aws = $_SESSION['rate_conversion_aws'];
$rate_conversion_google_cloud = $_SESSION['rate_conversion_google_cloud'];
$rate_conversion_azure = $_SESSION['rate_conversion_azure'];
$rate_conversion_vivo = $_SESSION['rate_conversion_vivo'];


// AWS ARRAY SORT START //
$data_aws_final =  array();
$data_aws =  array();
$filename = $region_aws.".json";
if (file_exists(ROOT_PATH_STORAGE_AWS.$filename)) {
	$myfile = fopen(ROOT_PATH_STORAGE_AWS.$filename, "r");
	$output = fread($myfile,filesize(ROOT_PATH_STORAGE_AWS.$filename));
	fclose($myfile);
	$json = json_decode($output);
	$products = $json->products;
	$data = array();
	foreach ($products as $key=>$product) {
            if(($product->productFamily == $storage_family_type) && ($product->attributes->storageClass == 'General Purpose')){
                $price_list = $json->terms->OnDemand;
                foreach ($price_list as $key_price=>$price) {
                    if($key_price == $key){
                        foreach ($price as $key_offer=>$price_offer) {
                            if (is_array($price_offer) || is_object($price_offer)){
                                foreach ($price_offer as $key_priceDimensions=>$priceDimensions) {
                                    if (is_array($priceDimensions) || is_object($priceDimensions)){
                                        foreach ($priceDimensions as $key_rateCode=>$rateCode) {
                                            $beginRange =  $rateCode->beginRange; 
                                            if (is_array($rateCode) || is_object($rateCode)){
                                                $product->pricePerUnit[$beginRange] = $rateCode->pricePerUnit->USD;
                                                $product->unit = $rateCode->unit;
                                                krsort($product->pricePerUnit);
                                            }
                                        }
                                        $data_aws['sku'] = $product->sku;
                                        $data_aws['instance_type'] = $product->attributes->servicename;
                                        $data_aws['priceTotalStorage'] = calculatePrice($storage, $product->pricePerUnit);
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if(($product->productFamily == $transfer_family_type) && ($product->attributes->transferType == 'AWS Outbound')){
                $product->pricePerUnit = array();
                $price_list = $json->terms->OnDemand;
                foreach ($price_list as $key_price=>$price) {
                    if($key_price == $key){
                        foreach ($price as $key_offer=>$price_offer) {
                            if (is_array($price_offer) || is_object($price_offer)){
                                foreach ($price_offer as $key_priceDimensions=>$priceDimensions) {
                                    if (is_array($priceDimensions) || is_object($priceDimensions)){
                                        foreach ($priceDimensions as $key_rateCode=>$rateCode) {
                                                $beginRange =  $rateCode->beginRange; 
                                                if (is_array($rateCode) || is_object($rateCode)){
                                                        $product->pricePerUnit[$beginRange] = $rateCode->pricePerUnit->USD;
                                                        $product->unit = $rateCode->unit;
                                                        krsort($product->pricePerUnit);
                                                }
                                        }
                                        $data_aws['priceTotalTransfer'] = calculatePrice($transfer, $product->pricePerUnit);
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if(($product->productFamily == $request_family_type) && (strpos($product->attributes->usagetype,"Requests-Tier2") > -1)){
                $product->pricePerUnit = array();
                $price_list = $json->terms->OnDemand;
                foreach ($price_list as $key_price=>$price) {
                    if($key_price == $key){
                        foreach ($price as $key_offer=>$price_offer) {
                            if (is_array($price_offer) || is_object($price_offer)){
                                foreach ($price_offer as $key_priceDimensions=>$priceDimensions) {
                                    if (is_array($priceDimensions) || is_object($priceDimensions)){
                                        foreach ($priceDimensions as $key_rateCode=>$rateCode) { 
                                            if (is_array($rateCode) || is_object($rateCode)){
                                                $data_aws['priceTotalGetRequest'] = calculatePriceGetAWSRequest($get_request, $rateCode->pricePerUnit->USD);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if(($product->productFamily == $request_family_type) && (strpos($product->attributes->usagetype,"Requests-Tier1") > -1)){
                $product->pricePerUnit = array();
                $price_list = $json->terms->OnDemand;
                foreach ($price_list as $key_price=>$price) {
                    if($key_price == $key){
                        foreach ($price as $key_offer=>$price_offer) {
                            if (is_array($price_offer) || is_object($price_offer)){
                                foreach ($price_offer as $key_priceDimensions=>$priceDimensions) {
                                    if (is_array($priceDimensions) || is_object($priceDimensions)){
                                        foreach ($priceDimensions as $key_rateCode=>$rateCode) { 
                                            if (is_array($rateCode) || is_object($rateCode)){
                                                $data_aws['priceTotalPutRequest'] = calculatePricePostAWSRequest($post_request, $rateCode->pricePerUnit->USD);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
	}
	$data = array();
        $data['sku'] = $data_aws['sku'];
        $data['instance_type'] = $data_aws['instance_type'];
        $data['totalStoragePrice'] = $data_aws['priceTotalStorage'];
        $data['totalTransferPrice'] = $data_aws['priceTotalTransfer'];
        $data['totalGetRequestPrice'] = $data_aws['priceTotalGetRequest'];
        $data['totalPutRequestPrice'] = $data_aws['priceTotalPutRequest'];
        $data['price'] = round($data_aws['priceTotalStorage'], 3) + round($data_aws['priceTotalTransfer'], 3) + round($data_aws['priceTotalGetRequest'], 3) + round($data_aws['priceTotalPutRequest'], 3);
        $data['price_unit'] = 'month';
        
        if($rate_conversion_aws['currency_conversion_required']){
            $exhange_rate = $rate_conversion_aws['exhange_rate'];
            $aws_price = $data['price']*$exhange_rate;
            $data['price'] = round($aws_price, 3);
            $data['totalStoragePrice'] = round($data_aws['priceTotalStorage']*$exhange_rate, 3);
            $data['totalTransferPrice'] = round($data_aws['priceTotalTransfer']*$exhange_rate, 3);
            $data['totalGetRequestPrice'] = round($data_aws['priceTotalGetRequest']*$exhange_rate, 3);
            $data['totalPutRequestPrice'] = round($data_aws['priceTotalPutRequest']*$exhange_rate, 3);
        }
        
        if($rate_conversion_aws['currency_conversion_required']){
            $data['currency_symbol'] = $rate_conversion_aws['domain_currency'];
        }else{
            $data['currency_symbol'] = '$';
        }

        if(isset($aws->reserved_price_list)){
            $data['reserved_price_list'] = $aws->reserved_price_list;
        }
        else{
            $data['reserved_price_list'] = array();
        }
        $data['type'] = 'aws';
        $data_aws_final[] = $data;
}


// AZURE ARRAY SORT START //
$data_azure_final =  array();
$azure_filename = "pricelist_azure_storage.json";

if (file_exists(ROOT_PATH_STORAGE_AZURE.$azure_filename)) {
    $azure_file = fopen(ROOT_PATH_STORAGE_AZURE.$azure_filename, "r");
    $azure_output = fread($azure_file,filesize(ROOT_PATH_STORAGE_AZURE.$azure_filename));
    $azure_json = json_decode($azure_output);
    $azure_products = $azure_json->products;
    $data_azure= array();
    foreach ($azure_products as $key=>$azure_product) {
        if ($region_azure === $key){
            foreach ($azure_product as $key=>$product) {
                if($product->productFamily == $storage_family_type){
                    $price_list = $product->priceDimensions;
                    $product->pricePerUnit = array();
                    foreach ($price_list as $key_rateCode=>$rateCode) {
                        $beginRange =  $rateCode->beginRange; 
                        if (is_array($rateCode) || is_object($rateCode)){
                            $product->pricePerUnit[$beginRange] = $rateCode->pricePerUnit->USD;
                            $product->unit = $rateCode->unit;
                            krsort($product->pricePerUnit);
                        }
                    }
                    $data_azure['priceTotalStorage'] = calculatePrice($storage, $product->pricePerUnit);
                }
                if($product->productFamily == $transfer_family_type){
                    $price_list = $product->priceDimensions;
                    $product->pricePerUnit = array();
                    foreach ($price_list as $key_rateCode=>$rateCode) {
                        $beginRange =  $rateCode->beginRange; 
                        if (is_array($rateCode) || is_object($rateCode)){
                            $product->pricePerUnit[$beginRange] = $rateCode->pricePerUnit->USD;
                            $product->unit = $rateCode->unit;
                            krsort($product->pricePerUnit);
                        }
                    }
                    $data_azure['priceTotalTransfer'] = calculatePrice($transfer, $product->pricePerUnit);
                }
                if($product->productFamily == $request_Post_type){
                    $price_list = $product->priceDimensions;
                    foreach ($price_list as $key_rateCode=>$rateCode) {
                       $data_azure['priceTotalPutRequest'] = calculatePricePostAzureRequest($post_request, $rateCode->pricePerUnit->USD);
                    }
                }

                if($product->productFamily == $request_Get_type){
                    $price_list = $product->priceDimensions;
                    foreach ($price_list as $key_rateCode=>$rateCode) {
                       $data_azure['priceTotalGetRequest'] = calculatePriceGetAzureRequest($get_request, $rateCode->pricePerUnit->USD);
                    }
                }
            } 
            $azure_data['sku'] = 11111111;
            $azure_data['instance_type'] = $azure_json->offerCode;
            $azure_data['totalStoragePrice'] = $data_azure['priceTotalStorage'];
            $azure_data['totalTransferPrice'] = $data_azure['priceTotalTransfer'];
            $azure_data['totalGetRequestPrice'] = $data_azure['priceTotalGetRequest'];
            $azure_data['totalPutRequestPrice'] = $data_azure['priceTotalPutRequest'];
            $azure_data['price'] = round($data_azure['priceTotalStorage'], 3) + round($data_azure['priceTotalTransfer'], 3) + round($data_azure['priceTotalGetRequest'], 3) + round($data_azure['priceTotalPutRequest'], 3);
            if($rate_conversion_azure['currency_conversion_required']){
                $exhange_rate = $rate_conversion_azure['exhange_rate'];
                $azure_price = $azure_data['price']*$exhange_rate;
                $azure_data['price'] = round($azure_price, 3);
                $azure_data['totalStoragePrice'] = round($azure_data['totalStoragePrice']*$exhange_rate, 3);
                $azure_data['totalTransferPrice'] = round($azure_data['totalTransferPrice']*$exhange_rate, 3);
                $azure_data['totalGetRequestPrice'] = round($azure_data['totalGetRequestPrice']*$exhange_rate, 3);
                $azure_data['totalPutRequestPrice'] = round($azure_data['totalPutRequestPrice']*$exhange_rate, 3);
            }
            if($rate_conversion_azure['currency_conversion_required']){
                $azure_data['currency_symbol'] = $rate_conversion_azure['domain_currency'];
            }else{
                $azure_data['currency_symbol'] = '$';
            }
            $azure_data['price_unit'] = 'month';
            $azure_data['type'] = 'azure';
            $data_azure_final[] = $azure_data;
        }
        else{
            continue;
        }
    }
}


// AZURE ARRAY SORT COMPLETE //
$data_final = array_merge($data_azure_final, $data_aws_final);

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
else{
    $output .='<img src="images/azure.png" class="img" width="120" height="59">';
}

if($data_product["type"] == 'aws' || $data_product["type"] == 'azure'){
    $sku = trim(str_replace(' ', '-', $data_product['sku']));
}
$sku = $sku.'-'.trim(str_replace(' ', '-', $region)).'-'.trim(str_replace(' ', '-', $storage)).'-'.trim(str_replace(' ', '-', $transfer)).'-'.trim(str_replace(' ', '-', $get_request)).'-'.trim(str_replace(' ', '-', $post_request));

$output .='<p style="width: 100%;" class="margin-0 bold padding-top10 list_description"><span class="instanceType">'. $data_product["instance_type"].'</span></p>'; 
$output .='<div style="min-height: 0px;" class="inside_p" id='.$sku.'>';
if($data_product["type"] == 'azure' || $data_product["type"] == 'aws'){
    $output .='<p class="margin-0 padding-top10 list_description">Storage Cost: '.$data_product["currency_symbol"].''.$data_product["totalStoragePrice"].'/month</p><p data-v-47d9a0be="" class="margin-0 list_description">Transfer Out (GB): '.$data_product["currency_symbol"].''.$data_product["totalTransferPrice"].'/month</p><p data-v-47d9a0be="" class="margin-0 list_description">Get Requests: '.$data_product["currency_symbol"].''.$data_product["totalGetRequestPrice"].'</p><p data-v-47d9a0be="" class="margin-0 list_description">Put Requests: '.$data_product["currency_symbol"].''.$data_product["totalPutRequestPrice"].'</p>';
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
$product_conf = $storage.' (GB) Storage /' . $transfer.' (GB) Transfer Out  / '. $get_request . ' GET Requests / ' . $post_request . ' PUT Requests';
$product_name = $data_product["instance_type"];
if(isset($data_product['price_unit'])){
    $price_unit = $data_product['price_unit'];
}
$product_type = 'STORAGE';
$output .='<div class="addcart"><form class="form-item-storage" method="POST" >
              <p class="formlink">
                <input type="hidden" name="sku" value="'.$sku.'">
                <input type="hidden" name="product_type" value="'.$product_type.'">    
                <input type="hidden" name="product_name" value="'.$product_name.'">
                <input type="hidden" name="product_conf" value="'.$price_unit.'">
                <input type="hidden" name="product_conf" value="'.$product_conf.'">
                <input type="hidden" name="price" value="'.$price.'">
                <input type="hidden" name="totalStoragePrice" value="'.$data_product["totalStoragePrice"].'">
                <input type="hidden" name="totalTransferPrice" value="'.$data_product["totalTransferPrice"].'">
                <input type="hidden" name="totalGetRequestPrice" value="'.$data_product["totalGetRequestPrice"].'">
                <input type="hidden" name="totalPutRequestPrice" value="'.$data_product["totalPutRequestPrice"].'">
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
<?php
function calculatePrice($numberOfUnits, $prices = array()) {
    // Initialise price
    $price = 0;
    $prices = (array) $prices;
    // Loop over price categories
    foreach($prices as $categoryAmount => $categoryPrice) {

        // Calculate the numbers that fall into the category
        $amount = $numberOfUnits - $categoryAmount;

        // If units fall into the category, add to the price
        // and calculate remaining units
        if($amount > 0) {
            $price += $amount*$categoryPrice;
            $numberOfUnits -= $amount;
        }
    }

    // Return the total price
    return $price;
}
function check_an_integer_range($search_number, $beginRange, $endRange){
    if ( in_array($search_number, range($beginRange, $endRange)) ) {
        return true;
    }
    else{
        return false;
    }
}
function calculatePricePostRequest($numberOfUnits, $pricesPerUnit) {
    $numberOfUnits =  (int) (1000 * ceil($numberOfUnits/1000));
    if($numberOfUnits > 1000){
        return $pricesPerUnit*$numberOfUnits;
    }
    else{
        return 0;
    }
    
}
function calculatePriceGetRequest($numberOfUnits, $pricesPerUnit) {
    $numberOfUnits =  (int) (10000 * ceil($numberOfUnits/10000));
    if($numberOfUnits > 10000){
        return $pricesPerUnit*$numberOfUnits;
    }
    else{
        return 0;
    }
    
}
function calculatePricePostAWSRequest($numberOfUnits, $pricesPerUnit) {
    if($numberOfUnits < 250){
        return 0;
    }
    else{
        if($numberOfUnits <= 1000){
            $price = 1000*$pricesPerUnit;
            return number_format((float)$price, 3);
        }
        else{
           return number_format($pricesPerUnit*$numberOfUnits, 3);
        }
    }
    
}
function calculatePriceGetAWSRequest($numberOfUnits, $pricesPerUnit) {
    if($numberOfUnits < 250){
        return 0;
    }
    else{
        if($numberOfUnits <= 10000){
            $price = 10000*$pricesPerUnit;
            return number_format((float)$price, 3);
        }
        else{
           return number_format($pricesPerUnit*$numberOfUnits, 3);
        } 
    } 
}

function calculatePricePostAzureRequest($numberOfUnits, $pricesPerUnit) {
    if($numberOfUnits <= 1000){
        $price = 1000*$pricesPerUnit;
        return number_format((float)$price, 3);
    }
    else{
       return number_format($pricesPerUnit*$numberOfUnits, 3);
    }
    
}
function calculatePriceGetAzureRequest($numberOfUnits, $pricesPerUnit) {
    if($numberOfUnits <= 10000){
        $price = 10000*$pricesPerUnit;
        return number_format((float)$price, 3);
    }
    else{
       return number_format($pricesPerUnit*$numberOfUnits, 3);
    } 
}
?>
<script>
    $(".form-item-storage").on("submit",function(e){
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