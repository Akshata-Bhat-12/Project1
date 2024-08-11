 <?php  
 if(isset($_POST["bookId"]))  
 {  
      $output = '';  
      include('../../connection.php');  
      $query = "SELECT * FROM video WHERE video_id = '".$_POST["id"]."'";  
      $result = mysqli_query($conn, $query);  
      $output .= '  
      <div class="ratio ratio-16x9">

      ';  
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                

                        <video class="embed-responsive-item" oncontextmenu="return false;" id="my-video-player" controls controlsList="nodownload">
                            <source src="course_video/<?php echo $row['video_file']; ?>" type="video/mp4">
                        </video>  
                 
           ';  
      }  
      $output .= '  
           </div> 
      ';  
      echo $output;  
 }  
 ?>