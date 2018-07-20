<?php
include_once "db.php";
session_start();
if (isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $userQuery = "SELECT * FROM user WHERE id = '$user_id'";
    $result = mysqli_query($connection, $userQuery);
    $user = mysqli_fetch_assoc($result);
}else{
    header('Location:login.php');
}
include_once "header.php";
include_once "sidebar.php";


if (isset($_GET['room_mang'])){
    include_once "room_mang.php";
}
elseif (isset($_GET['reservation_mang'])){
    include_once "reservation_mang.php";
}
elseif (isset($_GET['test'])){
    include_once "test.php";
}
elseif (isset($_GET['reservation'])){
    include_once "reservation.php";
}
elseif (isset($_GET['staff_mang'])){
    include_once "staff_mang.php";
}
elseif (isset($_GET['shift'])){
    include_once "shift.php";
}
elseif (isset($_GET['add_emp'])){
    include_once "add_emp.php";
}
elseif (isset($_GET['cleaning'])){
    include_once "cleaning.php";
}
elseif (isset($_GET['inventory'])){
    include_once "inventory.php";
}
elseif (isset($_GET['complain'])){
    include_once "complain.php";
}
elseif (isset($_GET['emp_history'])){
    include_once "emp_history.php";
}
elseif (isset($_GET['add_item'])){
    include_once "add_item.php";
}
elseif (isset($_GET['edit_cleaning_status'])){
    include_once "edit_cleaning_status.php";
}
else{
    include_once "room_mang.php";
}

include_once "footer.php";
