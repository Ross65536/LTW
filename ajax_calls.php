<?php
  session_start();

  include_once('database/UsersFacade.php');

  $userDB = new UsersFacade();

if (isset($_GET['function']) && $_GET['function'] == 'validUser') {
    if ($_GET['username'] == $_SESSION['username']) {
      echo -1;
    } elseif ($userDB->checkUsernameExists($_GET['username'])) {
      echo 0;
    } else {
      echo -2;
    }
}

?>
