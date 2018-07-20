
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Cleaning Management</li>
        </ol>
    </div><!--/.row-->

    <br>

    <div class="row">
        <div class="col-lg-12">
            <div id="success"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Cleaning Management
                  </div>
                  <form class="" method="POST" action="add_clean_room.php">
                    <select name="room_num" class="input-sm">
                        <?php
                        require('config.php');
                        if($result->num_rows > 0){
                              $sql = "SELECT room_no FROM room2;";
                              $room_result = mysqli_query($connection, $sql);
                              if (mysqli_num_rows($room_result) > 0) {
                                  while ($roomm = mysqli_fetch_assoc($room_result)) {
                                    echo "<option value='$roomm[room_no]' name=''>$roomm[room_no]</option>";
                                  }
                              }
                        }
                        ?>
                    </select>
                    <button class="btn btn-info pull-right" type="submit">Add Room</button>
                  </form>

                <div class="panel-body">
                    <?php
                    if (isset($_GET['error'])) {
                        echo "<div class='alert alert-danger'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error on Delete !
                            </div>";
                    }
                    if (isset($_GET['success'])) {
                        echo "<div class='alert alert-success'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Successfully Delete !
                            </div>";
                    }
                    ?>
                    <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%"
                           id="rooms">
                        <thead>
                        <tr>
                            <th>Room No</th>
                            <th>Cleaning Status</th>
                            <th>Cleaning by</th>
                            <th>Update Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                  if($result->num_rows > 0){

                        $room_query = "SELECT * FROM cleaning";
                        $rooms_result = mysqli_query($connection, $room_query);
                        if (mysqli_num_rows($rooms_result) > 0) {
                            while ($rooms = mysqli_fetch_assoc($rooms_result)) { ?>
                                <tr>
                                    <td><?php echo $rooms['room_no'] ?></td>
                                    <td><?php echo $rooms['cleaning_status'] ?></td>
                                    <td><?php echo $rooms['cleaning_by'] ?></td>
                                    <td><?php echo $rooms['update_time']?></td>
                                    <td>
                                      <a href="index.php?edit_cleaning_status&id=<?php echo $rooms['room_no']; ?>" class="btn btn-info">Edit Cleaning Status</a>
                                    </td>
                                </tr>
                            <?php }
                        } else {
                            echo "No Rooms";
                        }}
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
              <p>HMS Developed by CSW</p>
        </div>
    </div>

</div>    <!--/.main-->
