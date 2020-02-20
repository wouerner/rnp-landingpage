<div id="product-trend-cost">
    <span id="curcost" style="display: none;"><span class="costlabel"><?php  echo t('Total Cost');?>: </span> <span class="currentcost"></span></span>
</div>
<div id="filter_vm_tag" class="filter-dropdown">
    <div id="filter_cost_resources" class="filter-dropdown">
        <div class="widgetDotMenu">
        <i id="menu-chart_widget27" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
        </div>
    </div>
    <div id="filter_chart_widget27" class="filter-dropdown"></div>
    <div id="filter_date_range_div27" class="filter-dropdown">
        <select id="date_range_selected27" class="chart_filter_date chart_date_range_type">           
            <option value="ytd"><?php  print t('Year to Date'); ?></option>
            <option value="12month" selected><?php  print t('Last 1 Year'); ?></option>
            <option value="6month"><?php  print t('Last 6 Months'); ?></option>
            <option value="3month"><?php  print t('Last 3 Months'); ?></option>
        </select>
    </div>
</div>


<div id="loaderDiv27" class="loaderDiv"></div>
<div id="chart_widget27" class="chart_daily_trend jsdn_chart"></div>
<div class="clear"></div>
<script>
(function( $ ) {
    $( document ).ready(function() {  
       chart_widget27(5); 
    });
    $(document).ready(function () {
	$('#menu-chart_widget27').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget27',
		items: [			
			{
                            type: 'label',
                            text: '<?php  print t('Display'); ?>',
			},
                        {
                            type: 'radio',
                            text: '<?php  print t('Area'); ?>',
                            radioGroup: 'radio',
                            group:'display',
                            checked: true
                            
			},
			{
                            type: 'radio',
                            text: '<?php  print t('Column'); ?>',
                            radioGroup: 'radio',
                            group:'display',		
			},

			{
                            type: 'radio',
                            text: '<?php  print t('Table'); ?>',
                            radioGroup: 'radio',
                            group:'display'
			},
			{
                            type: 'radio',
                            text: '<?php  print t('CSV'); ?>',
                            radioGroup: 'radio',
                            group:'display'
			}
		]
	}).click(function () {
		$(this).materialMenu('open');
	});
    });	
})( jQuery ); 
</script>
    
