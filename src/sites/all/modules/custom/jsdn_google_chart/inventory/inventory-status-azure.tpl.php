<div id="inventory_widget4" class="chart_daily_trend jsdn_chart" align='center'></div>
<div class="clear"></div>
<?php
unset($_SESSION['inventory_azure_resources']);
unset($_SESSION['inventory_azure_volumes']);
unset($_SESSION['inventory_azure_elastic']);
unset($_SESSION['inventory_azure_images']);
unset($_SESSION['inventory_azure_snapshot']);


$resourceGroup = $_SESSION['inventory_resources'];
$subscriptionID = $_SESSION['subscriptionId'];

$totalIntances=0;
// Implementation to get the VM List per Resource Group
$url_vm_list = "https://management.azure.com/subscriptions/".$subscriptionID."/resourceGroups/".$resourceGroup."/providers/Microsoft.Compute/virtualMachines?api-version=2017-03-30";
$inventory_azure_resources = jsdn_google_chart_get_azure_resource_call($url_vm_list);
 

if(count($inventory_azure_resources['value'])){
    $totalIntances = count($inventory_azure_resources['value']);
    $_SESSION['inventory_azure_resources'] = $inventory_azure_resources['value'];
}

$volumeAvailable=0;
$volumeInuse=0;

// Implementation to get the Volumes per Resource Group
$url_volumes = "https://management.azure.com/subscriptions/".$subscriptionID."/resourceGroups/".$resourceGroup."/providers/Microsoft.Compute/disks?api-version=2016-04-30-preview";
$inventory_azure_volumes = jsdn_google_chart_get_azure_resource_call($url_volumes);

if(count($inventory_azure_volumes['value'])){
    $volumes_available = $inventory_azure_volumes['value'];
    foreach ($volumes_available as $volume) {
        $involumeAvailable = $volume['properties']['diskState'];
        if($involumeAvailable == 'Unattached'){
            $volumeAvailable++;
        }
    }
}    
$_SESSION['inventory_azure_volumes'] = $inventory_azure_volumes['value'];
$volumes = $_SESSION['inventory_azure_resources'];
foreach ($volumes as $volume) {
    $inUse = count($volume['properties']['storageProfile']['dataDisks']);
    if(isset($inUse))
    {
        $volumeInuse += $inUse;
    }
    if(isset($volume['properties']['storageProfile']['osDisk']))
    {
        $volumeInuse += 1;
    }
}



// Implementation to get the Elastic IP
$url_elastic = "https://management.azure.com/subscriptions/".$subscriptionID."/resourceGroups/".$resourceGroup."/providers/Microsoft.Network/publicIPAddresses?api-version=2015-06-15";
$inventory_azure_elastic = jsdn_google_chart_get_azure_resource_call($url_elastic);

$totalElastic=0;
$freecount=0;
$freeip=0;

if(count($inventory_azure_elastic['value'])){
    $totalElastic = count($inventory_azure_elastic['value']);
    $_SESSION['inventory_azure_elastic'] = $inventory_azure_elastic['value'];
    $ipaddresses = $_SESSION['inventory_azure_elastic'];
    
    foreach ($ipaddresses as $ipaddress) {
        $ip = $ipaddress['properties'];
	if(isset($ip['ipConfiguration']))
	{
            $freecount+= 1;
	}
    }
    $freeip = $totalElastic - $freecount;
}

$totalSnapshot=0;      
// Implementation to get the Snapshots
$url_snapshot = "https://management.azure.com/subscriptions/".$subscriptionID."/resourceGroups/".$resourceGroup."/providers/Microsoft.Compute/snapshots/?api-version=2017-03-30";
$inventory_azure_snapshot = jsdn_google_chart_get_azure_resource_call($url_snapshot);

if(count($inventory_azure_snapshot['value'])){
    $totalSnapshot = count($inventory_azure_snapshot['value']);
    $_SESSION['inventory_azure_snapshot'] = $inventory_azure_snapshot['value'];
}

