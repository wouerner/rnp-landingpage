<div id="inventory_widget1" class="chart_daily_trend jsdn_chart" align='center'></div>
<div class="clear"></div>
<?php

if(($_SESSION['accessKey'] != '') && ($_SESSION['secretKey'] != '') && ($_SESSION['inventory_region'] != '')){
    $path = drupal_get_path('module', 'jsdn_google_chart'). '/lib/aws/config.php';
    include ($path);
    
    try{
        $volume = $ec2Client->DescribeVolumes(array('OwnerIds' => ['self']));
    } catch (Exception $ex) {?>
        <script type="text/javascript">
        jQuery("#inventory_widget1").html('<div class="noData"><?php print t('Not able to get the data currently. Please contact support.');?></div>');
        </script>
    <?php 
		watchdog('jsdn_inventory', 'Live API AWS Response %exception.', array('%exception' => json_encode($ex)));	
        $_SESSION['instances'] = 0;
        return;} 
    
    $volumes = $volume['Volumes'];
    $_SESSION['Volumes']=$volumes;
    
    $intances = $ec2Client->DescribeInstances(array());
    $instanceAll = $intances['Reservations'];
    $_SESSION['instances']=$instanceAll;
    
    $ipaddresses = $ec2Client->describeAddresses(array());
    $ipaddresses = $ipaddresses['Addresses'];
    $_SESSION['ipaddresses']=$ipaddresses;
    
    
    $snapshots = $ec2Client->DescribeSnapshots(array('OwnerIds' => ['self']));
    $snapshots = $snapshots['Snapshots'];
    $_SESSION['snapshots']=$snapshots;
    
    $images = $ec2Client->DescribeImages(array('Owners' => ['self']));
    $images = $images['Images'];
    $_SESSION['images']=$images;
}

$volumeAvailable=0;
$volumeInuse=0;

foreach ($volumes as $volume) {
    if($volume['State']=='available'){
        $volumeAvailable = $volumeAvailable+1;
    }
	else if($volume['State']=='in-use'){
        $volumeInuse = $volumeInuse+1;
    }
}

$intanceRunning=0;
$intanceStopped=0;
$intanceTerminated=0;

foreach ($instanceAll as $reservation) {
    $instances = $reservation['Instances'];
    foreach ($instances as $instance) {
        if($instance['State']['Name']=='running'){
            $intanceRunning = $intanceRunning+1;
        }
        else if($instance['State']['Name']=='stopped'){
            $intanceStopped = $intanceStopped+1;
        }
        else if($instance['State']['Name']=='terminated'){
            $intanceTerminated = $intanceTerminated+1;
        }
    }
}

$allowcatedip = 0;
$freecount = 0;

foreach ($ipaddresses as $ipaddress) {
    $ip = $ipaddress['PublicIp'];
	if(!empty($ipaddress['AssociationId']))
	{
                $inst = $ipaddress['AssociationId'];
		$freecount +=count($inst);
	}
	$allowcatedip +=count($ip);
}
$freeip = $allowcatedip - $freecount;
 
$completedSnapshots = 0;
$errorSnapshots = 0;

foreach ($snapshots as $snapshot) {
    if($snapshot['State']=='completed'){
        $completedSnapshots = $completedSnapshots+1;
    }
	else if($snapshot['State']=='error'){
        $errorSnapshots = $errorSnapshots+1;
    }
}

$availableimages = 0;
$failedimages = 0;

foreach ($images as $image) {
    if($image['State']=='available'){
        $availableimages = $availableimages+1;
    }
    else if($image['State']=='failed'){
        $failedimages = $failedimages+1;
    }
}
$data_empty = false;
if(($intanceRunning == 0) && ($intanceStopped == 0) && ($volumeInuse == 0) && ($volumeAvailable == 0) && ($errorSnapshots == 0) && ($completedSnapshots == 0) && ($availableimages == 0) && ($failedimages == 0) && ($intanceRunning == 0) && ($intanceStopped == 0) && ($freeip == 0) && ($freecount == 0)){
    $data_empty = true;
}
?>
<script type="text/javascript">
    <?php if($data_empty == false) { ?>
        drawChart();
    <?php } else{ ?>
        jQuery("#inventory_widget1").html('<div class="noData"><?php print t('No data available for the selected criteria');?></div>');
    <?php } ?>
    function drawChart() {        
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Resource');
        data.addColumn('number', 'Status');
        data.addColumn({type: 'string', role: 'tooltip'});
        data.addColumn('number', 'Status');
        data.addColumn({type: 'string', role: 'tooltip'});
        data.addColumn('number', 'Status');
        data.addColumn({type: 'string', role: 'tooltip'}); 
       
            data.addRows([
              ["<?php print t('Instances');?>", <?php echo $intanceRunning == 0 ? '' : $intanceRunning; ?>,'<?php print t('Running');?>: '+<?php echo $intanceRunning; ?>+'',<?php echo $intanceStopped == 0 ? '' : $intanceStopped; ?>,'Stopped: '+<?php echo $intanceStopped; ?>+'',<?php echo $intanceTerminated == 0 ? '' : $intanceTerminated; ?>,'Terminated: '+<?php echo $intanceTerminated; ?>+''],
              ["<?php print t('Volumes');?>", <?php echo $volumeInuse == 0 ? '' : $volumeInuse; ?>,'<?php print t('In-Use');?>: '+<?php echo $volumeInuse; ?>+'',<?php echo $volumeAvailable == 0 ? '' : $volumeAvailable; ?>,'Available: '+<?php echo $volumeAvailable; ?>+'', , ''],
              ["<?php print t('Public IPs');?>", <?php echo $freecount == 0 ? '' : $freecount; ?>,'<?php print t('Allocated');?>: '+<?php echo $freecount; ?>+'',<?php echo $freeip == 0 ? '' : $freeip; ?>,'Free: '+<?php echo $freeip; ?>+'', , ''],
              ["<?php print t('Snapshots');?>", <?php echo $completedSnapshots == 0 ? '' : $completedSnapshots; ?>,'<?php print t('Active');?>: '+<?php echo $completedSnapshots; ?>+'',<?php echo $errorSnapshots == 0 ? '' : $errorSnapshots; ?>,'<?php print t('Error');?>: '+<?php echo $errorSnapshots; ?>+'', , ''],
              ["<?php print t('Images');?>", <?php echo $availableimages == 0 ? '' : $availableimages; ?>,'<?php print t('Active');?>: '+<?php echo $availableimages; ?>+'',<?php echo $failedimages == 0 ? '' : $failedimages;?>,'<?php print t('Failed');?>: '+<?php echo $failedimages;?>+'', , '']
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
        var chart = new google.visualization.ColumnChart(document.getElementById('inventory_widget1'));
        chart.draw(data, options);
    }
</script>
