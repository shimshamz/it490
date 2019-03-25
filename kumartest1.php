<?php
session_start();
$username = $_SESSION['username'];
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
      
      <a class="navbar-brand">Kya bol reli hai DJ ki Public $username</a>





        <ul class="navbar-nav ml-md-auto d-md-flex">
          <li class="nav-item">
            <a class="nav-link" href="kumartest1.php">Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="portfolio.php">Portfolio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.khanacademy.org/economics-finance-domain/ap-macroeconomics/ap-financial-sector/financial-assets-ap/v/introduction-to-interest">Education</a>
	  </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>



        </ul>
    </nav>
<div class="container">

<h1> Search for a Stock: </h1> 

 <form method="POST" action="">
      <input type="text" name="search" placeholder="Enter Stock Symbol" required>
      <button type="submit">Search</button>
    </form>


<style>
div.a {
  position: absolute;
  right:800px;
  width: 100px;
  height: 120px;
  border: 3px solid blue;
}

div.widget2 {
  position: absolute;
  left:50px;
  width: 100px;
  height: 120px;
  border: 3px solid blue;
}



</style>



<?php $search_input = $_POST['search']; ?>

<!-- TradingView Widget BEGIN -->
<object align="right">
<div class="tradingview-widget-container">
<div class = "a">
  <div id="tradingview_f81ca"></div>
  <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/$search_input/" rel="noopener" target="_blank"><span class="blue-text"></span></a></div>
  <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
  <script type="text/javascript">
  new TradingView.widget(
  {
  	
  "width": 880,
  "height": 510,
  "symbol": "<?php $search_input ?>",
  "timezone": "Etc/UTC",
  "theme": "Dark",
  "style": "1",
  "locale": "en",
  "toolbar_bg": "#f1f3f6",
  "enable_publishing": true,
  "withdateranges": true,
  "range": "1d",
  "hide_side_toolbar": false,
  "allow_symbol_change": true,
  "details": true,
  "hotlist": true,
  "calendar": true,
  "news": [
    "stocktwits",
    "headlines"
  ],
  "show_popup_button": true,
  "popup_width": "1000",
  "popup_height": "650",
  "container_id": "tradingview_f81ca"
}
  );
  </script>
</div>
</object>
<!-- TradingView Widget END -->

   







<?php
//Search input from hmtl
#$search_input = $_POST['search'];
//Username obtained from user login using post
//$username = $username ; //not set up atm
echo nl2br("\n ");
if (isset($_POST['search']) && !empty($_POST['search'])){
	$searchname = preg_replace('/\s+/', '+',$search_input);
	//scearch
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

	$_SESSION['symbol'] = $symbol;
	$_SESSION['name'] = $name;
	$_SESSION['currPrice'] = $lastPrice;

echo ("<button onclick=\"location.href='buy.php'\">Buy</button>");
echo ("<button onclick=\"location.href='sell.php'\">Sell</button>");

}

?>



</div>
</body>
</html>
