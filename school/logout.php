<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['pass']);
$_SESSION['status'] = "unlogged";

header("refresh:2;url=index.php");
?>
