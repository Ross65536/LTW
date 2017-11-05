<?php 
    session_start();

    include_once('database/connection.php');
    include_once('database/UsersFacade.php'); 
    include_once('PHP/Session.php'); 

    Session\redirectBackIfLoggedIn();
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $usersDB = new UsersFacade($db);
    $userExists = $usersDB->checkValidUserLoginInfo($username, $password);
    if($userExists)
        Session\logIn($username);

    Session\redirectBack();
?>