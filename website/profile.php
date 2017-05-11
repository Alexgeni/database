<?php
  session_start();
  if(isset($_POST['btn-logout'])){
  session_unset();
  session_destroy();
  }
  if(isset($_SESSION['data'])){
    //arrays
    $dataTitles=['Full name','National id','Academic id','CGPA','Home phone','Mobil Phone','Academic mail','E-mail','Gender','Address'];
    $data=$_SESSION['data'];
    $courses=$_SESSION['courses'];
    $bar='<form class="navbar-form navbar-right" role="form" method="post" id="login-form">
      <a class="btn btn-primary">'.$data[0].'</a>
      <button type="submit" class="btn btn-danger" id="btn-login" name="btn-logout">sign out</button>
    </form>';
  }
  else{
    header("Location: index.php");
    die();
  }
  if(isset($_GET['creg'])){

  }else{
    $creg=array();
  }
 ?>
<!DOCTYPE html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>Profile</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" href="apple-touch-icon.png">

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
        <?php echo $bar; ?>
      </div>
      <!--/.navbar-collapse -->
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h2>Your data</h2>
        <dl>
          <?php
            for($i = 0;$i<sizeof($data);$i++){
              echo '<dt>'.$dataTitles[$i].'</dt>';
              echo '<dd>'.$data[$i].'</dd>';
            }
           ?>
        </dl>
        <p><a class="btn btn-default" href="#" role="button">Edit &raquo;</a></p>
      </div>
      <div class="col-md-4">
        <h2>Department</h2>
        <dl>
          <dt>Major</dt>
          <dd>CS</dd>
          <dt>Minor</dt>
          <dd>Statistics</dd>
        </dl>
        <p><a class="btn btn-default" href="#" role="button">Register department &raquo;</a></p>
      </div>
      <div class="col-md-4">
        <h2>Courses this semester</h2>
        <ul class="list-group">
          <?php
            if(count($courses)<1){
              echo '<h3>NO COURSES SUBMITTED</h3>';
            }
            else
            for($i=0;$i<count($courses);$i++){
              echo '<li class="list-group-item">'.$courses[$i].' <span class="badge">2</span></li>';
            }
           ?>
        </ul>
        <p><a class="btn btn-default" type="button" data-toggle="modal" data-target="#myModal">Register &raquo;</a></p>
      </div>
    </div>
  </div>
  <!-- Modal for courses registeration -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  <div class="container">
    <hr>
    <footer>
      <p>&copy; <?php echo date("Y");?></p>
    </footer>
  </div>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="js/vendor/bootstrap.min.js"></script>

  <script src="js/main.js"></script>
</body>

</html>
