<?php
define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT'].'/cms/');
require_once DRUPAL_ROOT . 'includes/bootstrap.inc';
// Bootstrap Drupal at the phase that you need
drupal_bootstrap(DRUPAL_BOOTSTRAP_SESSION);
drupal_bootstrap(DRUPAL_BOOTSTRAP_DATABASE);
session_start();
define('ROOT_PATH_MAPPING', './json/');
$logo = $_SESSION['logo_path'];
$logo = str_replace('cloudcompare/', '', $logo);
$footer_content = $_SESSION['footer_content'];
$mapping_filename = "country_mapping.json";
$mapping_file = fopen(ROOT_PATH_MAPPING.$mapping_filename, "r");
$output = fread($mapping_file,filesize(ROOT_PATH_MAPPING.$mapping_filename));
$output_json = json_decode($output);
$countries = $output_json->country_mapping;
$country_codes = array();
foreach ($countries as $key=>$country) {
    $country_codes[] = $key;
}

$active_class_vm = '';
$active_class_rds = '';
$active_class_elb = '';

if(($_GET['q'] == 'vm') || ($_GET['q'] == null)){
    $active_class_vm = 'class="active"';
}
elseif(($_GET['q'] == 'rds')){
    $active_class_rds = 'class="active"';
}
elseif(($_GET['q'] == 'elb')){
    $active_class_elb = 'class="active"';
}
$total = 0;
$total_qty = 0;
if(isset($_SESSION["products"]) && count($_SESSION["products"])>0){ //if we have session variable
    foreach($_SESSION["products"] as $provider_key=>$provider){ //loop though items and prepare html content
        foreach($provider as $key=>$products_type){ //loop though items and prepare html content
            foreach($products_type as $product){ //loop though items and prepare html content
                $product_price = $product["price"]; 
                $product_qty = $product["product_qty"];
                $subtotal = ($product_price * $product_qty);
                $total = ($total + $subtotal);
                $total_qty = ($total_qty + $product_qty);
            }
        }
    }
}


$rate_conversion_filename = "currency_conversion.json";
$rate_conversion_file = fopen(ROOT_PATH_MAPPING.$rate_conversion_filename, "r");
$rate_conversion_output = fread($rate_conversion_file,filesize(ROOT_PATH_MAPPING.$rate_conversion_filename));

$rate_conversion_json = json_decode($rate_conversion_output);
$stores = $rate_conversion_json->stores;
$rate_conversion_aws = array();
$rate_conversion_azure = array();
$rate_conversion_google = array();
$rate_conversion_vivo = array();
$domain_url = $_SERVER['SERVER_NAME'];
$rate_conversion = false;
foreach ($stores as $key=>$store) {
    if($domain_url == $key){
        $rate_conversion_aws['currency_conversion_required'] = $store->currency_conversion_required;
        $rate_conversion_google_cloud['currency_conversion_required'] = $store->currency_conversion_required;
        $rate_conversion_azure['currency_conversion_required'] = $store->currency_conversion_required;
        $rate_conversion_vivo['currency_conversion_required'] = $store->currency_conversion_required;
        $rate_conversion_aws['domain_currency'] = $store->domain_currency_symbol;
        $rate_conversion_google_cloud['domain_currency'] = $store->domain_currency_symbol;
        $rate_conversion_azure['domain_currency'] = $store->domain_currency_symbol;
        $rate_conversion_vivo['domain_currency'] = $store->domain_currency_symbol;
        $domain_providers = $store->domain_providers;
        foreach ($domain_providers as $key_rate=>$provider_rate) {
            if($key_rate == "aws"){
                $rate_conversion_aws['exhange_rate'] = $provider_rate;
            }
            elseif($key_rate  == "azure"){
                $rate_conversion_azure['exhange_rate'] = $provider_rate;
            }
            elseif($key_rate  == "google"){
                $rate_conversion_google_cloud['exhange_rate'] = $provider_rate;
            }
            elseif($key_rate  == "vivo"){
                $rate_conversion_vivo['exhange_rate'] = $provider_rate;
            }
        }
        
        if($store->currency_conversion_required == true){
            $rate_conversion = true;
        }
    }
}

