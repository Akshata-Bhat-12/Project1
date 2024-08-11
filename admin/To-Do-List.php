<?php

session_start();

if(!isset($_SESSION["admin_id"]))
{
	header("location:../");
}

include('../database_connection.php');

include('function.php');

$admin_name = '';
$admin_id = '';


if(isset($_SESSION["admin_name"], $_SESSION["admin_id"]))
{
	$admin_name = $_SESSION["admin_name"];
	$admin_id = $_SESSION["admin_id"];
	
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Jnana | Admin</title>
  <link rel="shortcut icon" href="../img/favicon.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include'nav.php'?>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include'sidebar.php'?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>To-Do-List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">To-Do-List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
          
          <!-- /.col -->
          <div class="col-md-10">
            <div class="card card-primary">
                <div class="card-header">
                    To-Do-List
                    
                </div>
              <div class="card-body p-3">
                       <form method="post" id="to_do_form">
        <span id="message"></span>
        <div class="row">
            <div class="col-lg-3">
               <div class="input-group">
         <input type="date" name="task_date" id="task_date" class="form-control" autocomplete="off" placeholder="Date" />
         </div> 
            </div>
            <div class="col-lg-9">
                <div class="input-group">
         <input type="text" name="task_name" id="task_name" class="form-control" autocomplete="off" placeholder="Title..." />
         
         <div class="input-group-btn">
          <button type="submit" name="submit" id="submit" class="btn btn-success"><span class="fa fa-plus"></span></button>
         </div>
        </div> 
            </div>
           
        
        </div>
        
        
       </form>
       <br />
       <div class="list-group">
       <?php
			include_once("../connection.php");
			$sql = "SELECT * FROM task_list where admin_id='".$admin_id."' ORDER BY task_list_id DESC";
			$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
			$row_count = 1;
			while( $record = mysqli_fetch_assoc($resultset) ) { 
			 $style = '';
        if($record["task_status"] == 'yes')
        {
         $style = 'text-decoration: line-through; color: #000;';
        }
        echo '<a href="#" style="'.$style.'" class="list-group-item" id="list-group-item-'.$record["task_list_id"].'" data-id="'.$record["task_list_id"].'">'.$record["task_date"].' '.$record["task_details"].'<span class="badge float-right" data-id="'.$record["task_list_id"].'">X</span></a>';
        } ?>
       
       
       </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer text-center">
  
    <strong>Copyright 2021 <a href="https://JNANA.com">JNANA.com</a>.</strong> All rights reserved.
  </footer>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>  
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- Page specific script -->
<script>
 
 $(document).ready(function(){
  
  $(document).on('submit', '#to_do_form', function(event){
   event.preventDefault();

   if($('#task_name').val() == '')
   {
    $('#message').html('<div class="alert alert-danger">Enter Task Details</div>');
    return false;
   }
   else
   {
    $('#submit').attr('disabled', 'disabled');
    $.ajax({
     url:"todo/add_task.php",
     method:"POST",
     data:$(this).serialize(),
     success:function(data)
     {
      $('#submit').attr('disabled', false);
      $('#to_do_form')[0].reset();
      $('.list-group').prepend(data);
       location.reload();
     }
    })
   }
  });

  $(document).on('click', '.list-group-item', function(){
   var task_list_id = $(this).data('id');
   $.ajax({
    url:"todo/update_task.php",
    method:"POST",
    data:{task_list_id:task_list_id},
    success:function(data)
    {
     $('#list-group-item-'+task_list_id).css('text-decoration', 'line-through');
    }
   })
  });

  $(document).on('click', '.badge', function(){
   var task_list_id = $(this).data('id');
   $.ajax({
    url:"todo/delete_task.php",
    method:"POST",
    data:{task_list_id:task_list_id},
    success:function(data)
    {
     $('#list-group-item-'+task_list_id).fadeOut('slow');
    }
   })
  });

 });
</script>
</body>
</html>
