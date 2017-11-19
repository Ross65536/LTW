<?php
    include_once('PHP/CommonInit.php');

    Session\redirectBackIfLoggedIn();
    include_once('database/UsersFacade.php');


    $username = $_POST['username'];
    $password = $_POST['password'];

    $usersDB = new UsersFacade();
    $userExists = $usersDB->checkValidUserLoginInfo($username, $password);
    if($userExists)
        Session\logIn($username);

    Session\redirectBack();
?>
