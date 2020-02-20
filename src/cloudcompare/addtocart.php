<?php
define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT'].'cms/');
require_once DRUPAL_ROOT . 'includes/bootstrap.inc';
// Bootstrap Drupal at the phase that you need
drupal_bootstrap(DRUPAL_BOOTSTRAP_SESSION);
//get action string
session_start();
//Add to cart
$sku = isset($_POST['sku']) ? $_POST['sku'] : "";
$product_type = isset($_POST['product_type']) ? $_POST['product_type'] : "";
$provider = isset($_POST['provider']) ? $_POST['provider'] : "";
$product_qty=1;
$reserved_price = isset($_POST['reserved_price']) ? $_POST['reserved_price'] : 0;

if(isset($sku) && $_SERVER['REQUEST_METHOD']=='POST') {
    if(isset($_SESSION["products"])){  //if session var already exist
        if(isset($_SESSION["products"][$provider][$product_type][$sku])){ //check item exist in products array
            $product_qty = $_SESSION['products'][$provider][$product_type][$sku]['product_qty']+1;
            unset($_SESSION["products"][$provider][$product_type][$sku]); //unset old item
        }			
    }
     //Incrementing the product qty in cart
    $new_product = array('product_qty'=>$product_qty,'sku'=>$_POST['sku'],'product_conf'=>$_POST['product_conf'],'conf_os'=>$_POST['conf_os'],'price'=>$_POST['price'],'region'=>$_POST['region'],'product_name'=>$_POST['product_name'], 'product_provider'=>$_POST['provider'], 'reserved_upfront'=>$_POST['reserved_upfront'], 'reserved_hourly'=>$_POST['reserved_hourly'], 'reserved_price'=>$_POST['reserved_price']);
    $_SESSION["products"][$provider][$product_type][$sku] = $new_product;	//update products with new item array	
    $cart_box = shoppingCartHtml();
    die($cart_box); //output json 
}

//Empty All
if(isset($_GET["emptyall"]) && isset($_SESSION["products"])) {
	$_SESSION['products'] =array();
	header("Location:index.php");	
}

//Empty one by one
if(isset($_GET["remove_code"]) && isset($_SESSION["products"])){
	$product_code   = filter_var($_GET["remove_code"], FILTER_SANITIZE_STRING); //get the product code to remove
	$product_type = $_GET["product_type"];
        $provider = $_GET["provider"];
        $products = $_SESSION['products'];
	unset($products[$provider][$product_type][$product_code]);
        if(count($products[$provider][$product_type]) == 0){
            unset($products[$provider][$product_type]);
            if(count($products[$provider]) == 0){
                unset($products[$provider]);
            }
        }
	$_SESSION['products']= $products;
        $cart_box = shoppingCartHtml();
        die($cart_box); //output json 
}

//increase product by one
if(isset($_GET["add_product"]) && isset($_SESSION["products"])){
        $product_code = filter_var($_GET["add_product"], FILTER_SANITIZE_STRING); //get the product code to remove
        $product_type = $_GET["product_type"];
        $provider = $_GET["provider"];
        if(isset($_SESSION["products"])){  //if session var already exist
            if(isset($_SESSION["products"][$provider][$product_type][$product_code])){ //check item exist in products array
                   $_SESSION['products'][$provider][$product_type][$product_code]['product_qty'] = $_GET["product_qty"];
            }			
        }
        $cart_box = shoppingCartHtml();
        die($cart_box); //output json 
}


function shoppingCartHtml(){
    global $user;
    $wishlist_data = serialize($_SESSION["products"]);
    $uid = $user->uid;
    if($uid){ 
        $wishlist = jsdn_check_wishlist_data();
        if(empty($_SESSION["products"])) {
            $query = db_delete('wishlist_cloud_comparator')
                ->condition('uid', $uid);
                $wid = $query->execute();
        }  
        elseif (!empty($wishlist)) {
            $query = db_update('wishlist_cloud_comparator')
                ->fields(array('wishlist_data' => $wishlist_data, 'timestamp' => REQUEST_TIME))
                ->condition('uid', $uid);
                $wid = $query->execute();
        }
        elseif (empty($wishlist)) {
            $wid = db_insert('wishlist_cloud_comparator') 
              ->fields(array(
                'wishlist_data' => $wishlist_data,
                'uid' => $uid,
                'timestamp' => REQUEST_TIME,
              ))
              ->execute();
        }
    }
    $total = 0; 
    $qty = 0; 
    if(isset($_SESSION["products"]) && count($_SESSION["products"])>0){ //if we have session variable
        foreach($_SESSION["products"] as $provider_key=>$provider){ //loop though items and prepare html content
            foreach($provider as $key=>$products_type){ //loop though items and prepare html content
                foreach($products_type as $product){ //loop though items and prepare html content
                    $product_price = $product["price"]; 
                    $product_qty = $product["product_qty"];
                    $subtotal = ($product_price * $product_qty);
                    $total = ($total + $subtotal);
                    $qty = ($qty + $product_qty);
                }
            }
        }
        $cart_details = shoppingCartHtmlGenerate($_SESSION["products"]);
    }
    $total = sprintf("%01.3f", ($total));
    return json_encode(array('total_price'=>$total, 'count'=> $qty, 'cart_details'=> $cart_details));
}

