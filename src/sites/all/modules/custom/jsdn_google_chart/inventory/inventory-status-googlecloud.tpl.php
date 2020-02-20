<div id="inventory_widget6" class="chart_daily_trend jsdn_chart" align='center'></div>
<div class="clear"></div>
<?php

if(($_SESSION['project_id'] != '') && ($_SESSION['inventory_zones'] != '')){
    $path = drupal_get_path('module', 'jsdn_google_chart'). '/lib/googlecloud/autoload.php';
    include ($path);
    $client = new Google_Client();
    $client->setApplicationName('Client Sample Application');
    $client->setScopes(['https://www.googleapis.com/auth/cloud-platform']);
    $client->useApplicationDefaultCredentials();
    $client->setAuthConfig($_SESSION['config_googlecloud'] ,'');
    $service = new Google_Service_Compute($client);
    
    $intance = $service->instances->listInstances($_SESSION['project_id'], $_SESSION['inventory_zones']);
    $intances = $intance->toSimpleObject();
    $_SESSION['google_cloud_instances'] = $intances->items;

    $volume = $service->disks->listDisks($_SESSION['project_id'], $_SESSION['inventory_zones']);
    $volumes = $volume->toSimpleObject();
    $_SESSION['google_cloud_volumes'] = $volumes->items;
    

    $zoneId = explode('-', $_SESSION['inventory_zones']);
    $zone = $zoneId[0].'-'.$zoneId[1];
    $ipaddress = $service->addresses->listAddresses($_SESSION['project_id'], $zone);    
    $ipaddresses = $ipaddress->toSimpleObject();
    $_SESSION['google_cloud_ipaddresses'] = $ipaddresses->items;


    $snapshots = $service->snapshots->listSnapshots($_SESSION['project_id']);
    $snapshots = $snapshots->toSimpleObject();
    $_SESSION['google_cloud_snapshots'] = $snapshots->items;
    
    $images = $service->images->listImages($_SESSION['project_id']);
    $images = $images->toSimpleObject();
    $_SESSION['google_cloud_images'] = $images->items;
}

$intanceRunning=0;
$intanceTerminated=0;


foreach ($_SESSION['google_cloud_instances'] as $instance) {
    if($instance['status']=='RUNNING'){
        $intanceRunning = $intanceRunning+1;
    }
    else if($instance['status']=='TERMINATED'){
        $intanceTerminated = $intanceTerminated+1;
    }
}


$volumeAvailable=0;
$volumeInuse=0;

foreach ($_SESSION['google_cloud_volumes'] as $volume) {
    if(!isset($volume['users'])){
        $volumeAvailable = $volumeAvailable+1;
    }
}

foreach ($_SESSION['google_cloud_instances'] as $instance) {
    foreach($instance['disks'] as $disk){
        $volumeInuse = $volumeInuse+1;
    }
}

$allowcatedip = 0;
$freeIp = 0;

foreach ($_SESSION['google_cloud_ipaddresses'] as $ipaddresses) {
    if(!isset($ipaddresses['users'])){
        $freeIp = $freeIp+1;
    }
}

foreach ($_SESSION['google_cloud_instances'] as $instance) {
    foreach($instance['networkInterfaces'] as $ip){
        if($ip['accessConfigs'][0]['natIP']){
             $allowcatedip = $allowcatedip+1;
        }
    }
}

$completedSnapshots = 0;
$errorSnapshots = 0;

foreach ($_SESSION['google_cloud_snapshots'] as $snapshot) {
    if($snapshot['id']){
        $completedSnapshots = $completedSnapshots+1;
    }
}

$availableimages = 0;
$failedimages = 0;

foreach ($_SESSION['google_cloud_images'] as $image) {
    if($image['id']){
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
        jQuery("#inventory_widget6").html('<div class="noData"><?php print t('No data available for the selected criteria');?></div>');
    <?php } ?>
    function drawChart() {        
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Resource');
        data.addColumn('number', 'Status');
        data.addColumn({type: 'string', role: 'tooltip'});
        data.addColumn('number', 'Status');
        data.addColumn({type: 'string', role: 'tooltip'});
       
            data.addRows([
              ["<?php print t('Instances');?>", <?php echo $intanceRunning == 0 ? '' : $intanceRunning; ?>,'<?php print t('Running');?>: '+<?php echo $intanceRunning; ?>+'',<?php echo $intanceTerminated == 0 ? '' : $intanceTerminated; ?>,'Stopped: '+<?php echo $intanceTerminated; ?>+''],
              ["<?php print t('Volumes');?>", <?php echo $volumeInuse == 0 ? '' : $volumeInuse; ?>,'<?php print t('In-Use');?>: '+<?php echo $volumeInuse; ?>+'',<?php echo $volumeAvailable == 0 ? '' : $volumeAvailable; ?>,'Available: '+<?php echo $volumeAvailable; ?>+''],
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
        var chart = new google.visualization.ColumnChart(document.getElementById('inventory_widget6'));
        chart.draw(data, options);
    }
</script>
