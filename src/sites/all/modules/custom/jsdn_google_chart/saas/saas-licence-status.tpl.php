<div id="filter_spend_provider_div28" class="filter-dropdown">
    <div id="filter_cost_resources" class="filter-dropdown">
        <div class="widgetDotMenu">
        <i id="menu-chart_widget28" class="material-icons md-18 sm-icon" title="Options">more_vert</i>
        </div>
    </div>
</div>
<div id="loaderDiv28" class="loaderDiv"></div>
<div id="chart_widget28" class="chart_daily_trend jsdn_chart"></div>
<div class="clear"></div>
<div class="widget-icon-div" style="display: none"><img src="/cms/themes/jcdefault/images/info-icon.png" class="widget-info-icon" id="spend-provider-info" title="<div>'<?php  print t("This report can be used to leverage arbitrage opportunities between clouds, so one can check if it's worthwhile to move assets to another vendor, assuming that application portability between clouds is relevant and feasible.");?>'<br><b>'<?php  print t("For more details, refer to the");?>' <a class='jsdnHelp' url='saas_dashboard.06.1.html#1311817'>'<?php  print t("Help");?>'</a> '<?php  print t("section");?>'</b></div>" /></div>
<script>
(function( $ ) {
        $( document ).ready(function() {
            chart_widget28(5);
        });
        $(document).ready(function () {
            $('#menu-chart_widget28').materialMenu('init', {
		position: 'overlay',
		identifier:'chart_widget28',
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