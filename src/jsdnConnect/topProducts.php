<?php
$authtocken = $_POST['authTocken'];
$companyID = $_POST['companyID'];
$host = $_SERVER['HTTP_HOST'];

if (!empty($_SERVER['HTTPS'])) {
    $jsdnURL="https://".$host;
}
else{
	$jsdnURL="http://".$host.":8080";
}
//$jsdnURL="https://entstore.regsrc.com";

//$body = '{"auth": {"passwordCredentials": {"username": "jtest.jtest.com","password": "Elvis@2010"},"tenantId": "entstore"}}';
//$body = '{"auth": {"passwordCredentials": {"username": "admin.fddemo.com","password": "Root@123"},"tenantId": "store2"}}';
/*
$ch = curl_init();
		$curlConfig1 = array(
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
		
		curl_setopt_array($ch, $curlConfig1);
		$result = curl_exec($ch);
		curl_close($ch);
		$arraytocken = json_decode($result, true);
		$authtocken=$arraytocken["access"]["token"]["id"];
*/
$ch = curl_init();
		$curlConfig = array(
		CURLOPT_URL            => $jsdnURL."/api/1.0/usage/getProductsByUsage/".$companyID."/E/5",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT        => 500,
		CURLOPT_USERAGENT      => "CMS", // who am i
		CURLOPT_SSL_VERIFYPEER => 0,
		CURLOPT_SSL_VERIFYHOST => 0
		);
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'X-Auth-Token:'.$authtocken,
    'Content-Type: application/xml',
    'Accept: application/xml',
	'xoauth-jsdn-loginUrl:'.$host,
	
    ));
		curl_setopt($ch, CURLOPT_HTTPGET, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 		 500);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); 
		
		curl_setopt_array($ch, $curlConfig);
		$result = curl_exec($ch);
		curl_close($ch);
		header('Content-Type: application/xml');
		print($result);
?>