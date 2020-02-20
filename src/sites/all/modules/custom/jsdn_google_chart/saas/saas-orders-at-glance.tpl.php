<div id="filter_spend_provider_div23" class="filter-dropdown">
    <div id="filter_cost_resources" class="filter-dropdown">
        <div class="widgetDotMenu">
        <i id="menu-chart_widget23" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
        </div>
    </div>
</div>
<div id="loaderDiv23" class="loaderDiv"></div>
<div id="chart_widget23" class="chart_daily_trend jsdn_chart"></div>
<div class="clear"></div>
<script>
(function( $ ) {
        $( document ).ready(function() {
            chart_widget23(5);
        });
        $(document).ready(function () {
            $('#menu-chart_widget23').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget23',
		items: [
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