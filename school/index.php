<head>
<?php session_start();?>
<style>
body {
	background-color:#efefef;
}
.d_name {
	display:inline-block;
	font-weight:bold;
	font-size:18px;
	padding:5px;
	padding-left:15px;
}
.d_body {
	font-size:15px;
	margin:10px 15px;
}
.box {
	background-color:#e6e6ff;
	margin-top:5px;
	border-radius: 5px;
}
.delete_btn{
	float:right;
	clear:both;
	margin-top:-40px;
	margin-right:40px;
}
</style>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "19951203";
try {
    $conn = new PDO("mysql:host=$servername;dbname=bbs", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $conn->prepare('SELECT * FROM bbs_comment ORDER BY ?');
    $sth->execute(array(id));
    $result = $sth->fetchAll();
    foreach($result as $ans){
	echo "<div class='box'><div><span class='d_name'>".$ans['name']."</span></div>";
	echo "<div class='d_body'><span>".$ans['body']."</span></div>";
	echo "<a href='delete.php?id=$ans[id]'><input type='button' value='Delete' class='delete_btn'></a></div>";
    }
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

?>
		<?php
		if($_SESSION['status'] == "logged"){
			?>
			<form method="POST" action="insert.php">
	    <div><span>Id </span><input type="text" name="data_name" value="<?php echo $_SESSION[id];?>" disabled required><!--readonly--></div>
	    <div><span>Comment </span><textarea name="data_body" required></textarea></div>
	    <input type="submit" id="submit_btn" name="data_btn">
	    </form>
			<div>
				<a href="signup.php"><button>Sign Up</button></a>
				<a href="logout.php"><button>Log Out</button></a>
		<?php
		}else{
			?>
			<a href="signup.php"><button>Sign Up</button></a>
			<a href="login.php"><button>Log In</button></a>
		<?php
		} ?>
		</div>
</body>
