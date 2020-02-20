<div id="product-trend-cost">
    <div class="container-Wrapper margin-0">
        <div class="wrapperCost">
            <div class="overallCost1 floatLeft overallBg dashboardboxSelected">
                <div class=" overallCost-Left">
                    <div class="executiveHeading margin-0">
                        <div id="curcost" style="display: none;">
                            <span class="costlabel"><?php echo t('Overall Cost');?>: </span> 
                            <span><p class="currentcost executivePrice"></p></span>
                        </div>
                    </div>
                    <p class="margin-0">
                        <span class="executivePercent" style="display: none;"> 
                            <span id="diffcost">
                                <span class="differencecost"></span>
                            </span>
                        </span> 
                    </p>
                    <div class="clear"></div>
                    <div class="executivePeriod margin-0"> 
                        <div id="precost" style="display: none;">
                            <span class="costlabel"><?php echo t('Previous Period');?>: </span> 
                            <span><p class="previouscost executiveprev-price"></p></span>  
                        </div>
                    </div>
                </div>
                <div class="overallCost-Right">
                    <div id="chart_widget1" class="chart_daily_trend"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
(function( $ ) {
    $( document ).ready(function() {
        chart_widget1(5);
    });
})( jQuery ); 
</script>