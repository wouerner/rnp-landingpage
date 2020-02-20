(function( $ ) {
	
    jQuery(document).on("click", ".request-action", function(e){
    e.preventDefault();
    jQuery('#requestAction textarea').removeClass('errorClass');
    jQuery('p.required').remove();
    if(jQuery('#requestAction textarea').val() != "" && jQuery('#requestAction textarea').val().length >= 6){
    jQuery(this).addClass('disabled');
    jQuery('.messages').slideUp();
    jQuery.ajax({  
        type: "POST",  
        url: '/cms/popup/requestaction',
        data: {data:jQuery('form#requestAction').serialize()},
    success: function(a) {
        var out = jQuery.parseJSON(a);
        jQuery('#requestPopUp').modal('hide');
        jQuery('.request-action').removeClass('disabled');
        jQuery('#requestAction textarea').val('');
        jQuery("body").prepend('<div class="messages '+out.status+'"><h2 class="element-invisible">Status message</h2>'+out.message+'<div class="close">x</div></div>');
        jQuery("html, body").animate({ scrollTop: 0 }, "slow");
    },
    error: function(a) {

    }
    });
    }else if(jQuery('#requestAction textarea').val() && jQuery('#requestAction textarea').val().length < 6){
        jQuery('#requestAction textarea').addClass('errorClass');
        jQuery('#requestAction textarea').after('<p class="required">'+Drupal.t('Minimum 6 characters required.')+'</p>');
    }else{
        jQuery('#requestAction textarea').addClass('errorClass');
        jQuery('#requestAction textarea').after('<p class="required">'+Drupal.t('This field is required.')+'</p>'); 
    }
})
jQuery(document).on("click", ".messages .close", function(e){
    jQuery('.messages').slideUp();
})
jQuery(document).on("click", "#cancelForm .btn-primary", function(e){
	if(!jQuery(this).hasClass('disabled')){
	jQuery('p.required').remove();
	jQuery('.messages').slideUp();
	e.preventDefault();
	if(jQuery('#cancelForm').attr('type') == "reject"){var useraction = "reject";}
	else if(jQuery('#cancelForm').attr('type') == "approve"){var useraction = "approve";}
	else if(jQuery('#cancelForm').attr('type') == "cancel"){var useraction = "cancel";}	
	if(jQuery('textarea#comment').length == 0 || (jQuery('#comment').val() !== "" && jQuery('textarea#comment').val().length >= 6)){
		jQuery('#cancelForm .btn-primary').addClass('disabled');
		jQuery.ajax({  
			type: "POST",  
			url: '/cms/popup/enduseraction',
			data: {actionType:useraction,data:jQuery('form#cancelForm').serialize()},
		success: function(a) {
			var out = jQuery.parseJSON(a);
			if(out.status =="url"){
				window.location.href = out.url;
			}else{
				jQuery('.actionpopup').modal('hide');
				jQuery('#cancelForm .btn-primary').removeClass('disabled');
				jQuery('textarea#comment').val('');
				jQuery("body").prepend('<div class="messages '+out.status+'">'+out.message+'<div class="close">x</div></div>');
				jQuery("html, body").animate({ scrollTop: 0 }, "slow");
				actionType = "search";
				jQuery('#example').DataTable().search('').page.len('10').draw();	
			}
			
		},
		error: function(a) {

		}
		});
	}
	else if(jQuery('textarea#comment').val() && jQuery('textarea#comment').val().length < 6){
        jQuery('textarea#comment').addClass('errorClass');
        jQuery('textarea#comment').after('<p class="required">'+Drupal.t('Minimum 6 characters required.')+'</p>');
    }else{
		jQuery('textarea#comment').addClass('errorClass');
        jQuery('textarea#comment').after('<p class="required">'+Drupal.t('This field is required.')+'</p>'); 
	}
}else{
	e.preventDefault();
}
})
jQuery(document).on("click", ".cancel", function(e){
	e.preventDefault();
	jQuery('.actionpopup').modal('hide');
})
jQuery(document).on("blur", "textarea#comment ", function(e){
    jQuery('p.required').remove();
	if(jQuery(this).val() == ""){
		jQuery('#comment').addClass('errorClass');
        jQuery('#comment').after('<p class="required">'+Drupal.t('This field is required.')+'</p>'); 
	}else{
		jQuery('#comment').removeClass('errorClass');
        jQuery('p.required').remove();
	}
})
})( jQuery );