    
<?php
session_start();
$userid = $_SESSION['userid'];
$mydb = new mysqli('192.168.1.107','admin','password','stocks');
if ($mydb->errno != 0)
{
        echo "failed to connect to database: ". $mydb->error . PHP_EOL;
        exit(0);
}
echo "successfully connected to database".PHP_EOL;
# $query = mysqli_query($mydb,"INSERT INTO portfolio (dashboard_id, comany_symbol, company_name, volume, buy_date, buy_amnt, current_amnt, sell_date, sell_amnt) VALUES ('111', 'test0', 'test', '3', NOW(), '32', '32', NOW(), '32')");
$userinfo = mysqli_query($mydb,"SELECT * FROM user WHERE userid = $userid");
#$quantity = '3';
#$symbol = '3';
#$company_name = 'test';
#$price = '3';
#$dashboard_id = 'test';
#$currBal = '3';
#$totalAmount = '3';
$quantity = $_POST['sell'];
$symbol = $_SESSION['symbol'];
$company_name = $_SESSION['name'];
$price = $_SESSION['currPrice'];
#$request['dashboard_id'] = $dash_info['balance'];
$currBal = $_SESSION['currBal'];
$totalAmount = $quantity * $price;
#$request['quantity'] = $_POST['buy'];
#$request ['symbol'] = $_SESSION['symbol'];
#$request['company_name'] = $_SESSION['name'];
#$request['price'] = $_SESSION['currPrice'];
#$request['dashboard_id'] = $dash_info['balance'];
#$request['currBal'] = $_SESSION['currBal'];
#$request['totalAmount'] = $request['quantity']* $request['price'];

$portfolio_info = mysqli_query($mydb,"SELECT * FROM portfolio WHERE user_id = '$userid' AND company_symbol = '$symbol'");

if (mysqli_num_rows($portfolio_info) == 0) {
	echo "Company does not exist in your portfolio";
}
else {
	$info = mysqli_fetch_array($portfolio_info, MYSQLI_ASSOC);
	$currVolume = $info['volume'];
	echo "Total quantit : $request[quantity]";
	echo "Total Pric $request[totalAmount]";
	#$query = mysqli_query($mydb,"INSERT INTO portfolio (id, dashboard_id, comany_symbol, company_name, volume, buy_date, buy_amnt, current_amnt, sell_date, sell_amnt) VALUES ('1', '1' 'test0', 'test', '3', NOW(), '32', '32', NOW(),'32')");
	#$query = mysqli_query($mydb,"INSERT INTO portfolio (dashboard_id, comany_symbol, company_name, volume, buy_date, buy_amnt, current_amnt, sell_date, sell_amnt) VALUES ('56', '$symbol', '$company_name', '$quantity', CURDATE(), '$price', '$newBal', NOW(), NULL)");
	#$query = mysqli_query($mydb,"INSERT INTO portfolio (dashboard_id, comany_symbol, company_name, volume, buy_date, buy_amnt, current_amnt, sell_date, sell_amnt) VALUES ('56', '$request[symbol]', '$request[company_name]', '$request[quantity]', CURDATE(), '$request[price]', '$request[currBal]', NOW(), NULL)");
	  $newBal = $currBal + $totalAmount;
	  $newVolume = $currVolume - $quantity;
	  $query = mysqli_query($mydb,"INSERT INTO portfolio (user_id, company_symbol, company_name, volume, buy_date, buy_amnt, sell_date, sell_amnt) VALUES ('$userid', '$symbol', '$company_name', '$newVolume', CURDATE(), '$totalAmount', CURDATE(), '$totalAmount')");
	  $user_info = mysqli_query($mydb,"UPDATE user SET balance = $newBal WHERE id='$userid'");
	  
	  echo "New Balance = $newBal";  
	#  header('Location: index.php');
}

?>
