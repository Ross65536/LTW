<?php
    include_once(__DIR__ . '/../../CommonInit.php');
    Session\redirectBackIfLoggedIn();
    include_once(__DIR__ . '/../AjaxReply.php');
    include_once(__DIR__ . '/../../../database/UsersFacade.php');
    include_once(__DIR__ . '/../../../database/UsersHTMLDecorator.php');
    

    $username = $_GET['username'];
    $password = $_GET['password'];

    $usersDB = new UsersHTMLDecorator(new UsersFacade());
    $userExists = $usersDB->checkValidUserLoginInfo($username, $password);

    if($userExists)
    {
        Session\logIn($username);
        AjaxReply\returnNoErrors();
    }
    else 
        AjaxReply\returnErrors(["login_error"]);
    

?>
