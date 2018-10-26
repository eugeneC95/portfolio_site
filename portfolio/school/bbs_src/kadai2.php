<?php
echo "<html>
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css' integrity='sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4' crossorigin='anonymous'>
<form class='form-inline' method='POST'>";
echo "<div class='form-group row'>
      <label class='col-sm-3 col-form-label' for='inlineFormCustomSelect'>入力1</label>";
echo "<div class='col-sm-10'>
      <input class='form-control' type='text' name='a' required></div></div>";




echo "<div class='form-group row'>
      <label class='col-sm-3 col-form-label'>入力2</label>";
echo "<div class='col-sm-10'>
      <input class='form-control' type='text' name='b' required></div></div>";


echo "
      <div class='offset-sm-1 col-sm-10'>
      <input class='btn btn-primary' type='submit' name='ok'>
      </div>";
echo "</form>";

if($_POST['b']<$_POST['a']){
        $temp = $_POST['b'];
        $_POST['b'] = $_POST['a'];
        $_POST['a'] = $temp;
}

echo "入力１= ".$_POST['a']."<br>";
echo "入力２= ".$_POST['b']."<br>";
if(isset($_POST['ok'])){
	for($i=$_POST['a'];$i<=$_POST['b'];$i++){
        	if($i%3 == 0){
                	echo $i."<br>";
        	}
	}
}
echo "</html>";
?>

