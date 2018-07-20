<?php
$username = "root";
$password = "199510923";
$hostname = "localhost";

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
 or die(mysql_error());

//select a database to work
$db = "mis";
$selected = mysql_select_db($db,$dbhandle)
  or die(mysql_error());


?>
