<div id="filter_chart_widget18" class="filter-dropdown">
<div id="filter_vm_tag" class="filter-dropdown">
    <select id="spend_provider_selected18" class="chart_filter chart_filter_type" style="display: none;">           
        <option value="column"><?php print t('Column');?></option>
        <option value="pie"><?php print t('Pie');?></option>
        <option value="table"><?php print t('Table');?></option>
        <option value="csv"><?php print t('CSV');?></option>
    </select>
</div>
<div id="filter_vm_tag_count" class="filter-dropdown">
    <select id="spend_filter_count_selected18" class="chart_filter_count" style="display: none;">           
        <option value="5"><?php print t('Top 5');?></option>
        <option value="10"><?php print t('Top 10');?></option>
        <option value="10000000"><?php print t('All');?></option>
    </select>
</div>
</div>
<div id="loaderDiv18" class="loaderDiv"></div>
<div id="chart_widget18" class="chart_daily_trend jsdn_chart"></div>
<div class="clear"></div>
<div class="widget-icon-div"><img src="/cms/themes/jcdefault/images/info-icon.png" class="widget-info-icon" id="vm-count-tag" title="<?php print t("<div>This report shows the total count of VMs grouped according to the organization's tagging strategy. For the selected Tag key, the report displays the number of instances for each of the associated Tag Values.<br><br><i>Only VMs tagged are considered. Resources that are not Tagged are excluded</i> <br><b>For more details, refer to the  <a class='jsdnHelp' url='topic/vm-count-by-tag-key.html' onclick='openHelp(this);'>Help </a> section</b></div>");?>" /></div>
<script>
(function( $ ) {
    $( document ).ready(function() {  
       chart_widget18(5); 
    });
})( jQuery ); 
</script>
    
