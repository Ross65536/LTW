<?php

include_once(__DIR__ . '/IListsGetInfo.php');
include_once(__DIR__ . '/HTMLDecoratorBase.php');

class ListsHTMLDecorator extends HTMLDecoratorBase implements IListsGetInfo
{
    public function getSecondaryInfo($username)
    {
        $map = $this->instance->getSecondaryInfo($username);
        return $this->prepareStringMap($map);
    }   
}
?>