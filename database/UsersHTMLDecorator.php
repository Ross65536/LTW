<?php

include_once(__DIR__ . '/IUserDB.php');
include_once(__DIR__ . '/HTMLDecoratorBase.php');

class UsersHTMLDecorator extends HTMLDecoratorBase implements IUserDB
{
    public function getSecondaryInfo($username)
    {
        $map = $this->instance->getSecondaryInfo($username);
        return $this->prepareStringMap($map);
    }

    public function checkValidUserLoginInfo($username, $password)
    {
        $username = $this->decodeString($username);
        return $this->instance->checkValidUserLoginInfo($username, $password);
    }

    public function checkUsernameExists($username)
    {
        $username = $this->decodeString($username);
        return $this->instance->checkUsernameExists($username);
    }

    public function checkEmailExists($email)
    {
        $email = $this->decodeString($email);
        return $this->instance->checkEmailExists($email);
    }

    public function addUser($username, $password, $name, $email, $photo_url)
    {
        $username = $this->decodeString($username);
        $email = $this->decodeString($email);
        $name = $this->decodeString($name);
        return $this->instance->addUser($username, $password, $name, $email, $photo_url);
    }


    public function updateSecondaryInfo($username, $infoDict)
    {
        $username = $this->decodeString($username);
        $infoDict = $this->decodeMap($infoDict);
        return $this->instance->updateSecondaryInfo($username, $infoDict);
    }

    public function updatePassword($username, $password)
    {
        $username = $this->decodeString($username);
        return $this->instance->updatePassword($username, $password);
    }

    public function getPhoto($username, $size) {
        $username = $this->decodeString($username);
        $size = $this->decodeString($size);
        return $this->instance->getPhoto($username, $size);
    }
}
?>
