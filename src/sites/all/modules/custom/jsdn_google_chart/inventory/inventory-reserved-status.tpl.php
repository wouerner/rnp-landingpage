<div id="inventory_widget8" class="chart_daily_trend jsdn_chart" align='center'></div>
<div class="clear"></div>
<?php
if(($_SESSION['accessKey'] != '') && ($_SESSION['secretKey'] != '') && ($_SESSION['inventory_region'] != '')){
    $path = drupal_get_path('module', 'jsdn_google_chart'). '/lib/aws/config.php';
    include ($path);
	    try{
        $result = $ec2Client->DescribeReservedInstances(array());
    } catch (Exception $ex) {
	?>
        <script type="text/javascript">
        jQuery("#inventory_widget8").html('<div class="noData"><?php print t('Not able to get the data currently. Please contact support.');?></div>');
        </script>
    <?php
		watchdog('jsdn_inventory', 'Reservation Response %exception.', array('%exception' => json_encode($ex)));
        return;
    }
    $reservations = $result['ReservedInstances'];
    $_SESSION['reservations']=$reservations;

    if(empty($_SESSION['instances'])){
        $intances = $ec2Client->DescribeInstances(array());
        $instanceAll = $intances['Reservations'];
        $_SESSION['instances']=$instanceAll;
    }
    $reservedInstances = $_SESSION['instances'];
   
    
foreach ($reservations as $reservation) {
 $resv[$reservation['InstanceType'].' - '.$reservation['ProductDescription']]=$resv[$reservation['InstanceType'].' - '.$reservation['ProductDescription']]+@$reservation['InstanceCount'] ;
}


foreach ($reservedInstances as $res) {
    $instances = $res['Instances'];
    foreach ($instances as $instance) {
     if(!isset($instance['Platform'])){
      if($instance['State']['Name']=="running"){
       $resultArray[$instance['InstanceType'].' - Linux/UNIX']['running'][]=1;
      }else{
       $resultArray[$instance['InstanceType'].' - Linux/UNIX']['stopped'][]=1;
      }
      
     }else{
      if($instance['State']['Name']=="running"){
       $resultArray[$instance['InstanceType'].' - Windows']['running'][]=1;
      }else{
       $resultArray[$instance['InstanceType'].' - Windows']['stopped'][]=1;
      }
      
     }
    }
}


foreach ($resv as $key => $value) {
 $data[$key]['reserved'] = $value;
 $data[$key]['running'] = count(@$resultArray[$key]['running']);
 $data[$key]['stopped'] = count(@$resultArray[$key]['stopped']);
}

$provider_php_arr = array();
foreach($data as $key=>$provider_data){
    $provider_php = array();
    $provider_php[] = $key;
    
    if($provider_data['reserved'] != 0){
        $provider_php[] = $provider_data['reserved'];
        $provider_php[] = t('Reserved').": ".$provider_data['reserved'];
    }
    else{
        $provider_php[] = null;
        $provider_php[] = "";
    }
    
    if($provider_data['running'] != 0){
        $provider_php[] = $provider_data['running'];
        $provider_php[] = t('Running').": ".$provider_data['running'];
    }
    else{
        $provider_php[] = null;
        $provider_php[] = "";
    }
   
    
    if($provider_data['stopped'] != 0){
        $provider_php[] = $provider_data['stopped'];
        $provider_php[] = t('Stopped').": ".$provider_data['stopped'];
    }
    else{
        $provider_php[] = null;
        $provider_php[] = "";
    }
    
    array_push($provider_php_arr , $provider_php);
}

$provider_php_arr = json_encode($provider_php_arr);

} 
$data_empty = false;
if(empty($data)){
    $data_empty = true;
}
?>
<script type="text/javascript">
    <?php if($data_empty == false) { ?>
        drawChart();
    <?php } else{ ?>
        jQuery("#inventory_widget8").html('<div class="noData"><?php print t("No data available for the selected criteria");?></div>');
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
        var result = JSON.stringify(<?php echo $provider_php_arr;?>);
        data.addRows(<?php echo $provider_php_arr;?>);

        var chartAreaSize = {width: '95%', height: '80%',top:15,left:90}; 
        var chartColor = ['#c7f634', '#ffa200', '#ff0000'];      
        var options = {
            colors: chartColor,
            tooltip:{"textStyle":{fontSize: 13, bold:true}},
            fontSize:12,
            chartArea: chartAreaSize,
            animation:{
                "startup": true,
                "duration": 1000,
                "easing": 'out',
            },
            vAxis:{title: '<?php echo t('Count');?>',scaleType:"mirrorLog", minValue:0, maxValue:100, gridlines:{count:5, color: '#e9e9e9'}}
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('inventory_widget8'));
        chart.draw(data, options);
    }
</script>