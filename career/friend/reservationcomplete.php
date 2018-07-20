<?php
require('header2.php');
session_start();

?>

</div>
</div>

<div class="row">
	<div class="col-sm-1">

	</div>
	<div class="col-6 col-md-3">

		<div class="col-lg-12">
		<p><b>Your Reservation</b></p><hr class="line">
				<form name="guestdetails" action="unsetroomchosen.php" method="post" >
				<div class="row">
					<div class="col-lg-12">
						<div class="row">

							<div class="col-lg-6">
								<span class="fontgreysmall">Check In
								</span>
							</div>

							<div class="col-lg-6">
								<span class="">: <?php echo $_SESSION['checkin_date'];?>
								</span>

							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<span class="fontgreysmall">Check Out
								</span>
							</div>

							<div class="col-lg-6">
								<span class="">: <?php echo $_SESSION['checkout_date'];?>
								</span>

							</div>
						</div>
						<div class="row">
							<div class="col-lg-6" style="max-width:100%;">
								<span class="fontgreysmall">Adults
								</span>
							</div>

							<div class="col-lg-6" style="max-width:100%;">
								<span class="">: <?php echo $_SESSION['adults'];?>
								</span>

							</div>
						</div>
						<div class="row">
							<div class="col-lg-6" style="max-width:100%;">
								<span class="fontgreysmall">Childrens
								</span>
							</div>

							<div class="col-lg-6" style="max-width:100%;">
								<span class="">: <?php echo $_SESSION['childrens'];?>
								</span>

							</div>
						</div>
						<div class="row">
							<div class="col-lg-6" style="max-width:100%;">
								<span class="fontgreysmall" >Night Stay(s)
								</span>
							</div>

							<div class="col-lg-6" style="max-width:100%;">
								<span class="">: <?php echo $_SESSION['total_night'];?>
								</span>

							</div>
						</div>
						<div class="row"><hr>
							<div class="col-lg-6" style="max-width:100%;">
								<span class="fontgreysmall" >Room Selected
								</span>
							</div>

							<div class="col-lg-6" style="max-width:100%;">
								<span class="fontgreysmall">Qty
								</span>

							</div>
						</div>
						<div class="row">
							<div class="col-lg-6" style="max-width:100%;">
								<span class="" ><?php

													foreach ($_SESSION['roomname'] as &$value0 ) {
													echo $value0;
													print "<br>";
													} ;

												?>

								</span>
							</div>

							<div class="col-lg-6" style="max-width:100%;">
								<span class="">&nbsp;
								<?php foreach ($_SESSION['roomqty'] as &$value1 ) {
													echo $value1;
													print "<br>";
													} ;

												?>
								</span>

							</div>
						</div>

					</div>
				</div><br>
				<div class="row">
						<div class="col-lg-12" style="max-width:100%;">
							<p class="fontgrey borderstyle" style="text-align:center;">15% Deposit Due Now<br>
							<span>MYR <?php echo $_SESSION['deposit'];?></span>
							<br><span class="fontgrey" style="text-align:center;">Total</span><br>
							<span class="fontslabo" style="font-size:32px; text-align:center;">MYR <?php echo $_SESSION['total_amount'];?></span></p>

						</div>

						<div class="col-lg-12" style="max-width:100%;">


						</div>
				</div>



				  <div class="row">
					<div class="col-lg-12" >
						<button type="submit" href="#" name="submit" class="btn btn-lg btn-primary">Edit Reservation</button>
					</div>
				  </div>
				</form>
		</div>



	</div>
	<div class="col-sm-7">

		<div class="col-sm-12" >
		<p><b>Reservation Complete</b></p><hr class="line">
		<p>Details of your reservation have just been sent to you
		in a confirmation email. Please check your spam folder if you didn't received any email. We look forward to see you soon. In the
		meantime, if you have any questions, feel free to contact us.</p>
		<p>
				<i class="icon-phone" style="font-size:24px"></i> <span class="i-name fontgrey">Phone</span><span class="i-code">&nbsp;&nbsp;&nbsp;1234567890</span><br>
        <i class="icon-fax" style="font-size:24px"></i> <span class="i-name fontgrey">Fax</span><span class="i-code"> &emsp;&emsp;1234567890</span><br>
        <i class="icon-mail-alt"style="font-size:24px"> </i> <span class="i-name fontgrey">Email</span><span class="i-code">&emsp; helloworld@hotmail.com</span>
		</p><hr>
		<div class="row">
			<div class="col-sm-12" >
					<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="3FWZ42DLC5BJ2">
					<input type="hidden" name="lc" value="MY">
					<input type="hidden" name="item_name" value="15% Hotel Deposit Payment for Booking ID #<?echo $_SESSION['booking_id'];?>">
					<input type="hidden" name="amount" value="<?php $amount = $_SESSION['deposit']; print $amount; ?>">
					<input type="hidden" name="currency_code" value="MYR">
					<input type="hidden" name="button_subtype" value="services">
					<input type="hidden" name="no_note" value="0">
					<input type="hidden" name="custom" value="<? echo $_SESSION['booking_id'];?>">
					<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
					<img type="image" src="img/paypal.jpg"height="57px" width=""></img>
					<br>
					<button type="submit" href="#" name="submit" alt="PayPal - The safer, easier way to pay online!" class="btn btn-lg btn-primary">Pay Deposit</button>
					<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>
			</div>
		</div>
	</div>
	</div>
</div>

<script>
</script>
</body></html>
