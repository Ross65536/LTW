<?php
    include_once(__DIR__ . '/../../CommonInit.php');
    Session\redirectBackIfLoggedIn();
    include_once(__DIR__ . '/../AjaxReply.php');
    include_once(__DIR__ . '/../../../database/UsersFacade.php');
    include_once(__DIR__ . '/../../../database/UsersHTMLDecorator.php');

    include_once(__DIR__ . '/../../Captcha.php');
    if(! checkClientIPLogged())
        AjaxReply\returnError("not_valid_site_use");
    if(! checkNumberedCaptchaSuccess())
        AjaxReply\returnError("wrong_captcha"); 


    $username = $_GET['username'];
    $password = $_GET['password'];

    $usersDB = new UsersHTMLDecorator(new UsersFacade());
    $userExists = $usersDB->checkValidUserLoginInfo($username, $password);

    if($userExists)
    {
        Session\logIn($username);
        AjaxReply\returnNoErrors();
    }
    else //on errors
    {
        $error_list = ["login_error"];
        incrementCaptchaAttempts();
        if(shouldDisplayCaptcha())
            array_push($error_list, "should_display_captcha");

        AjaxReply\returnErrors($error_list);
    }

?>
