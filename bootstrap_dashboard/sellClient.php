    
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
  $msg = "Sell testing";
}

$request = array();
$request['type'] = "sell";
$request['userid'] = $_SESSION['userid'];
$request['quantity'] = $_POST['sell'];
$request['symbol'] = $_SESSION['symbol'];
$request['currPrice'] = $_SESSION['currPrice'];
$request['currBal'] = $_SESSION['currBal'];
$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);
echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

if ($response == 0 ) {
  $status = nl2br("Transaction Error: \n\nEither the company does not exist in your portfolio \nOR \nThe quantity requested to sell exceeds the volume of shares available");
  $_SESSION['transactionStatus'] = $status;
  header('Location: transactionstatus.php');
}
else {
  $status = "Transaction successful!";
  $_SESSION['transactionStatus'] = $status;
  header('Location: transactionstatus.php');
}

?>
