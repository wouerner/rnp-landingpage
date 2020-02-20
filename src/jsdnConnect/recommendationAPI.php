<?php
$server_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT'].'cms/');
define("JSDN_OAUTH_HOST", $server_url);
require_once DRUPAL_ROOT . 'includes/bootstrap.inc';

// Bootstrap Drupal at the phase that you need
drupal_bootstrap(DRUPAL_BOOTSTRAP_SESSION);

$type = $_POST['type'];
$instanceId = $_POST['instanceId'];

if(($_SESSION['accessKey'] != '') && ($_SESSION['secretKey'] != '') && ($_SESSION['inventory_recommendation_region'] != '')){
    $path = DRUPAL_ROOT.'sites/all/modules/custom/jsdn_google_chart/lib/aws/configRecommendation.php';
    include ($path);
    
    switch ($type) {
        case 'volume':
             // Volumes Recommendation
            $volume = $ec2Client->DescribeVolumes(array('OwnerIds' => ['self']));
            $volumes = $volume['Volumes'];
            $recommendation_volume = array();
            $volumeAvailable=0;
            foreach ($volumes as $volume) {
                if($volume['State']=='available'){
                    $volumeAvailable = $volumeAvailable+1;
                    $recommendation_volume[] = $volume;
                }
            }
            $out = json_encode($recommendation_volume);
            $_SESSION['recommendation_volumes'] = $recommendation_volume; 
            break;
            
        case 'instance':
            //Instances Recommendation
            $intances = $ec2Client->DescribeInstances(array());
            $instanceAll = $intances['Reservations'];
            $intanceStopped = 0;
            $intanceOversized = 0;
            $recommendation_instances = array();
            $recommendation_instances_stopped  = array();
            $recommendation_instances_oversized  = array();
            $todaydate = date("Y-m-d");
            $last_month = date("Y-m-d", strtotime("$todaydate -1 month"));
            foreach ($instanceAll as $reservation) {
                $instances = $reservation['Instances'];
                foreach ($instances as $instance) {
                    // Intances Stopped Recommendation
                    if($instance['State']['Name']=='stopped'){
                        $intanceStopped = $intanceStopped+1;
                        $instance['recommendation_status'] = 'Stopped';
                        $recommendation_instances_stopped[] = $instance;
                    }
                    // Intances Oversized Recommendation
                    $instances_oversized = $CloudWatchClient->getMetricStatistics(array(
                        'Dimensions' => [
                            [
                                'Name' => 'InstanceId', // REQUIRED
                                'Value' => $instance['InstanceId'], // REQUIRED
                            ],
                        ],
                        'MetricName' => 'CPUUtilization', // REQUIRED
                        'Namespace' => 'AWS/EC2', // REQUIRED
                        'Period' => 86400, //1Hour
                        'Statistics' => ['Average','Maximum'],
                        'StartTime' => $last_month,
                        'EndTime' => $todaydate
                    ));
                    $instances_oversized = $instances_oversized["Datapoints"];
                    if(!empty($instances_oversized)) {
                        $recommendation_status = true;
                        foreach ($instances_oversized as $oversized) {
                            if($oversized['Maximum'] > 80){
                                $recommendation_status = false;
                                break;
                            }
                        }
                        if($recommendation_status == true){
                            $average_status = true;
                            foreach ($instances_oversized as $oversized) {
                                if($oversized['Average'] > 60){
                                    $average_status = false;
                                    break;
                                }
                            }
                            if($average_status == true){
                                if($instance['State']['Name'] != 'terminated'){
                                    $intanceOversized = $intanceOversized+1;
                                    $instance['recommendation_status'] = 'Underutilized';
                                    $recommendation_instances_oversized[] = $instance;
                                }
                            }
                        }
                    }
                }
            }
            array_unshift($recommendation_instances , array("recommendation_instances_stopped" =>  $recommendation_instances_stopped));
            array_unshift($recommendation_instances , array("recommendation_instances_oversized" =>  $recommendation_instances_oversized));
            array_unshift($recommendation_instances , array("intanceStopped" =>  $intanceStopped));
            array_unshift($recommendation_instances , array("intanceOversized" =>  $intanceOversized));
            $out = json_encode($recommendation_instances);
            $_SESSION['recommendation_instances'] = $recommendation_instances;
            break;
            
        case 'snapshot':
            // Snapshots Recommendation
            $snapshots = $ec2Client->DescribeSnapshots(array('OwnerIds' => ['self']));
            $snapshots = $snapshots['Snapshots'];
            $recommendation_snapshots = array();
            foreach($snapshots as $snapshot){
                $startTime = casttoclass('stdClass', $snapshot['StartTime']);
                $snap_date = $startTime->date;
                $snapshot_date = new DateTime($snap_date);
                $todaydate = new DateTime();
                $difference = $snapshot_date->diff($todaydate);
                if(($difference->y == 0) && ($difference->m > 2) && ($difference->m <= 5)){
                    $snapshot['days_elapsed'] = '3 Months';
                    $snapshot['snap_date'] = $snap_date;
                    $recommendation_snapshots[]= $snapshot;
                }
                elseif(($difference->y == 0) && ($difference->m > 5)){
                    $snapshot['days_elapsed'] = '6 Months';
                    $snapshot['snap_date'] = $snap_date;
                    $recommendation_snapshots[]= $snapshot;
                }
                elseif(($difference->y >= 1)){
                    $snapshot['days_elapsed'] = '12 Months';
                    $snapshot['snap_date'] = $snap_date;
                    $recommendation_snapshots[]= $snapshot;
                }
            }
            $out = json_encode($recommendation_snapshots);
            $_SESSION['recommendation_snapshots'] = $recommendation_snapshots;
            break;
            
        case 'ip':
            // IP Address Recommendation
            $ipaddresses = $ec2Client->describeAddresses(array());
            $ipaddresses = $ipaddresses['Addresses'];
            $recommendation_ip = array();
            $freeIp = 0;
            foreach ($ipaddresses as $ipaddress) {
                if(empty($ipaddress['AssociationId'])){
                    $recommendation_ip[] = $ipaddress;
                    $freeIp +=count($inst);
                }
            }
            $out = json_encode($recommendation_ip);
            $_SESSION['recommendation_ipaddresses']= $recommendation_ip;
            break;
            
        case 'image':
            // Images Recommendation
            $images = $ec2Client->DescribeImages(array('Owners' => ['self']));
            $images = $images['Images'];
            $recommendation_image = array();
            foreach ($images as $image) {
                $startTime = $image['CreationDate'];
                $image_date = new DateTime($startTime);
                $todaydate = new DateTime();
                $difference = $image_date->diff($todaydate);
                if(($difference->y == 0) && ($difference->m > 2) && ($difference->m <= 5)){
                    $image['days_elapsed'] = '3 Months';
                     $recommendation_image[]=$image;
                }
                elseif(($difference->y == 0) && ($difference->m > 5)){
                    $image['days_elapsed'] = '6 Months';
                     $recommendation_image[]=$image;
                }
                elseif(($difference->y >= 1)){
                    $image['days_elapsed'] = '12 Months';
                    $recommendation_image[]=$image;
                }
            }
            $out = json_encode($recommendation_image);
            $_SESSION['recommendation_images'] = $recommendation_image;
            break;
            
        case 'instances_underutilized':
            // Intances Oversized Recommendation
            $todaydate = date("Y-m-d");
            $last_month = date("Y-m-d", strtotime("$todaydate -1 month"));
            $instances_oversized = $CloudWatchClient->getMetricStatistics(array(
                'Dimensions' => [
                    [
                        'Name' => 'InstanceId', // REQUIRED
                        'Value' => $instanceId, // REQUIRED
                    ],
                ],
                'MetricName' => 'CPUUtilization', // REQUIRED
                'Namespace' => 'AWS/EC2', // REQUIRED
                'Period' => 86400, //1Hour
                'Statistics' => ['Average','Maximum'],
                'StartTime' => $last_month,
                'EndTime' => $todaydate
            ));
            $oversized = $instances_oversized["Datapoints"];
            $columns = array('Average CPU Utilization (%)', 'Maximum CPU Utilization (%)', 'Timestamp');
            $oversized_data_arr = array();
            foreach($oversized as $oversized_data){
                $provider_php = array();
                $provider_php[] = $oversized_data['Average'];
                $provider_php[] = $oversized_data['Maximum'];
                $provider_php[] = $oversized_data['Timestamp'];
                array_push($oversized_data_arr , $provider_php);
            }
            array_unshift($oversized_data_arr , $columns);
            $out = json_encode($oversized_data_arr);
            break;
            
        case 'load_balancer':
            // Load balancer Recommendation
            $result = $ElasticLoadBalancingClient->describeLoadBalancers();
            $load_balancer = $result['LoadBalancerDescriptions'];
            $recommendation_load_balancer = array();
            foreach ($load_balancer as $balancer) {
                if(count($balancer['Instances']) <= 1){
                    $recommendation_load_balancer[] = $balancer;
                }
            }
            $out = json_encode($recommendation_load_balancer);
            $_SESSION['recommendation_load_balancer']= $recommendation_load_balancer;
            break;
            
        case 'security':
            // Security ELB Recommendation
            $result = $ElasticLoadBalancingClient->describeLoadBalancers();
            $securitys = $result['LoadBalancerDescriptions'];
            $recommendation_security_elb = array();
            $recommendation_security = array();
            $security_entire = array();
            $intanceSecurity = 0;
            foreach ($securitys as $security) {
                if(count($security['SecurityGroups']) <= 0){
                    $recommendation_security_elb[] = $security;
                    $intanceSecurity = $intanceSecurity+1;
                }
            }
            // Security Recommendation
            $result_security = $ec2Client->describeSecurityGroups(array(
                        'Filters' => [		
                                        [
                                            'Name' => 'ip-permission.cidr',
                                            'Values' => ['0.0.0.0/0'],
                                        ]		
                                    ]
                        ));
            $security_sg = $result_security['SecurityGroups'];
            foreach ($security_sg as $sg) {
                $security_ip = $sg['IpPermissions'];
                foreach ($security_ip as $ip) {
                    if (in_range($ip['ToPort'], $ip['FromPort'])){
                        $ipRanges = $ip['IpRanges'];
                        foreach ($ipRanges as $ipRange) {
                            if($ipRange['CidrIp'] == '0.0.0.0/0'){
                                $found = false;
                                foreach ($recommendation_security as $security_array) {
                                    if ($security_array['GroupId'] == $sg['GroupId']) {
                                        $found = true;
                                    }
                                }
                                if($found == false){
                                    $recommendation_security[] = $sg;
                                    $intanceSecurity = $intanceSecurity+1;
                                }
                            }
                        }
                    }
                }
            }
            array_unshift($security_entire , array("recommendation_security_elb" =>  $recommendation_security_elb));
            array_unshift($security_entire , array("recommendation_security" =>  $recommendation_security));
            array_unshift($security_entire , array("intanceSecurity" =>  $intanceSecurity));
            $out = json_encode($security_entire);
            $_SESSION['recommendation_security']= $security_entire;
            break;
            
        case 'database':
            //Instances Recommendation
            $databases = $RdsClient->DescribeDBInstances(array());
            $databaseAll = $databases['DBInstances'];
            $databaseStopped = 0;
            $databaseOversized = 0;
            $recommendation_databases = array();
            $todaydate = date("Y-m-d");
            $last_month = date("Y-m-d", strtotime("$todaydate -1 month"));
            $last_month_unused = date("Y-m-d", strtotime("$todaydate -15 days"));
            foreach ($databaseAll as $database) {
                // Database Unused Recommendation
                $database_unused = $CloudWatchClient->getMetricStatistics(array(
                    'Dimensions' => [
                            [
                                'Name' => 'DBInstanceIdentifier', // REQUIRED
                                'Value' => $database['DBInstanceIdentifier'], // REQUIRED		
                            ],
                    ],
                    'MetricName' => 'DatabaseConnections', // REQUIRED
                    'Namespace' => 'AWS/RDS', // REQUIRED
                    'Period' => 216000, //1Hour
                    'Statistics' => ['Average','Maximum'],
                    'StartTime' => $last_month_unused,
                    'EndTime' => $todaydate,
                    'Unit' => 'Count'
                ));
                
                $database_unused = $database_unused["Datapoints"];
                
                if(!empty($database_unused)) {
                    $average_status_unused = false;
                    foreach ($database_unused as $unused) {
                        if($unused['Maximum'] > 0){
                            $average_status_unused = true;
                            break;
                        }
                    }
                    if($average_status_unused == false){
                        $databaseStopped = $databaseStopped+1;
                        $database['recommendation_status'] = 'Unused';
                        $recommendation_databases[] = $database;
                    }
                }
                // Database Oversized Recommendation
                $database_oversized = $CloudWatchClient->getMetricStatistics(array(
                    'Dimensions' => [
                            [
                                'Name' => 'DBInstanceIdentifier', // REQUIRED
                                'Value' => $database['DBInstanceIdentifier'], // REQUIRED		
                            ],
                    ],
                    'MetricName' => 'CPUUtilization', // REQUIRED
                    'Namespace' => 'AWS/RDS', // REQUIRED
                    'Period' => 216000, //1Hour
                    'Statistics' => ['Average','Maximum'],
                    'StartTime' => $last_month,
                    'EndTime' => $todaydate,
                    'Unit' => 'Percent'
                ));

                $database_oversized = $database_oversized["Datapoints"];
                if(!empty($database_oversized)) {
                    $recommendation_status = true;
                    foreach ($database_oversized as $oversized) {
                        if($oversized['Maximum'] > 80){
                            $recommendation_status = false;
                            break;
                        }
                    }
                    $average_status = false;
                    if($recommendation_status == true){
                        $average_status = true;
                        foreach ($database_oversized as $oversized) {
                            if($oversized['Average'] > 60){
                                    $average_status = false;
                                    break;
                            }
                        }
                        if($average_status == true){
                            $databaseOversized = $databaseOversized+1;
                            $database['recommendation_status'] = 'Underutilized';
                            $recommendation_databases[] = $database;
                        }
                    }
                }
            }
            array_unshift($recommendation_databases , array("databaseStopped" =>  $databaseStopped));
            array_unshift($recommendation_databases , array("databaseOversized" =>  $databaseOversized));
            $out = json_encode($recommendation_databases);
            $_SESSION['recommendation_databases'] = $recommendation_databases;
            break;
            
        case 'database_underutilized':
            // Intances Oversized Recommendation
            $todaydate = date("Y-m-d");
            $last_month = date("Y-m-d", strtotime("$todaydate -1 month"));
            $database_oversized = $CloudWatchClient->getMetricStatistics(array(
                'Dimensions' => [
                        [
                            'Name' => 'DBInstanceIdentifier', // REQUIRED
                            'Value' => $instanceId, // REQUIRED		
                        ],
                ],
                'MetricName' => 'CPUUtilization', // REQUIRED
                'Namespace' => 'AWS/RDS', // REQUIRED
                'Period' => 216000, //1Hour
                'Statistics' => ['Average','Maximum'],
                'StartTime' => $last_month,
                'EndTime' => $todaydate,
                'Unit' => 'Percent'
            ));

            $database_oversized = $database_oversized["Datapoints"];
            $columns = array('Average CPU Utilization (%)', 'Maximum CPU Utilization (%)', 'Timestamp');
            $oversized_data_arr = array();
            foreach($database_oversized as $oversized_data){
                $provider_php = array();
                $provider_php[] = $oversized_data['Average'];
                $provider_php[] = $oversized_data['Maximum'];
                $provider_php[] = $oversized_data['Timestamp'];
                array_push($oversized_data_arr , $provider_php);
            }
            array_unshift($oversized_data_arr , $columns);
            $out = json_encode($oversized_data_arr);
            break;
            
        case 'database_unused':
            // Intances Oversized Recommendation
            $todaydate = date("Y-m-d");
            $last_month_unused = date("Y-m-d", strtotime("$todaydate -15 days"));
            $database_unused = $CloudWatchClient->getMetricStatistics(array(
                    'Dimensions' => [
                            [
                                'Name' => 'DBInstanceIdentifier', // REQUIRED
                                'Value' => $instanceId, // REQUIRED		
                            ],
                    ],
                    'MetricName' => 'DatabaseConnections', // REQUIRED
                    'Namespace' => 'AWS/RDS', // REQUIRED
                    'Period' => 216000, //1Hour
                    'Statistics' => ['Average','Maximum'],
                    'StartTime' => $last_month_unused,
                    'EndTime' => $todaydate,
                    'Unit' => 'Count'
            ));
            $database_unused = $database_unused["Datapoints"];
            $columns = array('Average Connection Rate', 'Maximum Connection Rate', 'Timestamp');
            $unused_data_arr = array();
            foreach($database_unused as $unused){
                $provider_php = array();
                $provider_php[] = $unused['Average'];
                $provider_php[] = $unused['Maximum'];
                $provider_php[] = $unused['Timestamp'];
                array_push($unused_data_arr , $provider_php);
            }
            array_unshift($unused_data_arr , $columns);
            $out = json_encode($unused_data_arr);
            break;
            
        case 'reservation':
            // Implementation to get the reservation data
            $JSDN_TENANT_ORG_ACRONYM = $_SESSION['companyacronym'];
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/ri-recommandation-details?cstype=IAAS&provider=aws&showAll=All"; 
            $reservation_json  = jsdn_google_chart_curl_call_api($api_url);
            $reservation = json_decode($reservation_json , true);
            $purachse_json = $reservation['DataFeedList'][0]['datafeedData'][0]['value'];
            $reservationPurchasedDays = $reservation['DataFeedList'][0]['datafeedData'][1]['value'];
            if($purachse_json != ''){
                $purachse_json = json_decode($purachse_json , true);
            }
            else{
                $purachse_json = array();
                $reservationPurchasedDays = 30;
            }
            $recommendation_reservation = array();
            $reservationPurchased = 0;
            foreach($purachse_json as $reservation_array){
                $reservationPurchased+= $reservation_array['recommendedNumberOfInstancesToPurchase'];
            }
            
            $api_url_sell = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/ri-sell-recommandation-details?cstype=IAAS&provider=aws&showAll=All"; 
            $reservation_sell_json  = jsdn_google_chart_curl_call_api($api_url_sell);
            $reservation_sell = json_decode($reservation_sell_json , true);
            $sell_json = $reservation_sell['DataFeedList'][0]['datafeedData'][0]['value'];
            $reservationSellDays =  $reservation_sell['DataFeedList'][0]['datafeedData'][1]['value'];
            if($sell_json != ''){
                $sell_json = json_decode($sell_json , true);
            }
            else{
                $sell_json = array();
                $reservationSellDays = 30;
            }
            $recommendation_reservation_sell = array();
            $reservationSell = 0;
            foreach($sell_json as $reservation_sell_array){
                $reservationSell++;
            }
            array_unshift($recommendation_reservation , array("recommendation_reservation" =>  $purachse_json));
            array_unshift($recommendation_reservation , array("recommendation_sell_reservation" =>  $sell_json));
            array_unshift($recommendation_reservation , array("reservationPurchasedDays" =>  $reservationPurchasedDays));
            array_unshift($recommendation_reservation , array("reservationSellDays" =>  $reservationSellDays));
            array_unshift($recommendation_reservation , array("reservationPurchased" =>  $reservationPurchased));
            array_unshift($recommendation_reservation , array("reservationSell" =>  $reservationSell));
            $out = json_encode($recommendation_reservation);
            break;
    }
}
print $out;
exit;

