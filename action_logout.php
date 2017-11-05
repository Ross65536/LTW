<?php
  session_start();
  include_once('PHP/Session.php'); 

  Session\logOut();

  Session\redirectBack();
?>



