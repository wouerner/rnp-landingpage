<div id="filter_chart_widget19" class="filter-dropdown">
<div id="filter_cost_tag_key" class="filter-dropdown">
    <select id="spend_provider_selected19" class="chart_filter chart_filter_type" style="display: none;">           
        <option value="column"><?php print t('Column');?></option>
        <option value="pie"><?php print t('Pie');?></option>
        <option value="table"><?php print t('Table');?></option>
        <option value="csv"><?php print t('CSV');?></option>
    </select>
</div>
<div id="filter_cost_tag_key_count" class="filter-dropdown">
    <select id="spend_filter_count_selected19" class="chart_filter_count" style="display: none;">           
        <option value="5"><?php print t('Top 5');?></option>
        <option value="10"><?php print t('Top 10');?></option>
        <option value="10000000"><?php print t('All');?></option>
    </select>
</div>
</div>
<div id="loaderDiv19" class="loaderDiv"></div>
<div id="chart_widget19" class="chart_daily_trend jsdn_chart"></div>
<div class="clear"></div>
<div class="widget-icon-div"><img src="/cms/themes/jcdefault/images/info-icon.png" class="widget-info-icon" id="vm-cost-tag" title="<?php print t("<div>Tagging provides an efficient way to track and organize your resources based on the cost. For the selected Tag key, the report displays the number of instances for each of the associated Tag Values. <br><br><i> Only VMs tagged are considered. Resources that are not tagged are excluded. </i> <br><b>For more details, refer to the  <a class='jsdnHelp' url='topic/vm-cost-by-tag-key.html' onclick='openHelp(this);'>Help</a> section</b></div>");?>" /></div>
<script>
(function( $ ) {
    $( document ).ready(function() {  
       chart_widget19(5);
    });
})( jQuery ); 
</script>
    
