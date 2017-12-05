<?php 

$hostname = "localhost";
$username = "root";
$password = "abdul";
$database ="mthdata";

@mysql_connect($hostname,$username,$password);
@mysql_select_db($database);


?>