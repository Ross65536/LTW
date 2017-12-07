<?php
  include_once('PHP/CommonInit.php');
  
  $BrowserTabTitle = "Edit Account";
  include_once('templates/accounts/account_head.php');
  include_once('templates/common/header.php');
  include_once('database/UsersHTMLDecorator.php');

  if(Session\isLoggedIn())
  {
    include_once('database/UsersFacade.php'); 
    
    $usersDB = new UsersHTMLDecorator(new UsersFacade());
    $username = Session\getHTMLLogin();
    $info = $usersDB->getSecondaryInfo(Session\getLoginUsername());
    $name = $info["name"]; //can be ""
    $email = $info["email"];

    include_once('templates/accounts/edit_account.php');
  }

  include_once('templates/common/footer.php');
?>



