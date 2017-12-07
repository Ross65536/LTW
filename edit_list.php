<?php
  include_once('PHP/CommonInit.php'); 

  $BrowserTabTitle = "Edit List";
  include_once('templates/lists/list_head.php');
  include_once('templates/common/header.php');
  include_once('database/ListsFacade.php');

  $listDB = new ListsFacade();

  if(! Session\isLoggedIn()) {
    include_once('templates/accounts/login.php');
    $_SESSION['error'] = 'not_logged_in';
  }
  else {
    echo '<script src="js/lists/common_functions.js"></script>';
    echo '<script src="js/lists/edit_list.js"></script>';
    echo '<script src="js/lists/update_elements.js"></script>';

    $title = $listDB->getListName($_GET['id']);
    $creator = $listDB->displayCreator($_GET['id']);
    $listItems = $listDB->getListItems($_GET['id']);
    $listUsers = $listDB->getListUsers($_GET['id']);
    include_once('templates/lists/edit_list.php');
  }

  include_once('templates/common/footer.php');
?>
