<?php
global $_domain;
$visibility_package = domain_conf_variable_get($_domain['domain_id'], 'package_visibility');
$menuPosition = variable_get('menu_position');
?>
<div id="menu_body">
    <div class="menuSection <?php if($menuPosition == "horizontal"){?>TopMenu<?php }else if($menuPosition == "vertical"){?>leftMenu<?php }?>"></div>
</div>
<script type="text/javascript" src="/cms/sites/all/modules/custom/jsdn_common/javascript/mustache.js"></script>
<script type="text/javascript" src="/cms/sites/all/modules/custom/jsdn_common/javascript/dropdown-menu.js"></script>
<script>
var CMSmenu= '<?php echo $_SESSION['MenuJSON']?>';
var jsdnHelpUrl= '<?php echo $_SESSION['jsdnHelpURL']?>';
function  doLogOut(){
  window.location.href = jsdnURL+'/jsdn/login/doCMSLogout.action';
}
function openPopup(url,newWindow) {
	if(newWindow){
		window.open(url,'Popup','toolbar=no,scrollbars=yes,locationbar=no,menubar=no,resizable=yes');
	}else{
		location.href=url;
	}
	return false;
}

(function( $ ) {

$( document ).ready(function() {
$.ajax({
        type: 'GET',
		url: '/jsdn/web2/mustache_templates/menu_template.mst',
        dataType: 'text',
        success: function (data) {
			CMSmenu=$.parseJSON(CMSmenu);
                        CMSmenu['baseURL'] = jsdnURL+"/jsdn";
                        var rendered = Mustache.render(data,CMSmenu);
		        		$("#menu_body .menuSection").html(rendered);
	jqueryslidemenu.buildmenu("jcMenu");
	$('#responsive-menu-button').sidr({
		name: 'sidr-main',
		source: '#jcMenu',
		side:'right',
	});
	$("a.sidr-class-sublink").click(function(){
	if($(this).parent('li').find('ul.sidr-class-subGroup').is( ":hidden" )){
	    $(this).addClass('down');
	}else{
	    $(this).removeClass('down');
	}
	$(this).parent('li').find('ul.sidr-class-subGroup').slideToggle();
	})
if(!CMSmenu.profile.isProxied){
    jqueryslidemenu.buildmenu("profileMenu"); 
}
else{
    $( ".profileIcon" ).hide();
}

if(typeof CMSmenu.helpdeskURL != 'undefined'){
var helpDeskLable='<?php print t('Open a New Ticket');?>';

var helpDeskUrl=jsdnURL+CMSmenu.helpdeskURL;
}
var cartCount='<?php echo $_SESSION['cartCount']?>';
var cartUrl=jsdnURL+"/jsdn/shoppingcart/viewShoppingCart.action";
<?php
if( !$visibility_package ){
	if( !drupal_is_front_page() ):

?>
	// js cart catalog
	if(cartCount){
		if ( $( ".cartDiv" ).length ) {}
		else{
	            $('<div class="floatRight cartDiv"><a href="'+cartUrl+'"><?php echo t('My Cart')?> <span class="fa fa-shopping-cart fa-lg"><span class="cartCount">'+cartCount+'</span></span> </a></div>').appendTo("#breadcrumb .breadcrumb");
	        }
	}

<?php else: ?>

		// js cart home
		var cartCount='<?php echo $_SESSION['cartCount']?>';
		var cartUrl=jsdnURL+"/jsdn/shoppingcart/viewShoppingCart.action";
		if(cartCount){
		  if ( $( ".cartDiv" ).length ) {}
		  else{
		            $('<div class="floatRight cartDiv"><a href="'+cartUrl+'"><?php echo t('My Cart')?> <span class="fa fa-shopping-cart fa-lg"><span class="cartCount">'+cartCount+'</span></span> </a></div>').appendTo("#jcMenu");
		        }
		}

<?php
	endif; // !front_page
} // !visibility_package
?>






if(helpDeskUrl){
if ( $( ".helpdeskDiv" ).length ) {}
	else{
	$('<div class="floatRight helpdeskDiv"><a href="'+helpDeskUrl+'" target="_blank">'+helpDeskLable+'</a></div>').appendTo("#breadcrumb .breadcrumb");;
}
}
        }
    });
});
})( jQuery );

</script>
