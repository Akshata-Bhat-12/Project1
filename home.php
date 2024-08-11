<?php
require_once 'connection.php';
//Include Google Configuration File
include('gconfig.php');

if($_SESSION['access_token'] == '') {     
  header("Location:./");
} 
//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
 //It will Attempt to exchange a code for an valid authentication token.
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

 //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
 if(!isset($token['error']))
 {
  //Set the access token used for requests
  $google_client->setAccessToken($token['access_token']);

  //Store "access_token" value in $_SESSION variable for future use.
  $_SESSION['access_token'] = $token['access_token'];

  //Create Object of Google Service OAuth 2 class
  $google_service = new Google_Service_Oauth2($google_client);

  //Get user profile data from google
  $data = $google_service->userinfo->get();

  //Below you can find Get profile data and store into $_SESSION variable
  if(!empty($data['id']))
  {
   $_SESSION['google_id'] = $data['id'];
   
  }
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
  
  $google_id = $_SESSION['google_id'];
  $name= $_SESSION['user_first_name'];
  $email = $_SESSION['user_email_address'] ;
  $gender= $_SESSION['user_gender'];
  $profile_pic = $_SESSION['user_image'];
  // checking user already exists or not
        $get_user = mysqli_query($conn, "SELECT `google_id` FROM `users` WHERE `google_id`='$google_id'");
        if(mysqli_num_rows($get_user) > 0){
                $_SESSION['login_id'] = $id; 
                header('Location: home');
                exit;
        }
        else{

            // if user not exists we will insert the user
            $insert = mysqli_query($conn, "INSERT INTO `users`(`google_id`,`name`,`email`,`profile_image`) VALUES('$google_id','$name','$email','$profile_pic')");

        }
  
  
 }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="img/favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Jnana</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
     <style>
      
    
   
   
       .morecontent span {
    display: none;
}
.morelink {
    display: block;
}

        
      
   </style>
  </head>
  <body>

<!-- Modal -->
<div class="modal fade" id="addBookDialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg ">
    <div class="modal-content" style="background-image: linear-gradient(to right, rgba(7, 57, 110,.9) , rgba(255, 68, 0,.7));
  -webkit-transform: translateY(-10px);
          transform: translateY(-10px);
  -webkit-box-shadow: rgba(0, 0, 0, 0.17) 0px -25px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
">
      <div class="modal-header">
        <h5 class="modal-title text-white" id="exampleModalLabel">Request for course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
                   
                    <div class="col-xl-6 col-lg-6 col-md-6 col-xs-6">
                       <form method="post" action="home" enctype="multipart/form-data">
                            <input type="hidden" name="bookId" id="bookId" value="">
                            
                            <div class="input-group mb-3">
                                        
                                            <div class="input-group-text">
                                                <i class="fa fa-phone fs-16 lh-0 op-6"></i>
                                            </div>
                                            <input type="tel" name="contact_no" id="contact_no" class="form-control" value="<?php echo !empty($postData['contact_no'])?$postData['contact_no']:''; ?>" pattern="[6789][0-9]{9}" placeholder="Contact Number" required="">
                                    </div>
                                    <div class="input-group mb-4">
                                        
                                        <div class="input-group-text">
                                            <i class="fa fa-paper-plane fs-16 lh-0 op-6"></i>
                                        </div>
                                    
                                    <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                                    </div>
                            
                                    
                            <!--<div class="form-group app-label mt-3">-->
                            <!--    <div class="row">-->
                            <!--        <div class="col-lg-4">-->
                            <!--            <label class="text-muted" for="attachment">JD Attachment :</label>-->
                            <!--        </div>-->
                            <!--        <div class="col-lg-8">-->
                            <!--            <input type="file" name="attachment" id="attachment" class="form-control">-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            
                            
                            <div class="submit">
                                <input type="submit" name="submit" class="btn btn-dark" value="SUBMIT">

                            </div>
            </form>
                    </div>
                     <div class="col-xl-6 col-lg-6 col-md-6 col-xs-6 justify-content-center align-items-center">
                        <img class="img-fluid" src="img/jnana_logo.png" alt="corporate-image">
                    </div>
                </div>
        </div>         
      </div>
    </div>
  </div>
