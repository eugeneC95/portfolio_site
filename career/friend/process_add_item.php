<?php
  require_once('config.php');
  session_start();
  $product = $_POST['product'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];
  $name = $_POST['name'];
  $status = $_POST['status'];


  $sql = "INSERT INTO inventory(product,quantity,price,name,status) VALUES ('$product','$quantity','$price','$name','Available')";
  if($connection->query($sql) === TRUE){
    header("Location:index.php?inventory");
  } else {
    header("Location:index.php?inventory");
  }
  $connection->close();
 ?>
