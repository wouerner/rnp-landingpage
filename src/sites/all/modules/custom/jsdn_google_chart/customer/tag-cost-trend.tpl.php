<div class="clear"></div>
<div id="filter_cost_resources" class="filter-dropdown">
<div class="widgetDotMenu">
<i id="menu-chart_widget20" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
</div>
</div>
<div id="filter_chart_widget20" class="filter-dropdown chart_filter"></div>
<div id="loaderDiv20" class="loaderDiv"></div>
<div id="chart_widget20" class="chart_daily_trend jsdn_chart"></div>
<script>
(function( $ ) {
    $( document ).ready(function() {  
       chart_widget20(5); 
    });
    $(document).ready(function () {
	$('#menu-chart_widget20').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget20',
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