<?php


interface IListsGetInfo
{
    public function getListName($id);
    public function displayCreator($id);
    public function getListItems($id);
    public function getListUsers($id);
    public function getListMainInfo($id);
    public function retrieveAllListsOfUser($username);

    public function isUserOnList($id, $username);
    public function addUser($id, $username);
    public function itemExists($id, $description);
    public function addItem($id, $description);
    public function removeItem($id, $description);
    public function removeUser($id, $username);
    public function updateDone($id, $description, $value);
}

?>