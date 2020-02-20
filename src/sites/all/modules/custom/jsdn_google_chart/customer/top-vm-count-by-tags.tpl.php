<div id="filter_cost_tags" class="filter-dropdown">
    <select id="spend_provider_selected33" class="chart_filter chart_filter_type" style="display: none;">           
        <option value="column"><?php print t('Column');?></option>
        <option value="pie"><?php print t('Pie');?></option>
        <option value="table"><?php print t('Table');?></option>
        <option value="csv"><?php print t('CSV');?></option>
    </select>
</div>
<div id="filter_cost_tags_count" class="filter-dropdown">
    <select id="spend_filter_count_selected33" class="chart_filter_count" style="display: none;">           
        <option value="5"><?php print t('Top 5');?></option>
        <option value="10"><?php print t('Top 10');?></option>
        <option value="10000000"><?php print t('All');?></option>
    </select>
</div>
<div id="loaderDiv33" class="loaderDiv"></div>
<div id="chart_widget33" class="chart_daily_trend jsdn_chart"></div>
<div class="clear"></div>
<div class="widget-icon-div"><img src="/cms/themes/jcdefault/images/info-icon.png" class="widget-info-icon" id="cost-tag-info" title='<div><?php print t('View the count of different resources that are tagged based on your organizations tagging policy. Identify the number of Resources that are un-tagged to ensure stricter resource tag enforcement.');?><br><b><?php print t('For more details, refer to the');?> <a class="jsdnHelp" url="topic/resource-count-by-tags.html" onclick="openHelp(this);"><?php print t('Help');?></a> <?php print t('section');?></b></div>' /></div>
<script>
(function( $ ) {
    $( document ).ready(function() {  
       chart_widget33(5); 
    });
})( jQuery ); 
</script>
    
