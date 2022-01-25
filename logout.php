<?php
  session_start();
  $_SESSION['email'] = null;
  session_destroy($_SESSION);
  unset($_SESSION);
  header("location: main.php");

?>