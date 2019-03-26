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
  $msg = "Testing Register";
}



$request = array();
$request['type'] = "register";
#$request['fname'] = "test";
#$request['lname'] = "test";
#$request['email'] = "user3@gmail.com";
#$request['password'] = "1234";
$request['fname'] = $_POST['fname'];
$request['lname'] = $_POST['lname'];
$request['email'] = $_POST['email'];
$request['password'] = $_POST['pass'];
$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);
echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";


if ($response == 0 ) {
	$date = date_create();
	file_put_contents('events.log', "[".date_format($date, 'm-d-Y H:i:s')."]"." User with email: ".$_POST['email']." registered successfully.", FILE_APPEND);
	header("location: registersuccess.html");
}
else {
	$date = date_create();
	file_put_contents('events.log', "[".date_format($date, 'm-d-Y H:i:s')."]"." User with email: ".$_POST['email']." failed to register.", FILE_APPEND);
	header("location: registererror.html");
}


?>


