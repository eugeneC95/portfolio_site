MYR<?php
require('header.php');
session_start();
if(isset($_POST["checkin"]) && !empty($_POST["checkin"]) && isset($_POST["checkout"]) && !empty($_POST["checkout"])){
	$_SESSION['checkin_date'] = date('d-m-y', strtotime($_POST['checkin']));
	$_SESSION['checkout_date'] = date('d-m-y', strtotime($_POST['checkout']));
	$_SESSION['checkin_db'] = date('y-m-d', strtotime($_POST['checkin']));
	$_SESSION['checkout_db'] = date('y-m-d', strtotime($_POST['checkout']));
	$_SESSION['datetime1'] = new DateTime($_SESSION['checkin_db']);
	$_SESSION['datetime2'] = new DateTime($_SESSION['checkout_db']);
	$_SESSION['checkin_unformat'] = $_POST["checkin"];
	$_SESSION['checkout_unformat'] = $_POST["checkout"];
	$_SESSION['interval'] = $_SESSION['datetime1']->diff($_SESSION['datetime2']);

	$_SESSION['total_night'] = $_SESSION['interval']->format('%d');

}
if(isset( $_POST["totaladults"] ) ){
$_SESSION['adults'] = $_POST["totaladults"];
}

if(isset( $_POST["totalchildrens"] ) ){
$_SESSION['childrens'] = $_POST["totalchildrens"];
}


