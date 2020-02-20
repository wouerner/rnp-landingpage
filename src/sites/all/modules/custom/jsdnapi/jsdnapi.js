(function( $ ) {

jQuery(document).ready(function(){
    if($('#myCarousel .item').length <=1 ){
        $('#myCarousel').parent().addClass('no-padding');
    }else{
        $('#myCarousel').parent().removeClass('no-padding');
    }
})
jQuery(document).on("click", ".messages .close", function(e){
    jQuery('.messages').slideUp();
})
var numclick;
$('.opentierwindow').on('click',function(event){
    var planDetailsDiv=$(this).attr('plandiv');
    $('#'+planDetailsDiv+'').dialog({
        modal: true,
        buttons: {
	Done: function() {
            $('#'+planDetailsDiv+'').dialog( "close" );
            }
        }
        });
    
});

$('.message-popup').on('click',function(event){
    var planDetailsDiv=$(this).attr('plandiv');
});

jQuery(document).on("click", ".notifyButton", function(e){
    $('.messages').slideUp();
    $(this).html('<img src="/cms/themes/jcdefault/images/loading.gif"/>');
    $(this).css({width:'146px'});
    $(this).addClass('disabled').attr('disabled',true);
    e.preventDefault();
    var fields = {
        offer: $(this).attr('offer'),name:$(this).attr('offername'),items:$('.notifyItems').val()
    };
    $.ajax({  
        type: "POST",  
        url: '/cms/popup/notify',
        data: fields,
        dataType: 'json',
        success: function(a) {
            $('#message-div').modal('hide');
            $("body").prepend('<div class="messages '+a.status+'">'+a.message+'<div class="close">x</div></div>');
            jQuery("html, body").animate({ scrollTop: 0 }, "slow");
        },
        error: function(a) {
                
        }
    });
});

$( ".popupaction" ).on('click',function(event){
    //offer = $(this).attr('offer');
    url = $(this).attr('url');
	window.location.href=url;
    /*
	type = $(this).attr('type');
    var fields = {
        offer: offer,url:url,type:type
    };
    $('#message-div').dialog('close');
    $.ajax({  
        type: "POST",  
        url: '/cms/popup/action',
        data: fields,
        dataType: 'json',
        success: function(a) {
            $('#message-div').dialog('close'); 
                if(url){
                    window.location.href=url;
                }
            },
            error: function(a) {
                $('#message-div').dialog('close'); 
				if(url){
                    window.location.href=url;
                }
            }
    });
*/	
});

$('.button-div span.close').on('click',function(event){
    $('#message-div').dialog('close');
})

$('.cart, .trialButton').on('click', function () {
        if (numclick!='1') {
            $('.cart').addClass( "disabled" );
            $('.trialButton').addClass( "disabled" );
            numclick ='1';
        }
        else {
            $('.cart').prop('disabled', true);
            $('.trialButton').prop('disabled', true);
            $('.cart').removeAttr("href");
            $('.trialButton').removeAttr("href");
        }
});
jQuery(document).on("click", ".btn-cancel", function(event){
    $('#cart-modal').modal('hide');
})

jQuery(document).on("click", '.CategoryList input[type="radio"]', function(event){
    if($(this).is(':checked')){
        $('#myCarousel').append('<div class="loading" style="position: absolute;width: 100%;height: 100%;background: rgba(93,93,93,0.2);top: 0;"><img src="/cms/sites/default/files/loading.gif" style="margin: auto;display: flex;margin-top: 9%;"/></div>');
        var list = $(this).attr('id');
        var fields = {
            subCategory: $(this).attr('id')
        };
        $.ajax({    
            type: "POST",  
            url:'/cms/sites/all/modules/custom/jsdnapi/service-family-offer.php',
            data: fields,
            success: function(response) {
                $('.loading').remove();
                $('.topDiv').remove();
                $('#myCarousel').html(response);
                if($('#myCarousel .item').length <=1 ){
                    $('#myCarousel').parent().addClass('no-padding');
                }else{
                    $('#myCarousel').parent().removeClass('no-padding');
                }
            }
        });
        /*
        var list = $(this).attr('id');
        $('.single-item').removeClass('no-margin-left').hide();
        $('.'+list).show();
        $('.'+list).first().addClass('no-margin-left');
        */
    }
});

jQuery(document).on("click", ".cartButton", function(event){
    $(this).addClass('loadingButton');
    $('body').append('<div class="topDiv" style="position: fixed;background: transparent;width: 100%;height: 100%;top: 0;bottom: 0;"></div>')
        event.preventDefault();
        var offercode = $(this).attr('rel');
        var istrial=$(this).hasClass("trialButton");
        var fields = {
            offer: $(this).attr('rel'),
            name: $(this).attr('name'),
            serviceId: $(this).attr('serviceId'),
            trialService:istrial
        };
        $.ajax({    
            type: "POST",  
            url: '/cms/popup/service',
            data: fields,
            success: function(response) {
                $(".cart-button").removeClass('loadingButton');
                $('.topDiv').remove();
                if(response  == ""){
                    if (istrial){
                        var jsdnDeepLink = jsdnURL +'/jsdn/deeplink/addItemToCart.action?offerCode='+offercode;
                    }
                    else{
                        var jsdnDeepLink = jsdnURL +'/jsdn/deeplink/addItemToCart.action?offerCode='+offercode+'&'+offercode+'.fromBuy=true';
                    }
                    window.location = jsdnDeepLink;
                }
                else{
                    $('#cart-modal .modal-body').html(response);
                    jQuery('#cart-modal').modal('show');
                }
            }
        });
    });
})( jQuery );