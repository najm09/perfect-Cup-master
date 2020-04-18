<?php

$mysqli = new mysqli('localhost', '', '', '');
if($mysqli->connect_error){
  die("Error: (' . $mysqli->connect_errno . ')" . $mysqli->connect_error);
}
$fname = mysqli_real_escape_string($mysqli, $_POST['fname']);
$email = mysqli_real_escape_string($mysqli, $_POST['email']);
$message =  mysqli_real_escape_string($mysqli, $_POST['message']);
$email2 = "";
$subject = "users comment";

if(strlen($fname) < 2){
  echo "fname_short";
}else if(strlen($fname) > 50){
  echo "fname_long";
}else if(strlen($email) > 50){
  echo "email_long";
}else if(strlen($email) < 2){
  echo "email_short";
}else if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
  echo "eformat";
}else if(strlen($message) > 500){
  echo "message_long";
}else if(strlen($message) < 2){
  echo "message_short";
}else{
  require 'phpmailer/PHPMailerAutoload.php';
  $mail = new PHPMailer;
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = '';
  $mail->Password = '';
  $mail->SMTPSecure = 'tls';
  
  $mail->Port = 587;
  $mail->AddReplyTo($email);
  $mail->From = $email2;
  $mail->FromName = $fname;
  $mail->addAddress('', '');
  
  $mail->isHTML(true);

  $mail->Subject = $subject;
  $mail->Body = $message;
  $mail->AltBody = 'this is the body in plane text for non-HTML mail clients';
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;

  if(!$mail->send()){
    echo "message could not be sent.";
    echo "Mailer Error:".$mail->ErrorInfo;
  }else{
    echo 'true';
  }
}
?>