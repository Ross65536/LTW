<?php
  include_once('PHP/CommonInit.php');
  
  $BrowserTabTitle = "My Lists";
  include_once('templates/lists/list_head.php');
  include_once('templates/common/header.php');
  include_once('database/ListsFacade.php');

  if(! Session\isLoggedIn()) {
    $_SESSION['error'] = 'not_logged_in';
    include_once('templates/accounts/login.php');
  }
  else {
    $listsDB = new ListsFacade();

    $lists = $listsDB->retrieveAllListsOfUser($_SESSION['username']);
    include_once('templates/lists/my_lists.php');
  }

  include_once('templates/common/footer.php');
?>
