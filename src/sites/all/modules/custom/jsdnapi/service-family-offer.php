<?php
/* die('service-family'); */
$server_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT'].'/cms/');
define("JSDN_OAUTH_HOST", $server_url);
require_once DRUPAL_ROOT . 'includes/bootstrap.inc';
// Bootstrap Drupal at the phase that you need
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
$service_type = $_SESSION['service_type'];
$filter_data = $_POST['subCategory'];
$service_details = $_SESSION['service_details'];
global $language;
$language = $_SESSION['domain_language'];
global $user;
global $_domain;
$domain_is_store = domain_conf_variable_get($_domain['domain_id'], 'domain_is_store');
$unit=$variables['unit'];
// add this message
$datamessage=$variables['message'];
$json = json_decode($service_details);
for($j=0; $j < count($json->Services->serviceList); $j++){
    if(str_replace(' ', '_', $filter_data) === str_replace(' ', '_', $json->Services->serviceList[$j]->serviceCategories->categoryList[0]->serviceSubCategories[0]->name)){
        $data->Services->serviceList[] = $json->Services->serviceList[$j];
    }
}
$json = $data;
$perPage = 4;
$onePage = false;

$totalCount = 0;
for($j=0; $j < count($json->Services->serviceList); $j++){
    $serviceList[] = $json->Services->serviceList[$j]->serviceCategories->categoryList[0]->serviceSubCategories[0]->name;
    for($i=0; $i < count($json->Services->serviceList[$j]->offers->offerList); $i++){
        $totalCount++;
    }
}
?>
<ol class="carousel-indicators">
            <?php
            if($totalCount <= $perPage) {
                $onePage = true;
            }
            if(!$onePage):
            $totalpager = ($totalCount);
            $pages = ceil($totalpager / $perPage);
            for($pagindex=0; $pagindex < ($pages); $pagindex++){
            ?>
                <li data-target="#myCarousel" data-slide-to="<?php echo $pagindex; ?>" <?php echo ($pagindex === 0 ? 'class="active"' : '' ); ?>></li>
            <?php } endif; ?>
        </ol>
