<?php
  require('config.php');
  session_start();
  $sql = "INSERT INTO cleaning (room_no,cleaning_status,cleaning_by)Values('$_POST[room_num]','','')";
  if($connection->query($sql) === TRUE){
    header("Location:index.php?cleaning");
  } else {
    header("Location:index.php?cleaning");
  }
  $connection->close();
