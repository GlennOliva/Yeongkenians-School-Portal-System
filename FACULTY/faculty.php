<!DOCTYPE html>
<html>
<head>
<?php          session_start(); ?>
    <meta charset="utf-8">
    <title>Student Portal</title>

    <link rel="stylesheet" type="text/css" href="css/faculty.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</head>
<body>

    <header class="header">
    <img src="logo.png" alt="">
        
        <a href="">STUDENT PORTAL</a>
        
        <div class="logout">
          <a href>
          <button type="button" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-log-out"></span>
          </button>
          </a>

          </div>
    </header>

    <div class="side-menu">

        <ul>

          <li>
            <a href=""class="ttr-material-button">
              <span class="ttr-icon"><i class="fa fa-home"></i></span>
              <span class="ttr-label">Dashboard</span></a>
          </li>
          <li>
            <a href=""class="ttr-material-button">
              <span class="ttr-icon"><i class="fa fa-user-circle"></i></span>
              <span class="ttr-label">Profile</span></a>
          </li>
          <li>
            <a href="" class="ttr-material-button">
              <span class="ttr-icon"><i class="fa fa-book"></i></span>
                <span class="ttr-label">Schedules</span></a>
          </li>
          <li>
            <a href="" class="ttr-material-button">
              <span class="ttr-icon"><i class="fa fa-trophy"></i></span>
                <span class="ttr-label">Students</span></a>
          
          </li>
            <a href="" class="ttr-material-button">
              <span class="ttr-icon"><i class="fa fa-gear"></i></span>
                <span class="ttr-label">Settings</span></a>
          </li>

        </ul>

      </div>
</body>
</html>