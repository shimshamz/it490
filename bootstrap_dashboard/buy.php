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

$userQuery = mysqli_query($mydb,"SELECT * FROM user WHERE id = '$userid'");
$user = mysqli_fetch_array($userQuery, MYSQLI_ASSOC);
$userid = $user['id'];

$quantity = $_POST['buy'];
$symbol = $_SESSION['symbol'];
$company_name = $_SESSION['name'];
$price = $_SESSION['currPrice'];
$currBal = $user['balance'];

$totalAmount = $quantity * $price;

if ($totalAmount > $currBal) {
  echo "Total buy amount exceeds balance available."
}
else {
  $query = mysqli_query($mydb, "INSERT INTO portfolio (user_id, company_symbol, company_name, volume, buy_date, buy_amnt) VALUES ('$userid', '$symbol', '$company_name', '$quantity', CURDATE(), '$price')");
  $newBal = $currBal - $totalAmount;
  $balanceUpdate = mysqli_query($mydb, "UPDATE user SET balance = $newBal WHERE id = $id");
  
  header('Location: index.php');
}

?>