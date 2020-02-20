<div id="filter_vm_source" class="filter-dropdown">
    <select id="spend_provider_selected12" class="chart_filter chart_filter_type" style="display: none;">           
        <option value="pie"><?php print t('Pie');?></option>
        <option value="column"><?php print t('Column');?></option>
        <option value="table"><?php print t('Table');?></option>
        <option value="csv"><?php print t('CSV');?></option>
    </select>
</div><div id="loaderDiv12" class="loaderDiv"></div>
<div id="chart_widget12" class="chart_daily_trend jsdn_chart"></div>
<div class="clear"></div>
<div class="widget-icon-div"><img src="/cms/themes/jcdefault/images/info-icon.png" class="widget-info-icon" id="vm-count-source" title="<?php print t("<div>Tracking where the instance is created (from the CMP platform or from the vendor'console etc) allows to monitor and avoid Shadow IT.  <br><b> For more details, refer to the  <a class='jsdnHelp' url='topic/vm-count-by-source-creation.html' onclick='openHelp(this);'> Help </a>  section</b></div>");?>" /></div>
<script>
(function( $ ) {
    $( document ).ready(function() {  
       chart_widget12(5);
    });
})( jQuery ); 
</script>