<div class="carousel-inner">
<?php
if ($service_type=='IaaS'){
    $n = 0;
    for($j=0; $j < count($json->Services->serviceList); $j++){
        for($i=0; $i < count($json->Services->serviceList[$j]->offers->offerList); $i++){
            $n++;
            $offname = $json->Services->serviceList[$j]->offers->offerList[$i]->name;
            $offercode = $json->Services->serviceList[$j]->offers->offerList[$i]->code;
            $dataMatrix = $json->Services->serviceList[$j]->offers->offerList[$i]->dataMatrix;
            $serviceAssignedToUser = $json->Services->serviceList[$j]->serviceAssignedToUser;
            $noOfLicenseAvailable = $json->Services->serviceList[$j]->offers->offerList[$i]->noOfLicenseAvailable;
            if($dataMatrix){
                foreach ($dataMatrix as $key => $value) {
                  $items=$items+1;
                  if($value=="No"){
                    $dataMatrixValue=$dataMatrixValue+1;
                    $notactivated .=$key.', ';
                  }else{
                    $activated .=$key.', ';
                  }
                }
                $_SESSION['inactiveprovider']=$notactivated;
            }
            $jsdnDeepLink = $jsdn_url.'/jsdn/deeplink/addItemToCart.action?offerCode='.$offercode.'&'.$offercode.'.fromBuy=true';
            if($items!= 0){
                if(isset($notactivated) && in_array('end user', $user->roles)){
                  $message="<div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal'>&times;</button><h4 class='modal-title' style='color:#fff'>".t('Alert')."</h4></div><div class='modal-body'><p>".t('The pre-requisites required to launch the stack is yet to be configured. If you wish to notify your administrator, click on Notify Administrator. We will send a notification email to the administrator to perform the necessary actions.')."</p></div><div class='modal-footer'><input type='hidden' value='".trim($notactivated,", ")."' class='notifyItems'/><a class='btn btn-default notifyButton btn-primary' href='' offer='".$offercode."' offername='".$offname."' type='continue'>".t("Notify Administrator")."</a><span class='btn btn-default' data-dismiss='modal'>".t('Cancel')."</span></div></div>";
                  }
                  else if(($dataMatrixValue !=0) && ($dataMatrixValue !=$items) && !in_array('end user', $user->roles)){
                  $message="<div class='modal-content'><button type='button' class='close' data-dismiss='modal'>&times;</button><div class='modal-body'><p>".t('You need to activate your vendor account details to launch these services. Your account details are activated for')." <b>".trim($activated,", ")."</b>; ".t('however, your account details are not available for')." <b>".trim($notactivated,", ")."</b>. ".t('Do you want to continue?')."</p></div><div class='modal-footer'><a class='btn btn-default btn-primary popupaction' href='".$jsdnDeepLink."' offer='".$offname."' type='continue'>".t('Continue')."</a><span class='btn btn-default' data-dismiss='modal'>".t('Cancel')."</span></div></div>";
                }
                else if($dataMatrixValue == $items && !in_array('end user', $user->roles)){
                  $message="<div class='modal-content'><div class='modal-header'><button type='button' class='close' data-dismiss='modal'>&times;</button><h4 class='modal-title' style='color:#fff'>".t('Alert')."</h4></div><div class='modal-body'><p>".t('Sorry, you cannot proceed further as the Vendor account details are not available. Please click on Add Account button to add the details.')."</p></div><div class='modal-footer'><a class='btn btn-default popupaction btn-primary' href='".$jsdnDeepLink."&accountconfig=true' offer='".$offname."' type='continue'>".t("Add Account")."</a><span class='btn btn-default' data-dismiss='modal'>".t('Cancel')."</span></div></div>";
                }
                if($message){
                   $priceId="<a href='#' class='message-popup launch-button' plandiv='message-div' title='Alert' rel='width:900;resizable:false;position:[center,60];'>".t('Launch')."</a><div style='display:none' id='message-div-content'>".$message."</div>";
                }else{
                  $priceId="<a class='launch-button' href='".$jsdnDeepLink."'>".t("Launch")."</a>";
                }
            }else{
                $priceId="<a class='launch-button' href='".$jsdnDeepLink."'>".t("Launch")."</a>";
            }
            if(!user_is_logged_in()){
                $priceId="<a class='launch-button ordersignin' offercode='".$offercode."' dlink='".$jsdnDeepLink."' href='#'>".t("Launch")."</a>";
            }
            ?>
            <?php if($n%4 == 1){?><div class="item <?php if($n==1){?>active<?php }?>"><?php }?>
              <div class="single-item <?php echo str_replace(' ', '_', $json->Services->serviceList[$j]->serviceCategories->categoryList[0]->serviceSubCategories[0]->name); if(!user_is_logged_in()){?> not-loged-in2<?php }?>">
                    <h2><?php echo strlen($offname) > 80 ? substr($offname, 0, 80) . '..' : $offname; ?>  </h2>
                      <p class="offer_description mb-0"><?php echo $offdescription; ?></p>
                      <?php if(user_access('jsdn offer display')){ ?>
                            <?php  print $priceId;?>
                      <?php } ?>
              </div>
            <?php if($n%4 == 0){?></div><?php }}} ?>
            <?php if($n%4 == 1 || $n%4 == 2 || $n%4 == 3){?></div><?php }?>
            <?php if($n>4):?>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev"></a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next"></a>
            <?php endif; } else {
			for($j=0; $j < count($json->Services->serviceList); $j++){
                $offerListData = $json->Services->serviceList[$j]->offers->offerList;
                foreach($offerListData as $row=>$value) {
                        $offerList[] = $value;
                }
            }
            function sort_objects_by_price($a, $b) {
              if($a->priceList[0]->price->charges[0]->totalScaledPrice  == $b->priceList[0]->price->charges[0]->totalScaledPrice){ return 0 ; }
              return ($a->priceList[0]->price->charges[0]->totalScaledPrice <= $b->priceList[0]->price->charges[0]->totalScaledPrice) ? -1 : 1;
            }
            usort($offerList, 'sort_objects_by_price');
            $n = 0;
            foreach($offerList as $row=>$value) {
				$n++;
				$priceurl = $value->priceList[0]->priceid;
				$offname = $value->name;
				$offdescription = $value->description;
				$priceId = $value->priceList[0]->priceid;
				$serviceTerm = isset($value->termInfo) ? $value->termInfo: '';
				$promotionInfo = isset($value->promotionInfo) ? $value->promotionInfo : '';
				$offercode = $value->code;
				$price_details = $value->priceList[0];
				$orderPlacedForMultiSubOffer = isset($value->orderPlacedForMultiSubOffer) ? $value->orderPlacedForMultiSubOffer : '';
				for($j=0; $j < count($json->Services->serviceList); $j++){
					for($i=0; $i < count($json->Services->serviceList[$j]->offers->offerList); $i++){
						if($offercode == $json->Services->serviceList[$j]->offers->offerList[$i]->code){
							$serviceAssignedToUser = $json->Services->serviceList[$j]->serviceAssignedToUser;
						}
					}
				}
				$noOfLicenseAvailable = $value->noOfLicenseAvailable;
				$term_priceid = '';
                $promoURL = $jsdn_url.'/jsdn/deeplink/addItemToCart.action?offerCode='.$offercode;
                $jsdnDeepLink = $jsdn_url.'/jsdn/deeplink/addItemToCart.action?offerCode='.$offercode.'&'.$offercode.'.fromBuy=true';
                $jsdnDeepLinkAssign = $jsdn_url.'/jsdn/endUserService/selfAssign.action?offerCode='.$offercode.'&from=endUser';

                //Below Variables for Add to Prelogin shopping cart
                $path = '/cms/jsdncart/family/nojs/' . $_SESSION['node_id'] . '/' . $offercode;
                $pathtrial = '/cms/jsdncart/family/nojs/' . $_SESSION['node_id'] . '/' . $offercode . '/trial';

                if ($promotionInfo!=null){
                    $customTrial=$json->Services->serviceList[$j]->offers->offerList[$i]->promotionInfo->iscustomtrial;
                    $trialPeriod=$json->Services->serviceList[$j]->offers->offerList[$i]->promotionInfo->customtrialperiod;
                    if (!empty($customTrial)){
                        if(in_array('end user', $user->roles) && $serviceAssignedToUser == false && $noOfLicenseAvailable > 0){
                          $priceId = "<a href='".$jsdnDeepLinkAssign."' class='cart-button self-assign' >".t("Self-Assign")."</a>";
                        }elseif(in_array('end user', $user->roles) && $serviceAssignedToUser == false && $noOfLicenseAvailable == 0){
                          $priceId = "<a href='#' class='cart-button request' offercode='".$offercode."' offername='".$offname."'>".t("Request")."</a>";
                        }elseif(in_array('end user', $user->roles) && $serviceAssignedToUser == true){
                          $priceId = "<a href='' class='cart-button unassign' >".t("Self-Assign")."</a>";
                        }else{
                            //$priceId="<a href='".$jsdnDeepLink."'>".t("Buy Now")."</a> <a class='trialButton' href='".$promoURL."'>".$trialPeriod. " Day(s) Trial</a>";
                            //Service Dependency

                          if(!user_is_logged_in()){
                                $priceId="<a class='cart-button basic-cart-add-to-cart' href='".$path."'>".t("Buy Now")."</a> <a class='trialButton cart-button basic-cart-add-to-cart' href='".$pathtrial."'>".$trialPeriod. " ".t("Day(s) Trial")."</a>";
                          }
                          else{
                                $priceId="<a class='cartButton cart-button' serviceId=".$serviceId." rel='".$offercode."' name='".$offname."'>".t("Buy Now")."</a> <a class='trialButton cartButton cart-button' serviceId=".$serviceId." rel='".$offercode."' name='".$offname."'>".$trialPeriod. " ".t("Day(s) Trial"). "</a>";
                          }
                        }
                    } else if(empty($customTrial)){
                            if(in_array('end user', $user->roles) && $serviceAssignedToUser == false && $noOfLicenseAvailable > 0){
                              $priceId = "<a href='".$jsdnDeepLinkAssign."' class='cart-button self-assign' >".t("Self-Assign")."</a>";
                            }elseif(in_array('end user', $user->roles) && $serviceAssignedToUser == false && $noOfLicenseAvailable == 0){
                              $priceId = "<a href='#' class='cart-button request' offercode='".$offercode."' offername='".$offname."'>".t("Request")."</a>";
                            }elseif(in_array('end user', $user->roles) && $serviceAssignedToUser == true){
                              $priceId = "<a href='' class='cart-button unassign' >".t("Self-Assign")."</a>";
                            }else{
                              if(!user_is_logged_in()){
                                $priceId = "<a class='trialButton cart-button basic-cart-add-to-cart' href='".$pathtrial."'>".t("Try Now")."</a>";
                              }
                              else{
                                $priceId = "<a class='trialButton cartButton cart-button' serviceId=".$serviceId." rel='".$offercode."' name='".$offname."'>".t("Try Now")."</a>";
                              }
                        }
                    }
                }
                else if($orderPlacedForMultiSubOffer){
                  $orderPlacedForMultiSubOfferLink = $jsdn_url.'/jsdn/manageservice/manageServices.action?brdcrm=new&from=catalog&offerName='.urlencode($offname).'&accountconfig=true' ;
                  $message= t("Looks like you already have an existing subscription or a saved order. Clicking on 'Proceed' will redirect you to Manage Subscriptions page, where you can add additional licenses to your existing subscription. <br><br>If you already have a saved order, navigate to Manage > Orders page and complete the order.")."";
                  $priceId="<a href='#' class='cart-message-popup' title='Alert' rel='width:900;resizable:false;position:[center,60];'>".t("Add to Cart")."</a><div style='display:none' id='cart-message-div'><div class='modal-header' style='text-align:left;background:#46b4c1'><button type='button' class='close' data-dismiss='modal'>&times;</button><h4 class='modal-title' style='color:#fff'>Alert</h4></div><div class='modal-body'>".$message."</div><div class='modal-footer'><a class='popupproceed btn btn-default btn-primary' href=".$orderPlacedForMultiSubOfferLink." offer='".$offname."' type='continue' style='background:#46b4c1;color:#fff'>".t('Proceed')."</a><button class='btn btn-default' data-dismiss='modal'>".t('Cancel')."</button></div></div>";
                }
                else{
                  if(in_array('end user', $user->roles) && $serviceAssignedToUser == false && $noOfLicenseAvailable > 0){
                    $priceId = "<a href='".$jsdnDeepLinkAssign."' class='cart-button self-assign' >".t("Self-Assign")."</a>";
                  }elseif(in_array('end user', $user->roles) && $serviceAssignedToUser == false && $noOfLicenseAvailable == 0){
                    $priceId = "<a href='#' class='cart-button request' offercode='".$offercode."' offername='".$offname."'>".t("Request")."</a>";
                  }elseif(in_array('end user', $user->roles) && $serviceAssignedToUser == true){
                    $priceId = "<a href='' class='cart-button unassign' >".t("Self-Assign")."</a>";
                  }else{
                      if(!user_is_logged_in()){
                          $priceId = "<a class='cart-button basic-cart-add-to-cart' href='".$path."'>".t("Add to Cart")."</a>";
                      }
                      else{
                          $priceId = "<a class='cartButton cart-button' serviceId=".$serviceId." rel='".$offercode."' name='".$offname."'>".t("Add to Cart")."</a>";
                      }
                  }
                }
                if($serviceTerm != null){
                  $term_priceid = 'Subscription Term: '.$serviceTerm->termperiod;
                }
                // Get the price details from json
                if(user_access('jsdn offer display')){
                  if(!empty($price_details)){
                    $charge = $price_details->price->charges[0];
                    $currency = $price_details->price->currencysymbol;
                    $priceid= $price_details->price->id;
                    if($charge->tierDescription){
                      $offerPrice = $charge->tierDescription;
                      $priceIddiv = "<span class='tier-price'><a href='javascript:void(0)' style='display:block;' class='opentierwindow' plandiv='tier-".$priceid."'>".t("View Detailed Price Plan")."</a></span><div style='display:none' id='tier-".$priceid."'>".$offerPrice."</div>";
                    } else{
                      $offerPrice = $charge->totalScaledPriceAsStr;
                      $priceIddiv = "<span >".$currency." ".$offerPrice." ".$unit."</span>";
                    }
                    if($datamessage){
                      $pricemessagediv ="<span class='data-details message'>".$datamessage."</span>";
                    }
                    // Hide price for Enterprise Store End User
                    if(in_array('end user', $user->roles) && $domain_is_store){
                          $priceIddiv = "<span>&nbsp;</span>";
                          $pricemessagediv ="";
                    }
                  }
                }
                if($n%4 == 1){?>
                    <div class="item <?php if($n==1){?>active<?php }?>"><?php }?>
                        <div class="single-item <?php echo $json->Services->serviceList[$j]->code; if(!user_is_logged_in()){?> not-loged-in2<?php }?>">
                            <h2><?php echo strlen($offname) > 80 ? substr($offname, 0, 80) . '..' : $offname; ?></h2>
                            <p class="offer_description mb-0"><?php echo $offdescription; ?></p>
                            <?php if(user_access('jsdn offer display')){ ?>
                              <?php print $priceIddiv;?>
                              <?php  print $pricemessagediv;?>
                              <?php  print $priceId;?>
                            <?php } ?>
                        </div>
                <?php if($n%4 == 0){?></div><?php }} ?>
                <?php if($n%4 == 1 || $n%4 == 2 || $n%4 == 3){?></div><?php }?>
            </div>
            <?php if($n>4):?>
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev"></a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next"></a>
                <?php endif; }?>
