<?php
  include_once('PHP/CommonInit.php');
  include_once('PHP/Regex.php');
  
  $BrowserTabTitle = "Register";
  include_once('templates/accounts/account_head.php');
  include_once('templates/common/header.php');
  
  if(! Session\isLoggedIn())
    include_once('templates/accounts/register.php');

  include_once('templates/common/footer.php');
?>



