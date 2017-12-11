<?php


interface IUserDB
{

    public function getSecondaryInfo($username);

    public function checkValidUserLoginInfo($username, $password);

    public function checkUsernameExists($username);

    public function checkEmailExists($email);

    public function addUser($username, $password, $name, $email, $photo_url);

    public function updateSecondaryInfo($username, $infoDict);

    public function updatePassword($username, $password);
}

?>
