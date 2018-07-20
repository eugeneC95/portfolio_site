<?php
	require ('config.php');
	session_start();

  if (isset($_GET['id'])!="")
  {
     $id=$_GET['id'];
      $deleteQuery = "DELETE FROM staff WHERE id=$id";
      if (mysqli_query($connection, $deleteQuery)) {
          header('Location: index.php?staff_mang');
      } else {
          echo "Error updating record: " . mysqli_error($connection);
      }
  }
?>
