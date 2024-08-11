<section class="contact p-5 bg-dark" id="contact">

  <div class="container">
      <div class="section-content text-light">
          <h1 class="section-header">Get in <span class="content-header wow fadeIn " data-wow-delay="0.2s" data-wow-duration="2s"> Touch with us</span></h1>
          <h3>Feel free to drop us a line below!</h3>
        </div>
        <hr>
      <div class="row p-3">
              
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
                                    
                                    <div class="input-group mb-4 text-light">
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
                                    

                                <button type="submit"  name="confirm" value="submit" class="btn btn-info">
                                Submit
                            </button>
                            </form>
                </div>
                 <div class="col-xl-6 col-lg-6 col-md-6 col-xs-6">
                    <img class="d-none d-lg-block img-fluid" src="img/about-5.jpg" alt="corporate-image">
                </div>
            </div>
   
</div>
</section>
<?php 
include_once("connection.php");
if(isset($_POST['confirm'])){
$name=$_POST['name'];
$gender=$_POST['gender'];
$email=$_POST['email'];
$number=$_POST['mobile_no'];
$msg=$_POST['message'];
$sql="INSERT INTO `contact`( `name`, `gender`, `email`, `phone_no`, `message`) VALUES ('$name','$gender','$email','$number','$msg')";
$result= mysqli_query($conn, $sql);
   
if($result){
  echo "<script>alert('submit successfully');window.location='./'</script>";
} else {
  echo "Error: " . $sql . "
" . mysqli_error($conn);
}
mysqli_close($conn);
}
?>