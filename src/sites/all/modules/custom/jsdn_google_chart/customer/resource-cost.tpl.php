<div id="filter_resource_cost" class="filter-dropdown">
    <select id="spend_provider_selected10" class="chart_filter chart_filter_type" style="display: none;">           
        <option value="column"><?php print t('Column');?></option>
        <option value="pie"><?php print t('Pie');?></option>
        <option value="table"><?php print t('Table');?></option>
        <option value="csv"><?php print t('CSV');?></option>
    </select>
</div>
<div id="filter_resource_cost_count" class="filter-dropdown">
    <select id="spend_filter_count_selected10" class="chart_filter_count" style="display: none;">           
        <option value="5"><?php print t('Top 5');?></option>
        <option value="10"><?php print t('Top 10');?></option>
        <option value="10000000"><?php print t('All');?></option>
    </select>
</div>
<div id="loaderDiv10" class="loaderDiv"></div>
<div id="chart_widget10" class="chart_daily_trend jsdn_chart"></div>
<div class="clear"></div>
<div class="widget-icon-div"><img src="/cms/themes/jcdefault/images/info-icon.png" class="widget-info-icon" id="resource-cost-region" title="<?php print t("<div>Different cloud regions have different pricing for each cloud provider. Resource cost can be identified by this report that indicates the number of resources associated with each region.<br><b>For more details, refer to the <a class='jsdnHelp' url='topic/resource-cost-by-region.html' onclick='openHelp(this);'>Help</a> section</b></div>");?>" /></div>
<script>
(function( $ ) {
    $( document ).ready(function() {  
       chart_widget10(5);
    });
})( jQuery ); 
</script>
    