/**
 * Api function to check whether service id exits or not
*/
function jsdn_check_wishlist_data() {
    global $user;
    $uid = $user->uid;
    $query = db_select('wishlist_cloud_comparator', 'z')
                ->fields('z', array('wishlist_data'))
                ->condition('z.uid', $uid)
                ->range(0, 1)
                ->execute();
    $result = $query->fetchObject();
    return $result->wishlist_data;
}

/**
 * generate the whishlist data
*/
function shoppingCartHtmlGenerate($products) {
    $cart_box = '<div class="col-md-1">';
    $rate_conversion_aws = $_SESSION['rate_conversion_aws'];
    if($rate_conversion_aws['currency_conversion_required']){
        $currency = $rate_conversion_aws['domain_currency'];
    }else{
        $currency = "$";   
    }
    foreach($_SESSION["products"] as $provider_key=>$provider){ //loop though provider html content
            if($provider_key == 'aws'){
                $provider_name = 'AWS CLOUD';
            }
            elseif($provider_key == 'google'){
                $provider_name = 'GOOGLE CLOUD';
            }
            elseif($provider_key == 'azure'){
                $provider_name = 'AZURE CLOUD';
            }
            elseif($provider_key == 'vivo'){
                $provider_name = 'VIVO CLOUD';
            }
            else{
                $provider_name = 'OTHER CLOUD';
            }
            $total = 0;     
            $cart_box .= '<div class="wishlist"><div class="wishlist-item">';
            $cart_box .= '<p class="margin-0 bold padding-top10 header list_description"><span>'.$provider_name.'</span></p>'; 
            $cart_box .= '<div class="wishlistWrapperScroll">';
            $cart_box .= '<div class="shopping-cart-box shopping-cart">';
            $cart_box .= '<div class="inside_p">';
            foreach($provider as $key=>$products_type){ //loop though resources html content
                $cart_box .= '<div class="product-type-header ">'.$key.'</div>';
                foreach($products_type as $product){ //loop though items and prepare html content
                    $product_code = $product["sku"];
                    $product_price = $product["price"]; 
                    $product_name = $product["product_name"]; 
                    $product_qty = $product["product_qty"];
                    $product_conf_os = $product["conf_os"];
                    $product_conf = $product["product_conf"];
                    $product_conf_region = $product["region"];
                    $product_provider = $product["product_provider"];
                    $reserved_hourly = $product["reserved_hourly"];
                    $reserved_upfront = $product["reserved_upfront"];
                    
                    //$sku = trim($product["product_name"]).'-'.trim(str_replace(' ', '-', $product["region"])).'-'.trim(str_replace(' ', '-', $product["conf_os"]));
                    $cart_box .=  '<div class="cartpwrapper">';
                    $cart_box .=  '<p class="margin-0 bold padding-top10 list_description"><span class="instanceType">'.$product_name.'</span></p>';
                    $cart_box .=  '<p class="margin-0 padding-top10 list_description"><b>Region:</b> '.$product_conf_region.'</p>';
                    if(!in_array($key, array('ELB'))){
                        $cart_box .=  '<p class="margin-0 padding-top10 list_description"><b>Configuration:</b> '.$product_conf.'</p>'; 
                    }
                    if(empty($reserved_hourly)){
                        $cart_box .=  '<p data-v-47d9a0be="" class="margin-0  list_description"><span><b>Price: </b></span><span class="productPriceText">'.$currency.''. sprintf("%01.3f", ($product_price)).'</span>';                 
                        if(in_array($key, array('ELB'))){
                            $cart_box .=  '/'.$product_conf.'</p>'; 
                        }
                        else if(in_array($key, array('STORAGE'))){
                            $cart_box .=  '/month</p>'; 
                        }
                        else{
                            $cart_box .=  '/hour</p>'; 
                        }
                    }
                    else{
                        $cart_box .=  '<p data-v-47d9a0be="" class="margin-0  list_description"><span><b>Price: </b></span><span class="productPriceText">'.$currency.''. sprintf("%01.3f", ($reserved_hourly)).'</span>';
                        $cart_box .=  '/hour';
                        $cart_box .=  '<span><b>, Upfront: </b></span><span class="productPriceText">'.$currency.''. sprintf("%01.3f", ($reserved_upfront)).'</span></p>';  
                    }

                    $cart_box .=  '<p data-v-47d9a0be="" class="margin-0 list_description"><b>Quantity:</b> <input class="wqty product-item-'.$key.'" type="number" name="price" value="'.$product_qty.'" provider-code="'.$product_provider.'" data-code="'.$product_code.'" min="1" max="15" onchange="validateFloatKeyPress(this);"></p>';
                    $cart_box .=  '<p data-v-47d9a0be="" class="margin-0 list_description"><a href="#" title="Remove" class="remove remove-item-'.$key.'" provider-code="'.$product_provider.'" data-code="'.$product_code.'"><img src="images/trash.png" width="14" height="14"/></a></p></div>';
                    $subtotal = ($product_price * $product_qty);
                    $total = ($total + $subtotal);
                    
                }
            }
            $cart_box .= '</div></div></div></div>';
            $cart_box .=  '<p class="pricetotal"><span class="estimatedPriceText">Total Estimated Price:</span> <b><span class="priceText">'.$currency.'<span class="totalCalculated">'. sprintf("%01.3f", ($total)).'</span></span></b></p>';
            $cart_box .= '</div>';
    }
    $cart_box .= '</div>'; 
    $cart_box .= '<script src="js/wishlist.js" type="text/javascript"></script>';
    return $cart_box;
}
?>