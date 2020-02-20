<div class="dcenterFilter">
<div id="filter_chart_widget50" class="filter-dropdown filter_data_center chart_daily_trend public_cloud"></div>
</div>
<div id="loaderDiv50" class="loaderDiv loaderDivFilter"></div>
<div class="clear" style="height:7px"></div>
<script>
(function( $ ) {
    $( document ).ready(function() {
        chart_widget50(5);
    });
})( jQuery ); 
</script>
<div class="privatedatacenterwidgets fullwidthwidgetprivate">
<div class="widget-divider">
    <div class="widget_title"><?php  print t('Cloud Cost Trend');?></div>
    <div id="filter_chart_widget49" class="filter-dropdown">
        <div id="filter_cost_trend" class="filter-dropdown">
            <div class="widgetDotMenu" style="margin-top: 8px;">
                    <i id="menu-chart_widget49" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
            </div>
        </div>
    </div>
</div>
<div id="product-trend-cost">
    <span id="dataCenterCost"><span class="costlabel"><?php  //echo t('Cost');?> </span> <span class="cloudCenterCost currentcost"></span></span>
</div>
<div id="loaderDiv49" class="loaderDiv"></div>
<div id="chart_widget49" class="chart_daily_trend jsdn_chart cloud_insights"></div>
<div class="clear"></div>
</div>
<div class="privatedatacenterwidgetsLeft">
    <div class="widget-divider">
        <div class="widget_title"><?php  print t('VM Count by Flavors');?></div>
        <div id="filter_cost_resources" class="filter-dropdown">
             <div class="widgetDotMenu" style="margin-top: 8px;">
                    <i id="menu-chart_widget39" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
            </div>
        </div>
    </div>
    <div id="loaderDiv39" class="loaderDiv"></div>
    <div id="chart_widget39" class="chart_daily_trend jsdn_chart cloud_insights"></div>
</div>
<div class="privatedatacenterwidgetsRight">
    <div class="widget-divider">
        <div class="widget_title"><?php  print t('VM Distribution Based on OS');?></div>
        <div id="filter_cost_resources" class="filter-dropdown">
             <div class="widgetDotMenu" style="margin-top: 8px;">
                    <i id="menu-chart_widget40" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
            </div>
        </div>
    </div>
    <div id="loaderDiv40" class="loaderDiv"></div>
    <div id="chart_widget40" class="chart_daily_trend jsdn_chart cloud_insights"></div>
</div>

<script>
(function( $ ) {
    $(document).ready(function () {
	$('#menu-chart_widget49').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget49',
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

<script>
(function( $ ) {
    $(document).ready(function () {
	$('#menu-chart_widget39').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget39',
		items: [			
			{
                            type: 'label',
                            text: '<?php  print t('Display'); ?>',
			},
                        {
                            type: 'radio',
                            text: '<?php  print t('Donut'); ?>',
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

<script>
(function( $ ) {
    $(document).ready(function () {
	$('#menu-chart_widget40').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget40',
		items: [			
			{
                            type: 'label',
                            text: '<?php  print t('Display'); ?>',
			},
                        {
                            type: 'radio',
                            text: '<?php  print t('Donut'); ?>',
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