<?php
  session_start();
  include_once('PHP/Session.php'); 
  include_once('templates/heads/default_head.php');
  include_once('templates/common/header.php');
  
  if(Session\isLoggedIn())
  {
    include_once('database/connection.php');
    include_once('database/UsersFacade.php'); 
    
    $usersDB = new UsersFacade($db);
    $username = Session\getLoginUsername();
    $info = $usersDB->getSecondaryInfo($username);

    $name = $info["name"]; //can be ""
    $email = $info["email"];

    include_once('templates/accounts/edit_account.php');
  }

  include_once('templates/common/footer.php');
?>



