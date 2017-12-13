<?php
  include_once('PHP/CommonInit.php');

  $BrowserTabTitle = "Edit List";
  include_once('templates/lists/list_head.php');
  include_once('templates/common/header.php');
  include_once('database/ListsFacade.php');

  $listDB = new ListsFacade();

  if(! Session\isLoggedIn()) {
    Session\redirectTo('login.php');
  }
  else {
    echo '<script src="js/lists/common_functions.js"></script>';
    echo '<script src="js/lists/edit_list.js"></script>';
    echo '<script src="js/lists/update_elements.js"></script>';

    $id = $_GET['id'];
    $title = $listDB->getListName($id);
    $creator = $listDB->displayCreator($id);
    $listItems = $listDB->getListItems($id);
    $listUsers = $listDB->getListUsers($id);
    $photo = $listDB->getPhoto($id, "thumbs_small");
    include_once('templates/lists/edit_list.php');
  }

  include_once('templates/common/footer.php');
?>
