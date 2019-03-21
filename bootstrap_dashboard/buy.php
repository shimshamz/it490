<?php
session_start();
$userid = $_SESSION['userid'];

$mydb = new mysqli('127.0.0.1','admin','password','stocks');
if ($mydb->errno != 0)
{
        echo "failed to connect to database: ". $mydb->error . PHP_EOL;
        exit(0);
}
echo "successfully connected to database".PHP_EOL;

$dash_info = mysqli_query($mydb,"SELECT * FROM dashboard WHERE userid = $userid");

$quantity = $_POST['buy'];
$symbol = $_SESSION['symbol'];
$company_name = $_SESSION['name'];
$price = $_SESSION['currPrice'];
$dashboard_id = $dash_info['balance'];
$currBal = $dash_info['balance'];

$totalAmount = $quantity * $price;


$query = mysqli_query($mydb,"INSERT INTO portfolio (dashboard_id, company_symbol, company_name, volume, buy_date, buy_amount) VALUES ($dashboard_id, $symbol, $company_name, $quantity, CURDATE(), $price)");

if ($totalAmount > $currBal) {
  echo "Total buy amount exceeds balance available."
}
else {
  $newBal = $currBal - $totalAmount;
  $dash_info = mysqli_query($mydb,"UPDATE dashboard SET balance = $newBal WHERE id = $dashboard_id");
  
  header('Location: index.php');
}

?>