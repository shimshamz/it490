

<!DOCTYPE HTML>
<html>
<body>

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

<nav class="navbar header-top fixed-top navbar-expand-lg  navbar-dark bg-dark">

      <a class="navbar-brand">Kya bol reli hai DJ ki Public</a>





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

<h2>Welcome to Stock Trasaction</h2>

<?php

session_start();

$symbol = $_SESSION['symbol'];
$currPrice = $_SESSION['currPrice'];
echo "Hello $username";
echo nl2br ("\n");
echo "Sybmol : $symbol";
echo nl2br ("\n");
echo "Current Price : $currPrice";


?>
<br>
How many stocks do you want to buy?
<br>

 <form method="POST" action="">
  <input type="text" name="search">
  <button type="submit"> Submit </button>
</form>









<?php
$quantity = $_POST['search'];

echo "You are buying these $quantity stocks of $symbol";

?>


</body>
</html>



