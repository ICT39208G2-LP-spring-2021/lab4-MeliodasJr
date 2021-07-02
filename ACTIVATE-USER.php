<?php
if (!isset($_SESSION)) {
  session_start();
}
?>

<?php
$token = $_GET['token'];
if($_SESSION['TOKEN'] == $token){
  $database = new mysqli('localhost', 'root', '', 'lab 3');
  $fetchToken = mysqli_query($database, "SELECT * FROM users WHERE EmailVerificationToken = '$token'");
  $changeStatusId = mysqli_query($database, "UPDATE users SET StatusId = '1' WHERE EmailVerificationToken = '$token'");
  echo "Email successfully verified";
}