<?php
    include_once(__DIR__ . '/../../CommonInit.php');
    Session\redirectBackIfLoggedIn();
    include_once(__DIR__ . '/../../../database/UsersFacade.php');


    $username = $_POST['username'];
    $password = $_POST['password'];

    $usersDB = new UsersFacade();
    $userExists = $usersDB->checkValidUserLoginInfo($username, $password);
    if($userExists)
        Session\logIn($username);

    Session\redirectBack();
?>
