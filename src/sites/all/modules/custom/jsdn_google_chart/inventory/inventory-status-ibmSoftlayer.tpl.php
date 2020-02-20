<div id="inventory_widget9" class="chart_daily_trend jsdn_chart" align='center'></div>
<div class="clear"></div>
<?php

if(($_SESSION['ibm_apiUsername'] != '') && ($_SESSION['ibm_apiKey'] != '')){
    try{
        $path = drupal_get_path('module', 'jsdn_google_chart'). '/lib/ibm_softlayer/vendor/autoload.php';
        include ($path);
    } catch (Exception $ex) {
		watchdog('jsdn_inventory', 'Live API IBM Response %exception.', array('%exception' => json_encode($ex)));
        return;
    }
    $apiUsername = $_SESSION['ibm_apiUsername'];
    $apiKey = $_SESSION['ibm_apiKey'];

    // Initialize an API client for the SoftLayer_Account service.
    try{
        $service = \SoftLayer\SoapClient::getClient('SoftLayer_Account', null, $apiUsername, $apiKey);
    } catch (Exception $ex) {
		watchdog('jsdn_inventory', 'Live API IBM Response %exception.', array('%exception' => json_encode($ex)));
        return;
    }
    
    try{
        $intances = $service->getVirtualGuests();
        $_SESSION['ibm_softlayer_instances'] = $intances;
    } catch (Exception $ex) {
        $_SESSION['ibm_softlayer_instances'] = '';
		watchdog('jsdn_inventory', 'Live API IBM Response %exception.', array('%exception' => json_encode($ex)));
        return;
    }
    
    
    $volumes_portable_disk = $service->getPortableStorageVolumes();
    $volumes_network = $service->getNetworkStorage();
    $volumes_disk = $service->getVirtualDiskImages();
    $volumes = array_merge($volumes_disk, $volumes_network);
    $_SESSION['ibm_softlayer_volumes'] = $volumes;
    
   
    
    $ipaddress = $service->getPublicIpAddresses();
    $_SESSION['ibm_softlayer_ipaddresses'] = $ipaddress;
    
    //get the virtual storage information
    $_SESSION['ibm_softlayer_snapshots'] = $volumes_network;
    
    $images = $service->getBlockDeviceTemplateGroups();
    $_SESSION['ibm_softlayer_images'] = $images;

}

$intanceRunning=0;
$intanceTerminated=0;


foreach ($_SESSION['ibm_softlayer_instances'] as $instance) {
    if($instance->status->keyName=='ACTIVE'){
        $intanceRunning = $intanceRunning+1;
    }
    else if($instance->status->keyName=='DISCONNECTED'){
        $intanceTerminated = $intanceTerminated+1;
    }
}


$volumeAvailable=0;
$volumeInuse=0;

foreach ($volumes_portable_disk as $volume) {
    $volumeInuse = $volumeInuse+1;
}

foreach ($volumes_network as $volume) {
    if(($volume->nasType == 'LOCKBOX') || ($volume->nasType == 'ISCSI') || ($volume->nasType == 'NAS') || ($volume->nasType == 'EVAULT')){
        $volumeInuse = $volumeInuse+1;
    }
}

$allowcatedip = 0;
$freeIp = 0;

foreach ($_SESSION['ibm_softlayer_instances'] as $instance) {
    if(isset($instance->primaryIpAddress)){
        $allowcatedip = $allowcatedip+1;
    }
}


$completedSnapshots = 0;
$errorSnapshots = 0;

foreach ($_SESSION['ibm_softlayer_snapshots'] as $snapshot) {
    if($snapshot->nasType == 'SNAPSHOT'){
        $completedSnapshots = $completedSnapshots+1;
    }
}

$availableimages = 0;
$failedimages = 0;

foreach ($_SESSION['ibm_softlayer_images'] as $image) {
    if($image->statusId = 1){
        $availableimages = $availableimages+1;
    }
}
$data_empty = false;
if(($allowcatedip == 0) && ($freeIp == 0)  && ($volumeInuse == 0) && ($volumeAvailable == 0) && ($errorSnapshots == 0) && ($completedSnapshots == 0) && ($availableimages == 0) && ($failedimages == 0) && ($intanceRunning == 0) && ($intanceTerminated == 0)){
    $data_empty = true;
}
?>
<script type="text/javascript">
    <?php if($data_empty == false) { ?>
        drawChart();
    <?php } else{ ?>
        jQuery("#inventory_widget9").html('<div class="noData"><?php print t('No data available for the selected criteria');?></div>');
    <?php } ?>
    function drawChart() {        
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Resource');
        data.addColumn('number', 'Status');
        data.addColumn({type: 'string', role: 'tooltip'});
        data.addColumn('number', 'Status');
        data.addColumn({type: 'string', role: 'tooltip'});
       
            data.addRows([
              ["<?php print t('Instances');?>", <?php echo $intanceRunning == 0 ? '' : $intanceRunning; ?>,'<?php print t('Active');?>: '+<?php echo $intanceRunning; ?>+'',<?php echo $intanceTerminated == 0 ? '' : $intanceTerminated; ?>,'Stopped: '+<?php echo $intanceTerminated; ?>+''],
              ["<?php print t('Volumes');?>", <?php echo $volumeInuse == 0 ? '' : $volumeInuse; ?>,'<?php print t('Active');?>: '+<?php echo $volumeInuse; ?>+'',<?php echo $volumeAvailable == 0 ? '' : $volumeAvailable; ?>,'Available: '+<?php echo $volumeAvailable; ?>+''],
              ["<?php print t('Public IPs');?>", <?php echo $allowcatedip == 0 ? '' : $allowcatedip; ?>,'<?php print t('Allocated');?>: '+<?php echo $allowcatedip; ?>+'',<?php echo $freeIp == 0 ? '' : $freeIp; ?>,'Free: '+<?php echo $freeIp; ?>+''],
              ["<?php print t('Snapshots');?>", <?php echo $completedSnapshots == 0 ? '' : $completedSnapshots; ?>,'<?php print t('Active');?>: '+<?php echo $completedSnapshots; ?>+'',<?php echo $errorSnapshots == 0 ? '' : $errorSnapshots; ?>,'<?php print t('Error');?>: '+<?php echo $errorSnapshots; ?>+''],
              ["<?php print t('Images');?>", <?php echo $availableimages == 0 ? '' : $availableimages; ?>,'<?php print t('Active');?>: '+<?php echo $availableimages; ?>+'',<?php echo $failedimages == 0 ? '' : $failedimages;?>,'<?php print t('Failed');?>: '+<?php echo $failedimages;?>+'']
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
        var chart = new google.visualization.ColumnChart(document.getElementById('inventory_widget9'));
        chart.draw(data, options);
    }
</script>
