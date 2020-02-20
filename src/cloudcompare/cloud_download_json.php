<?php
define('ROOT_PATH_INDEX', './json/');
define('ROOT_PATH_MAPPING', './json/vm/');
define('ROOT_PATH_AWS', './json/vm/aws/');
define('ROOT_PATH_AZURE', './json/vm/azure/');
define('ROOT_PATH_GOOGLE', './json/vm/google/');
define('ROOT_PATH_RDS_MAPPING', './json/rds/');
define('ROOT_PATH_S3_MAPPING', './json/storage/');
define('ROOT_PATH_RDS_AWS', './json/rds/aws/');
define('ROOT_PATH_RDS_AZURE', './json/rds/azure/');
define('ROOT_PATH_S3_AWS', './json/storage/aws/');
define('ROOT_PATH_S3_AZURE', './json/storage/azure/');
define('BASE_PATH_URL', 'https://pricing.us-east-1.amazonaws.com');

$url1  = '/offers/v1.0/aws/index.json';


$download_aws1 = downloadFile(BASE_PATH_URL.$url1, ROOT_PATH_INDEX, 'index.json');

if($download_aws1){
    $result = readDownloadFile(ROOT_PATH_INDEX, 'index.json');
    if(!empty($result->offers)){
        $url2 = $result->offers->AmazonEC2->currentRegionIndexUrl;
        $download_aws2 = downloadFile(BASE_PATH_URL.$url2, ROOT_PATH_MAPPING, 'region_index.json');
    }
}


if($download_aws2){
    $result = readDownloadFile(ROOT_PATH_MAPPING, 'region_index.json');
    if(!empty($result)){
        $regions = $result->regions;
        $url3 = '';
        $filename = '';
        foreach($regions as $region){
            $filename = $region->regionCode.'.json';
            $url3 = $region->currentVersionUrl;
            $download_aws3 = downloadFile(BASE_PATH_URL.$url3, ROOT_PATH_AWS, $filename);
        }
    }
}


$filename_google = 'pricelist_google.json';
$url4 = 'https://cloudpricingcalculator.appspot.com/static/data/pricelist.json';
$download_aws4 = get_remote_data($url4);

if(!empty($download_aws4)){
	$googlefname = ROOT_PATH_GOOGLE. $filename_google;
	$newfGoogle = fopen ($googlefname, "wb");
	$fwrite = fwrite($newfGoogle, $download_aws4);
	if ($newfGoogle) {
		fclose($newfGoogle);
	}
}

$url5 = 'https://www.jamcracker.com/cloudpricing/azure/pricelist_azure.json';
$download_azure = downloadFile($url5, ROOT_PATH_AZURE, 'pricelist_azure.json');

if($download_aws1){
    $result = readDownloadFile(ROOT_PATH_INDEX, 'index.json');
    if(!empty($result->offers)){
        $url5 = $result->offers->AmazonRDS->currentRegionIndexUrl;
        $download_aws5 = downloadFile(BASE_PATH_URL.$url5, ROOT_PATH_RDS_MAPPING, 'region_index.json');
    }
}

if($download_aws5){
    $result = readDownloadFile(ROOT_PATH_RDS_MAPPING, 'region_index.json');
    if(!empty($result)){
        $regions = $result->regions;
        $url6 = '';
        $filename = '';
        foreach($regions as $region){
                $filename = $region->regionCode.'.json';
                $url6 = $region->currentVersionUrl;
                $download_aws6 = downloadFile(BASE_PATH_URL.$url6, ROOT_PATH_RDS_AWS, $filename);
        }
    }
}

$url7 = 'https://www.jamcracker.com/cloudpricing/azure/pricelist_azure_rds.json';
$download_azure = downloadFile($url7, ROOT_PATH_RDS_AZURE, 'pricelist_azure_rds.json');


$url8 = 'https://www.jamcracker.com/cloudpricing/azure/pricelist_azure_elb.json';
$download_azure_elb = downloadFile($url8, ROOT_PATH_AZURE, 'pricelist_azure_elb.json');


if($download_aws1){
    $result = readDownloadFile(ROOT_PATH_INDEX, 'index.json');
    if(!empty($result->offers)){
        $url9 = $result->offers->AmazonS3->currentRegionIndexUrl;
        $download_aws7 = downloadFile(BASE_PATH_URL.$url9, ROOT_PATH_S3_MAPPING, 'region_index.json');
    }
}

if($download_aws7){
    $result = readDownloadFile(ROOT_PATH_S3_MAPPING, 'region_index.json');
    if(!empty($result)){
        $regions = $result->regions;
        $url10 = '';
        $filename = '';
        foreach($regions as $region){
                $filename = $region->regionCode.'.json';
                $url10 = $region->currentVersionUrl;
                $download_aws8 = downloadFile(BASE_PATH_URL.$url10, ROOT_PATH_S3_AWS, $filename);
        }
    }
}

$url11 = 'https://www.jamcracker.com/cloudpricing/azure/pricelist_azure_storage.json';
$download_azure_storage = downloadFile($url11, ROOT_PATH_S3_AZURE, 'pricelist_azure_storage.json');


function downloadFile($url, $path, $filename){
     // folder to save downloaded files to. must end with slash
    $newfname = $path . $filename;
    $file = fopen ($url, "rb");
	
    if ($file) {
		$newf = fopen ($newfname, "wb");
		if ($newf)
			while(!feof($file)) {
			$fwrite = fwrite($newf, fread($file, 1024 * 20 ), 1024 * 20 );
			if ($fwrite === FALSE) {
				$written = 0;
			}
			else{
				$written = 1;
			}
		}
    }

    if ($file) {
      fclose($file);
    }

    if ($newf) {
      fclose($newf);
    }
	return $written;
}


function readDownloadFile($path, $filename){
	$mapping_file = fopen($path.$filename, "r");
	$output = fread($mapping_file,filesize($path.$filename));
	$output_json = json_decode($output);
	return $output_json;
}


//See Updates and explanation at: https://github.com/tazotodua/useful-php-scripts/
function get_remote_data($url, $post_paramtrs=false)
{
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $url);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    if($post_paramtrs)
    {
        curl_setopt($c, CURLOPT_POST,TRUE);
        curl_setopt($c, CURLOPT_POSTFIELDS, "var1=bla&".$post_paramtrs );
    }
    curl_setopt($c, CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($c, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0");
    curl_setopt($c, CURLOPT_COOKIE, 'CookieName1=Value;');
    curl_setopt($c, CURLOPT_MAXREDIRS, 10);
    $follow_allowed= ( ini_get('open_basedir') || ini_get('safe_mode')) ? false:true;
    if ($follow_allowed)
    {
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
    }
    curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 9);
    curl_setopt($c, CURLOPT_REFERER, $url);
    curl_setopt($c, CURLOPT_TIMEOUT, 60);
    curl_setopt($c, CURLOPT_AUTOREFERER, true);
    curl_setopt($c, CURLOPT_ENCODING, 'gzip,deflate');
    $data=curl_exec($c);
    $status=curl_getinfo($c);
    curl_close($c);
    preg_match('/(http(|s)):\/\/(.*?)\/(.*\/|)/si',  $status['url'],$link); $data=preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/|\/)).*?)(\'|\")/si','$1=$2'.$link[0].'$3$4$5', $data);   $data=preg_replace('/(src|href|action)=(\'|\")((?!(http|https|javascript:|\/\/)).*?)(\'|\")/si','$1=$2'.$link[1].'://'.$link[3].'$3$4$5', $data);
    if($status['http_code']==200)
    {
        return $data;
    }
}			
?>