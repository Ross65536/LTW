<?php
    include_once('PHP/CommonInit.php');

    include_once('database/UsersFacade.php');

    Session\redirectBackIfLoggedIn();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $usersDB = new UsersFacade();
    $userExists = $usersDB->checkValidUserLoginInfo($username, $password);
    if($userExists)
        Session\logIn($username);

    Session\redirectIndex();
?>
