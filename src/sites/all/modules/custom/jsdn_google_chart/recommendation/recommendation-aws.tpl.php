<div id="inventory_widget11" align='center'>
<div class="recomondation-container">
<div id="loaderDiv8" class="loaderDiv recomondation"></div>
<div id="jc_database" class="recomondation" style="display:none">
	<div class="floatLeft resource fail">
            <div class="database">
                <span><?php print t('Database');?></span>
            </div>
	</div>
	<div class="floatLeft resDwidth">            
             <span class="count database-oversized floatLeft"></span>
                <span class="resourcestatus floatLeft"><?php print t('Underutilized');?></span>
            <div class="clear"></div>
                <span class="count database-unused floatLeft"><?php print $intanceStopped;?></span>
                <span class="resourcestatus floatLeft"><?php print t('Unused');?></span>
	</div>
</div>
<div id="loaderDiv5" class="loaderDiv recomondation"></div>
<div id="jc_volume" class="recomondation" style="display:none">
	<div class="floatLeft resource">
            <div class="volume">
                <span><?php print t('Volume');?></span>
            </div>
	</div>
	<div class="floatLeft twidth">
            <span class="count floatLeft"></span>
            <span class="resourcestatus floatLeft"><?php print t('Unused');?></span>
	</div>
</div>
<div id="loaderDiv2" class="loaderDiv recomondation"></div>
<div id="jc_instance" class="recomondation" style="display:none">
	<div class="floatLeft resource">
            <div class="instance">
                <span><?php print t('Instances');?></span>
            </div>
	</div>
	<div class="floatLeft resDwidth">
            <span class="count resource-oversized floatLeft"></span>
                <span class="resourcestatus floatLeft"><?php print t('Underutilized');?></span>
            <div class="clear"></div>
                <span class="count resource-stopped floatLeft"></span>
                <span class="resourcestatus floatLeft"><?php print t('Stopped');?></span>
	</div>
</div>
<div id="loaderDiv3" class="loaderDiv recomondation"></div>
<div  id="jc_snapshot" class="recomondation" style="display:none">
	<div class="floatLeft resource">
            <div class="snapshot">
                <span><?php print t('Snapshot');?></span>
            </div>
	</div>
	<div class="floatLeft twidth">
            <span class="count floatLeft"></span>
            <span class="resourcestatus floatLeft"><?php print t('Redundant');?></span>
	</div>
</div>
<div id="loaderDiv6" class="loaderDiv recomondation"></div>
<div id="jc_security" class="recomondation" style="display:none">
	<div class="floatLeft resource fail">
            <div class="security">
                <span><?php print t('Security');?> </span>
            </div>
	</div>
	<div class="floatLeft twidth">
            <span class="count floatLeft resource-security"></span>
            <span class="resourcestatus floatLeft"><?php print t('Need Attention');?></span>
	</div>
</div>
<div id="loaderDiv7" class="loaderDiv recomondation"></div>
<div id="jc_load_balancer" class="recomondation" style="display:none">
	<div class="floatLeft resource fail">
            <div class="lBalncer">
                <span><?php print t('Load Balancer');?></span>
            </div>
	</div>
	<div class="floatLeft twidth">
            <span class="count floatLeft"></span>
            <span class="resourcestatus floatLeft"><?php print t('Unused');?></span>
	</div>
</div>
<div id="loaderDiv1" class="loaderDiv recomondation"></div>
<div id="jc_ip" class="recomondation" style="display:none">
	<div class="floatLeft resource" >
            <div class="ip">
                <span><?php print t('Public IP');?></span>
            </div>
	</div>
	<div class="floatLeft twidth">
            <span class="count floatLeft"></span>
            <span class="resourcestatus floatLeft"><?php print t('Unused');?></span>
	</div>
</div>
<div id="loaderDiv4" class="loaderDiv recomondation"></div>
<div id="jc_image" class="recomondation" style="display:none">
	<div class="floatLeft resource">
            <div class="image">
                <span><?php print t('Image');?></span>
            </div>
	</div>
	<div class="floatLeft twidth">
		<span class="count floatLeft"></span>
		<span class="resourcestatus floatLeft"><?php print t('Redundant');?></span>
	</div>
</div>
<!--
<div id="loaderDiv17" class="loaderDiv recomondation"></div>
<div id="jc_reservation" class="recomondation" style="display:none">
    <div class="floatLeft resource">
        <div class="reservation">
            <span><?php print t('Reserved Instance');?></span>
        </div>
    </div>
    <div class="floatLeft resDwidth">
        <span class="count resource-purchased floatLeft"></span>
        <span class="resourcestatus floatLeft"><?php print t('Purchase');?></span>
         <div class="clear"></div>
        <span class="count resource-sell floatLeft"></span>
        <span class="resourcestatus floatLeft"><?php print t('Sell');?></span>
    </div>
</div>
-->
</div> 
</div>
<div class="clear"></div>
<div id="inventory_widget12" class="inventory_widget12 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table1">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="2" class="filter-head">
                    <div class="table-title"><?php print t('Unused Public IPs');?></div>
                    <div class="recommendation-tooltip"><?php print t('Public IPs that are not attached to any Network Interface should be released to reduce cost.');?></div>
                </th>
                <th class="filter-head">
                    <div id="csvIP" class="csvDiv"></div>
                </th>
            </tr>
            <tr class="headertable">
                <th class="exportheader" id="inven_th"><?php print t('Public IP');?></th>
                <th class="exportheader" id="inven_th"><?php print t('Private IP');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Scope');?> </th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table> 
<div id="paginationDiv1"></div>
</div>
<div id="inventory_widget13" class="inventory_widget13 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table2">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="5" class="filter-head">
                    <div class="table-title"><?php print t('Underutilized VMs'); ?></div>
                    <div class="recommendation-tooltip"><?php print t('An Instance is considered "Underutilized" if anytime in the last 30 days the Average CPU utilization < 60% and Maximum CPU utilization < 80%. Resize or terminate the instance to control costs.'); ?></div>
                </th>
                <th class="filter-head">
                    <div id="csvOversizedInstance" class="csvDiv"></div>
                </th>
            </tr>
            <tr class="headertable">
                <th class="exportheader" id="inven_th"><?php print t('Instance Name'); ?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Instance ID'); ?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Instance Type'); ?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Launch Time'); ?> </th>
                <th class="exportheader" id="inven_th"><?php print t('VM state'); ?> </th>
                <th id="inven_th"><?php print t('Download'); ?> </th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table> 
<div id="paginationDiv2"></div>
</div>
<div id="inventory_widget21" class="inventory_widget21 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table10">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="3" class="filter-head">
                    <div class="table-title"><?php print t('Stopped  VMs');?></div>
                    <div class="recommendation-tooltip"><?php print t('Instances currently in Stopped state may be still charged, so consider Terminating if you do not need it. Remember to release associated IPs and terminate the volume to control costs. You may also want to take an image before terminating, in case you need to spin up  the VM later.');?></div>
                </th>
                <th class="filter-head">
                    <div id="csvStoppedInstance" class="csvDiv"></div>
                </th>
            </tr>
            <tr class="headertable">
                <th class="exportheader" id="inven_th"><?php print t('Instance Name'); ?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Instance ID'); ?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Instance Type'); ?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Launch Time'); ?> </th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table> 