?>
<!DOCTYPE html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reservation</title>
<meta name="reservation hotel for malaysia" >
<meta name="zulkarnain" content="gambohnetwork.com.my">
<meta name="copyright" content="Hotel Malaysia, inc. Copyright (c) 2014">
<link rel="stylesheet" href="scss/foundation.css">
<link rel="stylesheet" href="scss/style.css">
<link href='http://fonts.googleapis.com/css?family=Slabo+13px' rel='stylesheet' type='text/css'>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
<meta class="foundation-data-attribute-namespace"><meta class="foundation-mq-xxlarge"><meta class="foundation-mq-xlarge"><meta class="foundation-mq-large"><meta class="foundation-mq-medium"><meta class="foundation-mq-small"><style></style><meta class="foundation-mq-topbar"></head>
<body>
<div class="container">
  <div class="row">
    <div class="col-6 col-md-4">
      <div class="card" style="width: 18rem;">
      <div class="card-body">
        <h3 class="card-title">Your Reservation</h3>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          <form action="sessiondestroy.php" method="post">
          <div class="row">
            <div class="col-lg-12">
              <div class="row">

                <div class="col-lg-12">
                  <span class="fontgrey">Check In
                  </span>
                </div>

                <div class="col-lg-12">
                  <span class="">: <?php echo $_SESSION['checkin_date'];?>
                  </span>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <span class="fontgrey">Check Out
                  </span>
                </div>

                <div class="col-lg-12">
                  <span class="">: <?php echo $_SESSION['checkout_date'];?>
                  </span>

                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <span class="fontgrey">Adults
                  </span>
                </div>

                <div class="col-lg-12">
                  <span class="">: <?php echo $_SESSION['adults'];?>
                  </span>

                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <span class="fontgrey">Childrens
                  </span>
                </div>

                <div class="col-lg-12">
                  <span class="">: <?php echo $_SESSION['childrens'];?>
                  </span>

                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <span class="fontgrey">No. of Night Stay(s)
                  </span>
                </div>

                <div class="col-lg-12">
                  <span class="">: <?php echo  $_SESSION['total_night'];?>
                  </span>

                </div>
              </div>

            </div>
          </div>

            <div class="row">
            <div class="col-lg-12" >
              <br><button name="submit" href="#" class="button small fontslabo">Edit Reservation</button>
            </div>
            </div>
          </form>
        </li>

      </ul>
      <div class="card-body">
        <div class="col-lg-12" id="roomselected">
              <label for="submit-form" class="book button small fontslabo">Proceed To Book</label>
        </div>
      </div>
    </div>
    </div>
    <div class="col-12 col-md-8">
        <?php
          include './auth.php';
          // check available room
          $datestart =  date('y-m-d', strtotime($_SESSION['checkin_unformat']) );
          $dateend =  date('y-m-d', strtotime($_SESSION['checkout_unformat']));

          $result = mysql_query("SELECT r.room_id, (r.total_room-br.total) as availableroom from room as r LEFT JOIN (

                      SELECT roombook.room_id, sum(roombook.totalroombook) as total from roombook where roombook.booking_id IN
                        (
                          SELECT b.booking_id as bookingID from booking as b
                          where
                          (b.checkin_date between '".$datestart."' AND '".$dateend."')
                          OR
                          (b.checkout_date between '".$dateend."' AND '".$datestart."')


                        )

                      group by roombook.room_id
                      )
                      as br

             ON r.room_id = br.room_id");
          echo mysql_error();
          if(mysql_num_rows($result) > 0){
            echo "<p><h2><b>Choose Your Room</b></h2></p><hr class=\"line\">";
            print "				<form action=\"guestform.php\" method=\"post\">\n";


            while ($row = mysql_fetch_array($result)) {


              if($row['availableroom'] != null && $row['availableroom'] > 0  )
              {

                $sub_result = mysql_query("select room.* from room where room.room_id = ".$row['room_id']." ");

                if(mysql_num_rows($sub_result) > 0)
                {

                  while($sub_row = mysql_fetch_array($sub_result)){ ?>


                          <div class="card" style="width: 55rem;">
                    <img src="<?php echo $sub_row['imgpath'];?>" height="183px" width="480px" class="roomimg">
                    <div class="card-body">
                      <h5 class="card-title"><p><span class="roomname"><?php echo $sub_row['room_name'];?></span></p></h5>
                      <p class="card-text">
                        <section class="roominfo">
                        <p class="desc"><?php echo $sub_row['descriptions'];?></p>
                                <span class="ro">Occupancy : </span><?php echo $sub_row['occupancy'];?><br>
                                <span class="ro">Size : </span> <?php echo $sub_row['size'];?><br>
                                <span class="ro">View : </span> <?php echo $sub_row['view'];?><br>
                                <span class="ro">Rate : MYR </span><?php echo $sub_row['rate'];?>/ night<br>
                                <span class="ro"><?php echo $row['availableroom'];?></span> room available
                                <label>
                                <select name="qtyroom<?php echo $sub_row['room_id'];?>" id="room<?php echo $sub_row['room_id'];?>" onChange="selection(<?php echo $sub_row['room_id'];?>)">
                                  <option value="0">0</option>
                                  <?php
                                  $i = 1;
                                  while($i <= $row['availableroom']) { ?>
                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                    <?php
                                    $i = $i+1;
                                    } ?>
                                </select></label>
                                <p><span class="ro">Extra bed : </span>
                                <select name="extrabed<?php echo $sub_row['room_id'];?>" id="bed<?php echo $sub_row['room_id'];?>" onChange="selection(<?php echo $sub_row['room_id'];?>"><option value="0">0</option>
                                  <?php $i = 1;
                                  while($i <= $sub_row['bed']) {
                                    ?>
                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                    <?php
                                    $i = $i+1;
                                  }?>
                                  </select>
                                  <span>/ MYR <?php echo $sub_row['extrabed_rate'];?> per night</span>
                                  <input type=hidden name="selectedroom<?php $sub_row['room_id'];?>" id="selectedroom<?php $sub_row['room_id'];?>" value="<?php $sub_row['room_id'];?>">
                                  <input type=hidden name="room_name<?php $sub_row['room_id'];?>" id="room_name<?php $sub_row['room_id'];?>" value="<?php $sub_row['room_name'];?>">
                          </section>
                      </p>
                    </div>
                  </div>
                          <?php
                          }

                        }
                      }
                      else if($row['availableroom'] == null ){
                        $sub_result2 = mysql_query("select room.* from room where room.room_id = ".$row['room_id']." ");
                        if(mysql_num_rows($sub_result2) > 0)
                        {
                          while($sub_row2 = mysql_fetch_array($sub_result2)){ ?>
                          <div class="card" style="width: 55rem;">
                            <img src="<?php echo $sub_row2['imgpath'];?>" height="183px" width="480px" class="roomimg">
                            <div class="card-body">
                              <h5 class="card-title"><p><span class="roomname"><?php echo $sub_row2['room_name'];?></span></p></h5>
                              <p class="card-text">
                                <section class="roominfo">
                                <p class="desc"><?php echo $sub_row2['descriptions'];?></p>
                                <span class="ro">Occupancy : </span><?php echo $sub_row2['occupancy'];?><br>
                                <span class="ro">Size : </span><?php echo $sub_row2['size'];?><br>
                                <span class="ro">View : </span><?php echo $sub_row2['view'];?><br>
                                <span class="ro">Rate : MYR </span><br><?php echo $sub_row2['rate'];?> <span> / night</span><br>
                                <p><span class="ro"><?php echo $sub_row2['total_room'];?></span> room available <label>
                                  <select name="qtyroom<?php echo $sub_row2['room_id'];?>"  id="room<?php echo $sub_row2['room_id'];?>" onChange="selection(<?php echo $sub_row2['room_id'];?>)">
                                <option value="0">0</option>
                                <?php $i = 1;
                                    while($i <= $sub_row2['total_room']) {
                                ?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php
                                  $i = $i+1; }
                                ?></select></label>
                                <p><span class="ro">Extra bed : </span><select name="extrabed<?php echo $sub_row2['room_id'];?>" id="bed<?php echo $sub_row2['room_id'];?>" onChange="selection(<?php echo $sub_row2['room_id'];?>"><option value="0">0</option>
                                  <?php $i = 1;
                                  while($i <= $sub_row2['bed']) {
                                    ?>
                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                    <?php
                                    $i = $i+1;
                                  }?>
                                  </select><span>/ MYR <?php echo $sub_row2['extrabed_rate'];?> per night and per bed</span></p>
                                <input type=hidden name="selectedroom<?php echo $sub_row2['room_id'];?>" value="<?php echo $sub_row2['room_id'];?>">
                                <input type=hidden name="room_name<?php echo $sub_row2['room_id'];?>" value="<?php echo $sub_row2['room_name'];?>">
                              </section>
                              </p>
                            </div>
                          </div>
                          <?php
                          }
                        }
                      }
                    }
                  }
                  else {
                  echo "<p><b>No room available</b></p><hr>";
                  }?>
                  <button type="submit" id="submit-form" style="display:none;">Book</button></form>
        </div>
    </div>
</div>
                  <script>
                  function selection(id) {
                  var e = document.getElementById('roomselected').style.display='block';
                  }
                  </script>

                  <?php include 'footer.php';?>
