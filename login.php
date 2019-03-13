#!/usr/bin/php
<?php
require_once('/home/it490/rabbitmqphp_example/path.inc');
require_once('/home/it490/rabbitmqphp_example/get_host_info.inc');
require_once('/home/it490/rabbitmqphp_example/rabbitMQLib.inc');

$client = new rabbitMQClient("/home/it490/rabbitmqphp_example/testRabbitMQ.ini","testServer");
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

	header("location:loginsuccess.php");

}



?>