</div>



    <?php include 'nav.php'?>

    <!-- Start Home -->
<section class="bg-home1">
  <div class="overlay"></div>
  <!-- The HTML5 video element that will create the background video on the header -->
  <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
      <source src="img/video.mp4" type="video/mp4">
  </video>
  <!-- The header content -->
  <div class="container h-100">
      <div class="d-flex h-100 text-center align-items-center">
          <div class="w-100 text-white">
              <!-- <h5>BEST ONLINE COURSES</h5> -->
        <h1>Welcome To Jnana</h1>
        <h3>Take The First step To Knowledge With Us.</h3>
        <h5><p>If you're new to online learning and not sure where to start, you're not alone.<br> We've curated a collection of courses for professionals. Take one of these courses and learn new skills.<br> The JNANA can offer you to enjoy the beauty of learning.</p></h5>
          </div>
      </div>
  </div>
</section>
<!-- end home -->

<section class="about p-5 p-md-5 m-md-3 text-center bg-info" id="about">
  <div class="container-fluid">
  
    <div class="row">
      <div class="col-lg-6 col-md-6 col-12 mt-sm-5">
        <h1 class="display-5 fw-bold lh-0 mb-1 px-4 py-4 ">About JNANA</h1>
        <p class="lead">JNANA is an online flatform that focused on education.<br>JNANA is website that offers video courses that are taught by experts.<br>It includes a short video with learning exercises.The flatform provides video tutorials, which are similar to the on-compus discussion group and a textbook. </p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          
      </div>
    </div>
      <div class="col-lg-6 col-md-6 col-12 pt-5 pt-sm-5">
        <img src="img/about-4.jpg" class="d-none d-lg-block img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
      </div>

</div>
    </div>
 
</section>


<section class="course p-5 bg-dark">

  <div class="container-fluid px-4 py-5">
    <div class="pb-2 border-bottom text-center bg-trans text-white">
      <h3>Trending Course</h3>
    </div>
    <div class="row">
       <?php
      include_once("connection.php");
      $sql = "SELECT `id`, `course_name`, `course_details`, `course_fee`, `course_duration` FROM course";
      $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
      
      while( $record = mysqli_fetch_assoc($resultset) ) { ?>
      <div class="col-lg-3 col-md-4 col-xs-12">
        <div class="card shadow">
          <div class="card-img-top">
            <img src="img/v1.jpg" alt="card-img-top" class="card-img-top">
          </div>
          <div class="card-body">
            <div class="course_details">
              <h5 class=""><?php echo $record["course_name"];?></h5>
              <p class="card-text more"><?php echo $record["course_details"];?></p> 
            </div>
          </div>
          <div class="card-footer">
              <div class="row text-center">
             <?php
                                               $get_request = mysqli_query($conn, "SELECT * FROM `course_request` WHERE `course_id`='".$record["id"]."' AND google_id='".$_SESSION['google_id']."' AND `status`='verified'");
                                                    if(mysqli_num_rows($get_request) > 0){?>
                                                    <a href="course_details.php?id=<?php echo $record['id'];?>"class="btn btn-primary btn-sm">Open</a>
                                                    <?php
                                                    }
                                                    else{?>
                                                     <a data-toggle="modal" data-id="<?php echo $record["id"];?>" title="Add this item" class="open-AddBookDialog btn btn-info rounded btn-sm" data-target="#addBookDialog" href="#addBookDialog">Enroll</a>
                                                   <?php
                                            
                                                    }
                                                    
                                                    ?>
            </div>
          </div>          
        </div>
      </div>
      <?php  } ?>
    </div>
  </div>
                                                 
</section>

  
  

