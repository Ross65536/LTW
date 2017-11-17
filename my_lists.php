<?php
  session_start();

  include_once('PHP/Session.php');
  include_once('templates/heads/default_head.php');
  include_once('templates/common/header.php');
  include_once('database/ListsFacade.php');

  if(! Session\isLoggedIn()) {
    include_once('templates/accounts/login.php');
    $_SESSION['error'] = 'not_logged_in';
  }
  else {
    $listsDB = new ListsFacade();

    $lists = $listsDB->retrieveAllListsOfUser($_SESSION['username']);
    include_once('templates/lists/my_lists.php');
  }

  include_once('templates/common/footer.php');
?>
