<?php

$mysqli = new mysqli('localhost', 'root', 'test3', 'perfectcup');
if($mysqli->connect_error){
  die("Error: (' . $mysqli->connect_errno . ')" . $mysqli->connect_error);
}



?>