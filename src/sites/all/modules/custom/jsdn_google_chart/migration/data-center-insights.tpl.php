<div class="dcenterFilter">
<div id="chart_widget47" class="filter-dropdown filter_data_center chart_daily_trend private_cloud"></div>
</div>
<div id="loaderDiv47" class="loaderDiv loaderDivFilter"></div>
<div class="clear" style="height:7px"></div>
<script>
(function( $ ) {
    $( document ).ready(function() {
        chart_widget47(5);
    });
})( jQuery ); 
</script>
<div class="privatedatacenterwidgets fullwidthwidgetprivate">
<div class="widget-divider">
<div class="widget_title"><?php  print t('Data Center Cost Trend');?></div>
<div id="filter_chart_widget48" class="filter-dropdown">
    <div id="filter_cost_trend" class="filter-dropdown">
        <div id="filter_cost_resources" class="filter-dropdown">
            <div class="widgetDotMenu" style="margin-top: 8px; margin-left: 19px;">
                <i id="menu-chart_widget48" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
            </div>
        </div>
    </div>
</div>
</div>
<div id="product-trend-cost">
    <span id="dataCenterCost" style="display: none;"><span class="costlabel"><?php  echo t('Cost');?>: </span> <span class="dataCenterCost currentcost"></span></span>
</div>
<div id="loaderDiv48" class="loaderDiv loaderPrivate"></div>
<div id="chart_widget48" class="chart_daily_trend jsdn_chart private_cloud data_center"></div>
<div class="clear"></div>
</div>
<div class="privatedatacenterwidgetsLeft">
    <div class="widget-divider">
        <div class="widget_title"><?php  print t('VM Count By CPU');?></div>
        <div id="filter_cost_resources" class="filter-dropdown">
            <div class="widgetDotMenu" style="margin-top: 8px;">
                <i id="menu-chart_widget38" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
            </div>
        </div>
    </div>
    <div id="loaderDiv38" class="loaderDiv loaderPrivate"></div>
    <div id="chart_widget38" class="chart_daily_trend jsdn_chart private_cloud data_center"></div>
</div>
<div class="privatedatacenterwidgetsRight">
    <div class="widget-divider">
        <div class="widget_title"><?php  print t('VM Distribution Based on OS');?></div>
        <div id="filter_cost_resources" class="filter-dropdown">
            <div class="widgetDotMenu" style="margin-top: 8px;">
                <i id="menu-chart_widget42" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
            </div>
        </div>
    </div>

    <div id="loaderDiv42" class="loaderDiv loaderPrivate"></div>
    <div id="chart_widget42" class="chart_daily_trend jsdn_chart private_cloud data_center"></div>
</div>
<div class="privatedatacenterwidgetsLeft">
    <div class="widget-divider">
    <div class="widget_title"><?php  print t('Migration Planner');?></div>
    <div id="filter_cost_resources" class="filter-dropdown">
        <div class="widgetDotMenu" style="margin-top: 8px;">
            <i id="menu-chart_widget43" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
        </div>
    </div>
    </div>
    <div id="loaderDiv43" class="loaderDiv loaderPrivate"></div>
    <div id="chart_widget43" class="chart_daily_trend jsdn_chart private_cloud data_center"></div>
</div>
<div class="privatedatacenterwidgetsRight">
    <div class="widget-divider">
    <div class="widget_title"><?php  print t('Virtualized Host Count By CPU');?></div>
    <div id="filter_cost_resources" class="filter-dropdown">
        <div class="widgetDotMenu" style="margin-top: 8px;">
            <i id="menu-chart_widget44" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
        </div>
    </div>
    </div>
    <div class="product-trend-cost">
        <span class="curcost" style="display: none;">
            <span class="costlabel"><?php  print t('Total Hosts');?>: </span> <span class="currentcost"></span>  
        </span>
        <span class="estimatedcost" style="display: none;">
            <span class="costlabel"><?php  print t("No of CPU's");?>: </span><span class="estcost"></span>
        </span>
    </div>
    <div id="loaderDiv44" class="loaderDiv loaderPrivate"></div>
    <div id="chart_widget44" class="chart_daily_trend jsdn_chart private_cloud data_center"></div>
</div>
<div class="privatedatacenterwidgetsLeft">
    <div class="widget-divider">
        <div class="widget_title"><?php  print t('Virtualized Host CPU Utilization');?></div>
        <div id="filter_cost_resources" class="filter-dropdown">
                <div class="widgetDotMenu" style="margin-top: 8px;">
                    <i id="menu-chart_widget45" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
                </div>
        </div>
    </div>
    <div id="loaderDiv45" class="loaderDiv loaderPrivate"></div>
    <div id="chart_widget45" class="chart_daily_trend jsdn_chart private_cloud data_center"></div>
</div>
<div class="privatedatacenterwidgetsRight">
    <div class="widget-divider">
        <div class="widget_title"><?php  print t('Virtualized Host Memory Utilization');?></div>
        <div id="filter_cost_resources" class="filter-dropdown">
            <div class="widgetDotMenu" style="margin-top: 8px;">
                <i id="menu-chart_widget46" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
            </div>
        </div>
    </div>
    <div id="loaderDiv46" class="loaderDiv loaderPrivate"></div>
    <div id="chart_widget46" class="chart_daily_trend jsdn_chart private_cloud data_center"></div>
</div>
<script>
(function( $ ) {
    $(document).ready(function () {
	$('#menu-chart_widget38').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget38',
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
	$('#menu-chart_widget42').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget42',
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
	$('#menu-chart_widget43').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget43',
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


<script>
(function( $ ) {
    $(document).ready(function () {
	$('#menu-chart_widget44').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget44',
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

<script>
(function( $ ) {
    $(document).ready(function () {
	$('#menu-chart_widget45').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget45',
		items: [			
			{
                            type: 'label',
                            text: '<?php  print t('Display'); ?>',
			},
			{
                            type: 'radio',
                            text: '<?php  print t('Stack'); ?>',
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

<script>
(function( $ ) {
    $(document).ready(function () {
	$('#menu-chart_widget46').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget46',
		items: [			
			{
                            type: 'label',
                            text: '<?php  print t('Display'); ?>',
			},
			{
                            type: 'radio',
                            text: '<?php  print t('Stack'); ?>',
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


<script>
(function( $ ) {
    $(document).ready(function () {
	$('#menu-chart_widget48').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget48',
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