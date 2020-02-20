<div class="product-trend-cost">
    <span class="curcostmachine" style="display: none;">
        <span class="costlabel"><?php  print t('Total Hosts');?>: </span> <span class="currentcostmachine"></span>  
    </span>
    <span class="estimatedcostmachine" style="display: none;">
        <span class="costlabel"><?php  print t("No of CPU's");?>: </span><span class="estcostmachine"></span>
    </span>
</div>
<div id="filter_cost_resources" class="filter-dropdown">
    <div id="filter_cost_resources" class="filter-dropdown">
        <div class="widgetDotMenu">
        <i id="menu-chart_widget37" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
        </div>
    </div>
</div>

<div id="loaderDiv37" class="loaderDiv"></div>
<div id="chart_widget37" class="chart_daily_trend jsdn_chart private_cloud"></div>
<div class="clear"></div>

<script>
(function( $ ) {
    $( document ).ready(function() {
        chart_widget37(5);
    });
    $(document).ready(function () {
	$('#menu-chart_widget37').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget37',
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
