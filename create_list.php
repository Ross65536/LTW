<?php

  session_start();
  include_once('PHP/Session.php');
  include_once('templates/heads/default_head.php');
  include_once('templates/common/header.php');

  if(! Session\isLoggedIn()) {
    include_once('templates/accounts/login.php');
    $_SESSION['error'] = 'not_logged_in';
  }
  else {
    echo '<script src="js/lists/edit_list.js"></script>';
    include_once('templates/lists/create_list.php');
  }

  include_once('templates/common/footer.php');
?>