<section class="section p-5 bg-info">

  <div class="container px-4 py-5" id="icon-grid">
    <h2 class="pb-2 border-bottom text-center bg-dark text-white">FEATURES</h2>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
      <div class="col d-flex align-items-start">
        <span class="fas fa-home fa-2x text-muted me-3 "></span>
        <div>
          <h4 class="fw-bold mb-0">Easy Learning</h4>
          <p>Easliy access the course in anytime and learn from anywhere.</p>
        </div>
      </div>
      <div class="col d-flex align-items-start">
        <span class="fa fa-envelope fa-2x text-muted me-3 "></span>
        <div>
          <h4 class="fw-bold mb-0">Login for course</h4>
          <p>Learner can get access to any content of the JNANA website limitlessly with a single google login.</p>
        </div>
      </div>
      <div class="col d-flex align-items-start">
        <span class="fa fa-pen fa-2x text-muted me-3 "></span>
        <div>
          <h4 class="fw-bold mb-0">Free accessibility</h4>
          <p>Jnana provide a best free online courses.</p>
        </div>
      </div>
      <div class="col d-flex align-items-start">
        <span class="fas fa-video fa-2x text-muted me-3 "></span>
        <div>
          <h4 class="fw-bold mb-0">Recorded lessons</h4>
          <p>Learn 24*7 from pre-recorded video lessons on the website.</p>
        </div>
      </div>
      <div class="col d-flex align-items-start">
        <span class="fas fa-mobile fa-2x text-muted me-3 "></span>
        <div>
          <h4 class="fw-bold mb-0">Responsive</h4>
          <p>This website is mobile-friendly. Users now want the flexibility of accessing a website from anywhere and across devices.</p>
        </div>
      </div>
      <div class="col d-flex align-items-start">
        <span class="fas fa-user fa-2x text-muted me-3 "></span>
        <div>
          <h4 class="fw-bold mb-0">Quick User Integration</h4>
          <p>Quick and smooth user integration can impact a user's choice of the learning platform.</p>
        </div>
      </div>
      <div class="col d-flex align-items-start">
        <span class="fas fa-car fa-2x text-muted me-3 "></span>
        <div>
          <h4 class="fw-bold mb-0">Reporting and Data Analysis</h4>
          <p>Learning analytics can reveal how a course participant is performing today, and this can predict performance..</p>
        </div>
      </div>
      <div class="col d-flex align-items-start">
        <span class="fas fa-water fa-2x text-muted me-3 "></span>
        <div>
          <h4 class="fw-bold mb-0">Easy Enrollment</h4>
          <p>User Request for enrollment and waits for approval.</p>
        </div>
      </div>
    </div>
  </div>
                                                  
</section>



