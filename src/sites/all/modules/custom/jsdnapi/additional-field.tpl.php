<script>
  var serviceType ='<?php echo $service_type;?>';
</script>

<?php
    global $language;
    global $user;
    global $_domain;
    $domain_is_store = domain_conf_variable_get($_domain['domain_id'], 'domain_is_store');
    $unit=$variables['unit'];
    $datamessage=$variables['message'];
    $cmsMenu = json_decode($_SESSION['MenuJSON']);
    $isProxied = json_decode($_SESSION['MenuJSON'])->profile->isProxied;
    $userRole = json_decode($_SESSION['MenuJSON'])->profile;
    unset($_SESSION['service_details']);
    $_SESSION['service_details'] = $service_details;
    $json = json_decode($service_details);
    $totalCount = count($json->Service->offers->offerList);
    $perPage = 4;
    $onePage = false;
    /*if(!user_access('jsdn offer display') && !empty($json)) {
    ?>
    <div class="signin-msg">
    <?php print t('You need to'); ?><strong> <a class="signin" href="#" data-toggle="modal" data-target="#loginPopUp"><?php print t('Sign In'); ?></a></strong> <?php print t('to view the pricing.'); ?>
    </div>
    <?php } */
    if($totalCount <= $perPage) {
        $onePage = true;
      }
?>

