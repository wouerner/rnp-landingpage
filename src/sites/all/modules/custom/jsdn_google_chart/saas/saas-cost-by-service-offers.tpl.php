<div id="filter_spend_provider_div25" class="filter-dropdown">
    <div id="filter_cost_resources" class="filter-dropdown">
        <div class="widgetDotMenu">
        <i id="menu-chart_widget25" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
        </div>
    </div>
</div>
<div id="filter_date_range_div25" class="floatRight floatRightCSO">
    <select id="date_range_selected25" class="chart_filter_date chart_date_range_type">           
        <option value="ytd"><?php  print t('Year to Date'); ?></option>
        <option value="12month" selected><?php  print t('Last 1 Year'); ?></option>
        <option value="6month"><?php  print t('Last 6 Months'); ?></option>
        <option value="3month"><?php  print t('Last 3 Months'); ?></option>
    </select>
</div>
<div class="clear"></div>
<div id="loaderDiv25" class="loaderDiv"></div>
<div id="chart_widget25" class="chart_daily_trend jsdn_chart"></div>
<div class="clear"></div>

<script>
(function( $ ) {
    $( document ).ready(function() {
        chart_widget25(5);
    });
    $(document).ready(function () {
	$('#menu-chart_widget25').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget25',
		items: [	
			{
                            type: 'label',
                            text: '<?php  print t('Results'); ?>',
			},
			{
                            type: 'radio',
                            text: '<?php  print t('Top 5'); ?>',
                            radioGroup: 'radio1',
                            checked: true,
                            group:'results'
			},
			{
                            type: 'radio',
                            text: '<?php  print t('Top 10'); ?>',
                            radioGroup: 'radio1',
                            group:'results'		
			},
			{
                            type: 'radio',
                            text: '<?php  print t('All'); ?>',
                            radioGroup: 'radio1',
                            group:'results'
			},
			{
                            type: 'divider'
			},		
			{
                            type: 'label',
                            text: '<?php  print t('Display'); ?>',
			},
			{
                            type: 'radio',
                            text: '<?php  print t('Column'); ?>',
                            radioGroup: 'radio',
                            group:'display',
                            checked: true			
			},
			{
                            type: 'radio',
                            text: '<?php  print t('Donut'); ?>',
                            radioGroup: 'radio',
                            group:'display'			
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
