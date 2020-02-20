<div id="cost_trend_offer" class="filter-dropdown">
    <div id="filter_date_range_div26" class="filter-dropdown">
        <select id="date_range_selected26" class="chart_filter_date chart_date_range_type">           
            <option value="ytd"><?php  print t('Year to Date'); ?></option>
            <option value="12month" selected><?php  print t('Last 1 Year'); ?></option>
            <option value="6month"><?php  print t('Last 6 Months'); ?></option>
            <option value="3month"><?php  print t('Last 3 Months'); ?></option>
        </select>
    </div>
    <div id="filter_product_trend" class="filter-dropdown"></div>
    <div class="widgetDotMenu" style="float: right">
        <i id="menu-chart_widget26" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
    </div>
</div>
<div id="loaderDiv26" class="loaderDiv"></div>
<div id="chart_widget26" class="chart_daily_trend jsdn_chart"></div>
<div class="clear"></div>
<script>
(function( $ ) {
    $( document ).ready(function() {  
       chart_widget26(5);
    });
    $(document).ready(function () {
	$('#menu-chart_widget26').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget26',
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
    

    

    
