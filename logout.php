<?php
  session_start();
  if($_SESSION['login']){
    session_destroy();
    header('location:index.php?logout=true');
}
?>