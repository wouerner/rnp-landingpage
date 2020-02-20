
<div id="filter_spend_provider_div53" class="filter-dropdown">
	<div class="widgetDotMenu">
		<i id="menu-chart_widget53" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
	</div>
</div>
<div id="loaderDiv53" class="loaderDiv"></div>
<div id="chart_widget53" class="chart_daily_trend jsdn_chart"></div>
<script>
(function( $ ) {
    $( document ).ready(function() {  
       chart_widget53(5);
    });
    
    $(document).ready(function () {
	$('#menu-chart_widget53').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget53',
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
    