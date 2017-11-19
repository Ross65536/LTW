<?php
    include_once(__DIR__ . '/../../CommonInit.php');
    Session\redirectBackIfLoggedIn();
    include_once(__DIR__ . '/../../../database/UsersFacade.php');


    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    if($password === $confirmPassword)
    {
        $usersDB = new UsersFacade();
        $isSuccessfulyRegistered = $usersDB->addUser($username, $password, $name, $email);

        if($isSuccessfulyRegistered)
            Session\logIn($username);
    }

    $php_index_path = '../../../index.php';
    Session\redirectTo($php_index_path);
?>
