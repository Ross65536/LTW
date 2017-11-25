<?php
  session_start();
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  include_once('../../../database/UsersFacade.php');
  include_once('../../../database/ListsFacade.php');

  $userDB = new UsersFacade();
  $listsDB = new ListsFacade();
if (isset($_GET['function']) && $_GET['function'] == 'validUser') {
    if ($_GET['username'] == $_SESSION['username']) {
      echo -1;
    } else if ($listsDB->isUserOnList($_GET['id'], $_GET['username'])){
      echo -3;
    } elseif ($userDB->checkUsernameExists($_GET['username'])) {
      $listsDB->addUser($_GET['id'], $_GET['username']);
      echo 0;
    }  else {
      echo -2;
    }
}

if (isset($_GET['function']) && $_GET['function'] == 'distinctItem') {
    if ($listsDB->itemExists($_GET['id'], $_GET['description'])) {
      echo -1;
    } else {
        $listsDB->addItem($_GET['id'], $_GET['description']);
      echo 0;
    }
}

if (isset($_GET['function']) && $_GET['function'] == 'removeItem') {
    $listsDB->removeItem($_GET['id'], $_GET['description']);
    echo 0;
}

if (isset($_GET['function']) && $_GET['function'] == 'removeUser') {
    $listsDB->removeUser($_GET['id'], $_GET['username']);
    echo 0;
}
?>
