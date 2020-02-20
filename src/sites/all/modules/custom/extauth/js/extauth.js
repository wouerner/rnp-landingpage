var message;
var targetURL;
var iaasOfferCode = '';
(function( $ ) {
    $( document ).ready(function() {
        jQuery('#languageSwitch').load(function(){
            jQuery('#languageSwitch').remove();
        });
        jQuery('.loginPopup').click(function() {
            iaasOfferCode = '';
        });

        $(".form-submitajax").click(function(e){
                if($("#user-login-form").valid()){
                    $(this).after('<div class="AjaxLoading"><img src="/cms/sites/all/modules/custom/extauth/images/throbber-large.gif" /></div>');
                    e.preventDefault();
                    $( "body").append( "<div class='no-action'></div>" );
                    var username = $("#edit-name").val() ;
                    var password = $("#edit-pass").val() ;
                    var fields = {username: username, password : password};
                    
                    $.ajax({
                            type: "POST",  
                            url:'/cms/jsdnConnect/userLogin.php',
                            data: fields,
                            dataType: 'json',
                            success:function(response){
                               var jsdnURL = Drupal.settings.jsdn_common.jsdnURL;
                               message = response.message;
                               var errorMsg = response.errorMsg;
                               var userRole = response.role;
                               var cartUrl = response.cart_url;
			       var nodeURL = response.node_url;
                               var cart_count = response.cart_count;
                               var enterprisestore = response.enterprisestore;
                               if(message === 'external_login_fail'){
						var commonLoginURL = jsdnURL+"/jsdn/login/commonLogin.action?isFromCMS=true&errorMsg="+errorMsg;
				                    if (enterprisestore){location.href = commonLoginURL;}
							else{
								   if(cartCount == 0 && iaasOfferCode == ''){
										location.href = commonLoginURL;
									}
									else if(cartCount == 0 && iaasOfferCode != ''){
										commonLoginURL += "&offerCode="+iaasOfferCode+"&"+iaasOfferCode+".fromBuy=true";
										location.href = commonLoginURL;
									}
									else{
										$.ajax({
												type: "GET",  
												url:'/cms/jsdnRegisterCart',
												dataType: 'json',
												success:function(response){
														var offerstrail = response.offerstrail; 
														var offer = response.offers;
														if(cartCount !=0 && iaasOfferCode == ''){
															commonLoginURL += "&"+offer+""+offerstrail;
														}
														else{
															commonLoginURL += "&"+offer+"~"+iaasOfferCode+""+offerstrail+"&"+iaasOfferCode+".fromBuy=true";
														}
														location.href = commonLoginURL;
												}
										});
									}
                               }
			    }
                               else if(errorMsg == 'external_logged_in_successfully'){
                                    if(userRole == 'End User' && cart_count == 0 && iaasOfferCode == ''){
                                        targetURL = jsdnURL+"/jsdn/dashboard/dashboardHome.action";
                                        proceedLogin();
                                    }
                                    else if(userRole == 'End User' && cart_count == 1 && iaasOfferCode == ''){
                                        $('#loginPopup, .no-action, .modal, .modal-backdrop').hide();
                                        $('#enduser-cart-alert').modal({backdrop: 'static', keyboard: false});
                                        targetURL = jsdnURL+"/cms/"+nodeURL;
                                    }
                                    else if(userRole == 'End User' && cart_count > 1 && iaasOfferCode == ''){
                                        $('#loginPopup, .no-action, .modal, .modal-backdrop').hide();
                                        $('#enduser-cart-alert').modal({backdrop: 'static', keyboard: false});
                                        targetURL = "/jsdn/dashboard/dashboardHome.action";
                                    }
                                    else if(userRole == 'End User' && cart_count == 0 && iaasOfferCode != ''){
                                        targetURL = jsdnURL+"/jsdn/deeplink/addItemToCart.action?offerCode="+iaasOfferCode+"&"+iaasOfferCode+".fromBuy=true";
                                        proceedLogin();
                                    }
                                    else{
										if(iaasOfferCode && cart_count != 0){
                                                var result = cartUrl.split('&');
                                                var tailcartUrl = '';
                                                $.each( result, function( key, value ) {
                                                        if(key != 0){
                                                                tailcartUrl +=  "&"+value;
                                                        }
                                                });
                                                cartUrl = result[0];
                                                result = cartUrl.split('=');
                                                var baseUrl = result[0];
                                                cartUrl = result[1];
                                                if(tailcartUrl != ''){
                                                    cartUrl +=  "~"+iaasOfferCode+""+tailcartUrl+"&"+iaasOfferCode+".fromBuy=true";
                                                }
                                                else{
                                                    cartUrl +=  iaasOfferCode+"&"+iaasOfferCode+".fromBuy=true";
                                                }
                                                cartUrl = baseUrl+"="+cartUrl;
                                        }
										else if(cart_count == 0 && iaasOfferCode != ''){
											cartUrl = jsdnURL+"/jsdn/deeplink/addItemToCart.action?offerCode="+iaasOfferCode+"&"+iaasOfferCode+".fromBuy=true";
                                        }
                                        targetURL = cartUrl;									
                                        proceedLogin();
                                    }
                                    iaasOfferCode = '';
                                }
                                else{
                                    location.href = jsdnURL+"/cms/";
                                }
                            }
                    });
                }
        });
		
$(document).on('click',".enduserloginproceed",function(event){
	proceedLogin();
});

$(document).on('click',".enduserlogincancel",function(event){
	$( "body").append( "<div class='no-action'></div>" );	
	window.location.href="https://"+window.location.hostname+"/cms/user/logout";	
});    
	
	});
})( jQuery );

function proceedLogin(){
	jQuery("body").append( "<div class='no-action'></div>" );
	jQuery("#authToken").val(message); 
	jQuery("#logintoJSDN").submit();
	jQuery('#jsdnSession').load(function(){
	location.href = ""+targetURL+"";
	});
	
}
