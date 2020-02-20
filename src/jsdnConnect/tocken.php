<?php
$host = $_SERVER['HTTP_HOST'];

$jsdnURL="http://entstore.regsrc.com:8080";
//$jsdnURL="http://fdcmsstore.tgtmkt76.com:8080";

$body = '{"auth": {"passwordCredentials": {"username": "jtest.jtest.com","password": "Elvis@2010"},"tenantId": "entstore"}}';
//$body = '{"auth": {"passwordCredentials": {"username": "admin.fddemo.com","password": "Root@123"},"tenantId": "store2"}}';

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
		$apitocken=$arraytocken["access"]["token"]["id"];
		print_r($apitocken);
?>