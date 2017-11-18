<?php 
    include_once('PHP/CommonInit.php');
    include_once('database/UsersFacade.php'); 
    

    Session\redirectBackIfNotLoggedIn();
    
    $username = Session\getLoginUsername();
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmNewPassword = $_POST['confirm_new_password'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $usersDB = new UsersFacade();
    if($usersDB->checkValidUserLoginInfo($username, $oldPassword))
    {
        $secInfo = [
            "name" => $name,
            "email" => $email
        ];
        $successfullyUpdatedSecondaryInfo = $usersDB->updateSecondaryInfo($username, $secInfo);
        
        if($newPassword === $confirmNewPassword)
        {
            $successfullyUpdatedPassword = $usersDB->updatePassword($username, $newPassword);
        }
    }

    Session\redirectBack();
?>