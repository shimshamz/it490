<?php
session_start();

$useremail =  $_SESSION['email'];
var_dump($_SESSION);


echo "email : $useremail";

?>
