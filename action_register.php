<?php 
    session_start();

    include_once('database/connection.php');
    include_once('database/UsersFacade.php'); 
    include_once('PHP/Session.php'); 

    Session\redirectBackIfLoggedIn();
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    if($password === $confirmPassword)
    {
        $usersDB = new UsersFacade($db);
        $isSuccessfulyRegistered = $usersDB->addUser($username, $password, $name, $email);

        if($isSuccessfulyRegistered)
            Session\logIn($username);
    }
    
    Session\redirectBack();
?>