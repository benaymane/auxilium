<?php
  session_start( );
  $_SESSION["loggedin"] = false;
  session_unset();
  
  header('Location:index.php');
?>
