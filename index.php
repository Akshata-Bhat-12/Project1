<?php

  //Include Google Configuration File
  include('gconfig.php');

  if(!isset($_SESSION['access_token'])) {
   //Create a URL to obtain user authorization
   $google_login_btn = '<a href="'.$google_client->createAuthUrl().'" class="rounded"><i class="mdi mdi-google" title="Google"></i></a>';
  } else {

    header("Location: home");
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
        <h5 class="modal-title text-white" id="exampleModalLabel">Get a Quote!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
                   
                    <div class="col-xl-6 col-lg-6 col-md-6 col-xs-6">
                        <form action="" method="POST" class="contact-us-form" >
                            <input type="hidden" name="bookId" id="bookId" value="">
                            <div class="input-group mb-4">
                              <div class="input-group-text">
                                <i class="fa fa-user fs-16 lh-0 op-6"></i>
                              </div>
                              <input type="text" class="form-control" name="name" placeholder="Enter Full Name" required>
                            </div>
                            
                            
                                <div class="input-group mb-3">
                                        
                                            <div class="input-group-text">
                                                <i class="fa fa-envelope fs-16 lh-0 op-6"></i>
                                            </div>
                                        
                                        <input type="email" class="form-control" name="email" placeholder="Email"
                                            required>
                                    </div>
                                    <div class="input-group mb-3">
                                        
                                            <div class="input-group-text">
                                                <i class="fa fa-phone fs-16 lh-0 op-6"></i>
                                            </div>
                                        <input type="text" maxlength="10" pattern="\d{10}" class="form-control" name="mobile_no"
                                            placeholder="Enter 10 Digit Mobile No." required>
                                    </div>
                                    
                                    <div class="input-group mb-4">
                                        
                                            <div class="input-group-text">
                                                <i class="fa fa-paper-plane fs-16 lh-0 op-6"></i>
                                            </div>
                                        
                                        <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                                        </div>
                                        <div class="input-group mb-4">
                                    <div class="input-group-text">
                                            <i class="fa fa-check fs-16 lh-0 op-6"></i>
                                        </div>
                                    
                                    
                                    <div class="form-check form-check-inline" style="padding-left:15px;">
  <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male">
  <label class="form-check-label" for="inlineRadio1">male</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female">
  <label class="form-check-label" for="inlineRadio2">female</label>
</div>
</div>
                                    <button type="submit"  name="confirm" value="submit" class="btn btn-dark">
                                    Submit
                                </button>
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
      <source src="img/url3.mp4" type="video/mp4">
  </video>
  <!-- The header content -->
  <div class="container h-100">
      <div class="d-flex h-100 text-center align-items-center">
          <div class="w-100 text-white">
              <!-- <h5>BEST ONLINE COURSES</h5> -->
        <h1>The Best Online Learning Patform.</h1>
        <h4><p>Learners around the world are launching new careers, advancing in their fields, and enriching their lives.Propel your career and expand your knowledge at any level.</p></h4>
          </div>
      </div>
  </div>
</section>
<!-- end home -->

<section class="about p-5 p-md-5 m-md-3 text-center bg-info" id="about">

  <div class="container-fluid"> 
    <div class="row">
      <div class="col-lg-6 col-md-6 col-12 mt-sm-5">
        <h3>About</h3>
        <h1 class="display-5 fw-bold lh-1 mb-3">WELCOME TO JNANA</h1>
        <p class="lead">JNANA is an online flatform that focused on education.<br>JNANA is website that offers video courses that are taught by experts.It includes a short video with learning exercises.The flatform provides video tutorials, which are similar to the on-compus discussion group and a textbook. </p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          <a data-toggle="modal" data-id="Get a Quote" class="open-AddBookDialog btn btn-dark rounded px-4 py-3" data-target="#addBookDialog" href="#addBookDialog"><b>Get a Quote !</b></a>
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
    <div class="pb-2 border-bottom text-center text-white">
      <h3>Trending Course</h3>
    </div>
    <div class="row p-3">
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
              <div class="col-lg-6"><a href="<?php echo $google_client->createAuthUrl(); ?>" class="btn btn-danger btn-xs px-3">More Details</a></div>
              <div class="col-lg-6"><a data-toggle="modal" data-id="contact now-<?php echo $record["course_name"];?>" class="open-AddBookDialog btn btn-info rounded btn-xs" data-target="#addBookDialog" href="#addBookDialog"><b>Contact now</b></a></div>
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
        <span class="fas fa-home fa-2x text-muted me-3 text-dark"></span>
        <div>
          <h4 class="fw-bold mb-0">Easy Learning</h4>
          <p>Easliy access the course in anytime and learn from anywhere.</p>
        </div>
      </div>
      <div class="col d-flex align-items-start">
        <span class="fas fa-envelope fa-2x text-muted me-3 "></span>
        <div>
          <h4 class="fw-bold mb-0">Login for course</h4>
          <p>Learner can get access to any content of the JNANA website limitlessly with a single goolge login.</p>
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