<?php
  require_once('config.php');
  session_start();
  $time = date("Y-m-d H:i:s");
  $sql = "UPDATE cleaning SET cleaning_status = '$_POST[radio]',cleaning_by = '$_POST[name]',update_time = '$time'WHERE room_no = '$_POST[room]'";
  if($connection->query($sql) === TRUE){
    header("Location:index.php?cleaning");
  } else {
    header("Location:index.php?cleaning");
  }
  $connection->close();
?>
