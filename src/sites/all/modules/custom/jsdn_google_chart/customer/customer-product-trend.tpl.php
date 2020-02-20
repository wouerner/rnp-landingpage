<div id="product-trend-cost">
    <span id="curcost" style="display: none;"><span class="costlabel"><?php  print t("Current Cost");?>: </span> <span class="currentcost"></span></span>
    <span id="estimatedcost" style="display: none;">
        <span class="costlabel"><?php  print t("Estimated Cost");?>: </span><span class="estcost"></span>
        <span style="margin-left: 5px; padding-top: 2px; display: inline-block; height: 13px; width: 13px;"><img src="/cms/themes/jcdefault/images/info-icon.png" class="info-icon icon-estimated" title="" width="100%"></span>
    </span>
</div>
<div id="filter_product_trend" class="filter-dropdown">
    <div id="filter_spend_provider_div2" class="filter-dropdown">
        <div class="widgetDotMenu">
            <i id="menu-chart_widget6" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
        </div>
    </div>
</div>
<div id="loaderDiv6" class="loaderDiv"></div>
<div id="chart_widget6" class="chart_daily_trend jsdn_chart"></div>
<div class="clear"></div>

<script>
(function( $ ) {
    $( document ).ready(function() {  
       chart_widget6(5);
    });
    
    $(document).ready(function () {
	$('#menu-chart_widget6').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget6',
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
    
