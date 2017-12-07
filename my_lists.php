<?php
  include_once('PHP/CommonInit.php');

  $BrowserTabTitle = "My Lists";
  include_once('templates/lists/list_head.php');
  include_once('templates/common/header.php');
  include_once('database/ListsFacade.php');

  if(! Session\isLoggedIn()) {
    Session\redirectIndex();
  }
  else {
    $listsDB = new ListsFacade();

    $lists = $listsDB->retrieveAllListsOfUser($_SESSION['username']);
    include_once('templates/lists/my_lists.php');
  }

  include_once('templates/common/footer.php');
?>
