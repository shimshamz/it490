#!/usr/bin/php
<?php
require_once('/var/www/html/it490-development/path.inc');
require_once('/var/www/html/it490-development/get_host_info.inc');
require_once('/var/www/html/it490-development/rabbitMQLib.inc');
function doRollback ($type,$package,$tier,$packageName,$version,$rollbackVersion){
        echo "Rollback Request received" . PHP_EOL;
        echo "TYPE: " . $type . PHP_EOL;
        echo "PACKAGE: " . $package . PHP_EOL;
        echo "TIER: " . $tier . PHP_EOL;
        echo "PACKAGE NAME: " . $packageName . PHP_EOL;
	$mydb = new mysqli('192.168.1.10','admin','password','stocks');
	if ($mydb->errno != 0){
                echo "Failed to connect to database: ".$mydb->error.PHP_EOL;
                exit(0);
        }	
	
	 $query = mysqli_query($mydb, "SELECT * Deploy WHERE VALUES('$packageName','$rollbackVersion')");
	echo "Previous version found! Rolling back!" . PHP_EOL; 
	$sourcefile = "/var/www/html/it490-development/deploy/bundle" . $packageName . "-" . $version . ".tgz";
	echo "FILEPATH: " . $sourcefile . PHP_EOL;
	$sourcefile = escapeshellarg($sourcefile);
        $output = exec("./rollback.sh $sourcefile");
}
function doDeploy ($type,$package,$tier,$packageName,$version){
	echo "Deploy Request received" . PHP_EOL;
	echo "TYPE: " . $type . PHP_EOL;
	echo "PACKAGE: " . $package . PHP_EOL;
	echo "TIER: " . $tier . PHP_EOL;
	echo "PACKAGE NAME: " . $packageName . PHP_EOL;
	echo "VERSION: " . $version . PHP_EOL;
	#echo "Installing " . $packageName . " on " . $tier ." " . $package;
	# execute shell script to install backend package
	echo "Installing " . $packageName . "-" . $version . ".tgz" . " on " . $tier ." " . $package . PHP_EOL;
	# execute shell script to install backend package
	#destination of the scp to send
	$sourcefile = "/var/www/html/it490-development/deploy/bundle" . $packageName . "-" . $version . ".tgz";
	echo "FILEPATH: " . $sourcefile . PHP_EOL;
	
	$sourcefile = escapeshellarg($sourcefile);
#	$output = 
	       	exec("./scpDeploy_tar.sh $sourcefile");
}
function doBundle ($type,$package,$tier,$packageName,$version){
        echo "Bundle Request received" . PHP_EOL;
        echo "TYPE: " . $type . PHP_EOL;
        echo "PACKAGE: " . $package . PHP_EOL;
        echo "TIER: " . $tier . PHP_EOL;
        echo "PACKAGE NAME: " . $packageName . PHP_EOL;
	echo "SCP INITIATED... ";
	echo "TAR FILE RECEIVED!";
	$mydb = new mysqli('192.168.1.10','admin','password','stocks');
        if ($mydb->errno != 0){
                echo "Failed to connect to database: ".$mydb->error.PHP_EOL;
                exit(0);
        }
	$query = mysqli_query($mydb, "INSERT INTO Deploy VALUES('$packageName','$version')");
}
function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "rollback":
      return doRollback($request['type'],$request['package'],$request['tier'],$request['packageName'],$request['version'],$request['rollbackversion']);
    case "update":
      return doUpdate($request['type'],$request['package'],$request['tier'],$request['packageName']);
    case "deploy":
      return doDeploy($request['type'],$request['package'],$request['tier'],$request['packageName'],$request['version']);
    case "bundle":
      return doBundle($request['type'],$request['package'],$request['tier'],$request['packageName'],$request['version']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}
$server = new rabbitMQServer("deployServer.ini","testServer");
echo "DeploySystem Server BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "DeploySystem Server END".PHP_EOL;
exit();
?>
