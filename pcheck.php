<?php
session_start();
$mysqli = new mysqli('localhost', 'root', 'test3','perfectcup');
if($mysqli->connect_error){
  die("Error . (' . $mysqli->connect_errno . ') " . $mysqli->connect_error);
}
$email =  $_POST['email'];
$password = $_POST['password'];
$sql = " SELECT * FROM members WHERE email = '$email' ";
$result = $mysqli->query($sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);
$num_row = mysqli_num_rows($result);
if($num_row >= 1){
  //unhash encrypted password
  if(password_verify($password, $row["password"])){
    $_SESSION['login'] = $row['id'];
    $_SESSION['fname'] = $row['fname'];
    $_SESSION['lname'] = $row['lname'];
    echo "true";
  }else{
    echo "false";
  }
}else{
  echo "false";
}
?>