#!/usr/bin/php
<?php
session_Start();
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
if ($response == 1 ) {
	$_SESSION["email"] = $_POST["email"];
#	header("Location: php1.php");
        header("Location:bootstrap_dashboard/index.php");
#	header("location:loginerror.html");
}else {
#	$_SESSION["email"] = $_POST["email"];
	#	header("Location: bootstrap_dashboard/index.php");

	   header("location:loginerror.html");

}
?>
