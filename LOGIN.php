<?php
if (!isset($_SESSION)) {
  session_start();
}
?>

<?php
$database = new mysqli('localhost', 'root', '', 'lab 3');

$emailLogin = $_POST['loginEmail'];
$passwordLogin = $_POST['loginPassword'];

$checkLoginEmail = mysqli_query($database, "SELECT * FROM users WHERE Email = '$emailLogin'");
if (mysqli_num_rows($checkLoginEmail) == 1) {
  $row = $checkLoginEmail->fetch_assoc();
  if (password_verify($passwordLogin, $row['Password']) == 1) {
    if ($row['StatusId'] == 0) {
      include 'REGISTER.php';
      echo "Please activate your account by email.";
    } else {
      $_SESSION['loginUsername'] = $row['FirstName'].' '.$row['LastName'];
      include 'HOME.php';
    }
  } else {
    include 'REGISTER.php';
    echo "The user name or password is incorrect";
  }
} else {
  include 'REGISTER.php';
  echo "The user name or password is incorrect";
}

