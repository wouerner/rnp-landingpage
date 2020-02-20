<?php 
$server_url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
define('DRUPAL_ROOT', $_SERVER['DOCUMENT_ROOT'].'/cms/');
define("JSDN_OAUTH_HOST", $server_url);
require_once DRUPAL_ROOT . 'includes/bootstrap.inc';
// Bootstrap Drupal at the phase that you need
drupal_bootstrap(DRUPAL_BOOTSTRAP_SESSION);
$draw = empty($_GET["draw"]) ? '1' : $_GET["draw"];
$index = ($_GET['start']+$_GET['length'])/10;
$sortColumn = 'null';
if(isset($_GET['order'])){
  if($_GET['order'][0]['column']>=0){
    $sortColumn = $_GET['order'][0]['column'];
  }
}
if($sortColumn != ''){
    $sortColumn = $_GET['columns'][$sortColumn]['data'];
}

$actionType = empty($_GET['actionType']) ? '' : $_GET['actionType'];
$sortOrder = empty($_GET['order'][0]['dir']) ? '' : $_GET['order'][0]['dir'];
$searchTerm = empty($_GET['search']['value']) ? '' : $_GET['search']['value'];
$filter = "";
if($actionType != 'search' && isset($actionType)){
    foreach ($_GET['columns'] as $k=>$post) {
      if($post['search']['value'] != NULL){
        $string_key = str_replace('label', 'code', $post['data']);
        $filter[$string_key] = json_decode($post['search']['value'], true);
      }
    }
    $filters = json_encode($filter);
}
$filter = $filters;
if($regions == 'All'){
    $regions = array('All');
}
else{
    $regions = explode(",", $regions);
}

$regions = json_encode($regions);
$endcustcompacronym = json_decode($_SESSION['MenuJSON'])->profile->companyacronym;
$request_body = '{
"search-requests":{
"companyAcronym":"'.$endcustcompacronym.'",
"start-page":"'.$index.'",
"filter-string":['.$filter.'],
"sort":[{"column":["'.$sortColumn.'","'.$sortOrder.'"]}],
"search-text": "'.$searchTerm.'"
}
}';
$api_url = JSDN_OAUTH_HOST."/api/v2/license/list-licenseRequest/";
$requestList = jsdn_requests_list($api_url, $request_body);
$output = json_decode($requestList, TRUE);
$output['draw'] =  $draw;
$output['recordsFiltered'] =  $output['recordsTotal'];
$output = json_encode($output);
$output = json_decode($output);
$output->filterString = array(rtrim($filter,","));
echo json_encode($output);

function jsdn_requests_list($api_url, $request_body) {
    $cmsMenu = json_decode($_SESSION['MenuJSON']);
    $isProxied = json_decode($_SESSION['MenuJSON'])->profile->isProxied;
    $compacronym = json_decode($_SESSION['MenuJSON'])->profile->storecompanyacronym;
    $endcustcompacronym=json_decode($_SESSION['MenuJSON'])->profile->companyacronym;
    $ch = curl_init();
    $curlConfig = array(
        CURLOPT_URL            => $api_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 500,
        CURLOPT_USERAGENT      => "CMS", // who am i
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $request_body
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
    print_r($result);exit;
    if ($result === false) {
        $error = curl_error($ch);
    } 
    curl_close($ch);
    return $result;
}
?>