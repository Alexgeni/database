<?php
session_start();
if(isset($_POST['btn-login'])){
  require('connectdb.php');
  require('signin.php');
}
if(isset($_SESSION['data'])){
  echo '<script type="text/javascript">
           window.location = "index.php"
      </script>';
}
$errors=array();

if(isset($_POST['reg'])){
  $sid=$_POST['sid'];
  $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $sname=$_POST['sname'];
  $tname=$_POST['tname'];
  $pword=$_POST['pword'];
  $nid=$_POST['nid'];
  $address=$_POST['address'];
  $phone=$_POST['phone'];
  $tel=$_POST['tel'];
  $email=$_POST['email'];
  $division=$_POST['division'];
  $gender=$_POST['gender'];
  if(strlen($_POST['fname'])<2){
    array_push($errors,"Invalid first name");
  }
  if(strlen($_POST['sname'])<2){
    array_push($errors,"Invalid father's name");
  }
  if(strlen($_POST['lname'])<2){
    array_push($errors,"Invalid last name");
  }
  if(strlen($_POST['tname'])<2){
    array_push($errors,"Invalid title name");
  }
  if(strlen($_POST['pword'])<3){
    echo $pword;
    array_push($errors,"Type a longer password");
  }
  if(strlen($_POST['sid'])<5){
    array_push($errors,"Invalid academic id");
  }
  if(strlen($_POST['nid'])<9){
    array_push($errors,"Invalid national id");
  }
  if(strlen($_POST['gender'])<3){
    array_push($errors,"Invalid Gender selection");
  }
  //if($_POST['division'])=="1"){
  //  array_push($errors,"Invalid division selection");
  //}
  if(strlen($_POST['address'])<3){
    array_push($errors,"please enter your address");
  }
  if(strlen($_POST['phone'])<3){
    array_push($errors,"please enter valid phone");
  }
  if(strlen($_POST['tel'])<3){
    array_push($errors,"please enter valid home phone");
  }
  if(strlen($_POST['email'])<3){
    array_push($errors,"please enter valid Email");
  }
  if(count($errors)>=0){
    require('connectdb.php');
    if (($conn->query("SELECT * FROM `student` WHERE sid = '".$_POST['sid']."'"))->num_rows > 0) {
      array_push($errors,'<span class="text-info">Academic ID already registered</span>');
    }
    if (($conn->query("SELECT * FROM `student` WHERE nid = '".$_POST['nid']."'"))->num_rows > 0) {
      array_push($errors,'<span class="text-info">National ID already registered</span>');
    }
    if (($conn->query("SELECT * FROM `student` WHERE email = '".$_POST['email']."'"))->num_rows > 0) {
      array_push($errors,'<span class="text-info">Email already registered</span>');
    }
    $conn->close();
  }

if(count($errors)==0){
    require('connectdb.php');
    //insert iinto table
   $sql = "INSERT INTO student
    VALUES (
      '".$_POST['sid']."',
      '".$_POST['fname']."',
      '".$_POST['lname']."',
      '".$_POST['sname']."',
      '".$_POST['tname']."',
      '".$_POST['pword']."',
      '".$_POST['tel']."',
      '".$_POST['phone']."',
      '".$_POST['amail']."',
      '".$_POST['email']."',
      '".$_POST['nid']."',
      '".$_POST['address']."',
      '".$_POST['gender']."',
      '".$_POST['division']."',
      '4',
      '0',
      '0',
      '0'
    )";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
  }
}else{
  $sid=$fname=$lname=$sname=$tname=$pword=$nid=$address=$phone=$tel=$email='';
  $division=0;
  $gender=0;
}

 ?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Register new student</title>
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
        <a class="navbar-brand" href="index.php">Project name</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <form class="navbar-form navbar-right" role="form" method="post" id="login-form">
          <div class="form-group">
            <input type="text" placeholder="Academic id" class="form-control" id="sid" name="sid">
            <p id="ierr" class="error text-danger"></p>
          </div>
          <div class="form-group">
            <input type="password" placeholder="Password" class="form-control" id="pword" name="pword">
            <p id="perr" class="error text-danger"></p>
          </div>
          <button type="submit" class="btn btn-success" id="btn-login" name="btn-login">Sign in</button>
        </form>
      </div>
      <!--/.navbar-collapse -->
    </div>
  </nav>

  <div class="container">
    <h1 class="well">Register new student</h1>
    <div class="col-lg-12 well">
      <div class="row">
        <form action="signup.php" method="post">
          <div class="col-sm-12">
            <?php
            if(count($errors)>0){
            echo '<div>
              <div class="alert alert-warning">
              <strong class="text-danger">ERRORS</strong>';
            }
                for($i=0;$i<count($errors);$i++)
                    echo '<p><strong class="text-danger">'.($i+1).'-'.$errors[$i].'</strong></p>';
              if(count($errors)>0){
                    echo '
              </div>
            </div>';}?>
            <div class="row">
              <div class="col-sm-3 form-group">
                <label>First Name</label>
                <input value="<?php echo $fname; ?>" type="text" placeholder="Enter First Name Here.." class="form-control" id="fname" name="fname">
              </div>
              <div class="col-sm-3 form-group">
                <label>Father's Name</label>
                <input value="<?php echo $sname; ?>" type="text" placeholder="Enter Father's Name Here.." class="form-control" id="sname" name="sname">
              </div>
              <div class="col-sm-3 form-group">
                <label>Last Name</label>
                <input value="<?php echo $lname; ?>" type="text" placeholder="Enter Last Name Here.." class="form-control" id="lname" name="lname">
              </div>
              <div class="col-sm-3 form-group">
                <label>Title</label>
                <input value="<?php echo $tname; ?>" type="text" placeholder="Enter Title Name Here.." class="form-control" id="fname" name="tname">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4 form-group">
                <label>Password</label>
                <input type="Password" placeholder="Password .." class="form-control" id="pword" name="pword">
              </div>
              <div class="col-sm-4 form-group">
                <label>Academic id</label>
                <input value="<?php echo $sid; ?>" type="text" placeholder="Academic id Here.." class="form-control" id="fname" name="sid">
              </div>
              <div class="col-sm-4 form-group">
                <label>National id</label>
                <input value="<?php echo $nid; ?>" type="text" placeholder="National id Here.." class="form-control" id="fname" name="nid">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 form-group">
                <label>Gender:</label>
                <select class="form-control" id="fname" name="gender">
                  <option value="0">Select Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
              </select>
              </div>
              <div class="col-sm-6 form-group">
                <label>Division:</label>
                <select class="form-control" id="fname" name="division">
                  <option value="1">Nature science</option>
                  <option value="2">Biology</option>
              </select>
              </div>
            </div>
            <div class="form-group">
              <label>Address</label>
              <textarea placeholder="Enter Address Here.." rows="3" class="form-control" id="fname" name="address"><?php echo $address; ?></textarea>
            </div>

            <div class="row">
              <div class="col-sm-6 form-group">
                <label>Phone Number</label>
                <input value="<?php echo $phone; ?>"  type="text" placeholder="Enter Phone Number Here.." class="form-control" id="fname" name="phone">
              </div>
              <div class="col-sm-6 form-group">
                <label>Home phone Number</label>
                <input value="<?php echo $tel; ?>" type="text" placeholder="Enter Phone Number Here.." class="form-control" id="fname" name="tel">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 form-group">
                <label>Email Address</label>
                <input value="<?php echo $email; ?>"  type="text" placeholder="Enter Email Address Here.." class="form-control" id="fname" name="email">
              </div>
              <div class="col-sm-6 form-group">
                <label>Academic Email Address</label>
                <input disabled type="text" placeholder="Enter Email Address Here.." class="form-control" id="fname" name="amail">
              </div>
            </div>
            <button type="submit" class="btn btn-lg btn-info" name="reg" id="reg">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <hr>
<div class="container">
  <footer>
    <p>&copy; <?php echo date("Y");?></p>
  </footer>
  </div>
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/vendor/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>
