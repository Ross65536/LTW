<?php 
    include_once(__DIR__ . '/../../CommonInit.php');
    Session\redirectBackIfNotLoggedIn();
    include_once(__DIR__ . '/../../../database/UsersFacade.php');
    
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