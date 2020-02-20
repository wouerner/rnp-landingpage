<?php
require_once 'aws-autoloader.php';

use Aws\Ec2\Ec2Client;
use Aws\CloudWatch\CloudWatchClient;
use Aws\ElasticLoadBalancing\ElasticLoadBalancingClient;
use Aws\Rds\RdsClient;

$ec2Client = ec2Client::factory(array(
    'credentials' => array(
       'key'    => $_SESSION['accessKey'],
       'secret' => $_SESSION['secretKey'],
    ),
    'region' => $_SESSION['inventory_recommendation_region'],
    'version' => 'latest',
    'scheme' => 'https'
));

$CloudWatchClient = CloudWatchClient::factory(array(
    'credentials' => array(
       'key'    => $_SESSION['accessKey'],
       'secret' => $_SESSION['secretKey'],
    ),
    'region' => $_SESSION['inventory_recommendation_region'],
    'version' => 'latest',
    'scheme' => 'http'
));


$ElasticLoadBalancingClient = ElasticLoadBalancingClient::factory(array(
    'credentials' => array(
       'key'    => $_SESSION['accessKey'],
       'secret' => $_SESSION['secretKey'],
    ),
    'region' => $_SESSION['inventory_recommendation_region'],
    'version' => 'latest',
    'scheme' => 'https'
));

$RdsClient = RdsClient::factory(array(
    'credentials' => array(
       'key'    => $_SESSION['accessKey'],
       'secret' => $_SESSION['secretKey'],
    ),
    'region' => $_SESSION['inventory_recommendation_region'],
    'version' => 'latest',
    'scheme' => 'https'
));

?>