$totalImages=0;
// Implementation to get the Images
$url = "https://management.azure.com/subscriptions/".$subscriptionID."/resourceGroups/".$resourceGroup."/providers/Microsoft.Compute/images/?api-version=2017-03-30";
$inventory_azure_images = jsdn_google_chart_get_azure_resource_call($url);

if(count($inventory_azure_images['value'])){
    $totalImages = count($inventory_azure_images['value']);
    $_SESSION['inventory_azure_images'] = $inventory_azure_images['value'];
}

$data_empty = false;
if($totalIntances == 0 && ($volumeInuse == 0) && ($volumeAvailable == 0) && ($totalSnapshot == 0) && ($freecount == 0) && ($freeip == 0) && ($totalImages == 0)){
    $data_empty = true;
}
?>
<script type="text/javascript">
    <?php if($data_empty == false) { ?>
        drawChart();
    <?php } else{ ?>
        (function( $ ) {
            $( document ).ready(function() { 
                if(provider_account) {
                    $(".homebox-column-wrapper").html('<div class="noaccount"><?php print t("No account associated with this user.");?></div>');
                }
                else{
                    $("#inventory_widget4").html('<div class="noData"><?php print t("No data available for the selected criteria");?></div>');
                }
            });
        })( jQuery );
    <?php } ?>
    function drawChart() {
        var data = new google.visualization.DataTable();
        
        
        data.addColumn('string', 'Resource');
        data.addColumn('number', 'Status');
        data.addColumn({type: 'string', role: 'tooltip'});
        data.addColumn('number', 'Status');
        data.addColumn({type: 'string', role: 'tooltip'});

        data.addRows([
          ["<?php print t('Instances');?>", <?php echo $totalIntances == 0 ? '' : $totalIntances; ?>,'<?php print t('Total Instances');?>: '+<?php echo $totalIntances; ?>+'', , ''],
          ["<?php print t('Volumes');?>", <?php echo $volumeInuse == 0 ? '' : $volumeInuse; ?>,'<?php print t('In-Use');?>: '+<?php echo $volumeInuse; ?>+'',<?php echo $volumeAvailable == 0 ? '' : $volumeAvailable; ?>,'<?php print t('Available');?>: '+<?php echo $volumeAvailable; ?>+''],
          ["<?php print t('Public IPs');?>", <?php echo $freecount == 0 ? '' : $freecount; ?>,'<?php print t('Allocated');?>: '+<?php echo $freecount; ?>+'',<?php echo $freeip == 0 ? '' : $freeip; ?>,'<?php print t('Free');?>: '+<?php echo $freeip; ?>+''],
          ["<?php print t('Snapshots');?>", <?php echo $totalSnapshot == 0 ? '' : $totalSnapshot; ?>,'<?php print t('Active');?>: '+<?php echo $totalSnapshot; ?>+'', , ''],
          ["<?php print t('Images');?>", <?php echo $totalImages == 0 ? '' : $totalImages; ?>,'<?php print t('Active');?>: '+<?php echo $totalImages; ?>+'', , '']
        ]);
            
        var chartAreaSize = {width: '95%', height: '80%',top:15,left:90}; 
        var chartColor = ['#c7f634', '#ffa200', '#ff0000'];      
        var options = {
            colors: chartColor,
            tooltip:{"textStyle":{fontSize: 13, bold:true}},
            fontSize:12,
            isStacked: true,
            chartArea: chartAreaSize,
            animation:{
                "startup": true,
                "duration": 1000,
                "easing": 'out',
            },
            vAxis:{title: '<?php echo t('Count');?>',scaleType:"mirrorLog", minValue:0, maxValue:100, gridlines:{count:5, color: '#e9e9e9'}}
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('inventory_widget4'));
        chart.draw(data, options);
    }
</script>