<div class="col-md-12 carousel-div offer-carousel <?php echo ($onePage === true ? 'p-0' : ''); echo ($listOnly === true ? 'd-none' : '') ?>">
		<ol class="carousel-indicators">
			<?php
				if(!$onePage):
				$totalpager = ($totalCount);
				$pages = round($totalpager / $perPage);
				for($pagindex=0; $pagindex < ($pages); $pagindex++){
      ?>
					<li data-target="#myCarousel" data-slide-to="<?php echo $pagindex; ?>" <?php echo ($pagindex === 0 ? 'class="active"' : '' ); ?>></li>
				<?php
			}
			endif;
			?>
		</ol>

  <div class="carousel slide" id="myCarousel" data-ride="carousel">
    <div class="carousel-inner">
      <?php if(empty($serviceId)) {?>
        <div class="item active">
          <div class="single-item <?php if(!user_is_logged_in()){?>not-loged-in2<?php }?>">
            <h2><?php print $serviceName; ?></h2>
            <a href='/cms/<?php echo $language->language;?>/content/enquire?name=<?php echo $serviceName;?>' class="enquireButton"><?php print t('Enquire'); ?></a>
          </div>
        </div>

      <?php } elseif ($service_type=='IaaS') {
    for($i=0; $i < count($json->Service->offers->offerList); $i++){
    $offname=$json->Service->offers->offerList[$i]->name;
    $offdescription_iaas=$json->Service->offers->offerList[$i]->description;
    $offercode=$json->Service->offers->offerList[$i]->code;
    $dataMatrix=$json->Service->offers->offerList[$i]->dataMatrix;
    $serviceAssignedToUser = $json->Service->serviceAssignedToUser;
    $noOfLicenseAvailable = $json->Service->offers->offerList[$i]->noOfLicenseAvailable;

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
         $priceId="<a href='#' class='message-popup launch-button' plandiv='message-div' title='Alert' rel='width:900;resizable:false;position:[center,60];'>".t("Launch")."</a><div style='display:none' id='message-div-content'>".$message."</div>";
      }else{
        $priceId="<a class='launch-button' href='".$jsdnDeepLink."'>".t("Launch")."</a>";
      }
    }else{
        $priceId="<a class='launch-button' href='".$jsdnDeepLink."'>".t("Launch")."</a>";
    }
	if(!user_is_logged_in()){
		$priceId="<a class='launch-button ordersignin' offercode='".$offercode."' dlink='".$jsdnDeepLink."' href='#'>".t("Launch")."</a>";
	}
	/*if(in_array('end user', $user->roles) && $serviceAssignedToUser == false && $noOfLicenseAvailable == 0){
         $priceId = "<a href='#' class='cart-button request' offercode='".$offercode."' offername='".$offname."'>".t("Request")."</a>";
    }*/
      } ?>
    <div class="single-item <?php if(!user_is_logged_in()){?>not-loged-in2<?php }?>">
      <h2><?php print $offname; ?></h2>
      <p class="offer_description mb-0"><?php print $offdescription_iaas; ?></p>
      <?php if(user_access('jsdn offer display')){  ?>
        <?php  print $priceId;?>
      <?php } ?>
    </div>
    <?php  }  else {

        function sort_objects_by_price($a, $b) {
          if($a->newPrice == $b->newPrice){ return 0 ; }
          return ($a->newPrice < $b->newPrice) ? -1 : 1;
        }
        // assign prices to the offerList object
        foreach($json->Service->offers->offerList as $row=>$value) {
          $json->Service->offers->offerList[$row]->newPrice = $value->priceList[0]->price->charges[0]->scaledPrice;
        }
        usort($json->Service->offers->offerList, 'sort_objects_by_price');
        //var_dump($json->Service->offers->offerList);

        for($i=0; $i < count($json->Service->offers->offerList); $i++){
          $n= $i+1;
          $priceurl = $json->Service->offers->offerList[$i]->priceList[0]->priceid;
          $offname=$json->Service->offers->offerList[$i]->name;
		  $offcode=$json->Service->offers->offerList[$i]->code;
          $offdescription=$json->Service->offers->offerList[$i]->description;
          $priceId=$json->Service->offers->offerList[i]->priceList[0]->priceid;
          $serviceTerm = $json->Service->offers->offerList[$i]->termInfo;
          $promotionInfo=$json->Service->offers->offerList[$i]->promotionInfo;
          $offercode=$json->Service->offers->offerList[$i]->code;
          $price_details = $json->Service->offers->offerList[$i]->priceList[0];
          $orderPlacedForMultiSubOffer = $json->Service->offers->offerList[$i]->orderPlacedForMultiSubOffer;
          $serviceAssignedToUser = $json->Service->serviceAssignedToUser;
          $noOfLicenseAvailable = $json->Service->offers->offerList[$i]->noOfLicenseAvailable;
          $term_priceid = '';
          $promoURL = $jsdn_url.'/jsdn/deeplink/addItemToCart.action?offerCode='.$offercode;
          $jsdnDeepLink = $jsdn_url.'/jsdn/deeplink/addItemToCart.action?offerCode='.$offercode.'&'.$offercode.'.fromBuy=true';
          $jsdnDeepLinkAssign = $jsdn_url.'/jsdn/endUserService/selfAssign.action?offerCode='.$offercode.'&from=endUser';

            //Below Variables for Add to Prelogin shopping cart
            $path = '/cms/jsdncart/add/nojs/' . arg(1) . '/' . $offercode;
          $pathtrial = '/cms/jsdncart/add/nojs/' . arg(1) . '/' . $offercode . '/trial';

		  if ($promotionInfo!=null){
            $customTrial=$json->Service->offers->offerList[$i]->promotionInfo->iscustomtrial;
            $trialPeriod=$json->Service->offers->offerList[$i]->promotionInfo->customtrialperiod;
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
					$priceId="<a class='cart-button basic-cart-add-to-cart use-ajax' href='".$path."'>".t("Buy Now")."</a> <a class='trialButton cart-button basic-cart-add-to-cart use-ajax' href='".$pathtrial."'>".$trialPeriod. " ".t("Day(s) Trial")."</a>";
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
					$priceId = "<a class='trialButton cart-button basic-cart-add-to-cart use-ajax' href='".$pathtrial."'>".t("Try Now")."</a>";
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
					$priceId = "<a class='cart-button basic-cart-add-to-cart use-ajax' href='".$path."'>".t("Add to Cart")."</a>";
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
                $offerPrice = $charge->scaledPriceAsStr;
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
        ?>
          <?php if($n%4 == 1){?><div class="item <?php if($n==1){?>active<?php }?>"><?php }?>
            <div class="single-item <?php if(!user_is_logged_in()){?>not-loged-in2<?php }?>">
                <h2><?php echo strlen($offname) > 80 ? substr($offname, 0, 80) . '..' : $offname; ?>
        </h2>
		<p class="offer_description mb-0"><?php echo $offdescription; ?></p>
                <?php if(user_access('jsdn offer display')){ ?>
                  <?php print $priceIddiv;?>
                  <?php  print $pricemessagediv;?>
                  <?php  print $priceId;?>
                <?php } ?>
            </div>
          <?php if($n%4 == 0){?></div><?php }?>
    <?php }
    }?>
    <?php if($n%4 == 1 || $n%4 == 2 || $n%4 == 3){?></div><?php }?>
    </div>
    <?php if($n>4):?>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"></a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next"></a>
    <?php endif; ?>
  </div>
</div>

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
  jQuery('.message-popup').click(function(e){
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

<div id="enquirePopup" class="modal fade">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      <div class="modal-body">
        <?php  $block = module_invoke('webform', 'block_view', 'client-block-112');
              print render($block['content']);?>
      </div>
    </div>
  </div>
</div>

<div id="tier-modal" class="modal fade">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class='modal-title' style='color:#fff'><?php echo t('Detailed Price Plan');?></h4>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>

<div id="message-div" class="modal fade">
  <div class="modal-dialog modal-md">
  </div>
</div>

<div id="assignPopUp" class="modal fade">
  <div class="modal-dialog modal-sd">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class='modal-title' style='color:#fff'><?php echo t('Confirm');?></h4>
      </div>
      <div class="modal-body text-center">
        <p><?php echo t('Are you sure you want to continue with Self-Assignment?');?></p>
      </div>
      <div class='modal-footer'>
        <a class='btn btn-default btn-primary popupaction' href='#' type='continue'><?php echo t('Confirm');?></a>
        <span class='btn btn-default' data-dismiss='modal'><?php echo t('Cancel');?></span>
      </div>
    </div>
  </div>
</div>

<div id="unassignPopUp" class="modal fade">
  <div class="modal-dialog modal-sd">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class='modal-title' style='color:#fff'><?php echo t('Alert');?></h4>
      </div>
      <div class="modal-body text-center">
        <p><?php echo t('You are already subscribed to this service. If you wish to subscribe to another offer of the same service, you need to unassign the existing service offer.');?></p>
      </div>
      <div class='modal-footer'>
        <span class='btn btn-default' data-dismiss='modal'><?php echo t('OK');?></span>
      </div>
    </div>
  </div>
</div>

<div id="requestPopUp" class="modal fade">
  <div class="modal-dialog modal-sd">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class='modal-title' style='color:#fff'><?php echo t('Reason for Request');?></h4>
      </div>
      <div class="modal-body">
        <div><?php echo t('Kindly specify the reason for request.');?></div>
        <div>
          <label><span class="required">*</span><?php echo t('Reason:');?></label>
          <form id="requestAction">
            <input type="hidden" value="" name="offercode" class="offercode" />
            <input type="hidden" value="" name="offername" class="offername" />
            <textarea name="requestComment" minlength="6" maxlength="1200"></textarea>
          </form>
        </div>
      </div>
      <div class='modal-footer'>
        <a class='btn btn-default btn-primary request-action' href='#' type='continue'><?php echo t('Confirm');?></a>
        <span class='btn btn-default' data-dismiss='modal'><?php echo t('Cancel');?></span>
      </div>
    </div>
  </div>
</div>

<div id="cart-modal" class="modal fade">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class='modal-title' style='color:#fff'><?php echo t('Service Dependancy Alert');?></h4>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>

<div style='display:none' id='hservicecode'>
  <input type="text" id='orderservice' value="">
</div>

<script type="text/javascript">
jQuery( document ).ready(function() {
	var maxHeight = 0;
	jQuery(".offer-carousel .item p.offer_description").each(function(){
		if (jQuery(this).height() > maxHeight) { maxHeight = jQuery(this).height(); }
	});
	jQuery(".offer-carousel .item p.offer_description").height(maxHeight);

	var maxHeight1 = 0;
	jQuery(".offer-carousel .item h2").each(function(){
		if (jQuery(this).height() > maxHeight1) { maxHeight1 = jQuery(this).height(); }
	});
	jQuery(".offer-carousel .item h2").height(maxHeight1);

});

function validate(){
        var sList = {};
        var sItems = "";
        var fItems = "";
        var i = 0;
        var orDependent = 0;
        jQuery('.error').remove();
        jQuery('#cart-modal ul').each(function () {
          var sCount = 0;
          jQuery(this).find("li input[type=checkbox]").each(function(){
            if(jQuery(this).hasClass('or_dependent')){
                if(this.checked){
                    orDependent = orDependent+1;
                }
            }else{
               orDependent = -1;
            }
            if(this.checked){
              sCount = sCount+1;
              sItems += "~"+this.value;
              fItems += "&"+this.value+".fromBuy=true";
            }
            sList[i] = sCount;
          })
            if(sList[i] == 0){
                jQuery(this).after('<span class="error" style="float: left;width: 100%;text-align: left;"><?php echo t("Please Select Any One Service");?></span>');
            }

          i = i+1;
        });
        if(orDependent == 0){
            jQuery('.error').remove();
            jQuery('a.popupproceed').before('<span class="error" style="float: left;width: 100%;text-align: left;margin-bottom:20px"><?php echo t("Please Select Any One Service");?></span>');
        }else if(orDependent > 0){
           jQuery('.error').remove();
        }
        if(jQuery(".error").length == 0) {
          var offercode = jQuery('.popupproceed').attr('rel');
          var isTrial = jQuery('.popupproceed').attr('trial');
		  if (isTrial=='true'){
			var jsdnDeepLink = jsdnURL +'/jsdn/deeplink/addItemToCart.action?offerCode='+offercode+sItems+fItems;
		  }
		  else{
			var jsdnDeepLink = jsdnURL +'/jsdn/deeplink/addItemToCart.action?offerCode='+offercode+sItems+"&"+offercode+'.fromBuy=true'+fItems;
		  }
          window.location= jsdnDeepLink;
        }
    }
</script>
