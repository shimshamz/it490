<?php

session_start();

//ERROR LOGGING

?>

<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
.navbar, .navbar-bar {
  
  color: white;
padding-bottom : 1px;
padding-top : 1px;

}

.container {

	padding-top: 60px;
padding-right : 50px;
}

</style>
</head>
<body>
   <nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">
      
      <a class="navbar-brand">Kya bol reli hai DJ ki Public</a>


        <ul class="navbar-nav ml-md-auto d-md-flex">
          <li class="nav-item">
            <a class="nav-link" href="test.php">Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="forums.php">Suggestions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      
    </nav>
           

<div class="container">
  
    
 <form method="POST" action="">
      <input type="text" name="search" placeholder="Enter Stock Symbol" required>
      <button type="submit">Search</button>
    </form>



<?php

//Search input from hmtl
$search_input = $_POST['search'];
//Username obtained from user login using post
//$username = $username ; //not set up atm
echo nl2br("\n ");

if (isset($_POST['search']) && !empty($_POST['search'])){

	$searchname = preg_replace('/\s+/', '+',$search_input);
	//API MULTI SEARCH ( MOVIES AND SHOWS)

	$json_string = file_get_contents("https://marketdata.websol.barchart.com/getQuote.json?apikey=aedef88fae1654cbca88ef03ee28b57e&symbols=".$search_input."");


     }



$jsonarray = json_decode($json_string, true); //convert json into multidimensional associative array
//Iterate through the array 'results' and assign a variable to each type that we want

foreach($jsonarray['results'] as $test){
	
	$symbol = $test["symbol"];
	$name = $test["name"];
	$mode = $test["mode"];
	$lastPrice = $test["lastPrice"];
	$percentChange = $test["percentChange"];
	$open = $test["open"];
	$high = $test["high"];
	$low = $test["low"];
	$close = $test["close"];
	$volume = $test["volume"];


	echo "<strong>$name ($symbol)</strong> <br>";
	echo "$$lastPrice<br>";
echo "Mode : $mode <br>";
#echo "Last Price : $$lastPrice <br>";
echo "% : $percentChange <br>";
echo "Open : $$open <br>";
echo "High : $$high <br>";
echo "Low : $$low <br>";
echo "Close : $$close <br>";
echo "Volume : $volume <br>";


 


}

#var_dump($jsonarray);
?>


</div>
</body>
</html>





