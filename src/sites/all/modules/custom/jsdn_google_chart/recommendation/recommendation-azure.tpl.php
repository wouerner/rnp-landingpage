<div id="inventory_widget22" align='center'>
<div class="recomondation-container">
<div id="loaderDiv16" class="loaderDiv recomondation"></div>
<div id="jc_database" class="recomondation" style="display:none">
	<div class="floatLeft resource fail">
            <div class="database">
                <span><?php print t('Performance');?></span>
            </div>
	</div>
	<div class="floatLeft twidth">            
            <span class="count database-oversized floatLeft"></span>
            <span class="resourcestatus floatLeft"><?php print t('Need Attention');?></span>
	</div>
</div>
<div id="loaderDiv13" class="loaderDiv recomondation"></div>
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
<div id="loaderDiv10" class="loaderDiv recomondation"></div>
<div id="jc_instance" class="recomondation" style="display:none">
	<div class="floatLeft resource">
            <div class="instance">
                <span><?php print t('Instances');?></span>
            </div>
	</div>
	<div class="floatLeft twidth">
            <span class="count resource-oversized floatLeft"></span>
            <span class="resourcestatus floatLeft"><?php print t('Underutilized');?></span>
	</div>
</div>
<div id="loaderDiv11" class="loaderDiv recomondation"></div>
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
<div id="loaderDiv14" class="loaderDiv recomondation" style="display:none"></div>
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
<div id="loaderDiv15" class="loaderDiv recomondation"></div>
<div id="jc_load_balancer" class="recomondation" style="display:none">
	<div class="floatLeft resource fail">
            <div class="lBalncer">
                <span><?php print t('High Availability');?></span>
            </div>
	</div>
	<div class="floatLeft twidth">
            <span class="count floatLeft"></span>
            <span class="resourcestatus floatLeft"><?php print t('Need Attention');?></span>
	</div>
</div>
<div id="loaderDiv9" class="loaderDiv recomondation"></div>
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
<!--
<div id="loaderDiv18" class="loaderDiv recomondation"></div>
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
<div id="inventory_widget23" class="inventory_widget23 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table9">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="3" class="filter-head">
                    <div class="table-title"><?php print t('Unused Public IPs');?></div>
                    <div class="recommendation-tooltip"><?php print t('Public IPs that are not attached to any network interfaces should be released to reduce cost.');?></div>
                </th>
                <th class="filter-head">
                    <div id="csvIP" class="csvDiv"></div>
                </th>
            </tr>
            <tr class="headertable">
                <th class="exportheader" id="inven_th"><?php print t('Name');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Allocation Method');?> </th>           
                <th class="exportheader" id="inven_th"><?php print t('Public IP');?></th>
                <th class="exportheader" id="inven_th"><?php print t('Private IP');?> </th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table> 
<div id="paginationDiv9"></div>
</div>
<div id="inventory_widget24" class="inventory_widget24 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table10">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="3" class="filter-head">
                    <div class="table-title"><?php print t('Underutilized VMs'); ?></div>
                    <div class="recommendation-tooltip"><?php print t('The list below displays VMs that are idle or underutilized. Usage is monitored for 14 days and VMs whose CPU utilization ≤ 5 % and network usage ≤ 7 MB for four or more days are considered low-utilization VMs.
<br><br>
Resize or terminate the Underutilized instance’s machine types to use the resources efficiently and control costs.'); ?></div>
                </th>
                <th class="filter-head">
                    <div id="csvOversizedInstance" class="csvDiv"></div>
                </th>
            </tr>
            <tr class="headertable">
                <th class="exportheader" id="inven_th"><?php print t('Instance Name'); ?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Impact'); ?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Problem'); ?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Solution'); ?> </th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table> 
<div id="paginationDiv10"></div>
</div>
<div id="inventory_widget25" class="inventory_widget25 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table11">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="2" class="filter-head">
                    <div class="table-title"><?php print t('Unused Volumes');?></div>
                    <div class="recommendation-tooltip"><?php print t('Remove the following unattached (unused) volumes to lower the cloud storage cost.');?></div>
                </th>
                <th class="filter-head">
                    <div id="csvVolume" class="csvDiv"></div>
                </th>
            </tr>
            <tr class="headertable">
                <th class="exportheader" id="inven_th"><?php print t('Volume Name');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Created Date');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Size');?> </th>
            </tr>
        </thead>
        <tbody></tbody>
    </table> 
