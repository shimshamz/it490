#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function doLogin($username,$password)
{	
$mydb = new mysqli('192.168.1.105','dbuser','pass1','testDb');

if ($mydb->errno != 0)
{
        echo "failed to connect to database: ". $mydb->error . PHP_EOL;
        exit(0);
}

echo "successfully connected to database".PHP_EOL;
	$query = mysqli_query($mydb,"SELECT * FROM testTable WHERE email = '$username' AND password = '$password' ");
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


function doregister($fname,$lname,$email,$password)
{
$mydb = new mysqli('192.168.1.105','dbuser','pass1','testDb');

if ($mydb->errno != 0)
{
        echo "failed to connect to database: ". $mydb->error . PHP_EOL;
        exit(0);
}

echo "successfully connected to database".PHP_EOL;

	$query = mysqli_query($mydb,"SELECT * FROM testTable WHERE email = '$email' AND password = '$password'");
	$count = mysqli_num_rows($query);

        //Check if credentials match the database
        if ($count == 1){
                        //Match
                        echo "<br><br>Please register with differernt email";
                        return true;
                }else{
                        //No Match
			$query = mysqli_query($mydb,"INSERT INTO testTable (firstname, lastname, email, password) VALUES ('$fname','$lname','$email','$password')");

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
	    return doLogin($request['email'],$request['password']);
    case "register":
	  return doregister($request ['fname'],$request['lname'],$request['email'],$request['password']);


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

