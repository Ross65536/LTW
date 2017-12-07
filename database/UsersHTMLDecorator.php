<?php

include_once(__DIR__ . '/IUsersGetInfo.php');
include_once(__DIR__ . '/HTMLDecoratorBase.php');

class UsersHTMLDecorator extends HTMLDecoratorBase implements IUsersGetInfo
{
    public function getSecondaryInfo($username)
    {
        $map = $this->instance->getSecondaryInfo($username);
        return $this->prepareStringMap($map);
    }   
}
?>