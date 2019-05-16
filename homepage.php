<?php

session_start(); 

?>

<!DOCTYPE html>

<body>
<head>
<h1> Welcome to Stock Exchange </h1>



</head>
<body>

<div class="topnav">

<a class="active" href="homepage.html">HOME</a> 
<a class="active" href="profile.html">PROFILE</a> 
<a href="#Suggestions">SUGGESTIONS</a> 
<a href="#buy">BUY</a> 
<a href="#sell">SELL</a> 
<a href="logout.php">Logout<a>

    
</div>

<form method="POST" action="">
<h2>Search a Stock:</h2>
	<input type="text" name="search" placeholder="Enter Stock Symbol" required>
	<button type="submit">Search</button>
</form>



<table class ="table table-bordered">
<thead>
<tr>
<th> Stock Info </th>
</tr>
</thead>
<tbody>
</tr>



<?php
//Search input from hmtl
$search_input = $_POST['search'];
echo nl2br("\n ");
if (isset($_POST['search']) && !empty($_POST['search'])){
	$searchname = preg_replace('/\s+/', '+',$search_input);
	//API MULTI SEARCH ( MOVIES AND SHOWS)
	#
	        $ch = curl_init("https://api.themoviedb.org/3/search/multi?api_key=a99025c572bede9218ee420b5c9f4cc4&language=en-US&query=" . $searchname . "&page=1&include_adult=false");
	#
	#$ch = curl_init("https://marketdata.websol.barchart.com/getQuote.json?apikey=aedef88fae1654cbca88ef03ee28b57e&symbols=".$searchname."");

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	//Set results to var
	$curl_results = curl_exec($ch);
	curl_close($ch);
	
}


$jsonarray = json_decode($curl_results, true); 

echo "Name : ", $jsonarray['title'];

foreach($jsonarray['results'] as $variable) {

	$symbol = $variable['symbol'];
	$exchange = $variable['exchange'];
	$name= $variable['name'];
	$lastPrice = $variable['lastPrice'];
	$open = $variable['open'];
	$high = $variable['high'];
	$close = $variable['close'];
	$volume = $variable['volume'];

	echo "<td>".$symbol." </td>";
	echo "</tr>";

	echo "Symbol : ", $jsonarray['symbol'];
	echo "Name : ", $variable['name'];


	echo "EEE";
}


echo "FEE";

?>
</tbody>
</table>
</body>
</html>


     
