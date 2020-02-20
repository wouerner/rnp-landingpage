<?php
$server_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT'].'cms/');
define("JSDN_OAUTH_HOST", $server_url);
require_once DRUPAL_ROOT . 'includes/bootstrap.inc';

// Bootstrap Drupal at the phase that you need
drupal_bootstrap(DRUPAL_BOOTSTRAP_SESSION);

$type = $_POST['type'];
$instanceId = $_POST['instanceId'];
$subscriptionID = $_SESSION['subscriptionId'];
if(($_SESSION['azure_Token'] != '') && ($_SESSION['subscriptionId'] != '')){

    switch ($type) {
        
        case 'volume':
            // Implementation to get the Volumes per Resource Group
            $url_volumes = "https://management.azure.com/subscriptions/".$subscriptionID."/providers/Microsoft.Compute/disks?api-version=2016-04-30-preview";
            $inventory_azure_volumes = jsdn_google_chart_get_azure_resource_call($url_volumes);
            $recommendation_volume = array();
            $volumeAvailable=0;
            if(count($inventory_azure_volumes['value'])){
                $volumes_available = $inventory_azure_volumes['value'];
                foreach ($volumes_available as $volume) {
                    $involumeAvailable = $volume['properties']['diskState'];
                    if($involumeAvailable == 'Unattached'){
                        $volumeAvailable++;
                        $recommendation_volume[] = $volume;
                    }
                }
            }    
            $out = json_encode($recommendation_volume);
            $_SESSION['recommendation_volumes'] = $recommendation_volume;
            break;
            
        case 'instance':
            $recommendation_instances = array();
            $url = "https://management.azure.com/subscriptions/".$subscriptionID."/providers/Microsoft.Advisor/recommendations?api-version=2017-03-31";
            $inventory_azure_oversized = jsdn_google_chart_get_azure_resource_call($url);
            $instances_oversized = $inventory_azure_oversized['value'];
            foreach ($instances_oversized as $oversized) {
                if($oversized['properties']['category'] == 'Cost'){
                    $oversizedIntances++;
                    $recommendation_instances[] = $oversized;
                }
            }
            $out = json_encode($recommendation_instances);
            $_SESSION['recommendation_instances'] = $recommendation_instances;
            break;
            
        case 'ip':
            // IP Address Recommendation
            $url_elastic = "https://management.azure.com/subscriptions/".$subscriptionID."/providers/Microsoft.Network/publicIPAddresses?api-version=2015-06-15";
            $inventory_azure_elastic = jsdn_google_chart_get_azure_resource_call($url_elastic);
            $freecount=0;
            $recommendation_ip = array();
            if(count($inventory_azure_elastic['value'])){
                $ipaddresses = $inventory_azure_elastic['value'];
                foreach ($ipaddresses as $ipaddress) {
                    $ip = $ipaddress['properties'];
                    if(empty($ip['ipConfiguration'])){
                        $recommendation_ip[] = $ipaddress;
                        $freecount+= 1;
                    }
                }
            }
            $out = json_encode($recommendation_ip);
            $_SESSION['recommendation_ipaddresses']= $recommendation_ip;
            break;
            
        case 'snapshot':
            // Snapshots Recommendation
            $url_snapshot = "https://management.azure.com/subscriptions/".$subscriptionID."/providers/Microsoft.Compute/snapshots/?api-version=2017-03-30";
            $inventory_azure_snapshot = jsdn_google_chart_get_azure_resource_call($url_snapshot);
            $snapshots = $inventory_azure_snapshot['value'];

            $recommendation_snapshots = array();
            foreach($snapshots as $snapshot){
                $startTime = $snapshot['properties']['timeCreated'];
                $snap_date = new DateTime($startTime);
                $snap_date = casttoclass('stdClass', $snap_date);
                $snap_date = $snap_date->date;
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
            
        case 'image':
            // Images Recommendation
            $url = "https://management.azure.com/subscriptions/".$subscriptionID."/providers/Microsoft.Compute/images/?api-version=2017-03-30";
            $inventory_azure_images = jsdn_google_chart_get_azure_resource_call($url);
            $images = $inventory_azure_images['value'];
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
            
            
        case 'security':
            // Security ELB Recommendation
            $recommendation_security = array();
            $security_entire = array();
            $intanceSecurity = 0;
            $url = "https://management.azure.com/subscriptions/".$subscriptionID."/providers/Microsoft.Advisor/recommendations?api-version=2017-03-31";
            $inventory_azure_security = jsdn_google_chart_get_azure_resource_call($url);
            $security_sg = $inventory_azure_security['value'];
            foreach ($security_sg as $sg) {
                if($sg['properties']['category'] == 'Security'){
                    $recommendation_security[] = $sg;
                    $intanceSecurity = $intanceSecurity+1;
                }
            }
            $out = json_encode($recommendation_security);
            $_SESSION['recommendation_security']= $recommendation_security;
            break;
            
        case 'high_availability':
            // Security ELB Recommendation
            $recommendation_high_availability = array();
            $url = "https://management.azure.com/subscriptions/".$subscriptionID."/providers/Microsoft.Advisor/recommendations?api-version=2017-03-31";
            $inventory_azure_availability = jsdn_google_chart_get_azure_resource_call($url);
            $high_availability = $inventory_azure_availability['value'];
            foreach ($high_availability as $availability) {
                if($availability['properties']['category'] == 'HighAvailability'){
                    $recommendation_high_availability[] = $availability;
                }
            }
            $out = json_encode($recommendation_high_availability);
            $_SESSION['recommendation_high_availability']= $recommendation_high_availability;
            break;
            
        case 'performance':
            // Security ELB Recommendation
            $recommendation_database = array();
            $url = "https://management.azure.com/subscriptions/".$subscriptionID."/providers/Microsoft.Advisor/recommendations?api-version=2017-03-31";
            $inventory_azure_database = jsdn_google_chart_get_azure_resource_call($url);
            $database = $inventory_azure_database['value'];
            foreach ($database as $db) {
                if($db['properties']['category'] == 'Performance'){
                    $recommendation_database[] = $db;
                }
            }
            $out = json_encode($recommendation_database);
            $_SESSION['recommendation_security']= $recommendation_database;
            break;
            
        case 'reservation':
            // Implementation to get the reservation data
            $JSDN_TENANT_ORG_ACRONYM = $_SESSION['companyacronym'];
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/ri-recommandation-details?cstype=IAAS&provider=".$_SESSION['providers_recommendation_type']."&showAll=All"; 
            $reservation_json  = jsdn_google_chart_curl_call_api($api_url);
            $reservation = json_decode($reservation_json , true);
            $purachse_json = $reservation['DataFeedList'][0]['datafeedData'][0]['value'];
            if($purachse_json != ''){
                $purachse_json = json_decode($purachse_json , true);
            }
            else{
                $purachse_json = array();
            }
            $recommendation_reservation = array();
            $reservationPurchased = 0;
            $reservationSell = 0;
            foreach($purachse_json as $reservation_array){
                $reservationPurchased+= $reservation_array['recommendedNumberOfInstancesToPurchase'];
            }
            
            $api_url_sell = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/report/ri-sell-recommandation-details?cstype=IAAS&provider=".$_SESSION['providers_recommendation_type']."&showAll=All"; 
            $reservation_sell_json  = jsdn_google_chart_curl_call_api($api_url_sell);
            $reservation_sell = json_decode($reservation_sell_json , true);
            $sell_json = $reservation_sell['DataFeedList'][0]['datafeedData'][0]['value'];
            if($sell_json != ''){
                $sell_json = json_decode($sell_json , true);
            }
            else{
                $sell_json = array();
            }
            $recommendation_reservation_sell = array();
            $reservationSell = 0;
            foreach($sell_json as $reservation_sell_array){
                $reservationSell++;
            }
            
            array_unshift($recommendation_reservation , array("recommendation_reservation" =>  $purachse_json));
            array_unshift($recommendation_reservation , array("recommendation_sell_reservation" =>  $sell_json));
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
/**
 * Implements azure_api_call().
 */
function jsdn_google_chart_get_azure_resource_call($url) {
    $ch = curl_init();
    $curlConfig = array(
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 500,
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer '.$_SESSION['azure_Token'],
    ));
    curl_setopt_array($ch, $curlConfig);
    $result = curl_exec($ch);
    if ($result === false) {
        $error = curl_error($ch);
        curl_close($ch);
        watchdog('jsdn_google_chart', 'Curl Request %exception.', array('%exception' => $error));
    } 
    curl_close($ch);
    return json_decode($result, true);
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