<?php
$authtocken = $_POST['authTocken'];

$host = $_SERVER['HTTP_HOST'];

if (!empty($_SERVER['HTTPS'])) {
    $jsdnURL="https://".$host;
}
else{
	$jsdnURL="http://".$host.":8080";
}

//$jsdnURL="http://fdcmsstore.tgtmkt76.com:8080";

$apibody=$_POST['postParam'];

//$body = '{"auth": {"passwordCredentials": {"username": "admin.fddemo.com","password": "Root@123"},"tenantId": "store2"}}';
/*

$ch = curl_init();
		$curlConfig = array(
		CURLOPT_URL            => $jsdnURL."/api/v2.0/tokens",
		CURLOPT_POST           => true,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT        => 500,
		CURLOPT_USERAGENT      => "CMS", // who am i
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_POSTFIELDS     => $body
		);
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Accept: application/json'
    ));
		curl_setopt($ch, CURLOPT_TIMEOUT, 		 500);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); 
		
		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		curl_close($ch);
		$arraytocken = json_decode($result, true);
		$authtocken=$arraytocken["access"]["token"]["id"];
*/
$ch = curl_init();
		$curlConfig = array(
		CURLOPT_URL            => $jsdnURL."/api/1.0/usage/usageTrend?date=".(time()*1000),
		CURLOPT_POST           => true,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT        => 500,
		CURLOPT_USERAGENT      => "CMS", // who am i
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_POSTFIELDS     => $apibody
		);
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'X-Auth-Token:'.$authtocken,
    'Content-Type: application/json',
    'Accept: application/json',
	'xoauth-jsdn-loginUrl:'.$host,
	
    ));
		curl_setopt($ch, CURLOPT_TIMEOUT, 		 500);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); 
		
		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		curl_close($ch);
		header('Content-Type: application/json');
		print($result);
?>