<div id="paginationDiv11"></div>
</div>
<div id="inventory_widget26" class="inventory_widget26 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table12">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="4" class="filter-head">
                    <div class="table-title"><?php print t('Redundant Snapshots');?></div>
                    <div class="recommendation-tooltip"><?php print t('Consider deleting the following Snapshots that are older than 3/6/12 months to reduce cloud costs.');?></div>
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
                <th class="exportheader" id="inven_th"><?php print t('Snapshot Name');?></th>
                <th class="exportheader" id="inven_th"><?php print t('Volume Size');?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Snapshot Age');?> </th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table> 
<div id="paginationDiv12"></div>
</div>
<div id="inventory_widget30" class="inventory_widget30 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table16">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="3" class="filter-head">
                    <div class="table-title"><?php print t('Security');?></div>
                    <div class="recommendation-tooltip"><?php print t('Below are the recommendations to improve the security of your Azure resources. Please access the Advisor by login to Azure Portal to see the exact recommendation.');?></div>
                </th>
                <th class="filter-head">
                    <div id="csvSecurity2" class="csvDiv"></div>
                </th>
            </tr>
            <tr class="headertable">
                <th class="exportheader" id="inven_th"><?php print t('Impacted Field'); ?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Impact'); ?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Problem'); ?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Solution'); ?> </th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table> 
<div id="paginationDiv16"></div>
</div>
<div id="inventory_widget29" class="inventory_widget29 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table15">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="3" class="filter-head">
                    <div class="table-title"><?php print t('High Availability');?></div>
                    <div class="recommendation-tooltip"><?php print t('The list below displays VMs that are not part of Availability set or where backup is not enabled or VMs with standard disks that must be upgraded to premium disks. Also included are Application gateway instances that are not configured for fault tolerance or Availability sets that contain only a single virtual machine (instead of two or more virtual machines).
<br><br>
Review the recommendations and take necessary action to ensure and improve the continuity of your business-critical applications.');?></div>
                </th>
                <th class="filter-head">
                    <div id="csvBalancer" class="csvDiv"></div>
                </th>
            </tr>
            <tr class="headertable">
                <th class="exportheader" id="inven_th"><?php print t('Name'); ?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Impact'); ?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Problem'); ?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Solution'); ?> </th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table> 
<div id="paginationDiv15"></div>
</div>
<div id="inventory_widget31" class="inventory_widget31 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table17">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="3" class="filter-head">
                    <div class="table-title"><?php print t('Performance');?></div>
                    <div class="recommendation-tooltip"><?php print t("The list below display instances where memory or CPU resources are exhausted by app runtimes or where collocating resources like web apps and databases can improve performance and lower cost.
<br><br>
The list also identifies Redis Cache instances where performance may be adversely affected by high memory usage, server load, network bandwidth, or a large number of client connections and offers recommendations for running the SQL Azure database's typical workload after analyzing the usage history. Review and take actions based on the recommendations to help improve the speed and responsiveness of your business-critical applications."); ?></div>
                </th>
                <th class="filter-head">
                    <div class="StatusDiv6 search-bar">
                    </div>
                    <div id="csvDatabase" class="csvDiv"></div>
                </th>
            </tr>
            <tr class="headertable">
                <th class="exportheader" id="inven_th"><?php print t('Name'); ?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Impact'); ?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Problem'); ?> </th>
                <th class="exportheader" id="inven_th"><?php print t('Solution'); ?> </th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table> 
