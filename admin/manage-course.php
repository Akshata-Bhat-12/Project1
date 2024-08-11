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
$admin_company = '';


if(isset($_SESSION["admin_name"], $_SESSION["admin_id"]))
{
	$admin_name = $_SESSION["admin_name"];
	$admin_id = $_SESSION["admin_id"];
	
}

?>
<?php
include('../connection.php');
// error_reporting(0);
$select_query = "SELECT * FROM course";  
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
            <h1>Manage Course</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Manage Course</li>
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
                <h3 class="card-title">Manage Course</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="post" id="frm">
                  <div class="row pb-2">
                    <div class="col-lg-6">
                      <a href="javascript:void(0)" class="btn btn-md btn-primary link_delete" onclick="delete_all()">Delete</a>
                    </div>
                    <div class="col-lg-6">  
                         <button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning float-right">Add Course</button>  
                     </div>
                    
                  </div>
                  <div id="course_table"> 
                  
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                     <tr>
                      <th><input type="checkbox" onclick="select_all()"  id="delete"/></th>
                        <th>Course Name</th>  
                        <th>Course Details</th>  
                        <th>Course Fees</th>
                        <th>Course Duration</th>
                        <th>Status</th>
                        <th>Videos</th>
                        <th>Edit</th>
                        <th>View</th>  
                    </tr>
                  </thead>
                  <tbody>
                  <?php
    while($row=mysqli_fetch_assoc($result)){
      ?>
      <tr id="box<?php echo $row['id']?>">
        <td><input type="checkbox" id="<?php echo $row['id']?>" name="checkbox[]" value="<?php echo $row['id']?>"/></td>
          
                                      
                                       <td><?php echo $row["course_name"]; ?></td>  
                                       <td><?php echo $row["course_details"]; ?></td>  
                                        <td><?php echo $row["course_fee"]; ?></td> 
                                         <td><?php echo $row["course_duration"]; ?></td> 
                                          <td><?php echo $row["c_status"]; ?></td> 
                                          <td>
                                              <a href="add-video.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Add Video<i class="mdi mdi-chevron-right"></i></a><br>
                                              <?php
                    
                    include '../connection.php';
$data = mysqli_query($conn,"SELECT * FROM course c, video v WHERE c.id=v.course_id AND c.id='".$row["id"]."'");
                    
                        while( $record = mysqli_fetch_array($data) ) { ?>
            <a   class="btn btn-danger rounded" ><?php echo $record['video_name']; ?></a>
            
            <?php  }?>
                                          
                                          </td>
                                            
                                    <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs edit_data" /></td>  
                                    <td><input type="button" name="view" value="view" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_data" /></td>
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
    $(document).on("click", ".open-AddBookDialog", function () {
     var myBookId = $(this).data('id');
     $(".modal-body .bookId").val( myBookId );
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>



<script>
function select_all(){
  if(jQuery('#delete').prop("checked")){
    jQuery('input[type=checkbox]').each(function(){
      jQuery('#'+this.id).prop('checked',true);
    });
  }else{
    jQuery('input[type=checkbox]').each(function(){
      jQuery('#'+this.id).prop('checked',false);
    });
  }
}

function delete_all(){
  var check=confirm("Are you sure?");
  if(check==true){
    jQuery.ajax({
      url:'course/delete.php',
      type:'post',
      data:jQuery('#frm').serialize(),
      success:function(result){
        jQuery('input[type=checkbox]').each(function(){
          if(jQuery('#'+this.id).prop("checked")){
            jQuery('#box'+this.id).remove();
          }
        });
      }
    });
  }
}

</script>
<script>  
 $(document).ready(function(){  
      $('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      });  
      $(document).on('click', '.edit_data', function(){  
           var id = $(this).attr("id");  
           $.ajax({  
                url:"course/fetch.php",  
                method:"POST",  
                data:{id:id},  
                dataType:"json",  
                success:function(data){  
                      
                     $('#course_name').val(data.course_name);  
                     $('#course_details').val(data.course_details);  
                     $('#course_fee').val(data.course_fee);  
                     $('#course_duration').val(data.course_duration);  
                     $('#c_status').val(data.c_status);  
                     $('#id').val(data.id);  
                     $('#insert').val("Update");  
                     $('#add_data_Modal').modal('show');  
                }  
           });  
      });  
      $('#insert_form').on("submit", function(event){  
           event.preventDefault();  
           
           if($('#course_name').val() == '')  
           {  
                alert("Course Name is required");  
           }  
           
           else if($('#course_details').val() == '')  
           {  
                alert("Course Detail is required");  
           }  
            else if($('#course_fee').val() == '')  
           {  
                alert("Course Fee is required");  
           }  
            else if($('#course_duration').val() == '')  
           {  
                alert("Course Duration is required");  
           }  
            else if($('#c_status').val() == '')  
           {  
                alert("Status is required");  
           }
           else  
           {  
                $.ajax({  
                     url:"course/insert.php", 
                    //  error_reporting(0); 
                     method:"POST",  
                     data:$('#insert_form').serialize(),  
                     beforeSend:function(){  
                          $('#insert').val("Inserting");  
                     },  
                     success:function(data){  
                          $('#insert_form')[0].reset();  
                          $('#add_data_Modal').modal('hide');  
                          $('#course_table').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', '.view_data', function(){  
           var id = $(this).attr("id");  
           if(id != '')  
           {  
                $.ajax({  
                     url:"course/select.php",  
                     method:"POST",  
                     data:{id:id},  
                     success:function(data){  
                          $('#course_detail').html(data);  
                          $('#dataModal').modal('show');  
                     }  
                });  
           }            
      });  
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
<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Course Details</h4>  
                </div>  
                <div class="modal-body" id="course_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>  
 
    <div class="modal fade" id="add_data_Modal">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Course Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" id="insert_form">  
                         <div class="form-group">
                             <label>Course Name</label>
                             <input type="text" name="course_name" id="course_name" class="form-control" />
                         </div>
                         <div class="form-group">
                             <label>Course Details</label>
                             <textarea name="course_details" id="course_details" class="form-control"></textarea> 
                         </div>
                         <div class="form-group">
                             <label>Course Fees</label>  
                             <input type="number" name="course_fee" id="course_fee" class="form-control" /> 
                         </div>
                         <div class="form-group">
                             <label>Course Duration</label>  
                             <input type="text" name="course_duration" id="course_duration" class="form-control" />
                         </div>
                         
                         <div class="form-group">
                             <label>Status</label>  
                             <select name="c_status" id="c_status" class="form-control">
                                 <option value="">change status</option> 
                             
                                <option value="Active">Active</option>  
                                <option value="Inactive">Inactive</option>  
                             </select> 
                         </div>
                         <input type="hidden" name="id" id="id" /> 
                    </div>
            
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" /> 
              </form> 
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
 
 

</body>
</html>
 
 
