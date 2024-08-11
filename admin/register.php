<?php

//index.php

//error_reporting(E_ALL);

session_start();

if(isset($_SESSION["admin_id"]))
{
	header("location:home.php");
}

include('function.php');
include '../database_connection.php';
$message = '';
$error_admin_name = '';
$error_admin_email = '';
$error_admin_password = '';
$admin_name = '';
$admin_email = '';
$admin_password = '';

if(isset($_POST["register"]))
{
	if(empty($_POST["admin_name"]))
	{
		$error_admin_name = "<label class='text-danger'>Enter Name</label>";
	}
	else
	{
		$admin_name = trim($_POST["admin_name"]);
		$admin_name = htmlentities($admin_name);
	}

	if(empty($_POST["admin_email"]))
	{
		$error_admin_email = '<label class="text-danger">Enter Email Address</label>';
	}
	else
	{
		$admin_email = trim($_POST["admin_email"]);
		if(!filter_var($admin_email, FILTER_VALIDATE_EMAIL))
		{
			$error_admin_email = '<label class="text-danger">Enter Valid Email Address</label>';
		}
	}

	if(empty($_POST["admin_password"]))
	{
		$error_admin_password = '<label class="text-danger">Enter Password</label>';
	}
	else
	{
		$admin_password = trim($_POST["admin_password"]);
		$admin_password = password_hash($admin_password, PASSWORD_DEFAULT);
	}

	if($error_admin_name == '' && $error_admin_email == '' && $error_admin_password == '')
	{
		$admin_activation_code = md5(rand());

		$admin_otp = rand(100000, 999999);

		$data = array(
			':admin_name'		=>	$admin_name,
			':admin_email'		=>	$admin_email,
			':admin_password'	=>	$admin_password,
			':admin_activation_code' => $admin_activation_code,
			':admin_email_status'=>	'not verified',
			':admin_otp'			=>	$admin_otp
		);

		$query = "
		INSERT INTO register_admin
		(admin_name, admin_email, admin_password, admin_activation_code, admin_email_status, admin_otp)
		SELECT * FROM (SELECT :admin_name, :admin_email, :admin_password, :admin_activation_code, :admin_email_status, :admin_otp) AS tmp
		WHERE NOT EXISTS (
		    SELECT admin_email FROM register_admin WHERE admin_email = :admin_email
		) LIMIT 1
		";

		$statement = $connect->prepare($query);

		$statement->execute($data);

		if($connect->lastInsertId() == 0)
		{
			$message = '<label class="text-danger">Email Already Register</label>';
		}	
		else
		{
			$admin_avatar = make_avatar(strtoupper($admin_name[0]));

			$query = "
			UPDATE register_admin 
			SET admin_avatar = '".$admin_avatar."' 
			WHERE register_admin_id = '".$connect->lastInsertId()."'
			";

			$statement = $connect->prepare($query);

			$statement->execute();


			require 'class/class.phpmailer.php';
			require 'class/class.smtp.php';
			$mail = new PHPMailer;
// 			$mail->IsSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = '26';
			$mail->SMTPAuth = true;
			$mail->Username = 'rufouss.web@gmail.com';
			$mail->Password = 'Rufouss@123';
			$mail->SMTPSecure = 'ssl';
			$mail->From = 'rufouss.web@gmail.com';
			$mail->FromName = 'Rufouss | OTP';
			$mail->AddAddress($admin_email);
			$mail->WordWrap = 50;
			$mail->IsHTML(true);
			$mail->Subject = 'Verification code for Verify Your Email Address';

			$message_body = '
			<p>For verify your email address, enter this verification code when prompted: <b>'.$admin_otp.'</b>.</p>
			<p>Sincerely,</p>
			';
			$mail->Body = $message_body;

			if($mail->Send())
			{
				echo '<script>alert("Please Check Your Email for Verification Code")</script>';

				header('location:email_verify.php?code='.$admin_activation_code);
			}
			else
			{
				$message = $mail->ErrorInfo;
			}
		}

	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>JNANA | Tracker</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="http://code.jquery.com/jquery.js"></script>
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>
	<body>
		<br />
		<div class="container">
			<h3 align="center">JNANA | Tracker</h3>
			<br />
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Registration</h3>
				</div>
				<div class="panel-body">
					<?php echo $message; ?>
					<form method="post">
						<div class="form-group">
							<label>Enter Your Name</label>
							<input type="text" name="admin_name" class="form-control" />
							<?php echo $error_admin_name; ?>
						</div>
						<div class="form-group">
							<label>Enter Your Email</label>
							<input type="text" name="admin_email" class="form-control" />
							<?php echo $error_admin_email; ?>
						</div>
						<div class="form-group">
							<label>Enter Your Password</label>
							<input type="password" name="admin_password" class="form-control" />
							<?php echo $error_admin_password; ?>
						</div>
						<div class="form-group">
       <input type="submit" name="register" class="btn btn-success" value="Click to Register" />&nbsp;&nbsp;&nbsp;
       <a href="resend_email_otp.php" class="btn btn-default">Resend OTP</a>
       &nbsp;&nbsp;&nbsp;
       <a href="login.php">Login</a>
      </div>
					</form>
				</div>
			</div>
		</div>
		<br />
		<br />
	</body>
</html>