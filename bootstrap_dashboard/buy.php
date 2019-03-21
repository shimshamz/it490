<?php
session_start();

$quantity = $_POST['buy'];
$symbol = $_SESSION['symbol'];
$company_name = $_SESSION['name'];
$price = $_SESSION['currPrice'];
$dashboard_id = $_SESSION['dashId']; 
$mydb = new mysqli('127.0.0.1','admin','password','stocks');
if ($mydb->errno != 0)
{
        echo "failed to connect to database: ". $mydb->error . PHP_EOL;
        exit(0);
}
echo "successfully connected to database".PHP_EOL;

$totalAmount = $quantity * $price;
$query = mysqli_query($mydb,"INSERT INTO portfolio (dashboard_id, company_symbol, company_name, volume, buy_date, buy_amount) VALUES ($dashboard_id, $symbol, $company_name, $quantity, CURDATE(), $price)");
$dash_info = mysqli_query($mydb,"SELECT balance FROM dashboard");
$currBal = $dash_info['balance'];
$newBal = $currBal - $totalAmount;
$dash_info = mysqli_query($mydb,"UPDATE dashboard SET balance = $newBal WHERE id = $dashboard_id");
$count = mysqli_num_rows($query);

header('Location: index.php');
?>