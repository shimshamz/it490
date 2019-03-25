#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include('database.php');

function doLogin($email, $password)
{
  global $mydb;
  $query = mysqli_query($mydb, "SELECT * FROM user WHERE email = '$email' AND password = '$password'");
  $count = mysqli_num_rows($query);
  //Check if credentials match the database
  if ($count == 1){
  		//Match
  		echo "<br><br>USERS CREDENTIALS VERIFIED";
  		return true;
  	}else{
  		//No Match
                	echo "<br><br>Mehta Suck!!!!";
        	        return false;
  	}
		
  if ($mydb->errno != 0)
  {
          echo "failed to execute query:".PHP_EOL;
          echo __FILE__.':'.__LINE__.":error: ".$mydb->error.PHP_EOL;
          exit(0);
  }

}


function doregister($fname, $lname, $email, $password)
{
  global $mydb;
  $query = mysqli_query($mydb,"SELECT * FROM user WHERE email = '$email'");
  $count = mysqli_num_rows($query);

  //Check if credentials match the database
  if ($count == 1){
    //Match
    echo "<br><br>Please register with differernt email";
    return true;
  }else{
    //No Match
    $query = mysqli_query($mydb, "INSERT INTO user (fname, lname, email, password) VALUES ('$fname','$lname','$email','$password')");
    $userQuery = mysqli_query($mydb, "SELECT id FROM user WHERE email = '$email'");
    $user = mysqli_fetch_array($userQuery, MYSQLI_ASSOC);
    $userid = $user['id'];

    echo "<br><br>Register Successful!!!!";
    return false;
  }

  if ($mydb->errno != 0)
  {
          echo "failed to execute query:".PHP_EOL;
          echo __FILE__.':'.__LINE__.":error: ".$mydb->error.PHP_EOL;
          exit(0);
  }

}

function buy($userid, $quantity, $symbol, $name, $currPrice, $exchange, $currBal) {
  $totalBuyVal = $quantity * $currPrice;

  if ($totalBuyVal  > $currBal ) {
    echo "Total buy amount exceeds balance available.";
    return false;
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
    
    echo "Transaction successful!<br><br>";
    echo "New Balance = $newBal";  

    return true;
  }
}


function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "login":
	    return doLogin($request['email'], $request['password']);
    case "register":
	  return doregister($request ['fname'], $request['lname'], $request['email'], $request['password']);
    case "buy":
      return buy($request['userid'], $request['quantity'], $request['symbol'], $request['name'], $request['currPrice'], $request['exchange'], $_SESSION['currBal']);

    case "validate_session":
      return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}







$server = new rabbitMQServer("testRabbitMQ.ini","testServer");
echo "rabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "rabbitMQServer END".PHP_EOL;
exit();



?>

