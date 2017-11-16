<?php
  session_start();

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  include_once('PHP/Session.php');
  include_once('templates/heads/default_head.php');
  include_once('templates/common/header.php');
  include_once('database/ListsFacade.php');


  $listsDB = new ListsFacade();


  $users = $listsDB->retrieveAllUsersOfList(1);
  ?><h2>Users that belong to list od id = 1 </h2><?
  foreach ($users as $user) {
    ?>
    <p>
      Username: <?=$user['username']?>
    </p>
    <?
  }
  include_once('templates/common/footer.php');
?>
