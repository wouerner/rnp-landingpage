<div id="filter_vm_instance_type" class="filter-dropdown">
    <select id="spend_provider_selected7" class="chart_filter chart_filter_type" style="display: none;">           
        <option value="column"><?php print t('Column');?></option>
        <option value="pie"><?php print t('Pie');?></option>
        <option value="table"><?php print t('Table');?></option>
        <option value="csv"><?php print t('CSV');?></option>
    </select>
</div>
<div id="filter_vm_instance_type_count" class="filter-dropdown">
    <select id="spend_filter_count_selected7" class="chart_filter_count" style="display: none;">           
        <option value="5"><?php print t('Top 5');?></option>
        <option value="10"><?php print t('Top 10');?></option>
        <option value="10000000"><?php print t('All');?></option>
    </select>
</div>
<div id="loaderDiv7" class="loaderDiv"></div>
<div id="chart_widget7" class="chart_daily_trend jsdn_chart"></div>
<div class="clear"></div>
<div class="widget-icon-div"><img src="/cms/themes/jcdefault/images/info-icon.png" class="widget-info-icon" id="vm-count-instance" title="<?php print t("<div>Public Cloud vendors offer their Instances or Virtual Machines (VMs) with different specifications based on sizes, categories, or families. This report details the number of VMs based on the Tier Size, Purpose, Generation, or Instance types.  <br><b> For more details, refer to the <a class='jsdnHelp' url='topic/vm-count-by-instance.html' onclick='openHelp(this);'>Help</a> section</b></div>");?>"" /></div>
<script>
(function( $ ) {
    $( document ).ready(function() {  
       chart_widget7(5); 
    });
})( jQuery ); 
</script>