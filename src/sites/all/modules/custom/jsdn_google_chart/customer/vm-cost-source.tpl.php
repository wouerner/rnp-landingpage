<div id="filter_vm_source_cost" class="filter-dropdown">
    <select id="spend_provider_selected11" class="chart_filter chart_filter_type" style="display: none;">           
        <option value="pie"><?php print t('Pie');?></option>
        <option value="column"><?php print t('Column');?></option>
        <option value="table"><?php print t('Table');?></option>
        <option value="csv"><?php print t('CSV');?></option>
    </select>
</div>
<div id="loaderDiv11" class="loaderDiv"></div>
<div id="chart_widget11" class="chart_daily_trend jsdn_chart"></div>
<div class="clear"></div>
<div class="widget-icon-div"><img src="/cms/themes/jcdefault/images/info-icon.png" class="widget-info-icon" id="vm-cost-instance" title="<?php print t("<div>Monitoring the VMs irrespective of where they are created allows CFOs to keep the cost under control. <br><b> For more details, refer to the <a class='jsdnHelp' url='topic/vm-cost-by-source-creation.html' onclick='openHelp(this);'>Help</a> section</b></div>");?>" /></div>
<script>
(function( $ ) {
    $( document ).ready(function() {  
       chart_widget11(5);
    });
})( jQuery ); 
</script>
    
