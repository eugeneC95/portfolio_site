<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['pass'])){
  //do auto login
  header("refresh:2;url=loading.php");
}else{
  //get form out and manually login
  echo "
  <h4>Welcome to our comunity.</h4>
  <h5>Log In now</h5>
  <form action='loading.php' method='POST'>
    <label>Username<input type='text' name='loginid' required></label>
    <label>Password<input type='password' name='loginpass' required></label>
    <input type='submit' name='submit_btn'>
  </form>
  ";
}
?>
