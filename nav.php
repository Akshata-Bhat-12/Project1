<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
     <a class="navbar-brand" href="./"><img src="img/jnana_logo.png" width="150px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="./">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./#about">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Course
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php
      include_once("connection.php");
      $sql = "SELECT `id`, `course_name`, `course_details`, `course_fee`, `course_duration` FROM course";
      $resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
      
      while( $record = mysqli_fetch_assoc($resultset) ) {
                if(!isset($_SESSION['access_token'])) { ?>

          <a class="dropdown-item" href="<?php echo $google_client->createAuthUrl(); ?>"><?php echo $record["course_name"];?></a></a>

           <?php
                   
                  } else { ?>
                  
                      <a class="dropdown-item" href="course_details.php?id=<?php echo $record['id']; ?>"><?php echo $record["course_name"];?></a>
                     <?php 
                  }
                  ?>
      
                
                <?php  } ?>
                
          
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./#contact" tabindex="-1" aria-disabled="true">contact</a>
      </li>
    </ul>
    <div class="my-2 my-lg-0">

      <?php

//Include Google Configuration File

if(!isset($_SESSION['access_token'])) { ?>
 
  <a href="<?php echo $google_client->createAuthUrl(); ?>" class="rounded btn btn-primary"><i class="fa fa-user mr-2" title="Google"></i>login</a>
  <?php
 
} else {

    $logout='<a href="logout.php" class="btn btn-primary btn-sm">Logout</a>';
    echo $logout;
}
?>
      
      <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
    </div>
  </div>
  </div>
 
</nav>





