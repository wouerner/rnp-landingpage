<div class="catalogSearch catalog-page-search">
    <form id="globalsearchForm" method="GET">
        <input id="search_api_views_fulltext_catalog" name="search_api_views_fulltext"  type="text" <?php if($_GET['search_api_views_fulltext']){?>value="<?php echo $_GET['search_api_views_fulltext'];?>"<?php }?> placeholder="<?php echo t('Search Service');?>" autocomplete="off" />
        <div id="suggesstion-box"></div>
        <button id="applicationSearchButton" class="fa fa-search" type="submit"><span><?php echo t('Search'); ?></span></button>
    </form>
</div>
<script>
var currentURL=window.location.host;
var cmsLanCode='<?php global $language; echo $language->prefix;?>';
var searchurl =  "/cms/"+cmsLanCode+"/catalog";
var isCmsloggedin='<?php if(user_is_logged_in()){ echo "true"; } ?>';
(function($) {
$("#globalsearchForm").attr("action",searchurl);
})(jQuery);
</script>