    
<?php
session_start();

require_once('../path.inc');
require_once('../get_host_info.inc');
require_once('../rabbitMQLib.inc');
$client = new rabbitMQClient("../testRabbitMQ.ini","testServer");

if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "Buy testing";
}

$request = array();
$request['type'] = "buy";
$request['userid'] = $_SESSION['userid'];
$request['quantity'] = $_POST['buy'];
$request['symbol'] = $_SESSION['symbol'];
$request['name'] = $_SESSION['name'];
$request['currPrice'] = $_SESSION['currPrice'];
$request['exchange'] = $_SESSION['exchange'];
$request['currBal'] = $_SESSION['currBal'];
$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);
echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

if ($response == 0 ) {
  echo "Transaction Error: Total buy amount exceeds balance available.";
}
else {
  echo "Transaction successful!<br><br>"; 
}

?>
