<?php

  include_once('PHP/CommonInit.php');


  $BrowserTabTitle = "List";
  include_once('templates/lists/list_head.php');
  include_once('templates/common/header.php');
  include_once('database/ListsFacade.php');

  $listsDB = new ListsFacade();

  if(! Session\isLoggedIn()) {
    Session\redirectTo('login.php');
  } else {
    echo '<script src="js/lists/common_functions.js"></script>';
    echo '<script src="js/lists/update_elements.js"></script>';

    $id = $_GET['id'];
    $main_info = $listsDB->getListMainInfo($id);
    $creator = $listsDB->displayCreator($id);
    $listItems = $listsDB->getListItems($id);
    $listUsers = $listsDB->getListUsers($id);
    $photo = $listsDB->getPhoto($id, "thumbs_small");

    include_once('templates/lists/single_list.php');

  }

  include_once('templates/common/footer.php');
?>