<script type="text/javascript">
  if(jQuery(window).width() < "421"){
    jQuery('.signin-msg p').text('You need to Sign In  to view the pricing.');
  }
  jQuery('a.signin').on('click',function(e){
        e.preventDefault();
        jQuery('#loginPopUp').modal('show');
  });
  jQuery('a.ordersignin').on('click',function(e){
        e.preventDefault();
        var str = jQuery(this).attr("dlink");
        jQuery("#orderservice").val(str);
        iaasOfferCode = jQuery(this).attr("offercode");
        jQuery('#loginPopUp').modal('show');
  })
  jQuery('a.cart-message-popup').on('click',function(e){
        e.preventDefault();
        jQuery('#enquirePopup .modal-content').html(jQuery('#cart-message-div').html());
        jQuery('.modal-backdrop').remove();
    jQuery('.offer-popup').hide();
        jQuery('#enquirePopup').modal('show');
    });
  jQuery('[id^=offer]').on("hide.bs.modal", function () {
    jQuery('[id^=offer]').remove();
  });
  jQuery('.opentierwindow').on('click',function(event){
    var planDetailsDiv=jQuery(this).attr('plandiv');
    jQuery('#tier-modal .modal-body').html(jQuery('#'+planDetailsDiv+'').html());
    jQuery('#tier-modal').modal('show');
  });
  jQuery('.message-popup').on('click',function(e){
    e.preventDefault();
    jQuery('#message-div .modal-dialog').html(jQuery('#message-div-content').html());
    jQuery('.modal-backdrop').remove();
    jQuery('.offer-popup').hide();
    jQuery('#message-div').modal('show');
  })
  jQuery('.self-assign').click(function(e){
    var url = jQuery(this).attr('href');
    e.preventDefault();
    jQuery('#assignPopUp .popupaction').attr("href", url);
    jQuery('#assignPopUp').modal('show');
  })
  jQuery('.unassign').click(function(e){
        e.preventDefault();
        jQuery('#unassignPopUp').modal('show');
  })
  jQuery('.request').click(function(e){
    e.preventDefault();
    jQuery('#requestPopUp input.offercode').val(jQuery(this).attr('offercode'));
    jQuery('#requestPopUp input.offername').val(jQuery(this).attr('offername'));
  jQuery('#requestPopUp textarea').val("");
    jQuery('#requestPopUp').modal('show');
  })

jQuery('.carousel-indicators li').click(function(e) {
    jQuery('.carousel-indicators li').removeClass('active');
    jQuery(this).addClass('active');
  })


jQuery('#myCarousel').bind('slid.bs.carousel', function() {

// remove active class
jQuery('.carousel-indicators li').removeClass('active');

// get index of currently active item
var idx = jQuery('#myCarousel .item.active').index();

// select currently active item and add active class
jQuery('.carousel-indicators li:eq(' + idx + ')').addClass('active');

});
</script>
