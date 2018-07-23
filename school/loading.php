<?php
session_start();
include_once "init.php";
if(isset($_SESSION['id']) && isset($_SESSION['pass'])){
  //do login
}elseif (isset($_POST['loginid']) && isset($_POST['loginpass'])) {
  //do login
}else if(isset($_POST['signup_btn'])){
  //sec setting
  $signid = htmlspecialchars($_POST['signid']);
  $signpass = htmlspecialchars($_POST['signpass']);

  //do signup
  try {
      $dbh = new PDO("mysql:host=$hostname;dbname=bbs",$username,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo 'Connected to Database<br/>';
      $sth = $dbh->prepare('SELECT username FROM user;');
      $sth->execute();
      foreach ($sth as $row){
        if($row['username'] == $signid){
          echo $row['username'];
          $_SESSION['error'] = "Username Exits";
          echo "username exits";
          //header("refresh:1;url=index.php");
        }
      }
      //$sth = $dbh->prepare("INSERT INTO user (username,password)VALUES('$signid','$signpass');");
      //$sth->execute();
      echo "Creating User";
      //header("refresh:2;url=index.php");
      $dbh = null;
      }
  catch(PDOException $e){
      echo $e->getMessage();
      }
}else{
  //header("refresh:2;url=index.php");
}




?>
