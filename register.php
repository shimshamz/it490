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



#$request = array();
#$request['type'] = "register";
#$request['fname'] = 'lol';
#$request['lname'] = 'lol';
#$request['email'] = '12@gmail.com';
#$request['password'] = 'lol';
#$request['message'] = $msg;
#$response = $client->send_request($request);
//$response = $client->publish($request);

#echo "Client received respone  ".PHP_EOL;
#print_r($response);
#echo "\n\n";

#echo $argv[0]." END".PHP_EOL;


?>


