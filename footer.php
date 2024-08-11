
<footer class="bg-info text-white">
                
                <div class="footer-main footer-main1 ">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-3 col-md-12 ml-2 mr-2 pt-2">
                                <a href="./">
                                    <img class="align-item-center justify-content-center" src="img/jnana_logo.png" alt=" logo"
                                        style="width:150px;">
                                </a><hr>
                                <p class="text-white text-justify">JNANA is an online flatform that focused on education. JNANA is website that offers video courses that are taught by experts.It includes a short video with learning exercises.The flatform provides video tutorials, which are similar to the on-compus discussion group and a textbook. </p>

                            </div>
                            <div class="col-lg-2 col-md-12 ml-2 mr-2">
                                <h5 class="mt-4"><b>Useful Links</b></h5><hr>
                                <ul class="list-unstyled mb-0">
                                    <li><a href="#contact" class="text-white">Contact Us</a></li>
                                    <li><a href="terms_conditions.php" class="text-white">Terms and Conditions</a></li>
                                    <li><a href="privacy_polices.php" class="text-white">Privacy Polices</a></li>
                                </ul>
                            </div>

                            <div class="col-lg-3 col-md-12 ml-2 mr-2">
                                <h5 class="mt-4"><b>Contact</b></h5><hr>
                                <h5>Head Office</h5>
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <a href="#" class="text-white"><i class="fa fa-home mr-3 text-white"></i>
                                            Mangalore, Karnataka -India.</a>
                                    </li>
                                    <li>
                                        <a href="mailto:akshatabhat2001@gmail.com" class="text-white"><i
                                                class="fa fa-envelope mr-3 text-white"></i>
                                                akshatabhat2001@gmail.com </a></li>
                                    <li>
                                        <a href="tel:918073725589" class="text-white"><i
                                                class="fa fa-phone mr-3 text-white"></i> +91 8073725589</a>
                                    </li>
                                </ul>

                            </div>
                            <div class="col-lg-3 col-md-12 ml-2 mr-2">
                                <h5 class="mt-4"><b>Chat & Follow us on</b></h5><hr>
                                <div class="clearfix"></div>
                                <div class="input-group w-100">
                                    <div>
                                        <a
                                            href="https://wa.me/918073725589?text=Hello%20Jnana%20team">
                                            <img src="img/whatsapp_us.png" style="width:200px;"> </a>
                                        <ul class="list-unstyled list-inline mt-7">
                                    <li class="list-inline-item">
                                        <a href="" target="_blank" class="btn-floating btn-sm rgba-white-slight bg-instagram mx-1 waves-effect waves-light">
                                            <h2><i class="fab fa-facebook" aria-hidden="true"></i></h2>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="" target="_blank" class="btn-floating btn-sm rgba-white-slight bg-instagram mx-1 waves-effect waves-light">
                                            <h2><i class="fab fa-twitter"></i></h2>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="" target="_blank"
                                            class="btn-floating btn-sm rgba-white-slight bg-linkedin mx-1 waves-effect waves-light">
                                            <h2><i class="fab fa-linkedin"></i></h2>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="" target="_blank"
                                            class="btn-floating btn-sm rgba-white-slight bg-youtube mx-1 waves-effect waves-light">
                                            <h2><i class="fab fa-youtube"></i></h2>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="" target="_blank"
                                            class="btn-floating btn-sm rgba-white-slight bg-instagram mx-1 waves-effect waves-light">
                                            <h2><i class="fab fa-instagram"></i></h2>
                                        </a>
                                    </li>
                                </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                        
                          
                            
                        </div>
                        <section style="background-color: #0f2448 !important;">
                            <div class="container-fluid">
                        <div class="row p-2" >
                           
                                 <h5 class="text-white">Trending Course</h5>
                        </div>
                        
                        <div class="row p-2">
                            <?php
      include_once("connection.php");
      $sql = "SELECT `id`, `course_name`, `course_details`, `course_fee`, `course_duration` FROM course";
      $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
      
      while( $record = mysqli_fetch_assoc($resultset) ) { ?>
                                
                                                           <p class="text-white"> &nbsp;<?php echo $record['course_name'];?>  &nbsp;| </p>

                                                       <?php } ?>
                                                        </div>
                            
                               
                           </div>
                        </section>
                    </div>
                </div>

            </footer>
  <!-- Main Footer -->
  <footer class="main-footer text-center">
    <!-- Default to the left -->
    <strong>Copyright &copy; 2022 <a href="./">Jnana</a>.</strong> All rights reserved.
   
  </footer>