<?php

//login_verify.php

include '../database_connection.php';
session_start();

$error = '';

$next_action = '';

sleep(2);

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'email')
	{
		if($_POST["admin_email"] != '')
		{
			$data = array(
				':admin_email'	=>	$_POST["admin_email"]
			);

			$query = "
			SELECT * FROM register_admin
			WHERE admin_email = :admin_email
			";

			$statement = $connect->prepare($query);

			$statement->execute($data);

			$total_row = $statement->rowCount();

			if($total_row == 0)
			{
				$error = 'Email Address not found';

				$next_action = 'email';
			}
			else
			{
				$result = $statement->fetchAll();

				foreach($result as $row)
				{
					$_SESSION["register_admin_id"] = $row["register_admin_id"];

					$_SESSION["admin_name"] = $row["admin_name"];

					$_SESSION['admin_email'] = $row["admin_email"];

					$_SESSION["admin_password"] = $row["admin_password"];
				}
				$next_action = 'password';
			}
		}
		else
		{
			$error = 'Email Address is Required';

			$next_action = 'email';
		}
	}

	if($_POST["action"] == 'password')
	{
		if($_POST["admin_password"] != '')
		{
			if(password_verify($_POST["admin_password"], $_SESSION["admin_password"]))
			{
				$login_otp = "123456";

				$data = array(
					':admin_id'		=>	$_SESSION["register_admin_id"],
					':login_otp'	=>	$login_otp,
					':last_activity'=>	date('d-m-y h:i:s')
				);

				$query = "
				INSERT INTO login_admin_data 
				(admin_id, login_otp, last_activity) 
				VALUES (:admin_id, :login_otp, :last_activity)
				";

				$statement = $connect->prepare($query);

				if($statement->execute($data))
				{
					$_SESSION['login_id'] = $connect->lastInsertId();
					$_SESSION['login_otp'] = $login_otp;

					require 'class/class.phpmailer.php';

					$mail = new PHPMailer;
         			$mail->IsSMTP();
        			$mail->Host = 'smtpout.secureserver.net';
        			$mail->Port = '80';
        			$mail->SMTPAuth = true;
        			$mail->Username = 'abc@gmail.com'; // add correct email
        			$mail->Password = 'bc@12';       //correct email password 
        			$mail->SMTPSecure = '';
        			$mail->From = 'bhatakshatav@gmail.com';
        			$mail->FromName = 'Jnana | OTP';



					// require 'PHPMailer/PHPMailerAutoload.php';


					// $mail = new PHPMailer;

					// //$mail->SMTPDebug = 3;                               // Enable verbose debug output

					// $mail->isSMTP();                                      // Set mailer to use SMTP
					// $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
					// $mail->SMTPAuth = true;                               // Enable SMTP authentication
					// $mail->SMTPKeepAlive = true;
					// $mail->Username = 'sanjay_kg@mindstack.in';                 // SMTP username
					// $mail->Password = 'Kallabbe581362';                           // SMTP password
					// $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
					// $mail->Port = 587; 

					// $mail->setFrom('sanjay_kg@mindstack.in', 'Jnana');

        			// $mail->addReplyTo('sanjay_kg@mindstack.in', 'Jnana');

					$mail->AddAddress($_SESSION["admin_email"]);

					$mail->WordWrap = 50;

					$mail->IsHTML(true);

					$mail->Subject = 'Verification code for Login';

					$message_body = '
					<p>For verify your login details, enter this verification code when prompted: <b>'.$login_otp.'</b>.</p>
					<p>Sincerely,</p>
					';

					$mail->Body = $message_body;
					$next_action = 'otp';
					// if($mail->Send())
					// {
					// 	$next_action = 'otp';
					// }
					// else
					// {
					// 	$error = '<label class="text-danger">'.$mail->ErrorInfo.'</label>';
					// 	$next_action = 'password';
					// }
				}
			}
			else
			{
				$error = 'Wrong Password';
				$next_action = 'password';
			}
		}
		else
		{
			$error = 'Password is Required';
			$next_action = 'password';
		}
	}

	if($_POST["action"] == "otp")
	{
		if($_POST["admin_otp"] != '')
		{
			if($_SESSION['login_otp'] == $_POST["admin_otp"])
			{
				$_SESSION['admin_id'] = $_SESSION['register_admin_id'];
				unset($_SESSION["register_admin_id"]);
				unset($_SESSION["admin_email"]);
				unset($_SESSION["admin_password"]);
				unset($_SESSION["login_otp"]);
			}
			else
			{
				$error = 'Wrong OTP Number';
				$next_action = 'otp';
			}
		}
		else
		{
			$error = 'OTP Number is required';
			$next_action = 'otp';
		}
	}





	$output = array(
		'error'			=>	$error,
		'next_action'	=>	$next_action
	);

	echo json_encode($output);
}


?>