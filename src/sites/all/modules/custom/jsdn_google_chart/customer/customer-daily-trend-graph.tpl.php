<div id="filter_spend_provider_div3" class="filter-dropdown">
<div class="widgetDotMenu">
<i id="menu-button" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
</div>
</div>

<div id="loaderDiv3" class="loaderDiv"></div>
<div id="chart_widget3" class="chart_daily_trend jsdn_chart"></div>
<script>
(function( $ ) {
    $( document ).ready(function() {
        chart_widget3(5); 
    });
	
    $(document).ready(function () {
	$('#menu-button').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget3',
		items: [	
			{
				type: 'label',
				text: '<?php print t('Display'); ?>',
			},
			{
				type: 'radio',
				text: '<?php print t('Area'); ?>',
				radioGroup: 'radio',
				group:'display',
				checked: true		
			},			
			{
				type: 'radio',
				text: '<?php print t('Column'); ?>',
				radioGroup: 'radio',
				group:'display'
			},
			{
				type: 'radio',
				text: '<?php print t('Table'); ?>',
				radioGroup: 'radio',
				group:'display'
			},
			{
				type: 'radio',
				text: '<?php print t('CSV'); ?>',
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
    
