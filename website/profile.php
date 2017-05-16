<?php
  session_start();
  if(isset($_POST['btn-logout'])){
  session_unset();
  session_destroy();
  }
  if(isset($_SESSION['data'])){
    //arrays
    $dataTitles=['Full name','National id','Academic id','CGPA','Credit Hours','Home phone','Mobil Phone','Academic mail','E-mail','Gender','Address'];
    $data=$_SESSION['data'];
    $courses=$_SESSION['courses'];
    $division=$_SESSION['division'];
    $div_id=$_SESSION['div_id'];
    $major=$_SESSION['major'];
    $minor=$_SESSION['minor'];
    $bar='<form class="navbar-form navbar-right" role="form" method="post" id="login-form">
      <a class="btn btn-primary" href="profile.php">'.$data[0].'</a>
      <button type="submit" class="btn btn-danger" id="btn-login" name="btn-logout">sign out</button>
    </form>';
  }
  else{
    header("Location: index.php");
    die();
  }
  //////////////on click registration of courses  button///////////////////////
  if(isset($_POST['creg'])){
      require('connectdb.php');
      $q1="DELETE FROM registered_courses WHERE sid='$data[2]'";
      $conn->query($q1);
      $cour_r=$_POST['cour_r'];
      $plus='';
      for($c=0;$c<sizeof($cour_r);$c++){
        $plus.="('$data[2]','".$cour_r[$c]."'),";
      }
      $plus=substr($plus, 0, -1);
      $q2="INSERT INTO registered_courses VALUES $plus";
      $conn->query($q2);
      ///read student courses from registered_courses table
      $sql2 = "SELECT * FROM courses WHERE cid IN (SELECT cid FROM registered_courses WHERE sid = '$data[2]')";
      $result2 = $conn->query($sql2);
      $courses=array();
      if ($result2->num_rows > 0) {
        while ($r=$result2->fetch_assoc()) {
          array_push($courses,[$r['c_code'],$r['name'],$r['hrs']]);
        }
      }
      $_SESSION['courses']=$courses;
      $conn->close();
  }
  //////////////REGISTRATION OF COURSES////////////////////////////
  $courseModal='<div class="container">
  <form method="post">';
  $hasCourses=0;
  $view_courses=array();
  require('connectdb.php');
  $res=$conn->query("SELECT * FROM courses WHERE div_id='$div_id' AND cid NOT IN (SELECT cid FROM finished_courses WHERE sid = '$data[2]')");
  $res2=$conn->query("SELECT * FROM courses WHERE did='$major[1]' AND div_id = '0' AND cid NOT IN (SELECT cid FROM finished_courses WHERE sid = '$data[2]')");
  $res3=$conn->query("SELECT * FROM courses WHERE did='$minor[1]' AND div_id = '0' AND cid NOT IN (SELECT cid FROM finished_courses WHERE sid = '$data[2]')");
  if($res->num_rows>0){
    $hasCourses=1;
    while($row=$res->fetch_assoc()){
      array_push($view_courses, [$row['cid'],$row['c_code'],$row['name'],$row['hrs']]);
    }
  }
  if($res2->num_rows>0){
    $hasCourses=1;
    while($row=$res2->fetch_assoc()){
      array_push($view_courses, [$row['cid'],$row['c_code'],$row['name'],$row['hrs']]);
    }
  }
  if($res3->num_rows>0){
    $hasCourses=1;
    while($row=$res3->fetch_assoc()){
      array_push($view_courses, [$row['cid'],$row['c_code'],$row['name'],$row['hrs']]);
    }
  }
  for($i=0;$i<sizeof($view_courses);$i++){
    $courseModal.='<div class="form-group">
      <label> Code: '.$view_courses[$i][1].' <br>Name: '.$view_courses[$i][2].' <br>Hours: '.$view_courses[$i][3].'</label>
      <input type="checkbox" value="'.$view_courses[$i][0].'" class="checkbox" name="cour_r[]">
    </div>';
  }
