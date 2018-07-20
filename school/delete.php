<?php
$servername = "localhost";
$username = "root";
$password = "19951203";

try {
    $conn = new PDO("mysql:host=$servername;dbname=bbs", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Deleting id No ".$_GET['id'];
    $sth = $conn->prepare("DELETE FROM bbs_comment WHERE id=?");
    $sth->execute(array($_GET['id']));
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
header("refresh:2;url=index.php");
