<?php
require_once 'aws-autoloader.php';

use Aws\Ec2\Ec2Client;


$ec2Client = ec2Client::factory(array(
    'credentials' => array(
       'key'    => $_SESSION['accessKey'],
       'secret' => $_SESSION['secretKey'],
    ),
    'region' => $_SESSION['inventory_region'],
    'version' => 'latest',
    'scheme' => 'https'
));

?>