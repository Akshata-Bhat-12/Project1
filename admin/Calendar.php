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
  <title>Jnana | Admin </title>
  <link rel="shortcut icon" href="../img/favicon.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
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
            <h1>Calendar</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Calendar</li>
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
              <div class="card-body p-3">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
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
  
    <strong>Copyright 2021 <a href="https://adminlte.io">JNANA.com</a>.</strong> All rights reserved.
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
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>  
  
 $(document).ready(function() {  
  var date = new Date();  
  var d = date.getDate();  
  var m = date.getMonth();  
  var y = date.getFullYear();
  var h = date.getHours();
  var m = date.getMinutes();
  var s = date.getSeconds();
  
  var calendar = $('#calendar').fullCalendar({  
   editable: true,  
   header: {  
    left: 'prev,next today',  
    center: 'title',  
    right: 'month,agendaWeek,agendaDay'  
   },  
  
   events: "calender/event.php",  
  
   eventRender: function(event, element, view) {  
    if (event.allDay === 'true') {  
     event.allDay = true;  
    } else {  
     event.allDay = false;  
    }  
   },  
   selectable: true,  
   selectHelper: true,  
   select: function(start, end, allDay) {  
   var title = prompt('Event Title:');  
  
   if (title) {  
   var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");  
   var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");  
   $.ajax({  
       url: 'calender/add_event.php',  
       data: 'title='+ title+'&start='+ start +'&end='+ end,  
       type: "POST",  
       success: function(json) {  
       displayMessage("Added Successfully");  
       }  
   });  
   calendar.fullCalendar('renderEvent',  
   {  
       title: title,  
       start: start,  
       end: end,  
       allDay: allDay  
   },  
   true  
   );  
   }  
   calendar.fullCalendar('unselect');  
   },  
  
   eventDrop: function(event, delta) {  
   var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");  
   var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");  
   $.ajax({  
       url: 'calender/update_event.php',  
       data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,  
       type: "POST",  
       success: function(json) {  
        displayMessage("Updated Successfully");  
       }  
   });  
   },  
   eventClick: function(event) {  
    var decision = confirm("Are you sure wants to delete ?");   
    if (decision) {  
    $.ajax({  
        type: "POST",  
        url: "calender/delete_event.php",  
        data: "&id=" + event.id,  
         success: function(json) {  
             $('#calendar').fullCalendar('removeEvents', event.id);  
              displayMessage("Deleted Successfully");}  
    });  
    }  
    },  
   eventResize: function(event) {  
       var start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");  
       var end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");  
       $.ajax({  
        url: 'calender/update_event.php',  
        data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,  
        type: "POST",  
        success: function(json) {  
         displayMessage("Updated Successfully");  
        }  
       });  
    }  
     
  });  
    
 }); 
 function displayMessage(message) {
        $(".response").html("<div class='success'>"+message+"</div>");
    setInterval(function() { $(".success").fadeOut(); }, 1000);
} 
  
</script>
</body>
</html>
