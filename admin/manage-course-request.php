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
$admin_company = '';


if(isset($_SESSION["admin_name"], $_SESSION["admin_id"]))
{
	$admin_name = $_SESSION["admin_name"];
	$admin_id = $_SESSION["admin_id"];
	
}

?>
<?php
include('../connection.php');
$select_query = "SELECT * FROM course_request";  
$result = mysqli_query($conn, $select_query); 
 
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  
  
  <!-- Theme style -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include'nav.php'?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include 'sidebar.php'?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Course-Request</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Manage Course-Request</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage Course-Request</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="post" id="frm">
                  
                  <div id="course_table"> 
                  
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>User</th>
                        <th>Mobile no</th>
                        <!-- <th>college</th> -->
                        <th>message</th>
                        <th>Course</th>
                        <th>Verify & Assign</th>  
                    </tr>
                  </thead>
                  <tbody>
                  <?php
    while($row=mysqli_fetch_assoc($result)){
      ?>
      <tr id="<?=($row['enquiry_id'])?>">
          
                                      
                                       
                                          <td><?php
			include_once("../connection.php");
			$sql = "select * from users where google_id='".$row['google_id']."'";
			$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
			while( $record = mysqli_fetch_array($resultset) ) { 
            ?>
             <?php echo $record['name']; ?>
            <p></p>
            <br>
            <?php  }
             ?>
            </td>
                                        <td><?php echo $row["mobile_no"]; ?></td> 
                                         <!-- <td><?php echo $row["college"]; ?></td>  -->
                                          <td><?php echo $row["message"]; ?></td>
                                          <td><?php
			include_once("../connection.php");
			$sql = "select * from course where id='".$row['course_id']."'";
			$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
			while( $record = mysqli_fetch_array($resultset) ) { 
            ?>
             <?php echo $record['course_name']; ?>
            <p></p>
            <br>
            <?php  }
             ?>
            </td>
                                    
                                     <td>
            <select  name="changestatus" id="changestatus" class="changestatus">
      
      <option value="<?php echo $row['status']; ?>" disabled selected><?php echo $row['status']; ?></option>
    <option value="Verified">Verified</option>
    <option value="Unverified">Unverified</option>
  </select><br>
           
            </td>      
                                    
                                    </tr>
      <?php
    }
    ?>
                  </tbody>
                  </form>
                  
                </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer text-center">
  
    <strong>Copyright 2021 <a href="https://jnana.com">JNANA.com</a>.</strong> All rights reserved.
  </footer>

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

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->

<script>
    

$(".changestatus").change(function(){
var check=confirm("Are you sure want to Update Status ?");
  if(check==true){
    var elem = $(this),
        selecteditem = elem.val(),
        id = elem.closest('tr').attr('id');

    $.ajax({
        type:"post",
        url:"update_status.php",
        data: {'status':selecteditem, 'id':id},
        success:function(data){
            alert('Successfully updated mysql database');
        }
    });
  }
});
</script>


<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

 

</body>
</html>
 
 