<div id="paginationDiv10"></div>
</div>
<div id="inventory_widget14" class="inventory_widget14 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table3">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="3" class="filter-head">
                    <div class="table-title"><?php print t('Unused Volumes');?></div>
                    <div class="recommendation-tooltip"><?php print t('Take a snapshot if required for future use and then Delete the unattached (unused) volumes to lower the cloud storage cost. Alternatively, you may also attach the unused volume to another VM.');?></div>
                </th>
                <th class="filter-head">
                    <div id="csvVolume" class="csvDiv"></div>
                </th>
            </tr>
            <tr class="headertable">
                <th class="exportheader" id="inven_th"><?php print t('Volume ID');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Volume Type');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Created Date');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Size');?> </th>
            </tr>
        </thead>
        <tbody></tbody>
    </table> 
<div id="paginationDiv3"></div>
</div>
<div id="inventory_widget15" class="inventory_widget15 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table4">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="4" class="filter-head">
                    <div class="table-title"><?php print t('Redundant Snapshots');?></div>
                    <div class="recommendation-tooltip"><?php print t('Consider deleting the following Snapshots that are older than 3/6/12 months to reduce cloud cost');?></div>
                </th>
                <th class="filter-head">
                    <div class="StatusDiv4 search-bar">
                        <select id="tab_sel"></select>
                    </div>
                    <div id="csvSnapshot" class="csvDiv"></div>
                </th>
            </tr>
            <tr class="headertable">
                <th class="exportheader" id="inven_th"><?php print t('Snapshot ID');?></th>
                <th class="exportheader" id="inven_th"><?php print t('Created Date');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Volume ID');?></th>
                <th class="exportheader" id="inven_th"><?php print t('Volume Size');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Snapshot Age');?> </th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table> 
<div id="paginationDiv4"></div>
</div>
<div id="inventory_widget16" class="inventory_widget16 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table5">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="5" class="filter-head">
                    <div class="table-title"><?php print t('Redundant Images');?></div>
                    <div class="recommendation-tooltip"><?php print t('Consider deleting the following images that are older than 3/6/12 months to reduce cloud costs.');?></div>
                </th>
                <th class="filter-head">
                    <div class="StatusDiv5 search-bar">
                        <select id="tab_sel"></select>
                    </div>
                    <div id="csvImage" class="csvDiv"></div>
                </th>
            </tr>
            <tr class="headertable">
                <th class="exportheader" id="inven_th"><?php print t('Image ID');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Image Name');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Image Type');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Created Date');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Size');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Image Age');?> </th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table> 
<div id="paginationDiv5"></div>
</div>
<div id="inventory_widget17" class="inventory_widget17 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table6">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="1" class="filter-head">
                    <div class="table-title"><?php print t('Load Balancers');?></div>
                    <div class="recommendation-tooltip"><?php print t('These Load Balancers do not have security groups associated. Please consider adding the security rules to protect your Load Balancers.');?></div>
                </th>
                <th  class="filter-head">
                    <div id="csvSecurity1" class="csvDiv"></div>
                </th>
            </tr>
            <tr class="headertable">
                <th class="exportheader" id="inven_th"><?php print t('Load Balancer Name');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('DNS Name');?> </th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table> 
<div id="paginationDiv6"></div>
</div>
<div id="inventory_widget19" class="inventory_widget19 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table8">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="2" class="filter-head">
                    <div class="table-title"><?php print t('Security Groups');?></div>
                    <div class="recommendation-tooltip"><?php print t('These security groups have opened ports other than 80 & 443 to the public internet. Please consider revising the rules for better security.');?></div>
                </th>
                <th class="filter-head">
                    <div id="csvSecurity2" class="csvDiv"></div>
                </th>
            </tr>
            <tr class="headertable">
                <th class="exportheader" id="inven_th"><?php print t('Security Group Id');?></th>
                <th class="exportheader" id="inven_th"><?php print t('Security Group Name');?></th>
                <th class="exportheader" id="inven_th"><?php print t('Description');?> </th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table> 
<div id="paginationDiv8"></div>
</div>
<div id="inventory_widget18" class="inventory_widget18 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table7">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="1" class="filter-head">
                    <div class="table-title"><?php print t('Load Balancer');?></div>
                    <div class="recommendation-tooltip"><?php print t('The following Elastic Load Balancers may have less than 2 Instances attached to them. Consider registering instances to utilize the ELB or delete it to manage cloud spend.');?></div>
                </th>
                <th class="filter-head">
                    <div id="csvBalancer" class="csvDiv"></div>
                </th>
            </tr>
            <tr class="headertable">
                <th class="exportheader" id="inven_th"><?php print t('Load Balancer Name');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('DNS Name');?> </th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table> 
<div id="paginationDiv7"></div>
</div>
<div id="inventory_widget20" class="inventory_widget20 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table9">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="5" class="filter-head">
                    <div class="table-title"><?php print t('Database Underutilized/Unused');?></div>
                    <div class="recommendation-tooltip"><?php print t('A Database is considered "Underutilized" if anytime in the last 30 days the Average CPU utilization < 60% and Maximum CPU utilization < 80%. <br> A Database  is considered as "Unused" if there are no connections for the last 15 days.Resize  or terminate the DBs to control cloud costs.'); ?></div>
                </th>
                <th class="filter-head">
                    <div class="StatusDiv6 search-bar">
                        <select id="tab_sel"></select>
                    </div>
                    <div id="csvDatabase" class="csvDiv"></div>
                </th>
            </tr>
            <tr class="headertable">
                <th class="exportheader" id="inven_th"><?php print t('Database ID');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Database Type');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Database Size');?></th>
                <th class="exportheader" id="inven_th"><?php print t('State');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Recommendation');?> </th>
                <th id="inven_th"><?php print t('Download');?> </th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table> 
<div id="paginationDiv9"></div>
</div>
<div id="inventory_widget33" class="inventory_widget33 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table17">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="8" class="filter-head">
                    <div class="table-title"><?php print t('Reserved Instance Purchase Recommendation');?></div>
                    <div class="recommendation-tooltip"><?php print t('Below RI purchase recommendations are based on past');?> <span id="reservationPurchaseDays"></span>  <?php print t('days of usage across region.');?></div>
                </th>
                <th class="filter-head">
                    <div id="csvReservation" class="csvDiv"></div>
                </th>
            </tr>
            <tr class="headertable">
                <th class="exportheader" id="inven_th"><?php print t('Recommended RI Type/Size');?></th>
                <th class="exportheader" id="inven_th"><?php print t('Platform');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Region');?></th>
                <th class="exportheader" id="inven_th"><?php print t('Recommended RI Quantity');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Payment Type');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Term');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Upfront Cost');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Estimated Monthly OnDemand Cost');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Monthly Saving');?> </th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table> 
<div id="paginationDiv17"></div>
</div>

<div id="inventory_widget35" class="inventory_widget35 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table19">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="14" class="filter-head">
                    <div class="table-title"><?php print t('Reserved Instance Sell Recommendation');?></div>
                    <div class="recommendation-tooltip"><?php print t('Below RI sell recommendations are based on past') ?> <span id="reservationSellDays"></span> <?php print ('days of usage across region.');?></div>
                </th>
                <th class="filter-head">
                    <div id="csvReservationSell" class="csvDiv"></div>
                </th>
            </tr>
            <tr class="headertable">
                <th class="exportheader" id="inven_th"><?php print t('Recommended Instance Type');?></th>
                <th class="exportheader" id="inven_th"><?php print t('Platform');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Recommended RI Type/Size');?></th>
                <th class="exportheader" id="inven_th"><?php print t('Start Date');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('End Date');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Payment Type');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Purchase Hour(s)');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Purchase Quantity');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Utilized Hour(s)');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Unused Hour(s)');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Threshold Hour(s)');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Unit Price');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Salable Quantity');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Contract Duration');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Amount Saved');?> </th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table> 
