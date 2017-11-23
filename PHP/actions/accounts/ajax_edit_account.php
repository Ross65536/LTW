<?php 
    include_once(__DIR__ . '/../../CommonInit.php');
    Session\redirectBackIfNotLoggedIn();
    include_once(__DIR__ . '/../AjaxReply.php');
    include_once(__DIR__ . '/../../../database/UsersFacade.php');
    
    $username = Session\getLoginUsername();
    $oldPassword = $_GET['old_password'];
    $newPassword = $_GET['new_password'];
    $confirmNewPassword = $_GET['confirm_new_password'];
    $name = $_GET['name'];
    $email = $_GET['email'];

    $usersDB = new UsersFacade();

    $error_list = [];
    
    if($usersDB->checkValidUserLoginInfo($username, $oldPassword))
    {
        $currentSecInfo = $usersDB->getSecondaryInfo($username);
        $currentUserEmail = $currentSecInfo["email"];

        $updateSecInfo = [
            "name" => $name,
        ];

        if($email != "" && $currentUserEmail != $email) //should update email
        {
            if($usersDB->checkEmailExists($email))
                array_push($error_list, "email_exists_error");
            else
                $updateSecInfo["email"] = $email;
        }

        $shouldUpdatePassword = $newPassword != "";

        if($shouldUpdatePassword && $newPassword != $confirmNewPassword)
            array_push($error_list, "password_match_error");

        if(count($error_list) == 0) //onlu updates on no errors
        {
            if(!$usersDB->updateSecondaryInfo($username, $updateSecInfo))
                array_push($error_list, "database_error");        
            
            if($shouldUpdatePassword && count($error_list) == 0)
                if(!$usersDB->updatePassword($username, $newPassword))
                    array_push($error_list, "database_error_2");
        }
    }
    else
        array_push($error_list, "wrong_password_error");
        
    AjaxReply\returnErrors($error_list); //returns empty [] on success
?>