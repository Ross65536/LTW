<?php

include_once(__DIR__ . '/IListsGetInfo.php');
include_once(__DIR__ . '/HTMLDecoratorBase.php');

class ListsHTMLDecorator extends HTMLDecoratorBase implements IListsGetInfo
{
    public function getListName($id)
    {
        $str = $this->instance->getListName($id);
        
        return $this->prepareString($str);
    }

    public function displayCreator($id)
    {
        $str = $this->instance->displayCreator($id);
        
        return $this->prepareString($str);
    }

    public function getListItems($id)
    {
        $map = $this->instance->getListItems($id);
        return $this->prepareStringDoubleMap($map);
    }

    public function getListUsers($id)
    {
        $map = $this->instance->getListUsers($id);
        return $this->prepareStringDoubleMap($map);
    }

    public function getListMainInfo($id)
    {
        $map = $this->instance->getListMainInfo($id);
        return $this->prepareStringMap($map);
    }

    public function retrieveAllListsOfUser($username)
    {
        $map = $this->instance->retrieveAllListsOfUser($username);
        return $this->prepareStringDoubleMap($map);
    }

    public function isUserOnList($id, $username)
    {
        $id = $this->decodeString($id);
        $username = $this->decodeString($username);
        return $this->isUserOnList($id, $username);
    }

    public function addUser($id, $username)
    {
        $id = $this->decodeString($id);
        $username = $this->decodeString($username);
        return $this->addUser($id, $username);
    }

    public function itemExists($id, $description)
    {
        $id = $this->decodeString($id);
        $description = $this->decodeString($description);
        return $this->itemExists($id, $description);
    }

    public function addItem($id, $description)
    {
        $id = $this->decodeString($id);
        $description = $this->decodeString($description);
        return $this->addItem($id, $description);
    }

    public function removeItem($id, $description)
    {
        $id = $this->decodeString($id);
        $description = $this->decodeString($description);
        return $this->removeItem($id, $description);
    }

    public function removeUser($id, $username)
    {
        $id = $this->decodeString($id);
        $username = $this->decodeString($username);
        return $this->removeUser($id, $username);
    }

    public function updateDone($id, $description, $value)
    {
        $id = $this->decodeString($id);
        $description = $this->decodeString($description);
        $value = $this->decodeString($value);
        return $this->updateDone($id, $description, $value);
    }
}
?>