<?php include 'contact.php'?>
<?php include 'footer.php'?>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->

    <script>
    $(document).on("click", ".open-AddBookDialog", function () {
     var myBookId = $(this).data('id');
     $(".modal-body #bookId").val( myBookId );
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script>

<script>
    $(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 80;  // How many characters are shown by default
    var ellipsestext = "";
    var moretext = "Read More";
    var lesstext = "Read Less";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span><a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
</script>
  </body>
</html>

<?php
$postData = $uploadedFile = $statusMsg = '';
$msgClass = 'errordiv';
if(isset($_POST['submit'])){
    // Get the submitted form data
    $postData = $_POST;
    
    $course_id= $_POST['bookId'];
    $google= $_SESSION['google_id'];
    $name =$_SESSION['user_first_name'];
    $email = $_SESSION['user_email_address'];
    $contact_no =$_POST['contact_no'];
    
    $message =$_POST['message'];
    $status= 'waiting';
    
     
    
    // Check whether submitted data is not empty
    if( !empty($contact_no)){
        
        // Validate email
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
            $statusMsg = 'Please enter your valid email.';
        }else{
            $uploadStatus = 1;
            
            // Upload attachment file
            if(!empty($_FILES["attachment"]["name"])){
                
                // File path config
                $targetDir = "uploads/";
                $fileName = basename($_FILES["attachment"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                
                // Allow certain file formats
                $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg');
                if(in_array($fileType, $allowTypes)){
                    // Upload file to the server
                    if(move_uploaded_file($_FILES["attachment"]["tmp_name"], $targetFilePath)){
                        $uploadedFile = $targetFilePath;
                    }else{
                        $uploadStatus = 0;
                        $statusMsg = "Sorry, there was an error uploading your file.";
                    }
                }else{
                    $uploadStatus = 0;
                    $statusMsg = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.';
                }
            }
            
            if($uploadStatus == 1){
                
               
      
      
                
                // Recipient
                $toEmail = 'kgsanjay.kallabbe@gmail.com';

                // Sender
                $from = 'info@jnana.com';
                $fromName = 'Jnana | Course Request';
                
                // Subject
                $emailSubject = 'Course Request by'.$name;
                
                // Message 
                $htmlContent = '<h2 style="color: blue;"><u>Requesting User Details</u></h2>
                    <p><b>Name:</b> '.$name.'</p>
                    <p><b>Email:</b> '.$email.'</p>
                    <p><b>Contact Number:</b> '.$contact_no.'</p>
                    
                    <p><b>Message:</b> '.$message.'</p>
                    <p><b>Course Name:</b> '.$course_name.'</p><hr>'
                    ;
                
                // Header for sender info
                $headers = "From: $fromName"." <".$from.">";

                if(!empty($uploadedFile) && file_exists($uploadedFile)){
                    
                    // Boundary 
                    $semi_rand = md5(time()); 
                    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 
                    
                    // Headers for attachment 
                    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
                    
                    // Multipart boundary 
                    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
                    "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 
                    
                    // Preparing attachment
                    if(is_file($uploadedFile)){
                        $message .= "--{$mime_boundary}\n";
                        $fp =    @fopen($uploadedFile,"rb");
                        $data =  @fread($fp,filesize($uploadedFile));
                        @fclose($fp);
                        $data = chunk_split(base64_encode($data));
                        $message .= "Content-Type: application/octet-stream; name=\"".basename($uploadedFile)."\"\n" . 
                        "Content-Description: ".basename($uploadedFile)."\n" .
                        "Content-Disposition: attachment;\n" . " filename=\"".basename($uploadedFile)."\"; size=".filesize($uploadedFile).";\n" . 
                        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
                    }
                    
                    $message .= "--{$mime_boundary}--";
                    $returnpath = "-f" . $email;
                    
                    // Send email
                    $mail = mail($toEmail, $emailSubject, $message, $headers, $returnpath);
                    
                    
                    // Delete attachment file from the server
                    // @unlink($uploadedFile);
                }else{
                     // Set content-type header for sending HTML email
                    $headers .= "\r\n". "MIME-Version: 1.0";
                    $headers .= "\r\n". "Content-type:text/html;charset=UTF-8";
                    
                    // Send email
                    $mail = mail($toEmail, $emailSubject, $htmlContent, $headers);
                    include('connection.php');
     $add_college="INSERT INTO `course_request`(`course_id`, `google_id`, `mobile_no`, `message`,`status`) VALUES ('$course_id','$google','$contact_no','$message','$status')";
    $sql=mysqli_query($conn,$add_college);
                    
                }
                 if ($sql) {
        echo "<script>alert('Requested Successfully... Our Representative will get back to you in shortly...');window.location='home' </script>";
    } else {
        echo "database connection refused";
    }
                
                // If mail sent
                if($mail){
                    $statusMsg = 'Your contact request has been submitted successfully !';
                    $msgClass = 'succdiv';
                    
                    $postData = '';
                }else{
                    $statusMsg = 'Your contact request submission failed, please try again.';
                }
            }
        }
    }else{
        $statusMsg = 'Please fill all the fields.';
    }
}
?>