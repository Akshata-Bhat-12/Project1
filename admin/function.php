<?php

//function.php

function make_avatar($character)
{
    $path = "avatar/". time() . ".png";
	$image = imagecreate(200, 200);
	$red = rand(0, 255);
	$green = rand(0, 255);
	$blue = rand(0, 255);
    imagecolorallocate($image, $red, $green, $blue);  
    $textcolor = imagecolorallocate($image, 255,255,255);  

    imagettftext($image, 100, 0, 55, 150, $textcolor, 'font/arial.ttf', $character);  
    //header("Content-type: image/png");  
    imagepng($image, $path);
    imagedestroy($image);
    return $path;
}

function Get_admin_avatar($admin_id, $connect)
{
	$query = "
	SELECT admin_avatar FROM register_admin 
    WHERE register_admin_id = '".$admin_id."'
	";

	$statement = $connect->prepare($query);

	$statement->execute();

	$result = $statement->fetchAll();

	foreach($result as $row)
	{
		echo '<img src="'.$row["admin_avatar"].'" width="75" class="img-thumbnail img-circle" />';
	}
}
function Get_supervisor_avatar($supervisor_id, $connect)
{
	$query = "
	SELECT supervisor_avatar FROM register_supervisor 
    WHERE supervisor_admin_id = '".$supervisor_id."'
	";

	$statement = $connect->prepare($query);

	$statement->execute();

	$result = $statement->fetchAll();

	foreach($result as $row)
	{
		echo '<img src="'.$row["supervisor_avatar"].'" width="75" class="img-thumbnail img-circle" />';
	}
}
function Get_employee_avatar($employee_id, $connect)
{
	$query = "
	SELECT employee_avatar FROM register_employee 
    WHERE register_employee_id = '".$employee_id."'
	";

	$statement = $connect->prepare($query);

	$statement->execute();

	$result = $statement->fetchAll();

	foreach($result as $row)
	{
		echo '<img src="'.$row["employee_avatar"].'" width="75" class="img-thumbnail img-circle" />';
	}
}
function Get_vendor_avatar($vendor_id, $connect)
{
	$query = "
	SELECT vendor_avatar FROM register_vendor 
    WHERE register_vendor_id = '".$vendor_id."'
	";

	$statement = $connect->prepare($query);

	$statement->execute();

	$result = $statement->fetchAll();

	foreach($result as $row)
	{
		echo '<img src="'.$row["vendor_avatar"].'" width="75" class="img-thumbnail img-circle" />';
	}
}

?>