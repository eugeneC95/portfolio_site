<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['pass'])){
  //do login
}elseif (isset($_POST['loginid']) && isset($_POST['loginpass'])) {
  //do login
}else if(isset($_POST['signid']) && isset($_POST['signpass']))
  //do signup
}else{
  header("refresh:2;url=index.php");
}




?>
