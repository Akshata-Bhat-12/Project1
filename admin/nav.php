<nav class="main-header navbar  navbar-expand navbar-info navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="home" class="nav-link">Home</a>
      </li>
  
      </ul>

    <ul class="navbar-nav ml-auto">   
<li class="nav-item dropdown">
        <a class="nav-link btn btn-outline-danger" data-toggle="dropdown" href="#">
          <i class="far fa-user"> <?php echo $admin_name; ?></i>
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          
          <a href="logout" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
        </div>
      </li>

       
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
    </ul>
  </nav>