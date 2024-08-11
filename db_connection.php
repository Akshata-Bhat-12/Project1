<?php
session_start();
session_regenerate_id(true);
// change the information according to your database
$servername='127.0.0.1:3307';
$username='root';
$password='';
$dbname = "cms";
$db_connection = mysqli_connect($servername,$username,$password,"$dbname");
// CHECK DATABASE CONNECTION
if(mysqli_connect_errno()){
    echo "Connection Failed".mysqli_connect_error();
    exit;
}