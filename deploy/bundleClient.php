#!/usr/bin/php
<?php
require_once('/var/www/html/it490-development/path.inc');
require_once('/var/www/html/it490-development/get_host_info.inc');
require_once('/var/www/html/it490-development/rabbitMQLib.inc');
#This script creates the tar file
exec('./tar_gen.sh ');
#execute script to make a tar file of database
#exec('./backuptest.sh ');
#exec('./installbundle.sh');
#Increment version number
$mydb = new mysqli('192.168.1.10','admin','password','stocks');
if ($mydb->errno != 0){
	echo "Failed to connect to database: ".$mydb->error.PHP_EOL;
	exit(0);
}

$type = 	readline("Enter What Type: ");		
$package = 	readline("Enter Package From: ");		
$tier = 	readline("Enter Package To: ");		
$packageName =	readline("Enter Package Name: ");
if ($type == 'rollback'){
	$rollbackVersion = readline("Enter version to rollback to: ");
}
$increment_value = "1";

$query = mysqli_query($mydb, "SELECT * FROM deploy WHERE bundleName = '$packageName'");
$count = mysqli_num_rows($query);
#If type is bundle do
if ($type == 'bundle'){
	if ($count){
        	#Get last version number
        	$check = mysqli_query($mydb, "SELECT * FROM deploy WHERE bundleName = '$packageName' ORDER BY (bundleVersion+0) DESC LIMIT 1");
        	$row = mysqli_fetch_assoc($check);
        	$version = $row['bundleVersion'];
        	echo "File already created...creating next version #" . ($version + $increment_value);
	}else{
        	echo "No bundle found..creating new filename";
        	$version = "0";
	}
}
#If type is deploy do
if ($type == 'deploy'){
	#Get last version number
	$check = mysqli_query($mydb, "SELECT * FROM deploy WHERE bundleName = '$packageName' ORDER BY (bundleVersion+0) DESC LIMIT 1");
	$row = mysqli_fetch_assoc($check);
	$version = $row['bundleVersion'];
	echo "Deploying " .  $packageName . "-" . $version;
}
if ($type == 'rollback'){
	$check = mysqli_query($mydb, "SELECT * FROM deploy WHERE bundleName = '$packageName' AND bundleVersion = '$rollbackVersion'");
	$row = mysqli_fetch_assoc($check);
	if ($row){
		echo "File Found! Rolling back to pervious version";
	}
}
$client = new rabbitMQClient("deployClient.ini","testServer");
$request = array();
$request['type'] = $type;
$request['package'] = $package;
$request['tier'] = $tier;
$request['packageName'] = $packageName;
if ($type == 'bundle'){
	$request['version'] = $version + $increment_value;
}
if ($type == 'deploy'){
        $request['version'] = $version;
}
if ($type == 'rollback'){
	$request['rollbackversion'] = $rollbackVersion;
}
$response = $client->send_request($request);
//print_r($response);
echo "\n";
#rename the generated tar file
if ($type == 'bundle'){
rename("/home/it490/Documents/backups/backup.tgz","/home/it490/Documents/backups/".$request['packageName']."-".$request['version'].".tgz");
#This script scps the file, then deletes it
exec('./scp_tar.sh');
}
?>
