<?php
include('../connection.php');

$dataupd = $_POST["status"];
$id = $_POST["id"];
$query   = mysqli_query($conn, "UPDATE `course_request` SET `status` = '$dataupd' WHERE `enquiry_id` = '$id'");



?>