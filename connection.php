<?php

$servername='127.0.0.1:3307';
$username='root';
$password='';
$dbname = "cms";
$conn=mysqli_connect($servername,$username,$password,"$dbname");
if(!$conn){
   die('Could not Connect My Sql:' .mysql_error());
}
   

?>