$providers = $rate_conversion_json->providers;
if($rate_conversion){
    foreach ($providers as $key=>$provider) {
        if($provider->type == "aws"){
            $rate_conversion_aws = array_merge($rate_conversion_aws, (array) $provider);
        }
        elseif($provider->type  == "azure"){
            $rate_conversion_azure = array_merge($rate_conversion_azure, (array) $provider);
        }
        elseif($provider->type  == "google"){
              $rate_conversion_google_cloud = array_merge($rate_conversion_google_cloud, (array) $provider);
        }
        elseif($provider->type  == "vivo"){
             $rate_conversion_vivo = array_merge($rate_conversion_vivo , (array) $provider);
        }
    }
}
else{
    $rate_conversion_aws['currency_conversion_required'] = false;
    $rate_conversion_google_cloud['currency_conversion_required'] = false;
    $rate_conversion_azure['currency_conversion_required'] = false;
    $rate_conversion_vivo['currency_conversion_required'] = false;
    $rate_conversion_aws['domain_conversion'] = false;
    $rate_conversion_google_cloud['domain_conversion'] = false;
    $rate_conversion_azure['domain_conversion'] = false;
    $rate_conversion_vivo['domain_conversion'] = false;
}
$_SESSION['rate_conversion_aws'] = $rate_conversion_aws;
$_SESSION['rate_conversion_google_cloud'] = $rate_conversion_google_cloud;
$_SESSION['rate_conversion_azure'] = $rate_conversion_azure;
$_SESSION['rate_conversion_vivo'] = $rate_conversion_vivo;

if($rate_conversion_aws['currency_conversion_required']){
    $currency = $rate_conversion_aws['domain_currency'];
}else{
    $currency = "$";   
}

if( isset($_GET['download']) && !empty($_SESSION['products'] ) ){
   downloadWishlistAction($_SESSION['products'], "wishlist.csv", $currency);
}

$wishlist = shoppingCartHtmlGenerate($_SESSION['products'], $currency);
?>
<!DOCTYPE html>
<html lang="en-US">
<title>Compare Cloud Costs</title>
<head> 
<meta charset="UTF-8">
<link rel="stylesheet" href="css/ui.theme.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/jquery-ui.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/cloudcompare.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/jquery.jscrollpane.css" type="text/css" media="all" />
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/cloudcompare.js" type="text/javascript"></script>
<script src="js/wishlist.js" type="text/javascript"></script>
<script src="js/jquery.jscrollpane.min.js"></script>
<script src="js/jquery.mousewheel.js"></script>
</head> 
<script>
$(document).ready(function(){
    $('.left').height($('.right').height());
	$('.border-dark').equalHeights();
})
</script>
<body>

<div class="contaniner">
<div class="header">
    <div class="logo"><img src="<?php print $logo ?>"></div>
    <div id="product-trend-cost" class="openerwishlist">
        <div class="shopping-cart-div shopping-cart-box">
           <div class="nav">
               <div class="navLeft"><a href="#" title="" class="openerwishlist"><img src="images/wishlist.png"> <span class="totalcount"><?php echo $total_qty;?></span></a></div>
                <div class="navRight">
                    <div><span class="navCost">Estimated Price: </span><span class="navPriceText"><?php echo $currency;?><span class="totalCalculated"><?php echo sprintf("%01.2f", ($total));?></span></span></div>
                </div>
            </div>
            <div style="display:none" class="reserved_price" id="wishlist">
                <div class="wishlist_info">
                    <span class="navTotal">Total Geral: <span class="navPriceText"><?php echo $currency;?><span class="totalCalculated"><?php echo sprintf("%01.2f", ($total));?></span></span></span>
                    <div class="normal" style="float: right;"><a href="index.php?download" class="download-link" title="Export Wishlist to CSV"> Download CSV</a></div>
                </div>
                <div class="wishlist_details"><?php echo $wishlist;?></div> 
            </div>
        </div>
    </div>
