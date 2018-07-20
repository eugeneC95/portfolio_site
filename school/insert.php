<?php
if(isset($_POST['data_name']) OR !empty($_POST['data_body'])){
	echo "GET"."<br>";	
	$servername = "localhost";
	$username = "root";
	$password = "19951203";
	try {
	    $conn = new PDO("mysql:host=$servername;dbname=bbs", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $dates =date("Y-m-d H:i:s");
    	    $sth = $conn->prepare('INSERT INTO bbs_comment(name,body,post_date)VALUES(?, ?, ?)');
	    $sth->execute(array($_POST['data_name'],nl2br($_POST['data_body']),$dates));
	    }
	catch(PDOException $e)
	    {
	    echo "Connection failed: " . $e->getMessage();
	    }
	echo "Input Done";
	header("refresh:2;url=index.php");
}else{
	header("refresh:2;url=index.php");
}
