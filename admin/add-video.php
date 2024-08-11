<?php

session_start();

if(!isset($_SESSION["admin_id"]))
{
	header("location:");
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
<?php 
include('../connection.php');
    $id = $_GET['id']; 
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
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
   <style>
      thead input {
        width: 100%;
        padding: 1px;
        box-sizing: border-box;
       
    }
     table.dataTable td {
padding: 2px 2px;
width: 1px;
white-space: nowrap;
}
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<?php include 'nav.php'; ?>

  

    <?php include 'sidebar.php'; ?>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Video</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    
    <!-- Button trigger modal -->




    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row align-item-center justify-content-center">
            <div class="card card-primary  card-outline col-lg-9 col-md-10 col-11">
              <div class="card-header">
                  <h3 class="card-title">Add Video</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 
					<form method="post" enctype="multipart/form-data" >
						<div class="form-group">
							<label>Video Name</label>
							<input type="text" name="video_name" class="form-control" required/>
							
						</div>
						<div class="form-group">
							<label>Video Details</label>
							<input type="text" name="video_details" class="form-control" required />
							
						</div>
						
                <div class="form-group">                          
                                        <label>video file <span class="required-field"></span></label><br>
                                        
                                        <input type="file"  name="video_file" id="video_file" accept="video/mp4,video/x-m4v,video/*"  required/>
                                    </div>

                                    <div class="form-group">                          
                                        <label>Notes</label><br>
                                        
                                        <input type="file"  name="notes" id="notes" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf"/>
                                    </div>
						
						<div class="form-group">
       <input type="submit" name="add_video" class="btn btn-success" value="Click to Add" />
      </div>
					</form>

    
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="plugins/select2/js/select2.full.min.js"></script>
<script src="plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->


</body>
</html>


<?php




if(isset($_POST["add_video"]))
{
    include('../connection.php');
    $video_name= $_POST['video_name'];
    $video_details= $_POST['video_details'];
    //$video_file= $_POST['video_file'];
    
                        $temp = explode(".", $_FILES["video_file"]["name"]);
                         $extension = end($temp);
                         $upload_file= date('dmYHis').str_replace(" ", "", basename($_FILES["video_file"]["name"]));
                         move_uploaded_file($_FILES["video_file"]["tmp_name"],"../course_video/".$upload_file);

                         $temp1 = explode(".", $_FILES["notes"]["name"]);
                         $extension = end($temp1);
                         $upload_notes= date('dmYHis').str_replace(" ", "", basename($_FILES["notes"]["name"]));
                         move_uploaded_file($_FILES["notes"]["tmp_name"],"../course_notes/".$upload_notes);
    
    

   $add_video="INSERT INTO `video`(`video_name`, `video_details`, `video_file`,`note_file`, `course_id`) VALUES ('$video_name','$video_details','$upload_file','$upload_notes','$id')";
    $video_added=mysqli_query($conn,$add_video);
    if ($video_added) {
        echo "<script>alert('Video Added Successfully');window.location='manage-course' </script>";
    } else {
        echo "database connection refused";
    }
}

?>


                        
                     