</div>
<div class="header_info">
<h2>Comparing cloud costs was never so easy!!!</h2>
<span>You can now compare cloud server cost from various public cloud providers. Select the required server parameters to instantly know various offerings from different IaaS cloud providers.</span>
</div>  
	<div class="row">
            <div class="left">
                <ul class="nav">
                    <li <?php print $active_class_vm;?>><a href="index.php?q=vm" title="VM"><img src="images/icon-vm.png"/></a></li>
                    <li <?php print $active_class_rds;?>><a href="index.php?q=rds" title="Databases"><img src="images/icon-rds.png"/></a></li>
                    <li <?php print $active_class_elb;?>><a href="index.php?q=elb" title="Load Balancers"><img src="images/icon-elb.png"/></a></li>
                    <li <?php print $active_class_s3;?>><a href="index.php?q=storage" title="Storage"><img src="images/storage.png"/></a></li>
                </ul>
            </div>
            <div class="right">
		<div class="rowleft">
		<p class="margin-0 bold padding-top10 header list_description"><span>Filters</span></p>
			<div id="chart_widget5" class="jsdn_chart">
				<div class="col-md-4">
					<div class="card rounded-0 h-100 border-0 bg-transparent sidebar">
						<div class="card-block h-100 p-3">
							<div class="form-group">
								<label for="region" class=" control-label col-sm-offset-2 col-sm-2 fsize">Region</label> 
								<div class="col-sm-6 col-md-4">
								<select id="region" class=" form-control padding8 w-100">
								<?php
								foreach ($country_codes as $key=>$code) {								
								?>
								<option value="<?php echo $code;?>"><?php echo $code;?></option> 
								<?php }
								?>									
								</select>
                                                            </div> 	
                                                        </div>
                                                        <?php if(($_GET['q'] == 'vm') || ($_GET['q'] == null)){?>
							<div class="form-group">
                                                            <label for="os" class="fsize">Operating System</label> 
                                                            <select id="os" class="form-control padding8 w-100">
                                                                    <option value="Linux">Linux</option> 
                                                                    <option value="Windows">Windows</option>
                                                            </select>
							</div>
                                                        <?php }?>
                                                        <?php if(($_GET['q'] == 'rds')){?>
							<div class="form-group">
                                                            <label for="db" class="fsize">Database Engine</label> 
                                                            <select id="db" class="form-control padding8 w-100">
                                                                    <option value="PostgreSQL">PostgreSQL</option> 
                                                                    <option value="SQL Server">SQL Server</option>
                                                                    <option value="MySQL">MySQL</option>
                                                                    <option value="Oracle">Oracle</option>
                                                                    <option value="MongoDB">MongoDB</option>
                                                                    <option value="MariaDB">Maria DB</option>
                                                                    <option value="Aurora MySQL">Aurora MySQL</option>
                                                                    <!--<option value="Aurora PostgreSQL">Aurora PostgreSQL</option>-->
                                                            </select>
							</div>
                                                        <?php }?>
                                                        <?php if(($_GET['q'] == 'elb')){?>
							<div class="form-group">
                                                            <label for="lb" class="fsize">Load Balancer Type</label> 
                                                            <select id="lb" class="form-control padding8 w-100">
                                                                    <option value="Load Balancer-Network">Network Load Balancer</option>
                                                                    <option value="Load Balancer-Application">Application Load Balancer</option>
                                                                    <option value="Load Balancer">Classic Load Balancer</option>
                                                            </select>
							</div>
                                                        <?php }?>
                                                        <?php if(($_GET['q'] == 'vm') || ($_GET['q'] == 'rds') || ($_GET['q'] == null)){?>
							<div class="AppCounter">
							<div class="form-group">
                                                            <label  class="fsize" for="vcpu">CPU: <span class="small">Min:1, Max:264</span> </label>
                                                            <div class="inputBlock">
								<input id="decrease_vcpu" type='button' value='-' class='qtyminus' field='quantity' />
								<input type='text' name='quantity' id="cpuval" value='1'  class='qty' maxlength='3' />
								<input  id="increase_vcpu" type='button' value='+' class='qtyplus'  field='quantity' />
                                                            </div>
                                                        </div> 
							<div class="form-group">
								<label  class="fsize" for="vcpu">Memory (GB): <span class="small">Min:1GB, Max:3904GB</span> </label>
								<div class="inputBlock">
                                                                    <input id="decrease_memory" type='button' value='-' class='qtyminus' field='qua' />
                                                                    <input type='text' name='qua' value='1' id="memval"  class='qty' maxlength='4' />
                                                                    <input  id="increase_memory" type='button' value='+' class='qtyplus'  field='qua' />
								</div>
							</div> 
							<div class="form-group">
								<label  class="fsize" for="vcpu">Disk (GB): <span class="small">Min:1GB, Max:10,000GB</span> </label>
								<div class="inputBlock">
								<input id="decrease_disc" type='button' value='-' class='qtyminus' field='quant' />
								<input type='text' name='quant' value='1' id="discval"  class='qty'  maxlength='5' />
								<input  id="increase_disc" type='button' value='+' class='qtyplus'  field='quant' />
							</div> 
							</div> 
							</div> 
                                                        <?php }?>
                                                        <?php if(($_GET['q'] == 'storage')){?>
                                                        <div class="AppCounter">
                                                            <div class="form-group">
                                                                    <label  class="fsize" for="vcpu">Storage (GB): <span class="small">Min:1GB, Max:10TB</span> </label>
                                                                    <div class="inputBlock">
                                                                        <input id="decrease_storage" type='button' value='-' class='qtyminus' field='quant' />
                                                                        <input type='text' name='quant' value='1' id="storageval"  class='qty'  maxlength='7' step="100"/>
                                                                        <input  id="increase_storage" type='button' value='+' class='qtyplus'  field='quant' />
                                                                    </div> 
                                                            </div> 
                                                            <div class="form-group">
                                                                <label  class="fsize" for="vcpu">Transfer Out (GB): <span class="small">Min:1GB, Max:10TB</span> </label>
                                                                <div class="inputBlock">
                                                                    <input id="decrease_transfer" type='button' value='-' class='qtyminus' field='quantity' />
                                                                    <input type='text' name='quantity' id="transferval" value='1'  class='qty' maxlength='7' />
                                                                    <input  id="increase_transfer" type='button' value='+' class='qtyplus'  field='quantity' step="100"/>
                                                                </div>
                                                            </div> 
                                                            <div class="form-group">
                                                                    <label  class="fsize" for="vcpu">GET Requests (per 10000): <span class="small">Min:10k, Max:1G</span> </label>
                                                                    <div class="inputBlock">
                                                                        <input id="decrease_get" type='button' value='-' class='qtyminus' field='qua' />
                                                                        <input type='text' name='qua' value='10000' id="getval"  class='qty' maxlength='7' step="10000" />
                                                                        <input  id="increase_get" type='button' value='+' class='qtyplus'  field='qua' />
                                                                    </div>
                                                            </div>
                                                            <div class="form-group">
                                                                    <label  class="fsize" for="vcpu">PUT Requests (per 1000): <span class="small">Min:1K, Max:10M</span> </label>
                                                                    <div class="inputBlock">
                                                                        <input id="decrease_put" type='button' value='-' class='qtyminus' field='qua' />
                                                                        <input type='text' name='qua' value='1000' id="putval"  class='qty' maxlength='7' step="1000"/>
                                                                        <input  id="increase_put" type='button' value='+' class='qtyplus'  field='qua' />
                                                                    </div>
                                                            </div>
							</div> 
                                                        <?php }?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="rowmiddle">
			<div id="chart_widget1" class="chart_widget"></div>
			<div id="loaderDiv1" class="loaderDiv">loading...</div>
		</div>
            </div>
	</div>
	<div class="clear"></div>
	<div class="footer">
	<?php print $footer_content; ?>
	</div>
	
