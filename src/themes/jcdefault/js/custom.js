document.addEventListener("contextmenu", function(e){
    e.preventDefault();
}, false);

jQuery( document ).ready(function() {
	jQuery('#ajax-facets-selectbox-field-category option[value="0"]').text(''+Drupal.t("SELECT CATEGORY")+'');
	jQuery('#ajax-facets-selectbox-field-provider option[value="0"]').text(''+Drupal.t("SELECT PROVIDER")+'');
});

jQuery(function(){

		if(jQuery('#edit-field-service-type-tid-all').length){
			jQuery('#edit-field-service-type-tid-all').addClass('selected');
		}
		jQuery('.loginPopup').find('a').attr({'data-toggle':"modal",'data-target':"#loginPopUp"});
		if(jQuery('.owl-wrapper').length){
			jQuery('.owl-wrapper .owl-item').css({"width":(jQuery('.owl-wrapper').width()/(jQuery('.owl-wrapper .owl-item').length*2))	});
		}
        jQuery(document).on("click", ".view-offer", function(){
			jQuery('.servicesGrid').append('<div class="ajax-progress ajax-progress-throbber"><div class="throbber">&nbsp;</div></div>');
			var serviceId = jQuery(this).attr('id');
			jQuery.ajax({  
				type: "POST",  
				url: '/cms/popup/offers',
				data: {id: serviceId},
			success: function(a) {
				jQuery('.ajax-progress').remove();
				jQuery('#offer'+serviceId).remove();
				jQuery('.servicesGrid').append(a);
				jQuery('#offer'+serviceId).modal('show');
			},
			error: function(a) {

			}
			});
        })
		jQuery('.user_login_form_reset_password a').click(function(e){
			e.preventDefault();
			jQuery('#loginPopup').hide();
			showForgotPassword();
		})
		jQuery('.enquireButton').click(function(e){
			e.preventDefault();
			jQuery('.enquire-message span').html('"'+(jQuery(this).attr('href').split('=')[1])+'"');
			jQuery('#enquirePopup').modal('show');
		})
		jQuery('.message-popup').click(function(e){
			e.preventDefault();
			jQuery('#message-div').modal('show');
		})

		jQuery(document).hide().ajaxSend(function(event, jqxhr, settings) {
	        if((settings.url).search("ajax_facets/refresh") > 0 ){
	        	jQuery('.view').append('<div class="ajax-progress ajax-progress-throbber"><div class="throbber">&nbsp;</div></div>');
	        }
	    	}).ajaxComplete(function(event, jqxhr, settings) {
	        if((settings.url).search("ajax_facets/refresh") > 0 ){
	        	jQuery('.ajax-progress').remove();
				jQuery('#ajax-facets-selectbox-field-category option[value="0"]').text(''+Drupal.t("SELECT CATEGORY")+'');
				jQuery('#ajax-facets-selectbox-field-provider option[value="0"]').text(''+Drupal.t("SELECT PROVIDER")+'');
	        }
    	})
    


})
function showForgotPassword()
{
	  var forgotURL=jsdnURL+'/jsdn/users/showForgotPassword.action?from=cms';
    jQuery('#forgotPopup').remove();
    jQuery("#mainWrapper").append('<div id="forgotPopup" class="modal fade"><div class="modal-dialog modal-md"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">'+Drupal.t('Forgot Password')+'</h4></div><div class="modal-body"><iframe width="100%" height="360" frameborder="0" id="ContentIframe" src="'+forgotURL+'"></iframe></div></div></div></div>');
    jQuery('.modal').modal('hide');
    jQuery('#forgotPopup').modal('show');

	
}
function openHelp(el)
{
	var helpurl=jQuery(el).attr("url");
	if(cmsLanCode=='en'){languageCode='en_US'}
  else if(cmsLanCode=='pt-br'){languageCode='pt_PT'}
	else{languageCode=cmsLanCode+'_'+cmsLanCode.toUpperCase();}
	if (isCmsloggedin=='true'){
		var URL = jsdnHelpUrl;
		URL = URL.replace('index.html',"");
		URL = URL.replace(/language_code/g, languageCode);
		URL = URL+helpurl;
	}
	window.open(URL, 'helpwindow','width=1000,height=500,toolbar=1,resizable=1,scrollbars=1');
}	
