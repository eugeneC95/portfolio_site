<?php
$servername = "localhost";
$username = "zun95";
$password = "Hotdilvin95";
$db ="merucali";
try {
		 $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
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
#phpinfo();
#ini_set('max_input_vars', 10000);
