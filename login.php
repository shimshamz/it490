#!/usr/bin/php
<?php
session_start();
include('database.php');
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "loginnnnnnnnnn";
}
$request = array();
$request['type'] = "login";
#$request['email'] = "user3@gmail.com";
#$request['password'] = "1234";
$request['email'] = $_POST['email'];
$request['password'] = $_POST['pass'];
$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);
echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

if ($response == 0 ) {
	header("location:loginerror.html");
}
else {
	global $mydb;
	
	$email = $_POST['email'];
	$query = mysqli_query($mydb,"SELECT id FROM user WHERE email='$email'");
	$user = mysqli_fetch_array($query,MYSQLI_ASSOC);
	$_SESSION['userid'] = $user['id'];
	header("Location: bootstrap_dashboard/index.php");
}
?>
