#!/usr/bin/php
<?php
require_once('/var/www/html/it490-development/path.inc');
require_once('/var/www/html/it490-development/get_host_info.inc');
require_once('/var/www/html/it490-development/rabbitMQLib.inc');
$client = new rabbitMQClient("deployClient.ini","testServer");
$request = array();
$request['type'] = "rollback";
$request['package'] = "BE";
$request['tier'] = "QA";
$request['packageName'] = "backendPackage-v";
$response = $client->send_request($request);
//print_r($response);
echo "\n";
?>
