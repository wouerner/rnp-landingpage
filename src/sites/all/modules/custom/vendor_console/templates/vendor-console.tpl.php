<?php
global $jsdnURL;
$url = $jsdnURL."/jsdn/iaasConsole/showSSODetails.action";
?>
<div class="sso_wrapper">
	<div class="sso_img" id="sso_img_after">
        <div class="vendor_title"><?php echo t('Vendor Console');?></div>
	</div>
	<div class="sso_content">
        <div class="sso_text_wrapper"><?php echo t("SSO to Vendor Console by clicking on their respective logos below.");?> </div>
        <div class="slider_wrapper">
            <div class="anythingSlider anythingSlider-default activeSlider" style="width: 432px; height: 296px;">
                <div class="anythingWindow">
                   <iframe src="<?php echo $url; ?>"></iframe>
                </div>
            </div>
        </div>
	</div>
</div>
<script>
jQuery('.sso_wrapper .sso_img').click(function (){
    if(jQuery(this).parent('div.sso_wrapper').hasClass('open')){
        jQuery(this).parent('div.sso_wrapper').removeClass('open');
    }else{
        jQuery(this).parent('div.sso_wrapper').addClass('open');
    }
})
jQuery('.sso_content').mouseleave(function (){
    jQuery(this).parent('div.sso_wrapper').removeClass('open');
})
</script> 