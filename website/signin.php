<?php
session_start();
if(isset($_SESSION['data'])){
  header("Location: index.php");
  die();
}
//read student data from student table
$sql = "SELECT * FROM `student` WHERE sid = '".$_POST['sid']."'  AND pword = '".$_POST['pword']."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$data=[$row['fname'].' '.$row['lname'].' '.$row['sname'].' '.$row['tname'],$row['nid'],$row['sid'],$row['cgpa'],$row['tel'],$row['phone'],$row['amail'],$row['email'],$row['gender'],$row['address']];
$_SESSION['data']=$data;
/////////////////////////////////////////////end
//read student courses from r-courses table
$sql2 = "SELECT * FROM `r-courses` WHERE sid = '".$_POST['sid']."'";
$result2 = $conn->query($sql2);
$courses=array();
if ($result2->num_rows > 0) {
  while ($row=$result2>fetch_assoc()) {
    array_push($courses,$row['name']);
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
