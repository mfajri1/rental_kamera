<?php 
  session_start();
  if(empty($_SESSION['username']) && empty($_SESSION['role'])){
    include "login.php";
  }else{
    include "template/header.php";
  }

?>