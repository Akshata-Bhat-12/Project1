<?php

session_start();

if(isset($_SESSION["admin_id"]))
{
	header("location:home");
  
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JNANA</title>
    <link rel="shortcut icon" href="../img/favicon.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <script src="http://code.jquery.com/jquery.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body class="hold-transition login-page" style="background: linear-gradient(
321deg, rgba(206,58,214,1) 0%, rgba(206,58,214,1) 3%, rgba(0,255,255,1) 100%);">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="" class="h1"> <img src="../img/jnana_logo.png" alt="Logo" width="150"></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your Admin session</p>

      <form method="POST" id="login_form">
        <div class="input-group mb-3" id="email_area">
          <input type="email" name="admin_email" id="admin_email"  class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <span id="admin_email_error" class="text-danger"></span>
        </div>
        <div class="input-group mb-3" id="password_area" style="display:none;">
          <input type="password" name="admin_password" id="admin_password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <span id="admin_password_error" class="text-danger"></span>
        </div>
        <div class="input-group mb-3" id="otp_area" style="display:none;">
          <input type="text" name="admin_otp" id="admin_otp"  class="form-control" placeholder="OTP">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-key"></span>
            </div>
          </div>
          <span id="admin_otp_error" class="text-danger"></span>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
              <input type="hidden" name="action" id="action" value="email" />
              <input type="submit" name="next" id="next" class="btn btn-primary btn-block" value="Next" />
              
          </div>
          
        
          <!-- /.col -->
        </div>
      </form>
  
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
<script>

$(document).ready(function(){
	$('#login_form').on('submit', function(event){
		event.preventDefault();
		var action = $('#action').val();
		$.ajax({
			url:"login_verify.php",
			method:"POST",
			data:$(this).serialize(),
			dataType:"json",
			beforeSend:function()
			{
				$('#next').attr('disabled', 'disabled');
			},
			success:function(data)
			{
				$('#next').attr('disabled', false);
				if(action == 'email')
				{
					if(data.error != '')
					{
						$('#admin_email_error').text(data.error);
					}
					else
					{
						$('#admin_email_error').text('');
						$('#email_area').css('display', 'none');
						$('#password_area').css('display', '');
					}
				}
				else if(action == 'password')
				{
					if(data.error != '')
					{
						$('#admin_password_error').text(data.error);
					}
					else
					{
						$('#admin_password_error').text('');
						$('#password_area').css('display', 'none');
						$('#otp_area').css('display', '');
					}
				}
				else
				{
					if(data.error != '')
					{
						$('#admin_otp_error').text(data.error);
					}
					else
					{
						window.location.replace("home");
					}
				}

				$('#action').val(data.next_action);
			}
		})
	});
});

</script>
