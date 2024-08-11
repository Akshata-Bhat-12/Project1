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
<?php
include_once 'connection.php';
$id = $_GET['id'];
$course_id=$_GET['course_id'];

$qry = mysqli_query($conn,"SELECT * FROM course_request r, course c, video v WHERE c.id='$course_id' AND v.video_id='$id' AND c.id=v.course_id AND c.id=r.course_id AND r.google_id='".$_SESSION['google_id']."'AND r.status='Verified'"); // select query

// $qry = mysqli_query($conn,"SELECT * FROM course c, video v WHERE c.id='$course_id' AND v.video_id='$id' AND c.id=v.course_id"); // select query
$row = mysqli_fetch_array($qry);
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
    <!-- Navigation Bar-->
    <?php include"nav.php" ?>

    <section class="section bg-white">
    <div class="bg-image" 
     style="background-image:  url('img/p7.jpg');
            height: 100vh">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 order-1 order-md-1 mt-4 mt-sm-4 pt-2 pt-sm-0">
                    <div class=" bg-dark text-light card rounded shadow">
                        <div class="ratio ratio-4x3">
                        <div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="course_video/<?php echo $row['video_file']; ?>" type="video/mp4" allowfullscreen></iframe>
</div>
                        <!-- <video class="embed-responsive-item" oncontextmenu="return false;" id="my-video-player" controls controlsList="nodownload">
                            <source src="course_video/<?php echo $row['video_file']; ?>" type="video/mp4">
                        </video> -->
                        </div>
                        <div class="p-2 ">
                        <h4><?php echo $row['video_name'];?></h4>
                        <p><?php echo $row['video_details'];?></p>
                        <a class="btn btn-danger btn-md" href="course_notes/<?php echo $row['note_file'];?>" download>download notes</a>
                        </div>
                        
                    </div>

                </div>
                <div class="col-lg-4 col-md-6 col-12 order-2 order-md-2 mt-4 mt-sm-5 pt-2 pt-sm-5">
                    <div class="sidebar bg-light mt-sm-30 p-4 rounded shadow">
                        

                        <!-- RECENT POST -->
                        <div class="widget bg-light mb-4 pb-2">
                            <h4 class="widget-title text-dark text-center">Course Videos</h4><hr>
                            <div class="mt-4 text-dark">
                                <ol>
                                <?php
			include_once("connection.php");
			$sql = "SELECT * FROM video where course_id='".$course_id."'";
            
			$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
       
			$row_count = 1;
			while( $record = mysqli_fetch_assoc($resultset) ) {
               
			?>
            
                                
                                <li><a href="video_details.php?id=<?php echo $record['video_id']; ?>&course_id=<?php echo $record['course_id']; ?>"><?php echo $record["video_name"];?></a></li>
                                
                                <?php } ?>
                                </ol>
                            </div>
                        </div>
                        <!-- RECENT POST -->

                       
                    </div>
                </div><!--end col-->


            </div>
            </div>
    </section>
    <!-- BLOG LIST END -->

    

    <?php include'footer.php' ?>

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

  </body>
</html>
