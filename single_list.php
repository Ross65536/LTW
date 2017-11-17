<?php

  session_start();
  include_once('PHP/Session.php');
  include_once('templates/heads/default_head.php');
  include_once('templates/common/header.php');
  include_once('database/ListsFacade.php');

  $listsDB = new ListsFacade();

  Session\redirectBackIfNotLoggedIn();

  echo '<script src="js/lists/list_item.js"></script>';

  $main_info = $listsDB->getListMainInfo($_GET['id']);
  $creator = $listsDB->displayCreator($_GET['id']);
  $listItems = $listsDB->getListItems($_GET['id']);
  $listUsers = $listsDB->getListUsers($_GET['id']);

  include_once('templates/lists/single_list.php');

  include_once('templates/common/footer.php');
?>
