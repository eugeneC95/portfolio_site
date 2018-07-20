
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Management System- Dashboard</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span></button>
            <a class="navbar-brand" href="login.php"><span>The </span>Hotel</a>
            <ul class="nav navbar-nav navbar-right">
               <li><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
               <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
             </ul>
        </div>
    </div><!-- /.container-fluid -->
</nav>
  <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class=" card-container">
                <br>
                <div class="result">
                    <?php
                    if (isset($_GET['empty'])){
                        echo '<div class="alert alert-danger">Enter Username or Password</div>';
                    }elseif (isset($_GET['loginE'])){
                        echo '<div class="alert alert-danger">Username or Password Don\'t Match</div>';
                    } ?>
                </div>
                <form class="form-signin" data-toggle="validator" action="ajax.php" method="post">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label></label>
                            <input type="text" name="email" class="form-control" placeholder="Username/Email Address" required
                                   data-error="Enter Username or Email">
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group col-lg-12">
                            <label></label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required
                                   data-error="Enter Password">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="login">Login</button>

                </form><!-- /form -->
            </div><!-- /card-container -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-4">
    <div class="card" style="width: 60rem;">
      <div class="card-body">
        <h2 class="card-title">Check Date</h2>
        <div class="row">
        <form name="form" action="checkroom.php" method="post" onSubmit="return validateForm(this);">
            <div class="form-group col-lg-6">
                <label>Check In Date</label>
                <input type="text" class="form-control" placeholder="mm/dd/yyyy" name="checkin" id="check_in_date" data-error="Select Check In Date" required>
                <div class="help-block with-errors"></div>
            </div>

            <div class="form-group col-lg-6">
                <label>Check Out Date</label>
                <input type="text" class="form-control" placeholder="mm/dd/yyyy" name="checkout" id="check_out_date" data-error="Select Check Out Date" required>
                <div class="help-block with-errors"></div>
            </div>

                <div class="form-group col-lg-6">
                  <label>Adults
                    <select class="form-control" name="totaladults" id="totaladults">
                      <option value="0">0</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      </select>
                  </label>
                </div>
                <div class="form-group col-lg-6">
                  <label>Children
                    <select class="form-control"  name="totalchildrens" id="totalchildrens">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    </select>
                  </label>
                </div>
            </div>
        </div>

          <div class="row">
          <div class="form-group col-lg-6" >
            <button type="submit" name="submit" class="btn btn-lg btn-primary">Check Availability</button>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-sm-3"></div>
</div>


<script>
	function validateForm(form) {
		var a = form.checkin.value;
		var b = form.checkout.value;
		var c = form.totaladults.value;
		var d = form.totalchildrens.value;
			if(a == null || b == null || a == "" || b == "")
			{
			 alert("Please choose date");
			 return false;
			}
			if(c == 0)
			{
			 	if(d == 0)
				{
				 alert("Please choose no. of guest");
				 return false;
				}
			}
			if(d == 0)
			{
			 	if(c == 0)
				{
				 alert("Please choose no. of guest");
				 return false;
				}
			}

	}
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-57205452-1', 'auto');
  ga('send', 'pageview');

</script>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/foundation-datepicker.min.js"></script>
<script src="js/validator.min.js"></script>
<script src="js/custom.js"></script>
<script src="ajax.js"></script>


</body>
</html>
