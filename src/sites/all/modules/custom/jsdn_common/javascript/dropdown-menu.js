//Specify full URL to down and right arrow images (23 is padding-right to add to top level LIs with drop downs):
/*var lineImage="";
var prevSelectedId=null;
var currSelectedId=null;*/

/*if("red_theme.css" == theme){
	lineImage=contextPath+'/web2/img/line_menu_red.png';
}else if("blue_theme.css" == theme || "default-theme.css" == theme){
	lineImage=contextPath+'/web2/img/line_menu_default.png';
}else if("darkBlue_theme.css" == theme){
	lineImage=contextPath+'/web2/img/line_menu_blue.png';
}else if("goldenyellow_theme.css" == theme){
	lineImage=contextPath+'/web2/img/line_menu_yellow.png';
}else if("grayblue_theme.css" == theme){
	lineImage=contextPath+'/web2/img/line_menu_gray.png';
}else if("green_theme.css" == theme){
	lineImage=contextPath+'/web2/img/line_menu_green.png';
}*/
/*$(".monitoring_img a").css({ "float": "left","padding-right": "23px"});
$(".monitoring_img").append('<img src="'+lineImage+'" />');*/

//var arrowimages={down:['downarrowclass', lineImage, 23], right:['rightarrowclass', contextPath+'/web2/images/right.png']};
//var arrowimagesprofile={down:['downarrowclass', contextPath+'/web2/images/icon_profiles.png', 23], right:['rightarrowclass', contextPath+'/web2/images/right.png']};
var jqueryslidemenu={
animateduration: {over: 500, out: 200}, //duration of slide in/ out animation, in milliseconds
buildmenu:function(menuid){
				jQuery(document).ready(function($){
		var $mainmenu=$("#"+menuid+">ul")
		var $headers=$mainmenu.find("ul").parent()
		$headers.each(function(i){
			var $curobj=$(this)
			var $subul=$(this).find('ul:eq(0)')
			this._dimensions={w:this.offsetWidth, h:this.offsetHeight, subulw:$subul.outerWidth(), subulh:$subul.outerHeight()}
			this.istopheader=$curobj.parents("ul").length==1? true : false
			$subul.css({top:this.istopheader? (this._dimensions.h)+"px" : 0})
			/*$curobj.children("a:eq(0)").css(this.istopheader? {paddingRight: arrowsvar.down[2]} : {}).append(
				'<img alt="" src="'+ (this.istopheader? arrowsvar.down[1] : arrowsvar.right[1])
				+'" class="' + (this.istopheader? arrowsvar.down[0] : arrowsvar.right[0])
				+ '" style="border:0;" />'
				);*/
				
					/*$curobj.hover(function(e){
							
								$("#"+prevSelectedId).find("ul").hide();
							
							var $targetul=$(this).children("ul:eq(0)");
							$(this).find("img").first().attr({ src: lineImage });
							currSelectedId=$(this).attr("id");
							if(currSelectedId == "profileID" || "dealerProfileId" == currSelectedId){
								this._offsets={left:$(this).offset().left, top:$(this).offset().top};
								var menuleft=this.istopheader? 0 : this._dimensions.w;
								menuleft=(this._offsets.left+menuleft+this._dimensions.subulw>$(window).width())? (this.istopheader? -this._dimensions.subulw+this._dimensions.w : -this._dimensions.w) : menuleft;
								if ($targetul.queue().length<=1) {
									$targetul.css({left:menuleft+"px"}).css("display","flex");}
							}else{
								$targetul.css({left:-8+"px"}).show();
							}
							 $targetul.css({top:42+"px"}).css( "z-index", 99 ).css("display","flex"); 
							prevSelectedId=currSelectedId;
					},function(e){
							var $targetul=$(this).children("ul:eq(0)");
							$targetul.mouseleave(function() {
								$targetul.hide();
							});
							$(this).find("img").first().attr({ src: lineImage});					
					});*/
				
				/*$('#jcMenu').find('#dashBoardId').mouseover(function() {
					if(prevSelectedId != null){
						$("#"+prevSelectedId).find("ul").hide();
					}
				});
				$('#jcMenu').find('#catalogId').mouseover(function() {
					if(prevSelectedId != null){
						$("#"+prevSelectedId).find("ul").hide();
				}
				});*/
				var thissize;
				$curobj.find("ul.profileIcon").css({display:'none', visibility:'visible'});

			$curobj.click(function(){
					if($(this).children("ul:eq(0)").css("display") == "none"){
						$(this).parent().parent().find("ul.clearfix").hide();
						var ju=$(this).children("ul:eq(0)");
						if ($(ju).hasClass( "subGroup" ))
						{
							if($('#jcMenu').parent().hasClass("leftMenu")){
							if($(this).find('a').hasClass('open')){ 
								$(this).children("ul:eq(0)").css("display","none");
								$('a.sublink').removeClass('open');
								return false;
							}else{
								$('a.sublink').removeClass('open');
								$(this).children("ul:eq(0)").css("display","block");  
								$(this).find('a.sublink').addClass('open');
								if($('#jcMenu').height()>470){
									$('#main-wrapper').css({"min-height":$('#jcMenu').height()+135});
								}
							}

								
							}else{
								$(this).children("ul:eq(0)").css("display","flex");
							}
						
						}
						else{$(this).children("ul:eq(0)").css("display","block");}
						var $targetul=$(this).children("ul:eq(0)");
						this._offsets={left:$(this).offset().left, top:$(this).offset().top};
						var menuleft=this.istopheader? 0 : this._dimensions.w;
						menuleft=(this._offsets.left+menuleft+this._dimensions.subulw>$(window).width())? (this.istopheader? -this._dimensions.subulw+this._dimensions.w : -this._dimensions.w) : menuleft;
						
						if ($targetul.queue().length<=1) {
							
							if ($( $targetul ).hasClass( "subGroup" ))
							{
								if($('#jcMenu').parent().hasClass("leftMenu")){
									$targetul.css({left:menuleft+"px"}).css("display","block");
								}else{
									$targetul.css({left:menuleft+"px"}).css("display","flex");
								}
							
							}
							else{
								$targetul.css({left:menuleft+"px"})
								}
							}
						else{
							$targetul.css({left:-8+"px"}).show();
							}
						var isIE11 = !!navigator.userAgent.match(/Trident.*rv\:11\./);
						if(isIE11 && !$targetul.hasClass('profileMenu')){
							var thislength = $targetul.find("li").length;
							if($(".heading_app").width() != 0){
								thissize = $(".heading_app").width()+16;
							}
							else{
								thissize = $("h2.heading").width();
							}
							//alert(thislength+":thislength"+thissize+":thissize");
							$targetul.width(thissize*thislength);
						}						
					}
					else{
						$(this).children("ul:eq(0)").hide();
						var isIE11 = !!navigator.userAgent.match(/Trident.*rv\:11\./);
						if(isIE11){
							$targetul.width(thissize);
						}
					}
				});
			$("body").mouseup(function (e)
			{
				var container = $curobj.children("ul:eq(0)");
					
				var Cdiv = $("#jcMenu"); 
			    if (!Cdiv.is(e.target) && Cdiv.has(e.target).length === 0) 
			    {
			    	$('a.sublink').removeClass('open');
			    }

				
				$('#main-wrapper').css({"min-height":470});
				if (container.has(e.target).length == 0)
				{
					container.width(thissize);
					container.hide();
				}
			});
			}); //end $headers.each()
			
			
			$mainmenu.find("ul").css({display:'none', visibility:'visible'});
			
			}) //end document.ready
}
};

//build menu with ID="myslidemenu" on page: