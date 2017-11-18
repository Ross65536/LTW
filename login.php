<?php
  include_once('PHP/CommonInit.php');
  
  $BrowserTabTitle = "Login";
  include_once('templates/accounts/account_head.php');
  include_once('templates/common/header.php');

  if(Session\isLoggedIn())
    Session\redirectIndex();
  else
    include_once('templates/accounts/login.php');
  
  include_once('templates/common/footer.php');
?>



