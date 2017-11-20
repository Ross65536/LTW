<?php
    include_once(__DIR__ . '/../../CommonInit.php');
    Session\redirectBackIfLoggedIn();
    include_once(__DIR__ . '/../../../database/UsersFacade.php');


    $username = $_GET['username'];
    $password = $_GET['password'];

    $usersDB = new UsersFacade();
    $userExists = $usersDB->checkValidUserLoginInfo($username, $password);
    if($userExists)
    {
        Session\logIn($username);
        echo json_encode(0);
    }
    else 
    {
        echo json_encode(1);
    }

?>
