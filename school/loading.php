<?php
session_start();
include_once "init.php";
if(isset($_POST['signup_btn'])){
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
          header("refresh:1;url=index.php");
        }
      }
      $sth = $dbh->prepare("INSERT INTO user (username,password)VALUES('$signid','$signpass');");
      $sth->execute();
      echo "Creating User";
      $_SESSION['status'] = "logged";
      $_SESSION['id'] = $signid;
      $_SESSION['pass'] = $signpass;
      header("refresh:2;url=login.php");
      $dbh = null;
      }
  catch(PDOException $e){
      echo $e->getMessage();
      }
}elseif (isset($_POST['login_btn'])) {
  //do login
  $loginid = htmlspecialchars($_POST['loginid']);
  $loginpass = htmlspecialchars($_POST['loginpass']);
  try {
      $dbh = new PDO("mysql:host=$hostname;dbname=bbs",$username,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo 'Connected to Database<br/>';
      $sth = $dbh->prepare('SELECT * FROM user;');
      $sth->execute();
      foreach ($sth as $row){
        if($loginid == $row['username'] && $loginpass == $row['password']){
          echo "Weocome Back ".$row['username'];
          $_SESSION['id'] = $row['username'];
          $_SESSION['pass'] = $row['password'];
          $_SESSION['status'] = "logged";
          header("refresh:1;url=index.php");
        }else{
          $_SESSION['error'] = "Username or Password Incorrect";
          header("refresh:1;url=login.php");
        }
      }
      $dbh = null;
      }
  catch(PDOException $e){
      echo $e->getMessage();
      }
}else if(isset($_SESSION['id']) && isset($_SESSION['pass']) && $_SESSION['status'] == "logged"){
  //do auto login
  $loginid = htmlspecialchars($_SESSION['id']);
  $loginpass = htmlspecialchars($_SESSION['pass']);
  try {
      $dbh = new PDO("mysql:host=$hostname;dbname=bbs",$username,$password);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo 'Connected to Database<br/>';
      $sth = $dbh->prepare('SELECT * FROM user;');
      $sth->execute();
      foreach ($sth as $row){
        if($row['username'] == $loginid && $row['password'] == $loginpass){
          echo "Weocome Back ".$row['username'];
          $_SESSION['id'] = $row['username'];
          $_SESSION['pass'] = $row['password'];
          $_SESSION['status'] = "logged";
          header("refresh:1;url=index.php");
        }else{
          $_SESSION['error'] = "Username or Password Incorrect";
          header("refresh:1;url=login.php");
        }
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
