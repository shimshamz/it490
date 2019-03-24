    
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

$quantity = $_POST['sell'];
$symbol = $_SESSION['symbol'];
$company_name = $_SESSION['name'];
$currPrice = $_SESSION['currPrice'];
$currBal = $_SESSION['currBal'];
$totalSellVal = $quantity * $currPrice;
#$request['quantity'] = $_POST['buy'];
#$request ['symbol'] = $_SESSION['symbol'];
#$request['company_name'] = $_SESSION['name'];
#$request['price'] = $_SESSION['currPrice'];
#$request['dashboard_id'] = $dash_info['balance'];
#$request['currBal'] = $_SESSION['currBal'];
#$request['totalAmount'] = $request['quantity']* $request['price'];

$portfolio_info = mysqli_query($mydb,"SELECT * FROM portfolio WHERE user_id = '$userid' AND company_symbol = '$symbol'");

if (mysqli_num_rows($portfolio_info) == 0) {
	echo "Company does not exist in your portfolio.";
}
else {
	$info = mysqli_fetch_array($portfolio_info, MYSQLI_ASSOC);
	$portfolioId = $info['id'];
	$currTotalVal = $info['total_value'];
    $currVolume = $info['total_volume'];

	if ($quantity > $currVolume) {
		echo "The quantity requested to sell exceeds the volume of shares available.";
	}
	else {
		$newBal = $currBal + $totalSellVal;
		$newTotalVal = $currTotalVal - $totalSellVal;
    	$newVolume = $currVolume - $quantity;
		$query = mysqli_query($mydb,"UPDATE portfolio SET total_value='$newTotalVal', total_volume='$newVolume', last_sell_price='$currPrice', last_sell_volume='$quantity' WHERE id='$portfolioId'");
		$user_info = mysqli_query($mydb,"UPDATE user SET balance = $newBal WHERE id='$userid'");

		echo "New Balance = $newBal"; 
	}
 
	#  header('Location: index.php');
}

?>
