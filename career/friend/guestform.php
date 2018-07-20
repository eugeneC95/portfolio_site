<?php
session_start();
include 'header.php';
include 'auth.php';
if(!isset($_SESSION['room_id'])) {
	$_SESSION['room_id'] = array();
	$_SESSION['roomname'] = array();
	$_SESSION['roomqty'] = array();
	$_SESSION['bedqty'] = array();
	$_SESSION['ind_rate'] = array();
	$_SESSION['total_amount'] = 0;
	$_SESSION['extra_amount'] = 0;
	//$_SESSION['deposit'] = 0;
}
$result=mysql_query("select * from room");
if(mysql_num_rows($result)>0) {
	$count=0;
	while ($row = mysql_fetch_array($result)) {
		if(isset($_POST["qtyroom".$row['room_id'].""])&&!empty($_POST["qtyroom".$row['room_id'].""])) {
			$_SESSION['room_id'][$count] = $_POST["selectedroom".$row['room_id'].""];
			$_SESSION['roomqty'][$count] = $_POST["qtyroom".$row['room_id'].""];
			$_SESSION['bedqty'][$count] = $_POST["extrabed".$row['room_id'.""]];
			$_SESSION['roomname'][$count] = $_POST["room_name".$row['room_id'].""];
			$_SESSION['ind_rate'][$count] = $row['rate']  * $_POST["qtyroom".$row['room_id'].""];
			$_SESSION['extra_amount'] = $row['extrabed_rate'] * $_POST["extrabed".$row['room_id'].""];
			$_SESSION['total_amount'] =  ( $row['rate']  * $_POST["qtyroom".$row['room_id'].""] * $_SESSION['total_night'] ) + ($row['extrabed_rate']*$_POST["extrabed".$row['room_id'].""]*$_SESSION['total_night']) + $_SESSION['total_amount'] ;
			//$_SESSION['deposit'] = $_SESSION['total_amount'] * 0.15;
			$count = $count + 1;
		}
	}
}
?>
<link rel="stylesheet" tyep="text/css" href="css/reservation.css?ver=1">
<div class="yellow">
</div>
<div id="reservation-main">
	<div id="re-flex">
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-3">
        <div id="re-check">
          <p id="reservation-title">My Reservation</p>
          <form id="re-bar" name="details" action="unsetroomchosen.php" method="post">
          <p><span class="rmenu">Check In : </span><?php echo $_SESSION['checkin_date'];?></p>
          <p><span class="rmenu">Check Out : </span><?php echo $_SESSION['checkout_date'];?></p>
          <p><span class="rmenu">Adults : </span><?php echo $_SESSION['adults'];?></p>
          <p><span class="rmenu">Childrens : </span><?php echo $_SESSION['childrens'];?></p>
          <p><span class="rmenu">No. of Night Stay(s) : </span><?php echo $_SESSION['total_night'];?></p>
          <p><span class="rmenu">Room Selected : </span><?php
          foreach ($_SESSION['roomname'] as $value0 ) {
            echo $value0;
            echo "<br>";
          };?></p>
          <p><span class="rmenu">Qty :
            </span><?php
          foreach ($_SESSION['roomqty'] as $value1 ) {
            echo $value1;
            echo "<br>";
          };?></p>
          <p><span class="rmenu">No. of Extra beds : </span>
          <?php
          foreach ($_SESSION['bedqty'] as $value2 ) {
            echo $value2;
            echo "<br>";
          };?></p>
          <!--<p>15% Deposit Due Now : MYR <?php //echo $_SESSION['deposit'];*/?></p>-->
          <p><span class="rmenu">Total : MYR </span><b><?php echo $_SESSION['total_amount'];?></b></p>
          <p style="text-align:center;"><button id="editB" name="submit" href="#">Edit Reservation</button></p>
          </form>
        </div>
      </div>
      <div class="col-sm-8">
        <div id="re-guestinfo">
          <div class="col-12 col-md-8">
        		<p><b>Guest Details</b><hr class="line"></p>
        		<form action="insertandemail.php" method="post"  onSubmit="return validateForm(this);">
        		  <div class="row">
          			<div class="form-group col-lg-6">
          			  <label>First Name*
          				<input name="firstname" type="text" class="form-control" value="<?php if(isset($_SESSION['firstname']) && !empty($_SESSION['firstname'])){echo  $_SESSION['firstname'];}?>" pattern="[a-zA-Z\s]+" Title="Only alphabet characters allowed" placeholder="" />
          			  </label>
          			</div>
          			<div class="form-group col-lg-6">
          			  <label class="fontcolor">Last Name*
          				<input name="lastname" type="text" class="form-control" value="<?php if(isset($_SESSION['lastname']) && !empty($_SESSION['lastname'])){echo  $_SESSION['lastname'];}?>" pattern="[a-zA-Z\s]+" Title="Only alphabet characters allowed" placeholder="" />
          			  </label>
          			</div>
        		  </div>

        		  <div class="row">
        			<div class="form-group col-lg-6">
        			  <label class="fontcolor">Email Address*
        				<input name="email" type="email" class="form-control" value="<?php if(isset($_SESSION['email']) && !empty($_SESSION['email'])){echo  $_SESSION['email'];}?>" placeholder="" />
        			  </label>
        			</div>
        			<div class="form-group col-lg-6">
        			  <label class="" style="color:black !important;">Telephone Number*
        				<input name="phone" type="text" id="phone" class="form-control" value="<?php if(isset($_SESSION['phone']) && !empty($_SESSION['phone'])){echo  $_SESSION['phone'];}?>" pattern= "[^a-zA-Z]+" Title="Only numbers are allowed"  placeholder="" size="35"/>
        			  </label>
        			</div>
        		  </div>
        		  <div class="row">
        			<div class="form-group col-lg-6">
        			  <label class="fontcolor">Address Line 1*
        				<input name="addressline1" type="text" class="form-control" value="<?php if(isset($_SESSION['addressline1']) && !empty($_SESSION['addressline1'])){echo  $_SESSION['addressline1'];}?>"   placeholder=""/>
        			  </label>
        			</div>
        			<div class="form-group col-lg-6">
        			  <label class="fontcolor">Address Line 2
        				<input name="addressline2" type="text" class="form-control" value="<?php if(isset($_SESSION['addressline2']) && !empty($_SESSION['addressline2'])){echo  $_SESSION['addressline2'];}?>"  placeholder=""/ />
        			  </label>
        			</div>
        		  </div>
        		  <div class="row">
        			<div class="form-group col-lg-6">
        			  <label class="fontcolor">Zip/Postcode*
        				<input name="postcode" type="text"  class="form-control" value="<?php if(isset($_SESSION['postcode']) && !empty($_SESSION['postcode'])){echo  $_SESSION['postcode'];}?>" pattern= "[a-zA-Z0-9\s]+" Title="Special characters such as ( ) * & ^ % $ & etc are not allowed><;"  placeholder=""/ />
        			  </label>
        			</div>
        			<div class="form-group col-lg-6">
        			  <label class="fontcolor">City*
        				<input name="city" type="text"  class="form-control" value="<?php if(isset($_SESSION['city']) && !empty($_SESSION['city'])){echo  $_SESSION['city'];}?>" pattern= "[a-zA-Z0-9\s]+" Title="Special characters such as ( ) * & ^ % $ & etc are not allowed"  placeholder=""/ />
        			  </label>
        			</div>
        		  </div>
        		  <div class="row">
        			<div class="form-group col-lg-6">
        			  <label class="fontcolor">State*
        				<input name="state" type="text" class="form-control" value="<?php if(isset($_SESSION['state']) && !empty($_SESSION['state'])){echo  $_SESSION['state'];}?>" pattern= "[a-zA-Z0-9\s]+" Title="Special characters such as ( ) * & ^ % $ & etc are not allowed"  placeholder=""/ />
        			  </label>
        			</div>
        			<div class="form-group col-lg-6">
        			  <label class="fontcolor">Country*
                  <br>
        				<select name="country" id="country" type="text" placeholder=""   required>
        						<?php
        						if(isset($_SESSION['country']) && !empty($_SESSION['country'])){
        						echo "<option value=\"".$_SESSION['country']."\" selected=\"true\">".$_SESSION['country']."</option>";
        						}else
        						{
        						echo "<option value=\"\" selected=\"true\">Country</option>";
        						}

        						?>

        						<option value="Afghanistan">Afghanistan</option>
        						<option value="Albania">Albania</option>
        						<option value="Algeria">Algeria</option>
        						<option value="American Samoa">American Samoa</option>
        						<option value="Andorra">Andorra</option>
        						<option value="Angola">Angola</option>
        						<option value="Anguilla">Anguilla</option>
        						<option value="Antigua Barbuda">Antigua &amp; Barbuda</option>
        						<option value="Argentina">Argentina</option>
        						<option value="Armenia">Armenia</option>
        						<option value="Aruba">Aruba</option>
        						<option value="Australia">Australia</option>
        						<option value="Austria">Austria</option>
        						<option value="Azerbaijan">Azerbaijan</option>
        						<option value="Bahamas">Bahamas</option>
        						<option value="Bahrain">Bahrain</option>
        						<option value="Bangladesh">Bangladesh</option>
        						<option value="Barbados">Barbados</option>
        						<option value="Belarus">Belarus</option>
        						<option value="Belgium">Belgium</option>
        						<option value="Belize">Belize</option>
        						<option value="Benin">Benin</option>
        						<option value="Bermuda">Bermuda</option>
        						<option value="Bhutan">Bhutan</option>
        						<option value="Bolivia">Bolivia</option>
        						<option value="Bonaire">Bonaire</option>
        						<option value="Bosnia Herzegovina">Bosnia &amp; Herzegovina</option>
        						<option value="Botswana">Botswana</option>
        						<option value="Brazil">Brazil</option>
        						<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
        						<option value="Brunei">Brunei</option>
        						<option value="Bulgaria">Bulgaria</option>
        						<option value="Burkina Faso">Burkina Faso</option>
        						<option value="Burundi">Burundi</option>
        						<option value="Cambodia">Cambodia</option>
        						<option value="Cameroon">Cameroon</option>
        						<option value="Canada">Canada</option>
        						<option value="Canary Islands">Canary Islands</option>
        						<option value="Cape Verde">Cape Verde</option>
        						<option value="Cayman Islands">Cayman Islands</option>
        						<option value="Central African Republic">Central African Republic</option>
        						<option value="Chad">Chad</option>
        						<option value="Channel Islands">Channel Islands</option>
        						<option value="Chile">Chile</option>
        						<option value="China">China</option>
        						<option value="Christmas Island">Christmas Island</option>
        						<option value="Cocos Island">Cocos Island</option>
        						<option value="Colombia">Colombia</option>
        						<option value="Comoros">Comoros</option>
        						<option value="CG">Congo</option>
        						<option value="Congo">Cook Islands</option>
        						<option value="Costa Rica">Costa Rica</option>
        						<option value="Cote D'Ivoire">Cote D'Ivoire</option>
        						<option value="Croatia">Croatia</option>
        						<option value="Cuba">Cuba</option>
        						<option value="Curacao">Curacao</option>
        						<option value="Cyprus">Cyprus</option>
        						<option value="Czech Republic">Czech Republic</option>
        						<option value="Denmark">Denmark</option>
        						<option value="Djibouti">Djibouti</option>
        						<option value="Dominica">Dominica</option>
        						<option value="Dominican Republic">Dominican Republic</option>
        						<option value="East Timor">East Timor</option>
        						<option value="Ecuador">Ecuador</option>
        						<option value="Egypt">Egypt</option>
        						<option value="El Salvador">El Salvador</option>
        						<option value="Equatorial Guinea">Equatorial Guinea</option>
        						<option value="Eritrea">Eritrea</option>
        						<option value="Estonia">Estonia</option>
        						<option value="Ethiopia">Ethiopia</option>
        						<option value="Fakland Islands">Falkland Islands</option>
        						<option value="Faroe Islands">Faroe Islands</option>
        						<option value="Fiji">Fiji</option>
        						<option value="Finland">Finland</option>
        						<option value="France">France</option>
        						<option value="French Guiana">French Guiana</option>
        						<option value="French Polynesia">French Polynesia</option>
        						<option value="French Southern Ter">French Southern Ter</option>
        						<option value="Gabon">Gabon</option>
        						<option value="Gambia">Gambia</option>
        						<option value="Georgia">Georgia</option>
        						<option value="Germany">Germany</option>
        						<option value="Ghana">Ghana</option>
        						<option value="Gibraltar">Gibraltar</option>
        						<option value="Great Britain">Great Britain</option>
        						<option value="Greece">Greece</option>
        						<option value="Greenland">Greenland</option>
        						<option value="Grenada">Grenada</option>
        						<option value="Guadeloupe">Guadeloupe</option>
        						<option value="Guam">Guam</option>
        						<option value="Guatemala">Guatemala</option>
        						<option value="Guinea">Guinea</option>
        						<option value="Guyana">Guyana</option>
        						<option value="Haiti">Haiti</option>
        						<option value="Hawaii">Hawaii</option>
        						<option value="Honduras">Honduras</option>
        						<option value="Hong Kong">Hong Kong</option>
        						<option value="Hungary">Hungary</option>
        						<option value="Iceland">Iceland</option>
        						<option value="India">India</option>
        						<option value="Indonesia">Indonesia</option>
        						<option value="Iran">Iran</option>
        						<option value="Iraq">Iraq</option>
        						<option value="Ireland">Ireland</option>
        						<option value="Isle of Man">Isle of Man</option>
        						<option value="Israel">Israel</option>
        						<option value="Italy">Italy</option>
        						<option value="Jamaica">Jamaica</option>
        						<option value="Japan">Japan</option>
        						<option value="Jordan">Jordan</option>
        						<option value="Kazakhstan">Kazakhstan</option>
        						<option value="Kenya">Kenya</option>
        						<option value="Kiribati">Kiribati</option>
        						<option value="North Korea">Korea North</option>
        						<option value="Korea South">Korea South</option>
        						<option value="Kuwait">Kuwait</option>
        						<option value="Kyrgyzstan">Kyrgyzstan</option>
        						<option value="Laos">Laos</option>
        						<option value="Latvia">Latvia</option>
        						<option value="Lebanon">Lebanon</option>
        						<option value="Lesotho">Lesotho</option>
        						<option value="Liberia">Liberia</option>
        						<option value="Libya">Libya</option>
        						<option value="Liechtenstein">Liechtenstein</option>
        						<option value="Lithuania">Lithuania</option>
        						<option value="Lucembourg">Luxembourg</option>
        						<option value="Macau">Macau</option>
        						<option value="Macedonia">Macedonia</option>
        						<option value="Madagascar">Madagascar</option>
        						<option value="Malaysia">Malaysia</option>
        						<option value="Malawi">Malawi</option>
        						<option value="Maldives">Maldives</option>
        						<option value="Mali">Mali</option>
        						<option value="Malta">Malta</option>
        						<option value="Marshall Islands">Marshall Islands</option>
        						<option value="Martinique">Martinique</option>
        						<option value="Mauritania">Mauritania</option>
        						<option value="Mauritius">Mauritius</option>
        						<option value="Mayotte">Mayotte</option>
        						<option value="Mexico">Mexico</option>
        						<option value="Midway Islands">Midway Islands</option>
        						<option value="Moldova">Moldova</option>
        						<option value="Monaco">Monaco</option>
        						<option value="Mongolia">Mongolia</option>
        						<option value="Montserrat">Montserrat</option>
        						<option value="Morocco">Morocco</option>
        						<option value="Mozambique">Mozambique</option>
        						<option value="Myanmar">Myanmar</option>
        						<option value="Nambia">Nambia</option>
        						<option value="Nauru">Nauru</option>
        						<option value="Nepal">Nepal</option>
        						<option value="Netherland Antilles">Netherland Antilles</option>
        						<option value="Netherlands (Holland, Europe)">Netherlands (Holland, Europe)</option>
        						<option value="Nevis">Nevis</option>
        						<option value="New Caledonia">New Caledonia</option>
        						<option value="New Zealand">New Zealand</option>
        						<option value="Nicaragua">Nicaragua</option>
        						<option value="Niger">Niger</option>
        						<option value="Nigeria">Nigeria</option>
        						<option value="Niue">Niue</option>
        						<option value="Norfolk Island">Norfolk Island</option>
        						<option value="Norway">Norway</option>
        						<option value="Oman">Oman</option>
        						<option value="Pakistan">Pakistan</option>
        						<option value="Palau Island">Palau Island</option>
        						<option value="Palestine">Palestine</option>
        						<option value="Panama">Panama</option>
        						<option value="Paoua New Guinea">Papua New Guinea</option>
        						<option value="Paraguay">Paraguay</option>
        						<option value="Peru">Peru</option>
        						<option value="Philippines">Philippines</option>
        						<option value="Pitcairn Island">Pitcairn Island</option>
        						<option value="Poland">Poland</option>
        						<option value="Portugal">Portugal</option>
        						<option value="Puerto Rico">Puerto Rico</option>
        						<option value="Qatar">Qatar</option>
        						<option value="Republic of Montenegro">Republic of Montenegro</option>
        						<option value="Republic of Serbia">Republic of Serbia</option>
        						<option value="Reunion">Reunion</option>
        						<option value="Romania">Romania</option>
        						<option value="Russia">Russia</option>
        						<option value="Rwanda">Rwanda</option>
        						<option value="St Barthelemy">St Barthelemy</option>
        						<option value="St Eustatius">St Eustatius</option>
        						<option value="St Helena">St Helena</option>
        						<option value="St Kitts-Nevis">St Kitts-Nevis</option>
        						<option value="St Lucia">St Lucia</option>
        						<option value="St Maarten">St Maarten</option>
        						<option value="St Pierre Miquelon">St Pierre &amp; Miquelon</option>
        						<option value="St Vincent Grenadines">St Vincent &amp; Grenadines</option>
        						<option value="Saipan">Saipan</option>
        						<option value="Samoa">Samoa</option>
        						<option value="Samoa American">Samoa American</option>
        						<option value="San Marino">San Marino</option>
        						<option value="Sao Tome Principe">Sao Tome &amp; Principe</option>
        						<option value="Saudi Arabia">Saudi Arabia</option>
        						<option value="Senegal">Senegal</option>
        						<option value="Serbia">Serbia</option>
        						<option value="Seychelles">Seychelles</option>
        						<option value="Sierra Leone">Sierra Leone</option>
        						<option value="Singapore">Singapore</option>
        						<option value="Slovakia">Slovakia</option>
        						<option value="Slovenia">Slovenia</option>
        						<option value="Solomon Islands">Solomon Islands</option>
        						<option value="Somalia">Somalia</option>
        						<option value="South Africa">South Africa</option>
        						<option value="Spain">Spain</option>
        						<option value="Sri Lanka">Sri Lanka</option>
        						<option value="Sudan">Sudan</option>
        						<option value="Suriname">Suriname</option>
        						<option value="Swaziland">Swaziland</option>
        						<option value="Sweden">Sweden</option>
        						<option value="Switzerland">Switzerland</option>
        						<option value="Syria">Syria</option>
        						<option value="Tahiti">Tahiti</option>
        						<option value="Taiwan">Taiwan</option>
        						<option value="Tajikistan">Tajikistan</option>
        						<option value="Tanzania">Tanzania</option>
        						<option value="Thailand">Thailand</option>
        						<option value="Togo">Togo</option>
        						<option value="Tokelau">Tokelau</option>
        						<option value="Tonga">Tonga</option>
        						<option value="Trinidad Tobago">Trinidad &amp; Tobago</option>
        						<option value="Tunisia">Tunisia</option>
        						<option value="Turkey">Turkey</option>
        						<option value="Turkmenistan">Turkmenistan</option>
        						<option value="Turks Caicos Is">Turks &amp; Caicos Is</option>
        						<option value="Tuvalu">Tuvalu</option>
        						<option value="Uganda">Uganda</option>
        						<option value="Ukraine">Ukraine</option>
        						<option value="United Arab Emirates">United Arab Emirates</option>
        						<option value="United Kingdom">United Kingdom</option>
        						<option value="United States of America">United States of America</option>
        						<option value="Uruguay">Uruguay</option>
        						<option value="Uzbekistan">Uzbekistan</option>
        						<option value="Vanuatu">Vanuatu</option>
        						<option value="Vatican City State">Vatican City State</option>
        						<option value="Venezuela">Venezuela</option>
        						<option value="Vietnam">Vietnam</option>
        						<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
        						<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
        						<option value="Wake Island">Wake Island</option>
        						<option value="Wallis Funtana Is">Wallis &amp; Futana Is</option>
        						<option value="Yemen">Yemen</option>
        						<option value="Zaire">Zaire</option>
        						<option value="Zambia">Zambia</option>
        						<option value="Zimbabwe">Zimbabwe</option>
        				</select>
        			  </label>
        			</div>
        		  </div>

        		  <div class="row">
        			<div class="col-sm-8">
        			  <label>Special Requirements
        				<textarea name="specialrequirements" placeholder=""><?php if(isset($_SESSION['special_requirement']) && !empty($_SESSION['special_requirement'])){echo  $_SESSION['special_requirement'];}?></textarea>
        			  </label>
        			</div>
        		  </div>
        		  <div class="row">
                <button type="submit" class="btn btn-lg btn-primary" name="submit">Confirm</button>
        		  </div>
        		  </div>
        		</form>
        	</div>
        </div>
      </div>
    </div>
  </div>

<script>
	function validateForm(form) {
		var fname = form.firstname.value;
		var lname = form.lastname.value;
		var email = form.email.value;
		var phone = form.phone.value;
		var add1 = form.addressline1.value;
		var postcode = form.postcode.value;
		var city = form.city.value;
		var state = form.state.value;
		var country = form.country.value;
			if(fname == null || lname == null || email == null || phone == null || add1 == null || postcode == null|| city == null|| state == null || country == null || fname == "" || lname == "" || email == "" || phone == "" || add1 == "" || postcode == "" || city == "" || state == "" || country == "")
			{
			 alert("Please fill in all the fields mark with *.");

			 return false;
			}

	}
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script src="build/js/intlTelInput.js"></script>
 <script>
      $("#phone").intlTelInput({
        //autoFormat: false,
        //autoHideDialCode: false,
         defaultCountry: "my",
        //nationalMode: true,
        //numberType: "MOBILE",
        //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        preferredCountries: ['my', 'us'],
        //responsiveDropdown: true,
        utilsScript: "lib/libphonenumber/build/utils.js"
      });
 </script>
