<?php
session_start();
if($_SESSION['status'] != "logged" && isset($_SESSION['id'])){
  //do auto login
  echo $_SESSION['status'];
  header("refresh:2;url=logout.php");
}elseif ($_SESSION['status'] == "logged") {
  echo "Logged in.Heading to homepage";
  echo "<br>".$_SESSION['status'];
  header("refresh:2;url=index.php");
}else{
  //get form out and manually login
  echo "
  <h4>Welcome to our comunity.</h4>
  <h5>Log In now</h5>
  <form action='loading.php' method='POST'>
    <label>Username<input type='text' name='loginid' required></label>
    <label>Password<input type='password' name='loginpass' required></label>
    <input type='submit' name='login_btn'>
    <label>$_SESSION[error]</label>
  </form>
  ";
}
?>
