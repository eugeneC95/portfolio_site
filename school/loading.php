<?php
session_start();
include_once "init.php";
if(isset($_SESSION['id']) && isset($_SESSION['pass'])){
  //do login
}elseif (isset($_POST['loginid']) && isset($_POST['loginpass'])) {
  //do login
}else if(isset($_POST['signid']) && isset($_POST['signpass']))
  //sec setting
  $signid = htmlspecialchars($_POST['$signid']);
  $signpass = htmlspecialchars()$_POST['$signpass']);
  //do signup
  try {
      $dbh = new PDO("mysql:host=$hostname;dbname=bbs",$username,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo 'Connected to Database<br/>';
      $sth = $dbh->prepare('SELECT username FROM user;');
      $sth->execute();
      foreach ($sth as $row){
        if($_POST['signid'] == $row['username']){
          $_SESSION['error'] = "Username Exits";
          header("refresh:1;url=index.php");
        }else{
          $sth = $dbh->prepare('INSERT INTO user (username,password)VALUES($signid,$signpass);');
          $sth->execute();
        };
      }
      $dbh = null;
      }
  catch(PDOException $e){
      echo $e->getMessage();
      }
}else{
  header("refresh:2;url=index.php");
}




?>
