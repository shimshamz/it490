#!/usr/bin/php
<?php
$dbprimaryip = '192.168.1.55';
$dbstandbyip = '192.168.1.59';
$dbfile = file_get_contents('/var/www/html/it490-development/database.php');
$replaceip = str_replace($dbprimaryip,$dbstandbyip,$dbfile);
file_put_contents('/var/www/html/it490-development/database.php', $replaceip);

?>
