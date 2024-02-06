<!DOCTYPE html>
<html lang="en">
  <?php          session_start(); ?>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Dashboard</title>
  </head>
  <body>
  
      <header>
          <img src="images/logo.png" alt="">
          <a href="studenthome.html">STUDENT PORTAL</a>
          <div class="logout">
            <a href="index.php">
              <span class="ttr-icon"><i class="fa fa-sign-out"></i></span>
            </a>
  
            </div>
      </header>
  
      <main>
           <!--  include the sidebar-->
           <?php include 'sidebar.php'; ?>
  
          <section>
      <div class="container-fluid">
        <div>
          <h4>
            <span><i class="fa fa-user-circle"></i>
            <?php 
                            // Access the session variable and echo the logged-in user
         
                            echo "Hi " . $_SESSION['user_identifier'] . "!"; 
                        ?>
          </h4>
          <hr>
          </div>
      
      <div class="row">
      <div class="col-md-6 col-log-3 col-xl-3 col-sm-6 col-12">
        <div class="widget-card widget-bg1">
          <div class="wc-item">
            <h4 class="wc-title">2023-2024</h4>
              <span class="wc-des">Current Academic Year</span>
              <span class="wc-stats">
              <i class="fa fa-calendar"></i></span>
              </i>
            </span>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-log-3 col-xl-3 col-sm-6 col-12">
        <div class="widget-card widget-bg2">
          <div class="wc-item">
            <h4 class="wc-title">FIRST</h4>
              <span class="wc-des">Current Semester</span>
              <span class="wc-stats">
              <i class="fa fa-bars"></i></span>
              </i>
            </span>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-log-3 col-xl-3 col-sm-6 col-12">
        <div class="widget-card widget-bg3">
          <div class="wc-item">
            <h4 class="wc-title">Enrolled</h4>
              <span class="wc-des">Status</span>
              <span class="wc-stats">
              <i class="fa fa-check-circle-o"></i></span>
              </i>
            </span>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-log-3 col-xl-3 col-sm-6 col-12">
        <div class="widget-card widget-bg4">
          <div class="wc-item">
            <h4 class="wc-title">STEM-12th</h4>
              <span class="wc-des">Strand & Grade Level</span>
              <span class="wc-stats">
              <i class="fa fa-graduation-cap"></i></span>
              </i>
            </span>
          </div>
        </div>
      </div>
    </section>
  </main>
</body>
</html>