<div id="paginationDiv19"></div>
</div>
<div style="float:left;width: 100%;border-top: 1px solid #dbdbdb;margin: 25px 0 0 12px;text-align: left;">^ <?php print t('All the dates are based on the server date and not the UTC or customer time zone');?></div>
<script type="text/javascript">
(function( $ ) {
    var intancePurchasedDays = 30; 
    var intanceSellDays = 30;
   $( document ).ready(function() {
        recommendation_refresh_all_widget();
        $( ".recomondation" ).click(function() {
            if(!$(this).hasClass('nodata')){
                $('.recomondation').removeClass('active'); /* This '.HeadingDiv' could be anything, I need something dynamic here */
                $(this).addClass('active');
            }
        });
        $( "#csvIP" ).click(function() {
            var now = moment().format('YYYY-MM-DD hh:mm:ss');
            var outputFile = 'Unused_Public_IP_'+now;
            outputFile = outputFile.replace('.csv','') + '.csv'
            // CSV
            exportTableToCSV.apply(this, [$('#inventoy_table1'), outputFile]);
        });
        $( "#csvOversizedInstance" ).click(function() {
            var now = moment().format('YYYY-MM-DD hh:mm:ss');
            var outputFile = 'Underutilized_VMs_'+now;   
            outputFile = outputFile.replace('.csv','') + '.csv'
            // CSV
            exportTableToCSV.apply(this, [$('#inventoy_table2'), outputFile]);
        });
        $( "#csvStoppedInstance" ).click(function() {
            var now = moment().format('YYYY-MM-DD hh:mm:ss');
            var outputFile = 'Stopped_VMs_'+now;   
            outputFile = outputFile.replace('.csv','') + '.csv'
            // CSV
            exportTableToCSV.apply(this, [$('#inventoy_table10'), outputFile]);
        });
        $( "#csvVolume" ).click(function() {
            var now = moment().format('YYYY-MM-DD hh:mm:ss');
            var outputFile = 'Unused_Volume_'+now;        
            outputFile = outputFile.replace('.csv','') + '.csv'
            // CSV
            exportTableToCSV.apply(this, [$('#inventoy_table3'), outputFile]);
        });
        $( "#csvSnapshot" ).click(function() {
            var now = moment().format('YYYY-MM-DD hh:mm:ss');
            var outputFile = 'Redundant_Snapshots_'+now;       
            outputFile = outputFile.replace('.csv','') + '.csv'
            // CSV
            exportTableToCSV.apply(this, [$('#inventoy_table4'), outputFile]);
        });
        $( "#csvImage" ).click(function() {
            var now = moment().format('YYYY-MM-DD hh:mm:ss');
            var outputFile = 'Redundant_Image_'+now;          
            outputFile = outputFile.replace('.csv','') + '.csv'
            // CSV
            exportTableToCSV.apply(this, [$('#inventoy_table5'), outputFile]);
        });
        $( "#csvSecurity1" ).click(function() {
            var now = moment().format('YYYY-MM-DD hh:mm:ss');
            var outputFile = 'Need_Attention_Security_ELB_'+now;
            outputFile = outputFile.replace('.csv','') + '.csv'
            // CSV
            exportTableToCSV.apply(this, [$('#inventoy_table6'), outputFile]);
        });
        $( "#csvSecurity2" ).click(function() {
            var now = moment().format('YYYY-MM-DD hh:mm:ss');
            var outputFile = 'Need_Attendtion_Security_'+now;
            outputFile = outputFile.replace('.csv','') + '.csv'
            // CSV
            exportTableToCSV.apply(this, [$('#inventoy_table8'), outputFile]);
        });
        $( "#csvBalancer" ).click(function() {
            var now = moment().format('YYYY-MM-DD hh:mm:ss');
            var outputFile = 'Unused_Load_Balancer_'+now;
            outputFile = outputFile.replace('.csv','') + '.csv'
            // CSV
            exportTableToCSV.apply(this, [$('#inventoy_table7'), outputFile]);
        });
        $( "#csvDatabase" ).click(function() {
            var now = moment().format('YYYY-MM-DD hh:mm:ss');
            var outputFile = 'Unused_Underutilized_Databases_'+now;  
            outputFile = outputFile.replace('.csv','') + '.csv'
            // CSV
            exportTableToCSV.apply(this, [$('#inventoy_table9'), outputFile]);
        });
        $( "#csvReservation" ).click(function() {
            var now = moment().format('YYYY-MM-DD hh:mm:ss');
            var outputFile = 'Purchased_Reserved_Instance_'+now;  
            outputFile = outputFile.replace('.csv','') + '.csv'
            // CSV
            exportTableToCSV.apply(this, [$('#inventoy_table17'), outputFile]);
        });
        $( "#csvReservationSell" ).click(function() {
            var now = moment().format('YYYY-MM-DD hh:mm:ss');
            var outputFile = 'Sell_Reserved_Instance_'+now;  
            outputFile = outputFile.replace('.csv','') + '.csv'
            // CSV
            exportTableToCSV.apply(this, [$('#inventoy_table19'), outputFile]);
        });
   });
    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    function recommendation_refresh_all_widget() {  
        recommendation_widget1('ip');
        recommendation_widget2('instance');
        recommendation_widget3('snapshot');
        recommendation_widget4('image');
        recommendation_widget5('volume');
        recommendation_widget6('security');
        recommendation_widget7('load_balancer');
        recommendation_widget8('database');
        //recommendation_widget17('reservation');
    }
    //------------------------------------------------------------
    // Helper Functions for IP Recommendation
    //------------------------------------------------------------
    function recommendation_widget1(type) {
        var elementId= 'jc_ip';
        var loaderId = 'loaderDiv1';
        recommendation_ajax_request(elementId, loaderId, type);
    }
    //------------------------------------------------------------
    // Helper Functions Instance Recommendation
    //------------------------------------------------------------
    function recommendation_widget2(type) {
        var elementId= 'jc_instance';
        var loaderId = 'loaderDiv2';
        recommendation_ajax_request(elementId, loaderId, type);
    }
    //------------------------------------------------------------
    // Helper Functions Snapshot Recommendation
    //------------------------------------------------------------
    function recommendation_widget3(type) {
        var elementId= 'jc_snapshot';
        var loaderId = 'loaderDiv3';
        recommendation_ajax_request(elementId, loaderId, type);
    }
    //------------------------------------------------------------
    // Helper Functions Image Recommendation
    //------------------------------------------------------------
    function recommendation_widget4(type) {
        var elementId= 'jc_image';
        var loaderId = 'loaderDiv4';
        recommendation_ajax_request(elementId, loaderId, type);
    }
    //------------------------------------------------------------
    // Helper Functions Volume Recommendation
    //------------------------------------------------------------
    function recommendation_widget5(type) {
        var elementId= 'jc_volume';
        var loaderId = 'loaderDiv5';
        recommendation_ajax_request(elementId, loaderId, type);
    }
    //------------------------------------------------------------
    // Helper Functions Security Recommendation
    //------------------------------------------------------------
    function recommendation_widget6(type) {
        var elementId= 'jc_security';
        var loaderId = 'loaderDiv6';
        recommendation_ajax_request(elementId, loaderId, type);
    }
    //------------------------------------------------------------
    // Helper Functions Load Balancer Recommendation
    //------------------------------------------------------------
    function recommendation_widget7(type) {
        var elementId= 'jc_load_balancer';
        var loaderId = 'loaderDiv7';
        recommendation_ajax_request(elementId, loaderId, type);
    }
    //------------------------------------------------------------
    // Helper Functions database Recommendation
    //------------------------------------------------------------
    function recommendation_widget8(type) {
        var elementId= 'jc_database';
        var loaderId = 'loaderDiv8';
        recommendation_ajax_request(elementId, loaderId, type);
    }
    //------------------------------------------------------------
    // Helper Functions reservation Purchase Recommendation
    //------------------------------------------------------------
    function recommendation_widget17(type) {
        //var elementId= 'jc_reservation';
        //var loaderId = 'loaderDiv17';
        //recommendation_ajax_request(elementId, loaderId, type);
    }
    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    function recommendation_ajax_request(elementId, loaderId, type){
        var fields = {type : type};
        var empty_message = '<?php print t("Not able to get the data currently. Please contact support.");?>';
        xhr = jQuery.ajax({  
            type: "POST",  
            url: '/cms/jsdnConnect/recommendationAPI.php',
            data: fields,
            dataType: 'json',
            error: function(error){
                $("#"+loaderId).hide();
                $("#"+elementId).show();
                $("#"+elementId).html('<div class="noData">'+empty_message+'</div>');
            },
            success: function(recommendation_result) {
                if(type == 'instance'){
                    var stopped = recommendation_result[1];
                    var oversized = recommendation_result[0];
                    var intanceStopped = stopped.intanceStopped; 
                    var intanceOversized = oversized.intanceOversized;
                    recommendation_result.shift();
                    recommendation_result.shift();
                    if((intanceStopped > 0) || (intanceOversized > 0)){
                        $("#"+elementId+" .resource" ).addClass( "fail" );
                    } 
                    else{
                        $( "#"+elementId ).addClass( "nodata" );
                        $( "#"+elementId+" .resource" ).addClass( "success" );
                    }
                    $("#"+elementId+" span.resource-stopped").text(intanceStopped);
                    $("#"+elementId+" span.resource-oversized" ).text(intanceOversized);
                }
                else if(type == 'database'){
                    var stopped = recommendation_result[1];
                    var oversized = recommendation_result[0];
                    var databaseStopped = stopped.databaseStopped; 
                    var databaseOversized = oversized.databaseOversized;
                    recommendation_result.shift();
                    recommendation_result.shift();
                    if((databaseStopped > 0) || (databaseOversized > 0)){
                        $("#"+elementId+" .resource" ).addClass( "fail" );
                    } 
                    else{
                        $( "#"+elementId ).addClass( "nodata" );
                        $( "#"+elementId+" .resource" ).addClass( "success" );
                    }
                    
                    $("#"+elementId+" span.database-unused" ).text(databaseStopped);
                    $("#"+elementId+" span.database-oversized" ).text(databaseOversized);
                }
                else if(type == 'security'){
                    var security = recommendation_result[0];
                    var intanceSecurity = security.intanceSecurity; 
                    $("#"+elementId+" span.resource-security" ).text(intanceSecurity);
                    if(intanceSecurity > 0){
                        $("#"+elementId+" .resource" ).addClass( "fail" );
                    } 
                    else{
                        $( "#"+elementId ).addClass( "nodata" );
                        $( "#"+elementId+" .resource" ).addClass( "success" );
                    }
                    recommendation_result.shift();
                }
                else if(type == 'reservation'){
                    var reservationPurchased = recommendation_result[1];
                    var reservationSell = recommendation_result[0];
                    var intancePurchased = reservationPurchased.reservationPurchased; 
                    var intanceSell = reservationSell.reservationSell;
                    var reservationPurchasedDays = recommendation_result[3];
                    var reservationSellDays = recommendation_result[2];
                    intancePurchasedDays = reservationPurchasedDays.reservationPurchasedDays; 
                    intanceSellDays = reservationSellDays.reservationSellDays;
                    $("#reservationPurchaseDays").text(intancePurchasedDays);
                    $("#reservationSellDays").text(intanceSellDays);
                    recommendation_result.shift();
                    recommendation_result.shift();
                    recommendation_result.shift();
                    recommendation_result.shift();
                    if((intancePurchased > 0) || (intanceSell > 0)){
                        $("#"+elementId+" .resource" ).addClass( "fail" );
                    } 
                    else{
                        $( "#"+elementId ).addClass( "nodata" );
                        $( "#"+elementId+" .resource" ).addClass( "success" );
                    }
                    $("#"+elementId+" span.resource-purchased" ).text(intancePurchased);
                    $("#"+elementId+" span.resource-sell" ).text(intanceSell);
                }
                else{
                     $("#"+elementId+" span.count" ).text(recommendation_result.length);
                }
                
                if(recommendation_result.length >= 1){
                    var recommendation = ["security", "instance"];
                    var exits = recommendation.indexOf(type);
                    if(exits == -1){
                        $("#"+elementId+" .resource" ).addClass( "fail" );
                    }        
           
                    if(type == 'ip'){
                        ipDataToTable(recommendation_result);
                    }
                    else if(type == 'instance'){
                        instanceDataToTable(recommendation_result);
                    }
                    else if(type == 'snapshot'){
                        snapshotDataToTable(recommendation_result);
                    }
                    else if(type == 'image'){
                        imageDataToTable(recommendation_result);
                    }
                    else if(type == 'volume'){
                        volumeDataToTable(recommendation_result);
                    }
                    else if(type == 'load_balancer'){
                        loadBalancerDataToTable(recommendation_result);
                    }
                    else if(type == 'security'){
                        securityDataToTable(recommendation_result);
                    }
                    else if(type == 'database'){
                        databaseDataToTable(recommendation_result);
                    }
                    else if(type == 'reservation'){
                        reservationDataToTable(recommendation_result);
                    }
                }
                else{
                    $( "#"+elementId ).addClass( "nodata" );
                    $( "#"+elementId+" .resource" ).addClass( "success" );
                }
                $("#"+loaderId).hide();
                $("#"+elementId).show();
            }
        });
    }
    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    function volumeDataToTable(volumeData) {
        var trHTML = '';
        var convertedDate;
        $.each(volumeData, function (i, item) {
            trHTML += '<tr class="border_bottom">';
            trHTML += '<td class="export">' + item.VolumeId + '</td>';
            trHTML += '<td class="export">'+ item.VolumeType+'</td>';
            convertedDate = moment.utc(''+item.CreateTime+'').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss');
            trHTML += '<td class="export">' + convertedDate + '</td>';
            trHTML += '<td class="export">'+ item.Size+' GB</td></tr>';
        });
        $('#inventoy_table3 > tbody:last-child').append(trHTML);
        var Props = {
                    col_1: "none",
                    col_2: "none",
                    col_3:"none",
                    col_4:"none",
                    display_all_text: '<?php print t("All");?>',
                    sort_select: true,
                    paging: true,  
                    paging_length: 10,  
                    stylesheet: '',
                    paging_target_id: 'paginationDiv3', 
                    filters_row_index: 2, 
                    on_keyup: true,
                    on_after_change_page:function(o,i){ },
                    on_after_filter:function(o,i){ }
                };  
        var tf2 = setFilterGrid("inventoy_table3", Props);

        $( "#jc_volume" ).click(function() {
            $("#inventory_widget14").show();
            $("#inventory_widget13").hide();
            $("#inventory_widget12").hide();
            $("#inventory_widget15").hide();
            $("#inventory_widget16").hide();
            $("#inventory_widget17").hide();  
            $("#inventory_widget18").hide(); 
            $("#inventory_widget19").hide();
            $("#inventory_widget20").hide();
            $("#inventory_widget21").hide();
            $("#inventory_widget33").hide();
            $("#inventory_widget35").hide();
            setTimeout(function(){  }, 30); 
        });
    }
    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    function ipDataToTable(ipData) {
        var trHTML = '';
        $.each(ipData, function (i, item) {
            trHTML += '<tr class="border_bottom">';
            trHTML += '<td class="export">' + item.PublicIp + '</td>';
            if(item.PrivateIpAddress){
                trHTML += '<td class="export">'+ item.PrivateIpAddress+'</td>';
            }
            else{
                trHTML += '<td class="export">' + '---' + '</td>';
            }
            trHTML += '<td class="export">' + item.Domain + '</td></tr>';
        });
        $('#inventoy_table1 > tbody:last-child').append(trHTML);
        var Props = {
                col_1: "none",
                col_2: "none",
                col_3:"none",
                col_4:"none",
                display_all_text: '<?php echo t("All")?>',
                sort_select: true,
                paging: true,  
                paging_length: 10,  
                stylesheet: '',
                paging_target_id: 'paginationDiv1', 
                filters_row_index: 2, 
                on_keyup: true,
                on_after_change_page:function(o,i){ },
                on_after_filter:function(o,i){ }
            };  
        var tf2 = setFilterGrid("inventoy_table1", Props); 

        $( "#jc_ip" ).click(function() {
            $("#inventory_widget12").show();
            $("#inventory_widget13").hide();
            $("#inventory_widget14").hide();
            $("#inventory_widget15").hide();
            $("#inventory_widget16").hide();
            $("#inventory_widget17").hide();  
            $("#inventory_widget18").hide();
            $("#inventory_widget19").hide();
            $("#inventory_widget20").hide();
            $("#inventory_widget21").hide();
            $("#inventory_widget33").hide();
            $("#inventory_widget35").hide();
            setTimeout(function(){  }, 30); 
        });
    }
    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    function snapshotDataToTable(snapshotData) {
        var trHTML = '';
        var convertedDate;
        $.each(snapshotData, function (i, item) {
            var snapshotString = '<?php print t("More than");?>';
            trHTML += '<tr class="border_bottom">';
            trHTML += '<td class="export">' + item.SnapshotId + '</td>';
            convertedDate = moment.utc(''+item.snap_date+'').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss');
            trHTML += '<td class="export">' + convertedDate + '</td>';
            trHTML += '<td class="export">' + item.VolumeId + '</td>';
            trHTML += '<td class="export">' + item.VolumeSize + ' GB</td>';
            trHTML += '<td class="export">' + snapshotString + ' ' + item.days_elapsed + '</td>';
            trHTML += '<td style="display:none">' + snapshotString + ' ' + item.days_elapsed + '</td></tr>';
        });
        $('#inventoy_table4 > tbody:last-child').append(trHTML);
        var Props = {
                    col_1: "none",
                    col_2: "none",
                    col_3: "none",
                    col_4: "none",
                    col_5: "select",
                    display_all_text: '<?php print t("All");?>',
                    sort_select: true,
                    paging: true,  
                    paging_length: 10,  
                    stylesheet: '',
                    paging_target_id: 'paginationDiv4', 
                    filters_row_index: 2, 
                    on_keyup: true,
                    on_after_change_page:function(o,i){ },
                    on_after_filter:function(o,i){ }
                };  
        var tf2 = setFilterGrid("inventoy_table4", Props); 
        
        $('.StatusDiv4 select').html($('#flt5_inventoy_table4').html());
        $('.StatusDiv4 select option[value=""]').text('All');
        $('.StatusDiv4 select').change(function(){
            $('#flt5_inventoy_table4').val($(this).val()).change();
        });

        $( "#jc_snapshot" ).click(function() {
            $("#inventory_widget15").show();
            $("#inventory_widget13").hide();
            $("#inventory_widget12").hide();
            $("#inventory_widget14").hide();
            $("#inventory_widget16").hide();
            $("#inventory_widget17").hide();  
            $("#inventory_widget18").hide(); 
            $("#inventory_widget19").hide();
            $("#inventory_widget20").hide();
            $("#inventory_widget21").hide();
            $("#inventory_widget33").hide();
            $("#inventory_widget35").hide();
            setTimeout(function(){  }, 30); 
        });
    }
    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    function imageDataToTable(imageData) {
        var trHTML = '';
        var convertedDate;
        $.each(imageData, function (i, item) {
            var imageString = '<?php print t("More than");?>';
            trHTML += '<tr class="border_bottom">';
            trHTML += '<td class="export">' + item.ImageId + '</td>';
            trHTML += '<td class="export">' + item.Name + '</td>';
            trHTML += '<td class="export">' + item.ImageType + '</td>';
            convertedDate = moment.utc(''+item.CreationDate+'').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss');
            trHTML += '<td class="export">' + convertedDate + '</td>';
            trHTML += '<td class="export">' + item.BlockDeviceMappings[0].Ebs.VolumeSize + ' GB</td>';
            trHTML += '<td class="export">' + imageString + ' ' + item.days_elapsed + '</td>';
            trHTML += '<td style="display:none">' + imageString + ' ' + item.days_elapsed + '</td></tr>';
        });
        $('#inventoy_table5 > tbody:last-child').append(trHTML);
        var Props = {
                col_1: "none",
                col_2: "none",
                col_3:"none",
                col_4:"none",
                col_5:"none",
                col_6:"select",
                display_all_text:'<?php print t("All");?>',
                sort_select: true,
                paging: true,  
                paging_length: 10,  
                stylesheet: '',
                paging_target_id: 'paginationDiv5', 
                filters_row_index: 2, 
                on_keyup: true,
                on_after_change_page:function(o,i){ },
                on_after_filter:function(o,i){ }
            };  
            var tf2 = setFilterGrid("inventoy_table5", Props);
            
            $('.StatusDiv5 select').html($('#flt6_inventoy_table5').html());
            $('.StatusDiv5 select option[value=""]').text('All');
            $('.StatusDiv5 select').change(function(){
                $('#flt6_inventoy_table5').val($(this).val()).change();
            });
        
            $( "#jc_image" ).click(function() {
                $("#inventory_widget16").show();
                $("#inventory_widget13").hide();
                $("#inventory_widget12").hide();
                $("#inventory_widget15").hide();
                $("#inventory_widget14").hide();
                $("#inventory_widget17").hide();  
                $("#inventory_widget18").hide(); 
                $("#inventory_widget19").hide();
                $("#inventory_widget20").hide();
                $("#inventory_widget21").hide();
                $("#inventory_widget33").hide();
                $("#inventory_widget35").hide();
                setTimeout(function(){  }, 30); 
            });
    }
    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    function loadBalancerDataToTable(balancerData) {
        var trHTML = '';
        $.each(balancerData, function (i, item) {
            trHTML += '<tr class="border_bottom">';
            trHTML += '<td class="export">' + item.LoadBalancerName + '</td>';
            trHTML += '<td class="export">' + item.DNSName + '</td>';
            trHTML += '</tr>';
        });
        $('#inventoy_table7 > tbody:last-child').append(trHTML);
        var Props = {
                col_1: "none",
                col_2: "none",
                col_3:"none",
                col_4:"none",
                display_all_text: '<?php print t("All");?>',
                sort_select: true,
                paging: true,  
                paging_length: 10,  
                stylesheet: '',
                paging_target_id: 'paginationDiv7', 
                filters_row_index: 2, 
                on_keyup: true,
                on_after_change_page:function(o,i){ },
                on_after_filter:function(o,i){ }
            };  
        var tf2 = setFilterGrid("inventoy_table7", Props); 

        $( "#jc_load_balancer" ).click(function() {
            $("#inventory_widget18").show();
            $("#inventory_widget13").hide();
            $("#inventory_widget12").hide();
            $("#inventory_widget15").hide();
            $("#inventory_widget14").hide();
            $("#inventory_widget17").hide();
            $("#inventory_widget16").hide();
            $("#inventory_widget19").hide();
            $("#inventory_widget20").hide();
            $("#inventory_widget21").hide();
            $("#inventory_widget33").hide();
            $("#inventory_widget35").hide();
            setTimeout(function(){  }, 30); 
        });
    }
    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    function securityDataToTable(securityData) {
        var security = securityData[0];
        var recommendation_security = security.recommendation_security;
        var security_elb = securityData[1];
        var recommendation_security_elb = security_elb.recommendation_security_elb;
        
        if(recommendation_security_elb.length > 0){
            var trHTML = '';
            $.each(recommendation_security_elb, function (i, item) {
                trHTML += '<tr class="border_bottom">';
                trHTML += '<td class="export">' + item.LoadBalancerName + '</td>';
                trHTML += '<td class="export"><div class="truncate" title="' + item.DNSName + '">' + item.DNSName + '</div></td>';
                trHTML += '</tr>';
            });
            $('#inventoy_table6 > tbody:last-child').append(trHTML);
            var Props = {
                    col_1: "none",
                    col_2: "none",
                    col_3:"none",
                    col_4:"none",
                    display_all_text: '<?php echo t("All")?>',
                    sort_select: true,
                    paging: true,  
                    paging_length: 10,  
                    stylesheet: '',
                    paging_target_id: 'paginationDiv6', 
                    filters_row_index: 2, 
                    on_keyup: true,
                    on_after_change_page:function(o,i){ },
                    on_after_filter:function(o,i){ }
                };  
            var tf2 = setFilterGrid("inventoy_table6", Props);
        }
       
        if(recommendation_security.length > 0){
            var trHTML = '';
            $.each(recommendation_security, function (i, item) {
                trHTML += '<tr class="border_bottom">';
                trHTML += '<td class="export">' + item.GroupId + '</td>';
                trHTML += '<td class="export"><div class="truncate" title="' + item.GroupName + '">' + item.GroupName + '</div></td>';
                trHTML += '<td class="export"><div class="truncate" title="' + item.Description + '">' + item.Description + '</div></td></tr>';
            });
            $('#inventoy_table8 > tbody:last-child').append(trHTML);
                var Props = {
                        col_1: "none",
                        col_2: "none",
                        col_3:"none",
                        col_4:"none",
                        display_all_text: '<?php print t("All");?>',
                        sort_select: true,
                        paging: true,  
                        paging_length: 10,  
                        stylesheet: '',
                        paging_target_id: 'paginationDiv8', 
                        filters_row_index: 2, 
                        on_keyup: true,
                        on_after_change_page:function(o,i){ },
                        on_after_filter:function(o,i){ }
            };  
            var tf3 = setFilterGrid("inventoy_table8", Props); 
        }
        
        $( "#jc_security" ).click(function() {
            if(recommendation_security.length > 0){    
                $("#inventory_widget19").show();
                $("#inventory_widget13").hide();
                $("#inventory_widget12").hide();
                $("#inventory_widget15").hide();
                $("#inventory_widget16").hide();
                $("#inventory_widget14").hide();
                $("#inventory_widget18").hide();
                $("#inventory_widget20").hide();
                $("#inventory_widget21").hide();
                $("#inventory_widget33").hide();
                $("#inventory_widget35").hide();
            }
            else{
                $("#inventory_widget19").hide();
            }
            if(recommendation_security_elb.length > 0){    
                $("#inventory_widget17").show();
                $("#inventory_widget13").hide();
                $("#inventory_widget12").hide();
                $("#inventory_widget15").hide();
                $("#inventory_widget16").hide();
                $("#inventory_widget14").hide();
                $("#inventory_widget18").hide();
                $("#inventory_widget20").hide();
                $("#inventory_widget21").hide();
                $("#inventory_widget33").hide();
                $("#inventory_widget35").hide();
            }
            else{
                $("#inventory_widget17").hide();
            }
            setTimeout(function(){  }, 30); 
        });
    }
    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    function instanceDataToTable(instanceData) {
        var convertedDate;        
        var stoppedInstances = instanceData[1] ? instanceData[1] : []; 
        var recommendation_stopped = stoppedInstances.recommendation_instances_stopped;
        var oversizedInstances = instanceData[0] ?  instanceData[0] : [];
        var recommendation_oversized = oversizedInstances.recommendation_instances_oversized;
        
        if(recommendation_oversized.length > 0){
            $("#jc_instance .resource" ).addClass( "fail" );
            var trHTML = '';
            $.each(recommendation_oversized, function (i, item) {
                trHTML += '<tr class="border_bottom">';
                if ((typeof(item.Tags) != "undefined") || (item.Tags != null)){
                    $.each(item.Tags, function (j, tags) {
                        if(tags.Key == "Name"){
                            trHTML += '<td class="export">' + tags.Value + '</td>';
                        }
                    });
                }
                else{
                    trHTML += '<td class="export">' +  + '</td>';
                }
                trHTML += '<td class="export">' + item.InstanceId + '</td>';
                trHTML += '<td class="export">' + item.InstanceType + '</td>';
                convertedDate = moment.utc(''+item.LaunchTime+'').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss');
                trHTML += '<td class="export">' + convertedDate + '</td>';
                trHTML += '<td class="export">' + item.State.Name + '</td>';
                trHTML += '<td><div title="Download CPU Utilization Metric" class="oversizedInstance" insID="'+ item.InstanceId+'"></div></td>';
                trHTML += '</tr>';
            });
            $('#inventoy_table2 > tbody:last-child').append(trHTML);
            var Props = {
                    col_1: "none",
                    col_2: "none",
                    col_3: "none",
                    col_4:"none",
                    col_5:"none",
                    col_6:"none",
                    col_7:"none",
                    display_all_text: '<?php echo t("All Status")?>',
                    sort_select: true,
                    paging: true,  
                    paging_length: 11,  
                    stylesheet: '',
                    paging_target_id: 'paginationDiv2', 
                    filters_row_index: 2, 
                    on_keyup: true,
                    on_after_change_page:function(o,i){ },
                    on_after_filter:function(o,i){ }
                };  
            var tf2 = setFilterGrid("inventoy_table2", Props); 
        }
        if(recommendation_stopped.length > 0){
            $("#jc_instance .resource" ).addClass( "fail" );
            var trHTML = '';
            $.each(recommendation_stopped, function (i, item) {
                trHTML += '<tr class="border_bottom">';
                if ((typeof(item.Tags) != "undefined") || (item.Tags != null)){
                    $.each(item.Tags, function (j, tags) {
                        if(tags.Key == "Name"){
                            trHTML += '<td class="export">' + tags.Value + '</td>';
                        }
                    });
                }
                else{
                    trHTML += '<td class="export">' +  + '</td>';
                }
                trHTML += '<td class="export">' + item.InstanceId + '</td>';
                trHTML += '<td class="export">' + item.InstanceType + '</td>';
                convertedDate = moment.utc(''+item.LaunchTime+'').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss');
                trHTML += '<td class="export">' + convertedDate + '</td>';
                trHTML += '</tr>';
            });
            $('#inventoy_table10 > tbody:last-child').append(trHTML);
            var Props1 = {
                    col_1: "none",
                    col_2: "none",
                    col_3: "none",
                    col_4:"none",
                    col_5:"none",
                    col_6:"none",
                    col_7:"none",
                    display_all_text: '<?php print t("All Status");?>',
                    sort_select: true,
                    paging: true,  
                    paging_length: 10,  
                    stylesheet: '',
                    paging_target_id: 'paginationDiv10', 
                    filters_row_index: 2, 
                    on_keyup: true,
                    on_after_change_page:function(o,i){ },
                    on_after_filter:function(o,i){ }
                };  
            var tf3 = setFilterGrid("inventoy_table10", Props1); 
        }
        
        $( "#jc_instance" ).click(function() {
            if(recommendation_oversized.length > 0){    
                $("#inventory_widget13").show();
                $("#inventory_widget12").hide(); 
                $("#inventory_widget14").hide();
                $("#inventory_widget15").hide();
                $("#inventory_widget16").hide();
                $("#inventory_widget17").hide();  
                $("#inventory_widget18").hide();
                $("#inventory_widget19").hide();
                $("#inventory_widget20").hide();
                $("#inventory_widget33").hide();
                $("#inventory_widget35").hide();
            }
            else{
                $("#inventory_widget13").hide();
            }
            if(recommendation_stopped.length > 0){    
               $("#inventory_widget21").show();
               $("#inventory_widget12").hide(); 
                $("#inventory_widget14").hide();
                $("#inventory_widget15").hide();
                $("#inventory_widget16").hide();
                $("#inventory_widget17").hide();  
                $("#inventory_widget18").hide();
                $("#inventory_widget19").hide();
                $("#inventory_widget20").hide();
                $("#inventory_widget33").hide();
                $("#inventory_widget35").hide();
            }
            else{
                $("#inventory_widget21").hide();
            }
            
            
            setTimeout(function(){  }, 30); 
        });
        
        $( ".oversizedInstance" ).click(function() {
            var type = 'instances_underutilized';
            var instanceId = $(this).attr('insID'); 
            recommendation_download_csv_request(type, instanceId);
        });
    }
    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    function databaseDataToTable(databaseData) {
        var trHTML = '';
        $.each(databaseData, function (i, item) {
            trHTML += '<tr class="border_bottom">';
            trHTML += '<td class="export">' + item.DBInstanceIdentifier + '</td>';
            trHTML += '<td class="export">' + item.DBInstanceClass + '</td>';
            trHTML += '<td class="export">' + item.AllocatedStorage + ' GB</td>';
            trHTML += '<td class="export">' + item.DBInstanceStatus + '</td>';
            if(item.recommendation_status === 'Underutilized'){
                trHTML += '<td class="export">' + item.recommendation_status + '</td>';
                trHTML += '<td><div title="Download CPU Utilization Metric" class="oversizedDatabase" insID="'+ item.DBInstanceIdentifier+'"></div></td>';            
            }
            else{
                trHTML += '<td class="export">' + item.recommendation_status + '</td>';
                trHTML += '<td><div title="Download Connection Rate Metric" class="unusedDatabase" insID="'+ item.DBInstanceIdentifier+'"></div></td>'; 
            }
            trHTML += '<td style="display:none">' + item.recommendation_status + '</td></tr>';
        });
        $('#inventoy_table9 > tbody:last-child').append(trHTML);
        var Props = {
                col_1: "none",
                col_2: "none",
                col_3: "none",
                col_4:"none",
                col_5:"none",
                col_6:"select",
                display_all_text: '<?php print t("All Status");?>',
                sort_select: true,
                paging: true,  
                paging_length: 10,  
                stylesheet: '',
                paging_target_id: 'paginationDiv9', 
                filters_row_index: 2, 
                on_keyup: true,
                on_after_change_page:function(o,i){ },
                on_after_filter:function(o,i){ }
            };  
        var tf2 = setFilterGrid("inventoy_table9", Props); 
        $('.StatusDiv6 select').html($('#flt6_inventoy_table9').html());
        $('.StatusDiv6 select option[value=""]').text('All Status');
        $('.StatusDiv6 select').change(function(){
            $('#flt6_inventoy_table9').val($(this).val()).change();
        });

        $( "#jc_database" ).click(function() {
            $("#inventory_widget20").show();
            $("#inventory_widget12").hide(); 
            $("#inventory_widget14").hide();
            $("#inventory_widget15").hide();
            $("#inventory_widget16").hide();
            $("#inventory_widget17").hide();  
            $("#inventory_widget18").hide();
            $("#inventory_widget19").hide();
            $("#inventory_widget13").hide();
            $("#inventory_widget21").hide();
            $("#inventory_widget33").hide();
            $("#inventory_widget35").hide();
            setTimeout(function(){  }, 30); 
        });
        
        $( ".oversizedDatabase" ).click(function() {
            var type = 'database_underutilized';
            var databaseId = $(this).attr('insID'); 
            recommendation_download_csv_request(type, databaseId);
        });
        
        $( ".unusedDatabase" ).click(function() {
            var type = 'database_unused';
            var databaseId = $(this).attr('insID'); 
            recommendation_download_csv_request(type, databaseId);
        });
    }
    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    function reservationDataToTable(reservationData) {
        var recommendation_purchase = reservationData[1] ? reservationData[1] : [];
        var recommendation_purchase = recommendation_purchase.recommendation_reservation;
        var recommendation_sell = reservationData[0] ? reservationData[0] : [];
        var recommendation_sell = recommendation_sell.recommendation_sell_reservation;
        var trHTML = '';

        if(recommendation_purchase.length > 0){
            $("#jc_reservation .resource" ).addClass( "fail" );
            $.each(recommendation_purchase, function (i, item) {
                trHTML += '<tr class="border_bottom">';
                trHTML += '<td class="export">' + item.instancesDetailsInfo.instanceType + '</td>';
                trHTML += '<td class="export">' + item.instancesDetailsInfo.platform + '</td>';
                trHTML += '<td class="export">' + item.instancesDetailsInfo.region + '</td>';
                trHTML += '<td class="export">' + item.recommendedNumberOfInstancesToPurchase + '</td>';
                trHTML += '<td class="export">' + item.paymentOption + '</td>';
                trHTML += '<td class="export">' + item.termInYears + ' Year</td>';
                trHTML += '<td class="export">$' + item.upfrontCost + '</td>';
                trHTML += '<td class="export">$' + item.estimatedMonthlyOnDemandCost + '</td>';
                trHTML += '<td class="export">$' + item.estimatedMonthlySavingsAmount + ' ('+item.estimatedMonthlySavingsPercentage +'%)</td>';
                trHTML += '</tr>';
            });
            $('#inventoy_table17 > tbody:last-child').append(trHTML);
            var Props = {
                    col_1: "none",
                    col_2: "none",
                    col_3:"none",
                    col_4:"none",
                    col_5: "none",
                    col_6: "none",
                    col_7:"none",
                    col_8:"none",
                    display_all_text: '<?php echo t("All")?>',
                    sort_select: true,
                    paging: true,  
                    paging_length: 10,  
                    stylesheet: '',
                    paging_target_id: 'paginationDiv17', 
                    filters_row_index: 2, 
                    on_keyup: true,
                    on_after_change_page:function(o,i){ },
                    on_after_filter:function(o,i){ }
                };  
            var tf2 = setFilterGrid("inventoy_table17", Props); 
        }
        var trHTML = '';
        if(recommendation_sell.length > 0){
            $("#jc_reservation .resource" ).addClass( "fail" );
            $.each(recommendation_sell, function (i, item) {
                trHTML += '<tr class="border_bottom">';
                trHTML += '<td class="export">' + item.instanceType + '</td>';
                trHTML += '<td class="export">' + item.os + '</td>';
                trHTML += '<td class="export">' + item.riType + '</td>';
                trHTML += '<td class="export">' + item.startdate + '</td>';
                trHTML += '<td class="export">' + item.enddate + '</td>';
                trHTML += '<td class="export">' + item.paymetType + '</td>';
                trHTML += '<td class="export">' + item.purchaseHours + '</td>';
                trHTML += '<td class="export">' + item.purchaseQuantity + '</td>';
                trHTML += '<td class="export">' + item.utilizedHours + '</td>';
                trHTML += '<td class="export">' + item.unusedHours + '</td>';
                trHTML += '<td class="export">' + item.thresholdHours + '</td>';
                trHTML += '<td class="export">$' + item.unitPrice + '</td>';
                trHTML += '<td class="export">' + item.salableQuantity + '</td>';
                trHTML += '<td class="export">' + item.contractDuration + '</td>';
                trHTML += '<td class="export">$' + item.amountSaved + '</td>';
                trHTML += '</tr>';
            });
            $('#inventoy_table19 > tbody:last-child').append(trHTML);
            var Props = {
                    col_1: "none",
                    col_2: "none",
                    col_3:"none",
                    col_4:"none",
                    col_5: "none",
                    col_6: "none",
                    col_7:"none",
                    col_8:"none",
                    col_9:"none",
                    display_all_text: '<?php echo t("All")?>',
                    sort_select: true,
                    paging: true,  
                    paging_length: 10,  
                    stylesheet: '',
                    paging_target_id: 'paginationDiv19', 
                    filters_row_index: 2, 
                    on_keyup: true,
                    on_after_change_page:function(o,i){ },
                    on_after_filter:function(o,i){ }
                };  
            var tf2 = setFilterGrid("inventoy_table19", Props); 
        }
        $( "#jc_reservation" ).click(function() {
            if(recommendation_purchase.length > 0){
                $("#inventory_widget33").show();
                $("#inventory_widget18").hide();
                $("#inventory_widget13").hide();
                $("#inventory_widget12").hide();
                $("#inventory_widget15").hide();
                $("#inventory_widget14").hide();
                $("#inventory_widget17").hide();
                $("#inventory_widget16").hide();
                $("#inventory_widget19").hide();
                $("#inventory_widget20").hide();
                $("#inventory_widget21").hide();
            }
            else{
                $("#inventory_widget33").hide();
            }

            if(recommendation_sell.length > 0){
                $("#inventory_widget35").show();
                $("#inventory_widget18").hide();
                $("#inventory_widget13").hide();
                $("#inventory_widget12").hide();
                $("#inventory_widget15").hide();
                $("#inventory_widget14").hide();
                $("#inventory_widget17").hide();
                $("#inventory_widget16").hide();
                $("#inventory_widget19").hide();
                $("#inventory_widget20").hide();
                $("#inventory_widget21").hide();
            }
            else{
                $("#inventory_widget35").hide();
            }
            setTimeout(function(){  }, 30); 
        });
    }
    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    function recommendation_download_csv_request(type, instanceId){
        var fields = {type : type, instanceId : instanceId};
        xhr = jQuery.ajax({  
            type: "POST",  
            url: '/cms/jsdnConnect/recommendationAPI.php',
            data: fields,
            dataType: 'json',
            success: function(csv_result) {
                var fileName = type;
                JSONToCSV(JSON.stringify(csv_result), fileName);
            }
        });
    }
    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    function JSONToCSV(JSONData, fileName) {
        //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
        var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;
        var now = moment().format('YYYY-MM-DD hh:mm:ss');
        var fileName = fileName + '_' + now;
        var CSV = '';    
        //1st loop is to extract each row
        for (var i = 0; i < arrData.length; i++) {
            var row = '';
            for (var j = 0; j < arrData[i].length; j++) {
                if (row != '') row += ','
                row += arrData[i][j];
            }
            CSV += row + '\r\n';
        }
        if (CSV == '') {        
            alert("Invalid data");
            return;
        }   

        // Anything excpet IE works here
        if (undefined === window.navigator.msSaveOrOpenBlob) {
            var e = document.createElement('a');
            var href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(CSV);
            e.setAttribute('href', href);
            e.setAttribute('download', fileName + '.csv');
            document.body.appendChild(e);
            e.click();
            document.body.removeChild(e);
        }
        // IE-specific code
        else {
            var blob = new Blob([CSV], {type: 'text/csv;charset=utf-8;'});
            window.navigator.msSaveOrOpenBlob(blob, fileName + '.csv');
        }
    }
    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    // Format the output so it has the appropriate delimiters
    function exportTableToCSV($table, filename) {
        var $headers = $table.find('tr.headertable:has(th)')
            ,$rows = $table.find('tr.border_bottom:has(td.export)')
            // Temporary delimiter characters unlikely to be typed by keyboard
            // This is to avoid accidentally splitting the actual contents
            ,tmpColDelim = String.fromCharCode(11) // vertical tab character
            ,tmpRowDelim = String.fromCharCode(0) // null character
            // actual delimiter characters for CSV format
            ,colDelim = '","'
            ,rowDelim = '"\r\n"';
            // Grab text from table into CSV formatted string
            var csv = '"';
            csv += formatRows($headers.map(grabRow));
            csv += rowDelim;
            csv += formatRows($rows.map(grabRow)) + '"';
            // Data URI
            // Anything excpet IE works here
            if (undefined === window.navigator.msSaveOrOpenBlob) {
                    //var csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
                    var e = document.createElement('a');
                    var href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv);
                    e.setAttribute('href', href);
                    e.setAttribute('download', filename);
                    document.body.appendChild(e);
                    e.click();
                    document.body.removeChild(e);
            }
            // IE-specific code
            else {
                    var charCodeArr = new Array(csv.length);
                    for (var i = 0; i < csv.length; ++i) {
                            var charCode = csv.charCodeAt(i);
                            charCodeArr[i] = charCode;
                    }
                    var blob = new Blob([new Uint8Array(charCodeArr)], {type: 'text/csv'});
                    window.navigator.msSaveOrOpenBlob(blob, filename);
            }

        //------------------------------------------------------------
        // Helper Functions 
        //------------------------------------------------------------
        // Format the output so it has the appropriate delimiters
        function formatRows(rows){
            return rows.get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim);
        }
        // Grab and format a row from the table
        function grabRow(i,row){

            var $row = $(row);
            //for some reason $cols = $row.find('td') || $row.find('th') won't work...
            var $cols = $row.find('td.export'); 
            if(!$cols.length) $cols = $row.find('th.exportheader');  
            return $cols.map(grabCol)
                        .get().join(tmpColDelim);
        }
        // Grab and format a column from the table 
        function grabCol(j,col){
            var $col = $(col),
                $text = $col.text();
            return $text.replace('"', '""'); // escape double quotes
        }
    }
   
})( jQuery );
</script>
