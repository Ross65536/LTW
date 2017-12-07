<?php

  include_once('PHP/CommonInit.php');

  $BrowserTabTitle = "Create List";
  include_once('templates/lists/list_head.php');
  include_once('templates/common/header.php');

  if(! Session\isLoggedIn()) {
    include_once('templates/accounts/login.php');
    $_SESSION['error'] = 'not_logged_in';
  }
  else {
    echo '<script src="js/lists/common_functions.js"></script>';
    echo '<script src="js/lists/edit_list.js"></script>';
    include_once('templates/lists/create_list.php');
  }

  include_once('templates/common/footer.php');
?>
