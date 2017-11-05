<?php
  session_start();
  include_once('PHP/Session.php'); 
  include_once('templates/heads/default_head.php');
  include_once('templates/common/header.php');
  
  if(! Session\isLoggedIn())
    include_once('templates/accounts/register.php');

  include_once('templates/common/footer.php');
?>



