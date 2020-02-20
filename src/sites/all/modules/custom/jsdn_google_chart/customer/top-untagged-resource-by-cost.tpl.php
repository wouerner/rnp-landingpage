<div class="clear"></div>
<div id="filter_cost_resources" class="filter-dropdown">
<div class="widgetDotMenu">
<i id="menu-chart_widget34" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
</div>
</div>
<div id="loaderDiv34" class="loaderDiv"></div>
<div id="chart_widget34" class="chart_daily_trend jsdn_chart"></div>
<script>
(function( $ ) {
    $( document ).ready(function() {  
       chart_widget34(5); 
    });
    $(document).ready(function () {
	$('#menu-chart_widget34').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget34',
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
    