$courseModal.='<button class="btn btn-success" type="submit" name="creg">Register Courses</button>
</form>
</div>';
if($hasCourses==0){
  $courseModal = '<p class="text-info">No courses at the moment</p>';
}
$conn->close();
  //////////////REGISTRATION OF DEPARTMENTS////////////////////////////
  if(isset($_POST['jreg'])){
    if(isset($_POST['j_dep_r'])){
      $j_dep_r=$_POST['j_dep_r'];
      require('connectdb.php');
      $conn->query("UPDATE student SET major= '$j_dep_r' WHERE sid = '$data[2]'");
      $d=($conn->query("SELECT * FROM department WHERE did= '$j_dep_r'"))->fetch_assoc();
      $major=[$d['dname'],$d['did']];
      $_SESSION['major']=$major;
    }
  }
  if(isset($_POST['nreg'])){
    if(isset($_POST['n_dep_r'])){
      $n_dep_r=$_POST['n_dep_r'];
      require('connectdb.php');
      $conn->query("UPDATE student SET minor= '$n_dep_r' WHERE sid = '$data[2]'");
      $d=($conn->query("SELECT * FROM department WHERE did= '$n_dep_r'"))->fetch_assoc();
      $minor=[$d['dname'],$d['did']];
      $_SESSION['minor']=$minor;
    }
  }

  if(((int)$data[4])>=30){
    if($major[0]=='0'){
      require('connectdb.php');
      $result=$conn->query("SELECT * FROM department WHERE did IN (SELECT did FROM departmentdivision WHERE div_id = '  $div_id')");
      if($result->num_rows>0){
        $deps=array();
        while ($row=$result->fetch_assoc()) {
          array_push($deps,[$row['did'],$row['dname']]);
        }
      }
      $depModal='<div class="container">
      <form method="post">';
      for($i=0;$i<sizeof($deps);$i++){
        $depModal.='<div class="form-group">
          <label>'.$deps[$i][1].'</label>
          <input type="radio" value="'.$deps[$i][0].'" id="radiodep" name="j_dep_r">
        </div>';
      }
      $depModal.='<button type="submit" name="jreg">register major</button>
      </form>
    </div>';
    $conn->close();
  }else if(((int)$data[4])>=60&&$minor[0]=='0'){
    require('connectdb.php');
    $result=$conn->query("SELECT * FROM department WHERE did IN (SELECT did FROM departmentdivision WHERE div_id = '  $div_id')");
    if($result->num_rows>0){
      $deps=array();
      while ($row=$result->fetch_assoc()) {
        array_push($deps,[$row['did'],$row['dname']]);
      }
    }
    $depModal='<div class="container">
    <form method="post">';
    for($i=0;$i<sizeof($deps);$i++){
      $depModal.='<div class="form-group">
        <label>'.$deps[$i][1].'</label>
        <input type="radio" value="'.$deps[$i][0].'" id="radiodep" name="n_dep_r">
      </div>';
    }
    $depModal.='<button type="submit" name="nreg">register minor</button>
    </form>
  </div>';
  $conn->close();
  }else{
    $depModal='<p>you cannot register departments at the moment . .</p>';
  }
  }else{
    $depModal='<p>you cannot register departments at the moment . .</p>';
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
        <a class="navbar-brand" href="index.php">Project name</a>
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
        <!--p><a class="btn btn-default" href="#" role="button">Edit &raquo;</a></p-->
      </div>
      <div class="col-md-4">
        <h2>Division</h2>
        <dl><dt><?php echo $division; ?></dt></dl>
        <h2>Department</h2>
        <dl>
          <dt>Major</dt>
          <dd><?php echo $major[0]; ?></dd>
          <dt>Minor</dt>
          <dd><?php echo $minor[0]; ?></dd>
        </dl>
        <p><a class="btn btn-default" type="button" data-toggle="modal" data-target="#depModal">Register department &raquo;</a></p>
      </div>
      <div class="col-md-4">
        <h2>Courses this semester</h2>
        <ul class="list-group">
          <?php
            if(sizeof($courses)<1){
              echo '<h3>NO COURSES SUBMITTED</h3>';
            }
            else
            for($i=0;$i<count($courses);$i++){
              echo '<li class="list-group-item">'.$courses[$i][1].' <span class="badge">'.$courses[$i][2].'</span></li>';
            }
           ?>
        </ul>
        <p><a class="btn btn-default" type="button" data-toggle="modal" data-target="#cModal">Register &raquo;</a></p>
      </div>
    </div>
  </div>
  <!-- Modal for departments registeration -->
<div id="depModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Department Registeration</h4>
      </div>
      <div class="modal-body">
        <div class="container">
        <?php echo $depModal; ?>
      </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  <!-- Modal for courses registeration -->
<div id="cModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <?php echo $courseModal; ?>
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
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/vendor/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>
