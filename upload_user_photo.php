<?php
  include_once('PHP/CommonInit.php');

  $BrowserTabTitle = "Upload Photo";
  include_once('templates/accounts/account_head.php');
  include_once('templates/common/header.php');
  include_once('database/UsersHTMLDecorator.php');

  if(Session\isLoggedIn())
  {
    include_once('database/UsersFacade.php');
    $userDB = new UsersFacade();
    $username = $_SESSION['username'];
    $photo = $userDB->getPhoto($username, "thumbs_medium");
    include_once('templates/accounts/upload_photo.php');
  }

  include_once('templates/common/footer.php');
?>