<div id="paginationDiv17"></div>
</div>
<div id="inventory_widget34" class="inventory_widget34 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table18">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="8" class="filter-head">
                    <div class="table-title"><?php print t('Purchased Reserved Instances');?></div>
                    <div class="recommendation-tooltip"><?php //print t('Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum');?></div>
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
<div id="paginationDiv18"></div>
</div>
<div id="inventory_widget36" class="inventory_widget36 widget-container" align='center' style="display:none">
    <table class="reccommendation_table" id="inventoy_table20">
        <thead>
            <tr class="filter-head-tr">
                <th colspan="14" class="filter-head">
                    <div class="table-title"><?php print t('Reserved Instance Sell Recommendation');?></div>
                    <div class="recommendation-tooltip"><?php //print t('The Reserved Instance Sell recommendations given below is across the region in case of Azure.');?></div>
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
<div id="paginationDiv20"></div>
</div>
<div style="float:left;width: 100%;border-top: 1px solid #dbdbdb;margin: 25px 0 0 12px;text-align: left;">^ <?php print t('All the dates are based on the server date and not the UTC or customer time zone');?></div>
<script type="text/javascript">
(function( $ ) {
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
            exportTableToCSV.apply(this, [$('#inventoy_table9'), outputFile]);
        });
        $( "#csvOversizedInstance" ).click(function() {
            var now = moment().format('YYYY-MM-DD hh:mm:ss');
            var outputFile = 'Underutilized_VMs_'+now;   
            outputFile = outputFile.replace('.csv','') + '.csv'
            // CSV
            exportTableToCSV.apply(this, [$('#inventoy_table10'), outputFile]);
        });
        $( "#csvVolume" ).click(function() {
            var now = moment().format('YYYY-MM-DD hh:mm:ss');
            var outputFile = 'Unused_Volume_'+now;        
            outputFile = outputFile.replace('.csv','') + '.csv'
            // CSV
            exportTableToCSV.apply(this, [$('#inventoy_table11'), outputFile]);
        });
        $( "#csvSnapshot" ).click(function() {
            var now = moment().format('YYYY-MM-DD hh:mm:ss');
            var outputFile = 'Redundant_Snapshots_'+now;       
            outputFile = outputFile.replace('.csv','') + '.csv'
            // CSV
            exportTableToCSV.apply(this, [$('#inventoy_table12'), outputFile]);
        });
        $( "#csvSecurity2" ).click(function() {
            var now = moment().format('YYYY-MM-DD hh:mm:ss');
            var outputFile = 'Need_Attendtion_Security_'+now;
            outputFile = outputFile.replace('.csv','') + '.csv'
            // CSV
            exportTableToCSV.apply(this, [$('#inventoy_table16'), outputFile]);
        });
        $( "#csvBalancer" ).click(function() {
            var now = moment().format('YYYY-MM-DD hh:mm:ss');
            var outputFile = 'Need_Attendtion_Availability_'+now;
            outputFile = outputFile.replace('.csv','') + '.csv'
            // CSV
            exportTableToCSV.apply(this, [$('#inventoy_table15'), outputFile]);
        });
        $( "#csvDatabase" ).click(function() {
            var now = moment().format('YYYY-MM-DD hh:mm:ss');
            var outputFile = 'Need_Attendtion_Performance_'+now;  
            outputFile = outputFile.replace('.csv','') + '.csv'
            // CSV
            exportTableToCSV.apply(this, [$('#inventoy_table17'), outputFile]);
        });
        $( "#csvReservation" ).click(function() {
            var now = moment().format('YYYY-MM-DD hh:mm:ss');
            var outputFile = 'Purchased_Reserved_Instance_'+now;  
            outputFile = outputFile.replace('.csv','') + '.csv'
            // CSV
            exportTableToCSV.apply(this, [$('#inventoy_table18'), outputFile]);
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
        recommendation_widget9('ip');
        recommendation_widget10('instance');
        recommendation_widget11('snapshot');
        recommendation_widget13('volume');
        recommendation_widget14('security');
        recommendation_widget15('high_availability');
        recommendation_widget16('performance');
        //recommendation_widget18('reservation');
    }
    //------------------------------------------------------------
    // Helper Functions for AZURE IP Recommendation
    //------------------------------------------------------------
    function recommendation_widget9(type) {
        var elementId= 'jc_ip';
        var loaderId = 'loaderDiv9';
        recommendation_ajax_request(elementId, loaderId, type);
    }
    //------------------------------------------------------------
    // Helper Functions Instance Recommendation
    //------------------------------------------------------------
    function recommendation_widget10(type) {
        var elementId= 'jc_instance';
        var loaderId = 'loaderDiv10';
        recommendation_ajax_request(elementId, loaderId, type);
    }
    //------------------------------------------------------------
    // Helper Functions Snapshot Recommendation
    //------------------------------------------------------------
    function recommendation_widget11(type) {
        var elementId= 'jc_snapshot';
        var loaderId = 'loaderDiv11';
        recommendation_ajax_request(elementId, loaderId, type);
    }
    //------------------------------------------------------------
    // Helper Functions Volume Recommendation
    //------------------------------------------------------------
    function recommendation_widget13(type) {
        var elementId= 'jc_volume';
        var loaderId = 'loaderDiv13';
        recommendation_ajax_request(elementId, loaderId, type);
    }
    //------------------------------------------------------------
    // Helper Functions Security Recommendation
    //------------------------------------------------------------
    function recommendation_widget14(type) {
        var elementId= 'jc_security';
        var loaderId = 'loaderDiv14';
        //recommendation_ajax_request(elementId, loaderId, type);
    }
    //------------------------------------------------------------
    // Helper Functions Load Balancer Recommendation
    //------------------------------------------------------------
    function recommendation_widget15(type) {
        var elementId= 'jc_load_balancer';
        var loaderId = 'loaderDiv15';
        recommendation_ajax_request(elementId, loaderId, type);
    }
    //------------------------------------------------------------
    // Helper Functions database Recommendation
    //------------------------------------------------------------
    function recommendation_widget16(type) {
        var elementId= 'jc_database';
        var loaderId = 'loaderDiv16';
        recommendation_ajax_request(elementId, loaderId, type);
    }
    //------------------------------------------------------------
    // Helper Functions reservation Recommendation
    //------------------------------------------------------------
    function recommendation_widget18(type) {
        //var elementId= 'jc_reservation';
        //var loaderId = 'loaderDiv18';
        //recommendation_ajax_request(elementId, loaderId, type);
    }
    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    function recommendation_ajax_request(elementId, loaderId, type){
        var fields = {type : type};
        var empty_message = '<?php  print t('Not able to get the data currently. Please contact support.'); ?>'; 
        xhr = jQuery.ajax({  
            type: "POST",  
            url: '/cms/jsdnConnect/recommendationAzureAPI.php',
            data: fields,
            dataType: 'json',
            beforeSend: function(){
            },
            error: function(error){
                $("#"+loaderId).hide();
                $("#"+elementId).show();
                $("#"+elementId).html('<div class="noData">'+empty_message+'</div>');
            },
            success: function(recommendation_result) {
                if(type == 'reservation'){
                    var reservationPurchased = recommendation_result[1];
                    var reservationSell = recommendation_result[0];
                    var intancePurchased = reservationPurchased.reservationPurchased; 
                    var intanceSell = reservationSell.reservationSell;
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
                }
                else{
                     $("#"+elementId+" span.count" ).text(recommendation_result.length);
                }
                if(recommendation_result.length >= 1){
                    $("#"+elementId+" .resource" ).addClass( "fail" );
                    if(type == 'ip'){
                        ipDataToTable(recommendation_result);
                    }
                    else if(type == 'instance'){
                        instanceDataToTable(recommendation_result);
                    }
                    else if(type == 'snapshot'){
                        snapshotDataToTable(recommendation_result);
                    }
                    else if(type == 'volume'){
                        volumeDataToTable(recommendation_result);
                    }
                    else if(type == 'high_availability'){
                        highAvailabilityDataToTable(recommendation_result);
                    }
                    else if(type == 'security'){
                        securityDataToTable(recommendation_result);
                    }
                    else if(type == 'performance'){
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
            trHTML += '<td class="export"><div class="truncate" title="' + item.name + '">' + item.name + '</div></td>';
            convertedDate = moment.utc(''+item.properties.timeCreated+'').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss');
            trHTML += '<td class="export">' + convertedDate + '</td>';
            trHTML += '<td class="export">'+ item.properties.diskSizeGB+' GB</td></tr>';
        });
        $('#inventoy_table11 > tbody:last-child').append(trHTML);
        var Props = {
                    col_1: "none",
                    col_2: "none",
                    col_3:"none",
                    col_4:"none",
                    display_all_text:'<?php print t('All');?>',
                    sort_select: true,
                    paging: true,  
                    paging_length: 10,  
                    stylesheet: '',
                    paging_target_id: 'paginationDiv11', 
                    filters_row_index: 2, 
                    on_keyup: true,
                    on_after_change_page:function(o,i){ },
                    on_after_filter:function(o,i){ }
                };  
        var tf2 = setFilterGrid("inventoy_table11", Props);

        $( "#jc_volume" ).click(function() {
            $("#inventory_widget25").show();
            $("#inventory_widget24").hide();
            $("#inventory_widget23").hide();
            $("#inventory_widget26").hide();
            $("#inventory_widget27").hide();
            $("#inventory_widget28").hide();  
            $("#inventory_widget29").hide(); 
            $("#inventory_widget30").hide();
            $("#inventory_widget31").hide();
            $("#inventory_widget32").hide();
            $("#inventory_widget34").hide();
            $("#inventory_widget36").hide();
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
            trHTML += '<td class="export">' + item.name + '</td>';
            trHTML += '<td class="export">' + item.properties.publicIPAllocationMethod + '</td>';
            if(item.properties.ipAddress){
                trHTML += '<td class="export">' + item.properties.ipAddress + '</td>';
            }
            else{
                trHTML += '<td class="export">' + '---' + '</td>';
            }
           
            if(item.properties.privateIPAddress){
                trHTML += '<td class="export">'+ item.properties.privateIPAddress+'</td>';
            }
            else{
                trHTML += '<td class="export">' + '---' + '</td>';
            }
            trHTML += '</tr>';
        });
        $('#inventoy_table9 > tbody:last-child').append(trHTML);
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
                paging_target_id: 'paginationDiv9', 
                filters_row_index: 2, 
                on_keyup: true,
                on_after_change_page:function(o,i){ },
                on_after_filter:function(o,i){ }
            };  
        var tf2 = setFilterGrid("inventoy_table9", Props); 

        $( "#jc_ip" ).click(function() {
            $("#inventory_widget23").show();
            $("#inventory_widget24").hide();
            $("#inventory_widget25").hide();
            $("#inventory_widget26").hide();
            $("#inventory_widget27").hide();
            $("#inventory_widget28").hide();  
            $("#inventory_widget29").hide();
            $("#inventory_widget30").hide();
            $("#inventory_widget31").hide();
            $("#inventory_widget32").hide();
            $("#inventory_widget34").hide();
            $("#inventory_widget36").hide();
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
            trHTML += '<td class="export"><div class="truncate" title="' + item.id + '">' + item.id + '</div></td>';
            convertedDate = moment.utc(''+item.snap_date+'').utcOffset(timeoffset).format('MMM Do YYYY, HH:mm:ss');
            trHTML += '<td class="export">' + convertedDate + '</td>';
            trHTML += '<td class="export">' + item.name + '</td>';
            trHTML += '<td class="export">' + item.properties.diskSizeGB + ' GB</td>';
            trHTML += '<td class="export">' + snapshotString + ' ' + item.days_elapsed + '</td>';
            trHTML += '<td style="display:none">' + snapshotString + ' ' + item.days_elapsed + '</td></tr>';
            
        });
        $('#inventoy_table12 > tbody:last-child').append(trHTML);
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
                    paging_target_id: 'paginationDiv12', 
                    filters_row_index: 2, 
                    on_keyup: true,
                    on_after_change_page:function(o,i){ },
                    on_after_filter:function(o,i){ }
                };  
        var tf2 = setFilterGrid("inventoy_table12", Props); 
        
        $('.StatusDiv4 select').html($('#flt5_inventoy_table4').html());
        $('.StatusDiv4 select option[value=""]').text('All');
        $('.StatusDiv4 select').change(function(){
            $('#flt5_inventoy_table4').val($(this).val()).change();
        });

        $( "#jc_snapshot" ).click(function() {
            $("#inventory_widget26").show();
            $("#inventory_widget24").hide();
            $("#inventory_widget23").hide();
            $("#inventory_widget25").hide();
            $("#inventory_widget27").hide();
            $("#inventory_widget28").hide();  
            $("#inventory_widget29").hide(); 
            $("#inventory_widget30").hide();
            $("#inventory_widget31").hide();
            $("#inventory_widget32").hide();
            $("#inventory_widget34").hide();
            $("#inventory_widget36").hide();
            setTimeout(function(){  }, 30); 
        });
    }
    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    function highAvailabilityDataToTable(highAvailabilityData) {
        var trHTML = '';
        $.each(highAvailabilityData, function (i, item) {
            trHTML += '<tr class="border_bottom">';
            if(item.properties.impactedValue){
                trHTML += '<td class="export">'+ item.properties.impactedValue+'</td>';
            }
            else{
                trHTML += '<td class="export">' + '---' + '</td>';
            }
            trHTML += '<td class="export">'+ item.properties.impact+'</td>';
            trHTML += '<td class="export"><div title="' + item.properties.shortDescription.problem + '">' +  item.properties.shortDescription.problem+'</div></td>';
            trHTML += '<td class="export"><div  title="' + item.properties.shortDescription.solution + '">' + item.properties.shortDescription.solution +'</div></td>';
            trHTML += '</tr>';
        });
        $('#inventoy_table15 > tbody:last-child').append(trHTML);
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
                paging_target_id: 'paginationDiv15', 
                filters_row_index: 2, 
                on_keyup: true,
                on_after_change_page:function(o,i){ },
                on_after_filter:function(o,i){ }
            };  
        var tf2 = setFilterGrid("inventoy_table15", Props); 

        $( "#jc_load_balancer" ).click(function() {
            $("#inventory_widget29").show();
            $("#inventory_widget24").hide();
            $("#inventory_widget23").hide();
            $("#inventory_widget26").hide();
            $("#inventory_widget25").hide();
            $("#inventory_widget28").hide();
            $("#inventory_widget27").hide();
            $("#inventory_widget30").hide();
            $("#inventory_widget31").hide();
            $("#inventory_widget32").hide();
            $("#inventory_widget34").hide();
            $("#inventory_widget36").hide();
            setTimeout(function(){  }, 30); 
        });
    }
    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    function securityDataToTable(securityData) {
            var trHTML = '';
            $.each(securityData, function (i, item) {
                trHTML += '<tr class="border_bottom">';
                var impactedStr= item.properties.impactedField;
                var impactedVal = impactedStr.split('/');
                if(impactedVal[1]){
                    trHTML += '<td class="export">'+ impactedVal[1] +'</td>';
                }
                else{
                    trHTML += '<td class="export">' + '---' + '</td>';
                }
                trHTML += '<td class="export">'+ item.properties.impact+'</td>';
                trHTML += '<td class="export"><div title="' + item.properties.shortDescription.problem + '">' +  item.properties.shortDescription.problem+'</div></td>';
                trHTML += '<td class="export"><div  title="' + item.properties.shortDescription.solution + '">' + item.properties.shortDescription.solution +'</div></td>';
                trHTML += '</tr>';
            });
            $('#inventoy_table16 > tbody:last-child').append(trHTML);
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
                        paging_target_id: 'paginationDiv16', 
                        filters_row_index: 2, 
                        on_keyup: true,
                        on_after_change_page:function(o,i){ },
                        on_after_filter:function(o,i){ }
            };  
            var tf3 = setFilterGrid("inventoy_table16", Props); 
        
        $( "#jc_security" ).click(function() {
            if(securityData.length > 0){    
                $("#inventory_widget30").show();
                $("#inventory_widget24").hide();
                $("#inventory_widget23").hide();
                $("#inventory_widget26").hide();
                $("#inventory_widget27").hide();
                $("#inventory_widget25").hide();
                $("#inventory_widget29").hide();
                $("#inventory_widget31").hide();
                $("#inventory_widget32").hide();
                $("#inventory_widget34").hide();
                $("#inventory_widget36").hide();
            }
            else{
                $("#inventory_widget30").hide();
            }
            setTimeout(function(){  }, 30); 
        });
    }
    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    function instanceDataToTable(instanceData) {       
            var trHTML = '';
            $.each(instanceData, function (i, item) {
                trHTML += '<tr class="border_bottom">';
                if(item.properties.impactedValue){
                    trHTML += '<td class="export">'+ item.properties.impactedValue+'</td>';
                }
                else{
                    trHTML += '<td class="export">' + '---' + '</td>';
                }
                trHTML += '<td class="export">'+ item.properties.impact+'</td>';
                trHTML += '<td class="export"><div title="' + item.properties.shortDescription.problem + '">' +  item.properties.shortDescription.problem+'</div></td>';
                trHTML += '<td class="export"><div  title="' + item.properties.shortDescription.solution + '">' + item.properties.shortDescription.solution +'</div></td>';
                trHTML += '</tr>';
            });
            $('#inventoy_table10 > tbody:last-child').append(trHTML);
            var Props = {
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
            var tf2 = setFilterGrid("inventoy_table10", Props); 
        
        $( "#jc_instance" ).click(function() {
            $("#inventory_widget24").show();
            $("#inventory_widget23").hide(); 
            $("#inventory_widget25").hide();
            $("#inventory_widget26").hide();
            $("#inventory_widget27").hide();
            $("#inventory_widget28").hide();  
            $("#inventory_widget29").hide();
            $("#inventory_widget30").hide();
            $("#inventory_widget31").hide();
            $("#inventory_widget34").hide();
            $("#inventory_widget36").hide();
            setTimeout(function(){  }, 30); 
        });
    }
    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    function databaseDataToTable(databaseData) {
        var trHTML = '';
        $.each(databaseData, function (i, item) {
                trHTML += '<tr class="border_bottom">';
                if(item.properties.impactedValue){
                    trHTML += '<td class="export">'+ item.properties.impactedValue+'</td>';
                }
                else{
                    trHTML += '<td class="export">' + '---' + '</td>';
                }
                trHTML += '<td class="export">'+ item.properties.impact+'</td>';
                trHTML += '<td class="export"><div title="' + item.properties.shortDescription.problem + '">' +  item.properties.shortDescription.problem+'</div></td>';
                trHTML += '<td class="export"><div  title="' + item.properties.shortDescription.solution + '">' + item.properties.shortDescription.solution +'</div></td>';
                trHTML += '</tr>';
        });
        $('#inventoy_table17 > tbody:last-child').append(trHTML);
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
                paging_target_id: 'paginationDiv17', 
                filters_row_index: 2, 
                on_keyup: true,
                on_after_change_page:function(o,i){ },
                on_after_filter:function(o,i){ }
            };  
        var tf2 = setFilterGrid("inventoy_table17", Props); 

        $( "#jc_database" ).click(function() {
            $("#inventory_widget31").show();
            $("#inventory_widget23").hide(); 
            $("#inventory_widget25").hide();
            $("#inventory_widget26").hide();
            $("#inventory_widget27").hide();
            $("#inventory_widget28").hide();  
            $("#inventory_widget29").hide();
            $("#inventory_widget30").hide();
            $("#inventory_widget24").hide();
            $("#inventory_widget32").hide();
            $("#inventory_widget34").hide();
            $("#inventory_widget36").hide();
            setTimeout(function(){  }, 30); 
        });
        
    }
    //------------------------------------------------------------
    // Helper Functions 
    //------------------------------------------------------------
    function reservationDataToTable(reservationData) {
        var recommendation_purchase = reservationData[1];
        var recommendation_purchase = recommendation_purchase.recommendation_reservation;
        var recommendation_sell = reservationData[0];
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
            $('#inventoy_table18 > tbody:last-child').append(trHTML);
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
                    paging_target_id: 'paginationDiv18', 
                    filters_row_index: 2, 
                    on_keyup: true,
                    on_after_change_page:function(o,i){ },
                    on_after_filter:function(o,i){ }
                };  
            var tf2 = setFilterGrid("inventoy_table18", Props); 
        }
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
            $('#inventoy_table20 > tbody:last-child').append(trHTML);
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
                    paging_target_id: 'paginationDiv20', 
                    filters_row_index: 2, 
                    on_keyup: true,
                    on_after_change_page:function(o,i){ },
                    on_after_filter:function(o,i){ }
                };  
            var tf2 = setFilterGrid("inventoy_table20", Props); 
        }
        $( "#jc_reservation" ).click(function() {
            $("#inventory_widget34").show();
            $("#inventory_widget36").show();
            $("#inventory_widget31").hide();
            $("#inventory_widget23").hide(); 
            $("#inventory_widget25").hide();
            $("#inventory_widget26").hide();
            $("#inventory_widget27").hide();
            $("#inventory_widget28").hide();  
            $("#inventory_widget29").hide();
            $("#inventory_widget30").hide();
            $("#inventory_widget24").hide();
            $("#inventory_widget32").hide();
            setTimeout(function(){  }, 30); 
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
