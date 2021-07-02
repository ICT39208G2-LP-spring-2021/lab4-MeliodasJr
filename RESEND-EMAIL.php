<?php
if (!isset($_SESSION)) {
  session_start();
}
?>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer(true);

try {
 
  $mail->isSMTP();
  $mail->Host       = 'smtp.gmail.com';
  $mail->SMTPAuth   = true;
  $mail->Username   = '';
  $mail->Password   = '';
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port       = 587;

  $mail->setFrom('', 'Legitimate Business');
  $mail->addAddress($_SESSION['EMAIL']);     

  $mail->isHTML(true);                                 
  $mail->Subject = 'Email verification';
  $mail->Body    = 'Confirm your email by following this link: http://localhost/lab3-Meliodasjr/ACTIVATE-USER.php?token=' . $_SESSION['TOKEN'];
  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  if ($_SESSION['TRIES'] > 0) {
    $mail->send();
    $canSend = 1;
    $_SESSION['TRIES'] -= 1;
  } else {
    $cantSend = 1;
  }
  include 'REGISTER.php';
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
