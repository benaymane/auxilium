<?php
  session_start( );

  $_SESSION["loggedin"] = false;
  session_unset();
  //echo $_SESSION["loggedin"];
  //echo "the fuck";
  header('Location:index.php');
?>
