<?php
  session_start();
  include_once('PHP/Session.php');

  Session\logOut();

  header('Location : index.php');
?>
