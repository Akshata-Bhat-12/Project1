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

$qry = mysqli_query($conn,"SELECT * from course where id='$id'"); // select query
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

<!-- Modal -->
<div class="modal fade" id="addBookDialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg ">
    <div class="modal-content" style="background-image: linear-gradient(to right, rgba(7, 57, 110,.9) , rgba(255, 68, 0,.7));
  -webkit-transform: translateY(-10px);
          transform: translateY(-10px);
  -webkit-box-shadow: rgba(0, 0, 0, 0.17) 0px -25px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
">
      <div class="modal-header">
        <h5 class="modal-title text-white" id="exampleModalLabel">Get a Quote!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
                   
                    <div class="col-xl-6 col-lg-6 col-md-6 col-xs-6">
                       <form method="post" action="" enctype="multipart/form-data">
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

   
<section  class="bg-image" id="about">
<div class="p-5"> 

  <div class="container"> 
    <div class="row">
      <div class="col-lg-8 col-md-8 col-12">
        <div class="card bg-white shadow">
                        <h3 class="card-header text-dark text-center"><?php echo $row['course_name'];?></h3>
                        <div class="card-body">
                            <p><?php echo $row['course_details'];?></p>
                             
                                <?php
                                 include 'connection.php';
$data = mysqli_query($conn,"SELECT * FROM course_request r, course c, video v WHERE r.course_id=c.id AND c.id=v.course_id AND r.google_id='".$_SESSION['google_id']."' AND c.id='".$row["id"]."' AND r.status='Verified'");
// $data = mysqli_query($conn,"SELECT * FROM course c, video v WHERE c.id=v.course_id AND c.id='".$row["id"]."'");
?>
              <h4>Course Videos</h4>
                            <ol>
                    <?php
                        while( $record = mysqli_fetch_array($data) ) { ?>
                        
            <li> <a href="video_details.php?id=<?php echo $record['video_id']; ?>&course_id=<?php echo $record['course_id']; ?>" ><?php echo $record['video_name']; ?></button></li>
            
            <?php  }?>
                               
                            </ol>
                        </div>
                    </div>
    </div>
      <div class="col-lg-4 col-md-4 col-12">
        <div class="card mt-sm-30 p-5 rounded shadow">
                        <!-- RECENT POST -->
                        <div class="mb-3 pb-3">
                            <h4 class="text-center text-dark">Trending courses</h4><hr>
                            <div class="m-10">
                                <?php
      include_once("connection.php");
      $sql = "SELECT `id`, `course_name`, `course_details`, `course_fee`, `course_duration` FROM course";
      $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
      $row_count = 1;
      while( $record = mysqli_fetch_assoc($resultset) ) {
      ?>
                                <div class="clearfix post-recent bg-dark rounded m-4">
                                    <!-- <div class="post-recent-thumb float-left"> <a href="jvascript:void(0)"> <img alt="img" src="images/featured-job/img-1.png" class="img-fluid rounded p-2"></a></div> -->
                                    <div class="post-recent-content float-left"><a href="course_details.php?id=<?php echo $record['id'];?>" class="mt-2"><?php echo $record["course_name"];?></a><span class="text-muted"><?php echo $record["course_duration"];?></span></div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- RECENT POST -->

                        
                        
                        
                    </div>
      </div>

      
    </div>
  </div>
      </div>
      
</section>


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

  </body>
</html>
