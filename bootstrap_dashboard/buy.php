    
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

$userinfo = mysqli_query($mydb,"SELECT * FROM user WHERE userid = $userid");

$quantity = $_POST['buy'];
$symbol = $_SESSION['symbol'];
$company_name = $_SESSION['name'];
$currPrice = $_SESSION['currPrice'];
$currBal = $_SESSION['currBal'];
$exchange = $_SESSION['exchange'];
$totalBuyVal = $quantity * $currPrice;
#$request['quantity'] = $_POST['buy'];
#$request ['symbol'] = $_SESSION['symbol'];
#$request['company_name'] = $_SESSION['name'];
#$request['price'] = $_SESSION['currPrice'];
#$request['dashboard_id'] = $dash_info['balance'];
#$request['currBal'] = $_SESSION['currBal'];
#$request['totalAmount'] = $request['quantity']* $request['price'];

if ($totalBuyVal  > $currBal ) {
  echo "Total buy amount exceeds balance available.";
}
else {
  $newBal = $currBal - $totalBuyVal;
  $portfolio_info = mysqli_query($mydb,"SELECT * FROM portfolio WHERE user_id = '$userid' AND company_symbol = '$symbol'");

  if (mysqli_num_rows($portfolio_info) == 0) {
    $query = mysqli_query($mydb,"INSERT INTO portfolio (user_id, company_symbol, company_name, total_value, total_volume, last_buy_price, last_buy_volume, last_sell_price, last_sell_volume, exchange) VALUES ('$userid', '$symbol', '$company_name', '$totalBuyVal', '$quantity', '$currPrice', '$quantity', NULL, NULL, '$exchange')");
    $user_info = mysqli_query($mydb,"UPDATE user SET balance = '$newBal' WHERE id='$userid'");
  }
  else {
    $info = mysqli_fetch_array($portfolio_info, MYSQLI_ASSOC);
    $portfolioId = $info['id'];
    $currTotalVal = $info['total_value'];
    $currVolume = $info['total_volume'];
    $newTotalVal = $currTotalVal + $totalBuyVal;
    $newVolume = $currVolume + $quantity;
    $query = mysqli_query($mydb,"UPDATE portfolio SET total_value='$newTotalVal', total_volume='$newVolume', last_buy_price='$currPrice', last_buy_volume='$quantity' WHERE id='$portfolioId'");
    $user_info = mysqli_query($mydb,"UPDATE user SET balance = '$newBal' WHERE id='$userid'");
  }
  
  
  echo "New Balance = $newBal";  
#  header('Location: index.php');
}
?>