function casttoclass($class, $object){
  return unserialize(preg_replace('/^O:\d+:"[^"]++"/', 'O:' . strlen($class) . ':"' . $class . '"', serialize($object)));
}
function in_range($min, $max){
    if($min == $max){
            if($min == 80 && $max == 80){
                    return FALSE;
            }
            elseif($min == 443 && $max == 443){
                    return FALSE;
            }
	}
    return TRUE;
}

/**
 * Get the resonse for to prepare the chart from JSDN.
 *
 * @param $api_url
 *   The api url identifier.
 */
function jsdn_google_chart_curl_call_api($url) { 
    $cmsMenu = json_decode($_SESSION['MenuJSON']);
    $isProxied = json_decode($_SESSION['MenuJSON'])->profile->isProxied;
    $compacronym = json_decode($_SESSION['MenuJSON'])->profile->storecompanyacronym;
    $endcustcompacronym=json_decode($_SESSION['MenuJSON'])->profile->companyacronym;
	
    $ch = curl_init();
    $curlConfig = array(
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 500,
        CURLOPT_USERAGENT      => "CMS", // who am i
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_HTTPGET        => 1
    );
    if ($isProxied){
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Auth-Token:'.$_SESSION['authToken'],
            'Content-Type: application/json',
            'Accept: application/json',
            'xoauth-jsdn-loginUrl:'.$_SERVER['HTTP_HOST'],
            'proxy-store:'.$compacronym,
            'proxy-end-customer:'.$endcustcompacronym,
        ));
    }
    else{
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Auth-Token:'.$_SESSION['authToken'],
            'Content-Type: application/json',
            'Accept: application/json',
            'xoauth-jsdn-loginUrl:'.$_SERVER['HTTP_HOST'],
        ));

    }
    curl_setopt_array($ch, $curlConfig);
    $result = curl_exec($ch);
    if ($result === false) {
        $error = curl_error($ch);
        curl_close($ch);
    } 
    curl_close($ch);
    return $result;
}