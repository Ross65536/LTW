<?php

include_once(__DIR__ . '/IUsersGetInfo.php');

class UsersHTMLDecorator implements IUsersGetInfo
{
    public function __construct($instance) {
        $this->instance = $instance;
    }

    public function getSecondaryInfo($username)
    {
        $map = $this->instance->getSecondaryInfo($username);


        foreach ($map as $key => $value)
            $map[$key] = $this->prepareHTML($value);
        

        return $map;
    }

    private function prepareHTML($text)
    {
        return htmlentities($text);
    }
}
?>