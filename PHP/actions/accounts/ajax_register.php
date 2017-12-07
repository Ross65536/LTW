<?php
    include_once(__DIR__ . '/../../CommonInit.php');
    if( Session\isLoggedIn())
        AjaxReply\returnErrors(["already_logged_in"]);
    include_once(__DIR__ . '/../AjaxReply.php');
    include_once(__DIR__ . '/../../../database/UsersFacade.php');
    include_once(__DIR__ . '/../../../database/UsersHTMLDecorator.php');
    include_once(__DIR__ . '/../../Forms.php');
    if( ! Forms\checkFormKeyCorrect($_GET['form_key']))
        AjaxReply\returnError("bad_form_key");

    $username = $_GET['username'];
    $password = $_GET['password'];
    $confirmPassword = $_GET['confirm_password'];
    $name = $_GET['name'];
    $email = $_GET['email'];

    if($password === "")
        AjaxReply\returnErrors(["empty_password_error"]);
        
    if($password === $confirmPassword)
    {
        $usersDB = new UsersHTMLDecorator(new UsersFacade());
        $error_list = [];
        
        if($usersDB->checkUsernameExists($username))
            array_push($error_list, "username_exists_error");

        if($usersDB->checkEmailExists($email))
            array_push($error_list, "email_exists_error");

        if(count($error_list) > 0)
            AjaxReply\returnErrors($error_list);
        else
        {
            $isSuccessfulyRegistered = $usersDB->addUser($username, $password, $name, $email);

            if($isSuccessfulyRegistered)
            {   
                Session\logIn($username); 
                AjaxReply\returnNoErrors();
            }
            else
                AjaxReply\returnErrors(["database_error"]);
        }
    }
    else
        AjaxReply\returnErrors(["password_match_error"]);
?>
