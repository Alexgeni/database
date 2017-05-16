<?php
session_start();
if(isset($_POST['btn-login'])){
  require('connectdb.php');
  require('signin.php');
}
if(isset($_POST['btn-logout'])){
session_unset();
session_destroy();
}
  if(isset($_SESSION['data'])){
    $data=$_SESSION['data'];
    $cont= '<h1>Hello, '.$data[0].'!</h1>
    <a class="btn btn-primary btn-lg" href="profile.php" role="button">Profile &raquo;</a></p>';
    $bar='<form class="navbar-form navbar-right" role="form" method="post" id="login-form">
      <a class="btn btn-primary" href="profile.php">'.$data[0].'</a>
      <button type="submit" class="btn btn-danger" id="btn-login" name="btn-logout">sign out</button>
    </form>';
  }
  else{
    $bar='<form class="navbar-form navbar-right" role="form" method="post" id="login-form">
      <div class="form-group">
        <input type="text" placeholder="Academic id" class="form-control" id="sid" name="sid">
        <p id="ierr" class="error text-danger"></p>
      </div>
      <div class="form-group">
        <input type="password" placeholder="Password" class="form-control" id="pword" name="pword">
        <p id="perr" class="error text-danger"></p>
      </div>
      <button type="submit" class="btn btn-success" id="btn-login" name="btn-login">Sign in</button>
    </form>';
    $cont='<h1>Hello, Welcome to faculty web site!</h1>
    <p>New student? sign up now</p>
    <p><a class="btn btn-primary btn-lg" href="signup.php" role="button">Sign up &raquo;</a></p>';
  }
  ?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <title>Home page</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
    body {
      padding-top: 50px;
      padding-bottom: 20px;
    }
  </style>
  <link rel="stylesheet" href="css/main.css">
</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <a class="navbar-brand" href="#">Project name</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
      <!-- loginform -->
        <?php echo $bar ;?>
      </div>
    </div>
  </nav>
  <div class="jumbotron">
    <div class="container">
      <?php echo $cont; ?>
    </div>
  </div>

  <div class="container">
    <hr>
    <footer>
      <p>&copy;  <?php echo date("Y");?></p>
    </footer>
  </div>
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/vendor/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>
<?php

?>
