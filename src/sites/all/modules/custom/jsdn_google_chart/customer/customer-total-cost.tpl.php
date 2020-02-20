<div id="loaderDiv4" class="loaderDiv"></div>
<div id="chart_widget4" class="chart_daily_trend">
    <div class="overview">
        <div class="left-div">
            <h3><b><?php print t('SaaS');?></b></h3>
            <div class="cost-div"><?php echo html_entity_decode($_SESSION['currencySymbol']); ?><span id="saas_cost"></span></div>
        </div>
        <div class="middle-div">
            <h3><b><?php print t('Total Cost'); ?></b></h3>
            <div class="cost-div"><?php echo html_entity_decode($_SESSION['currencySymbol']); ?><span id="total_cost"></span></div>
        </div>
        <div class="right-div">
            <h3><b><?php print t('IaaS');?></b></h3>
            <div class="cost-div"><?php echo html_entity_decode($_SESSION['currencySymbol']); ?><span id="iaas_cost"></span></div>
        </div>
    </div>
</div>
<script>
(function( $ ) {
    $( document ).ready(function() {
       chart_widget4(5);
       $('.chart_daily_trend').closest('#homebox-block-jsdn_google_chart_total_cost').find('.portlet-icon').css({'display':'none'});
    });
})( jQuery ); 
</script>
    
