#!/usr/bin/php
<?php
require_once('/var/www/html/it490-development/path.inc');
require_once('/var/www/html/it490-development/get_host_info.inc');
require_once('/var/www/html/it490-development/rabbitMQLib.inc');
echo "Enter info for deployment";
echo "\n";
#Variables that can be set......
#$type = 	readline("Enter Type: ");		
$package = 	readline("Enter Package: ");	
$tier = 	readline("Enter Tier: ");		
$packageName =	readline("Enter PackageName: ");
$version = 	readline("Enter Version: ");
$client = new rabbitMQClient("deployClient.ini","testServer");
$request = array();
$request['type'] = "deploy";
$request['package'] = $package;
$request['tier'] = $tier;
$request['packageName'] = $packageName;
$request['version'] = $version;
$response = $client->send_request($request);
//print_r($response);
echo "\n";
?>
