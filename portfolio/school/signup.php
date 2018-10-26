<?php
session_start();

echo "
<h4>Welcome to join our comunity.</h4>
<h5>Sign Up</h5>
<form action='loading.php' method='POST'>
  <label>Username<input type='text' name='signid' required></label>
  <label>Password<input type='password' name='signpass' required></label>
  <input type='submit' name='signup_btn'>
  <label>$_SESSION[error]</label>
</form>
";

?>