</div>
</body>
</html>
<?php
/**
 * Api function to download file as CSV
*/
function downloadWishlistAction($items, $filename = "wishlist.csv", $currency) {
    $data = array(
        'Product Type',
        'Product Name',
        'Product Configuration',
        'Provider',
        'Region',
        'Price/Hour',
        'Quantity',
    );
    $reserved_price = false;
    $fp = fopen('php://temp', 'w+');
    fprintf($fp, "\xEF\xBB\xBF");
    fputcsv($fp, $data, ',', '"');
    foreach($items as $provider_key=>$provider){ //loop though provider html content
        foreach ($provider as $key=>$item) {
            foreach ($item as $key_val=>$product) {
                if(!$product['reserved_price']){
                    $data = array(
                        'product_type' => $key,
                        'product_name' => $product['product_name'],
                        'product_config' => $product['product_conf'],
                        'provider' => $product['product_provider'],
                        'region' => $product['region'],
                        'price' => $currency.$product['price'],
                        'qty' => $product['product_qty'],
                    );
                    fputcsv($fp, $data, ',', '"');
                }
                else{
                    $reserved_price = true;
                }
            }
        }
    }
    if($reserved_price){
        $reserved_fillgap = array();
        fputcsv($fp, $reserved_fillgap, ',', '"');
        $reserved_header = array(
            'Product Type',
            'Product Name',
            'Product Configuration',
            'Provider',
            'Region',
            'Price',
            'Price Upfront',
            'Price Hourly',
            'Quantity',
        );
        fputcsv($fp, $reserved_header, ',', '"');
        foreach($items as $provider_key=>$provider){ //loop though provider html content
            foreach ($provider as $key=>$item) {
                foreach ($item as $key_val=>$product) {
                    if($product['reserved_price']){
                        $data = array(
                            'product_type' => $key,
                            'product_name' => $product['product_name'],
                            'product_config' => $product['product_conf'],
                            'provider' => $product['product_provider'],
                            'region' => $product['region'],
                            'price' => $currency.$product['price'],
                            'reserved_upfront' => '$'.$product['reserved_upfront'],
                            'reserved_hourly' => '$'.$product['reserved_hourly'],
                            'qty' => $product['product_qty'],
                        );
                        fputcsv($fp, $data, ',', '"');
                    }
                }
            }
        }
    }
    rewind($fp);
    $csvFile = stream_get_contents($fp);
    fclose($fp);
    header('Content-Encoding: UTF-8');
    header('Content-type: text/csv; charset=UTF-8');
    header('Content-Length: '.strlen($csvFile));
    header('Content-Disposition: attachment; filename='.$filename);
    exit($csvFile);
}
/**
 * generate the whishlist data
*/
function shoppingCartHtmlGenerate($products, $currency) {
    $cart_box = '<div class="col-md-1">';  
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
            $cart_box .=  '<p class="pricetotal"><span class="estimatedPriceText">Total Estimated Price</span> <b><span class="priceText">'.$currency.'<span class="totalCalculated">'. sprintf("%01.3f", ($total)).'</span></span></b></p>';
             $cart_box .= '</div>';
    }
    $cart_box .= '</div>'; 
    return $cart_box;
}
?>