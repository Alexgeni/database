<?php
session_start();
if(isset($_SESSION['data'])){
  header("Location: index.php");
  die();
}
////////////////read student data from student table////////////
$sql = "SELECT * FROM `student` WHERE sid = '".$_POST['sid']."'  AND pword = '".$_POST['pword']."'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
$row = $result->fetch_assoc();
$data=[
$row['fname'].' '.$row['lname'].' '.$row['sname'].' '.$row['tname'],
$row['nid'],
$row['sid'],
$row['cgpa'],
$row['hrs'],
$row['tel'],
$row['phone'],
$row['amail'],
$row['email'],
$row['gender'],
$row['address']
];
////////read division/////////////////
$divrow=($conn->query("SELECT div_name FROM division WHERE div_id='".$row['div_id']."'"))->fetch_assoc();
///////read department major//////////
$res=$conn->query("SELECT * FROM department WHERE did= '".$row['major']."'");
if($res->num_rows>0){
  $m=$res->fetch_assoc();
  $_SESSION['major']=[$m['dname'],$m['did']];
}
else{
  $_SESSION['major']=["0","0"];
}
///////read department minor//////////
$res=$conn->query("SELECT * FROM department WHERE did= '".$row['minor']."'");
if($res->num_rows>0){
  $m=$res->fetch_assoc();
  $_SESSION['minor']=[$m['dname'],$m['did']];
}
else{
  $_SESSION['minor']=["0","0"];
}
$division=$divrow['div_name'];
$_SESSION['division']=$division;
$_SESSION['div_id']=$row['div_id'];
$_SESSION['data']=$data;
///read student courses from registered_courses table
$sql2 = "SELECT * FROM courses WHERE cid IN (SELECT cid FROM registered_courses WHERE sid = '".$_POST['sid']."')";
$result2 = $conn->query($sql2);
$courses=array();
if ($result2->num_rows > 0) {
  while ($r=$result2->fetch_assoc()) {
    array_push($courses,[$r['c_code'],$r['name'],$r['hrs']]);
  }
}
$_SESSION['courses']=$courses;
//////////////////////////////////////////////////////end
} else {
  echo '<div class="alert alert-danger alert-dismissable fade in" style="position:absolute;right:0">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Danger! </strong>Wrong id or password.
</div>';
}
$conn->close();
?>
