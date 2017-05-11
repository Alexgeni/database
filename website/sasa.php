<?php
$fname = $_POST['fname'];
$sname = $_POST['sname'];
$lname = $_POST['lname'];
$tname = $_POST['tname'];
$tel = $_POST['tel'];
$phone = $_POST['phone'];
$amail = $_POST['amail'];
$email = $_POST['email'];
$sid = $_POST['sid'];
$nid = $_POST['nid'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$did = $_POST['did'];
$cgpa = $_POST['cgpa'];
$pword = $_POST['pword'];

//SERVER connection
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "faculty";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
///////////////////////
//INSERT DATA
$sql = "INSERT INTO student VALUES ('$sid','$fname', '$sname' , '$lname', '$tname', $pword, '$tel', '$phone', '$amail', '$email', '$nid', '$address', '$gender', 0, 0)";
if ($conn->query($sql) === TRUE) {
  echo '<script type="text/javascript">
           window.location = "/profile.php"
      </script>';
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
