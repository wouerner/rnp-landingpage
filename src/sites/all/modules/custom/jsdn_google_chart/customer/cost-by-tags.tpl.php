<div id="filter_cost_tags" class="filter-dropdown">
    <select id="spend_provider_selected16" class="chart_filter chart_filter_type" style="display: none;">           
        <option value="column"><?php print t('Column');?></option>
        <option value="pie"><?php print t('Pie');?></option>
        <option value="table"><?php print t('Table');?></option>
        <option value="csv"><?php print t('CSV');?></option>
    </select>
</div>
<div id="filter_cost_tags_count" class="filter-dropdown">
    <select id="spend_filter_count_selected16" class="chart_filter_count" style="display: none;">           
        <option value="5"><?php print t('Top 5');?></option>
        <option value="10"><?php print t('Top 10');?></option>
        <option value="10000000"><?php print t('All');?></option>
    </select>
</div>
<div id="loaderDiv16" class="loaderDiv"></div>
<div id="chart_widget16" class="chart_daily_trend jsdn_chart"></div>
<div class="clear"></div>
<div class="widget-icon-div"><img src="/cms/themes/jcdefault/images/info-icon.png" class="widget-info-icon" id="cost-tag-info" title="<?php print t("<div>The Cost by Tags graph allows a visual representation by environment, project, cost centre or department for organizations that use IT resource-based tagging to allocate their cloud costs. This allows cost management on a very granular level and can be used for internal chargeback or show back when aligned to your internal business process and organisational structures.<br><b>For more details, refer to the <a class='jsdnHelp' url='topic/resource-cost-by-tag.html' onclick='openHelp(this);'>Help</a> section</b></div>");?>" /></div>
<script>
(function( $ ) {
    $( document ).ready(function() {  
       chart_widget16(5); 
    });
})( jQuery ); 
</script>