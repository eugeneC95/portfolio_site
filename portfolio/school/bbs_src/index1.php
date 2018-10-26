<h3>掲示板</h3>
<form method='POST' action='index.php'>
<textarea name='text1' rows="4" cols="40" placeholder="投稿文"></textarea>
<input type='submit' name='submit'>
<style>
li{list-style-type:none;}
</style>
<?php
session_start();
$file = '/tmp/01.txt';

$string = file_get_contents($file);

$list = preg_split("/\n/",$string);
print("<div>");
$s=0;
foreach($list as $line){
$i = preg_split("/ /",$line);
$s++;
if($s %2 == 0){
print("<div style='max-width:500px;background-color:red;'>");
print("<span style='float:left;'>".$i[0]."</span>");
print("<span style='float:right;'>".$i[1]."</span>");
print("<span style='float:none;color:white;'>-</span></div>");
}else{
print("<div style='max-width:500px'>");
print("<span style='float:left;'>".$i[0]."</span>");
print("<span style='float:right;'>".$i[1]."</span>");
print("<span style='float:none;color:white;'>-</span></div>");
}
}

print("</div>");
$date = date("m-d@H:i");
if($_POST['text1'] != ""){
$string .= "\n".$_POST['text1']." ".$date;
}
file_put_contents($file,$string);