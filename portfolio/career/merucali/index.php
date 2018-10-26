<?php
  $host ="localhost";
  $user ="zun95";
  $pass ="Hotdilvin95";
  $db   ="merucali";

try{
  $conn = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $sth = $conn->prepare("SELECT * FROM changes ORDER BY id DESC LIMIT 0,200");
  $sth->execute();
  $datas = $sth->fetchAll();
  foreach($datas as $data){
    ?>
    <div>
      <span><?php echo $data[id]?></span><b style='margin-left:20px;'><?php echo $data[price]?></b>
    </div>
    <div>
      <a href="<?php echo $data[href]?>"><img src="<?php echo $data[img]?>" width=150 height=150></a>
    </div>
    <?php
  }
}
catch(PDOException $e){
    echo "Connection To db failed:".$e->getMessage();
}
?>
