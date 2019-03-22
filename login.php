#!/usr/bin/php
<?php
session_start();

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
	$mydb = new mysqli('127.0.0.1','admin','password','stocks');
	if ($mydb->errno != 0)
	{
	        echo "failed to connect to database: ". $mydb->error . PHP_EOL;
	        exit(0);
	}
	echo "successfully connected to database".PHP_EOL;
	$email = $_POST['email'];
	$query = mysqli_query($mydb,"SELECT id FROM user WHERE email=$email");
	$_SESSION['userid'] = $query['id'];
	header("Location: bootstrap_dashboard/index.php");
}
?>
