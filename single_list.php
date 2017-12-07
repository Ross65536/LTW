<?php

  include_once('PHP/CommonInit.php');

  $BrowserTabTitle = "List";
  include_once('templates/lists/list_head.php');
  include_once('templates/common/header.php');
  include_once('database/ListsFacade.php');
  include_once('database/ListsHTMLDecorator.php');
  
  $listsDB = new ListsHTMLDecorator(new ListsFacade());

  if(! Session\isLoggedIn()) {
    include_once('templates/accounts/login.php');
    $_SESSION['error'] = 'not_logged_in';
  }

  echo '<script src="js/lists/common_functions.js"></script>';
  echo '<script src="js/lists/update_elements.js"></script>';

  $main_info = $listsDB->getListMainInfo($_GET['id']);
  $creator = $listsDB->displayCreator($_GET['id']);
  $listItems = $listsDB->getListItems($_GET['id']);
  $listUsers = $listsDB->getListUsers($_GET['id']);

  include_once('templates/lists/single_list.php');

  include_once('templates/common/footer.php');
?>
