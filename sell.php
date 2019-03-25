<!DOCTYPE HTML>
<html>
<body>



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
How many stocks do you want to sell
<br>

 <form method="POST" action="">
  <input type="text" name="search">
  <button type="submit"> Submit </button>
</form>

<?php
$quantity = $_POST['search'];

echo "You are selling  these $quantity stocks of $symbol";

?>


</body>
</html>


