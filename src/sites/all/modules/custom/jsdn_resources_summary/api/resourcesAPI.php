<?php
$server_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT'].'/cms/');
define("JSDN_OAUTH_HOST", $server_url);
require_once DRUPAL_ROOT . 'includes/bootstrap.inc';

// Bootstrap Drupal at the phase that you need
drupal_bootstrap(DRUPAL_BOOTSTRAP_SESSION);



$company_acronym = urlencode($_POST['company_acronym']);
$count = $_POST['count'];
$provider = urlencode($_POST['provider']);
$regions = $_POST['regions'];
$type = $_POST['type'];
$showAll = false;
$showRegions = false;


if(empty($company_acronym) || ($company_acronym == 'All')){
    $JSDN_TENANT_ORG_ACRONYM = $_SESSION['companyacronym'];
    $_SESSION['changed_acronym'] = '';
}
else{
    $JSDN_TENANT_ORG_ACRONYM = $company_acronym;
    $_SESSION['changed_acronym'] = $company_acronym;
}

if($company_acronym == 'All'){
    $showAll = true;
}


    switch ($type) {
        case 'resources-instances-by-count':
            $api_url = JSDN_OAUTH_HOST."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/jsdn/unified-resources-instances-by-count?provider=".$provider; 
            $showRegions = true;
            break;
            
        case 'resources-by-provider':
            $api_url = JSDN_OAUTH_HOST ."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/jsdn/unified-resources-resources-by-provider?provider=".$provider;
            $showRegions = true;
            break;
                
        case 'resources-by-region':
            $api_url = $api_url = JSDN_OAUTH_HOST."/api/2.0/".$JSDN_TENANT_ORG_ACRONYM."/datafeed/jsdn/unified-resources-resources-by-region?provider=".$provider;
            $showRegions = true;
            break;
        
        case 'resources-regions': 
            $_SESSION['session_provider'] = $provider;
            $api_url = JSDN_OAUTH_HOST .'/api/2.0/'.$JSDN_TENANT_ORG_ACRONYM.'/datafeed/jsdn/unified-resources-region?provider='.$provider;
            break;
    }
    if($showRegions){
        $regions_array = explode(',', $regions);
        foreach($regions_array as $region){
            $api_url .= "&region=".$region; 
        }
    }
    $output  = jsdn_resources_chart_curl_call_api($api_url);
    $out = jsdn_resources_chart_build_js_data_api($output, $type, $chart_type, $date_type, $JSDN_TENANT_ORG_ACRONYM, $provider, $startdate, $enddate, $days_between);

    print $out;
    exit;
	

/**
 * Implements jsdn_google_chart_build_js_data().
 */
function jsdn_resources_chart_build_js_data_api($chart_data, $data_type, $chart_type, $date_type, $JSDN_TENANT_ORG_ACRONYM, $provider, $startdate, $enddate, $days_between) {
    global $tagvalue;
    $json_data = json_decode($chart_data, true);
    if($data_type == 'resources-instances-by-count'){
        $provider = empty($json_data['DataFeedList']) ? array() : $json_data['DataFeedList'];
        $provider_php_arr = array();
        if($provider[0] != null){
            foreach($provider as $k=>$provider_data){
                $provider_php_arr[$k]['class'] = $provider_data['key'];
                $provider_php_arr[$k]['key'] = $provider_data['datafeedData'][0]['key'];
                $provider_php_arr[$k]['value'] = $provider_data['datafeedData'][0]['value'];
            }
        }
        $out = json_encode($provider_php_arr);
    }
    elseif($data_type == 'resources-by-provider') {
        $provider = empty($json_data['DataFeedList']) ? array() : $json_data['DataFeedList'];
        $columns = array('Products', 'Count');
        $out = jsdn_google_chart_json_array_two_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'resources-by-region') {
        $provider = empty($json_data['DataFeedList']) ? array() : $json_data['DataFeedList'];
        $columns = array('Products', 'Count');
        $out = jsdn_google_chart_json_array_two_dimensional_api($provider, $columns);
    }
    elseif($data_type == 'resources-regions') {
        $provider = empty($json_data['DataFeedList']) ? array() : $json_data['DataFeedList'];
        $provider_php_arr = array();
        foreach($provider as $k=>$provider_data){
            $provider_php_arr[$k]['key'] = $provider_data['datafeedData'][0]['key'];
            $provider_php_arr[$k]['value'] = $provider_data['datafeedData'][0]['value'];
        }
        $out = json_encode($provider_php_arr);
    } 
    return $out;
}
/**
 * Implements jsdn_google_chart_build_js_data().
 */
function jsdn_google_chart_json_array_one_dimensional_api($provider, $columns = array()) { 
    $provider_php_arr = array();
    foreach($provider as $provider_data){
        $provider_php = array();
        $provider_php[] = $provider_data['key'];
        $provider_php[] = (float) $provider_data['value'];
        array_push($provider_php_arr , $provider_php);
    }
    array_unshift($provider_php_arr , $columns);
    $result = json_encode($provider_php_arr);
    return $result;
}

/**
 * Implements jsdn_google_chart_build_js_data().
 */
function jsdn_google_chart_json_array_two_dimensional_api($provider, $columns = array()) { 
    $provider_php_arr = array();
    foreach($provider as $key=>$provider_data){
        $provider_php = array();
        $provider_array = $provider_data['datafeedData'];
        if($provider_array != null){
            foreach($provider_array as $provider_array_data){
                $provider_php[] = $provider_array_data['key'];
                $provider_php[] = (float) $provider_array_data['value'];
            }     
            array_push($provider_php_arr , $provider_php);
        }
    }
    array_unshift($provider_php_arr , $columns);
    $result = json_encode($provider_php_arr);
    return $result;
}

/**
 * Get the resonse for to prepare the chart from JSDN.
 *
 * @param $api_url
 *   The api url identifier.
 */
function jsdn_resources_chart_curl_call_api($url) { 
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