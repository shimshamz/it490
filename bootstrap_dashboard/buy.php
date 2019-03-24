    
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
$price = $_SESSION['currPrice'];
$currBal = $_SESSION['currBal'];
$totalAmount = $quantity * $price;
#$request['quantity'] = $_POST['buy'];
#$request ['symbol'] = $_SESSION['symbol'];
#$request['company_name'] = $_SESSION['name'];
#$request['price'] = $_SESSION['currPrice'];
#$request['dashboard_id'] = $dash_info['balance'];
#$request['currBal'] = $_SESSION['currBal'];
#$request['totalAmount'] = $request['quantity']* $request['price'];

if ($totalAmount  > $currBal ) {
  echo "Total buy amount exceeds balance available.";
}
else {
  $newBal = $currBal - $totalAmount;
  $portfolio_info = mysqli_query($mydb,"SELECT * FROM portfolio WHERE user_id = '$userid' AND company_symbol = '$symbol'");
  if (mysqli_num_rows($portfolio_info) == 0) {
    $query = mysqli_query($mydb,"INSERT INTO portfolio (user_id, company_symbol, company_name, volume, buy_date, buy_amnt, sell_date, sell_amnt) VALUES ('$userid', '$symbol', '$company_name', '$quantity', CURDATE(), '$totalAmount', NULL, NULL)");
    $user_info = mysqli_query($mydb,"UPDATE user SET balance = '$newBal' WHERE id='$userid'");
  }
  else {
    $info = mysqli_fetch_array($portfolio_info, MYSQLI_ASSOC);
    $portfolioId = $info['id'];
    $currVolume = $info['volume'];
    $currBuyAmnt = $info['buy_amnt'];
    $newVolume = $currVolume + $quantity;
    $newBuyAmnt = $currBuyAmnt + $totalAmount;
    $query = mysqli_query($mydb,"UPDATE portfolio SET volume='$newVolume', buy_amnt='$newBuyAmnt' WHERE id='$portfolioId'");
    $user_info = mysqli_query($mydb,"UPDATE user SET balance = '$newBal' WHERE id='$userid'");
  }
  
  
  echo "New Balance = $newBal";  
#  header('Location: index.php');
}
?>
