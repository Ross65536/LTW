<?php

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('../../../database/ListsFacade.php');
include_once('database/ListsHTMLDecorator.php');

$listsDB = new ListsHTMLDecorator(new ListsFacade());

if (isset($_GET['function']) && $_GET['function'] == 'updateListItems') {
    $items = $listsDB->getListItems($_GET['id']);
    echo json_encode($items);
}

if (isset($_GET['function']) && $_GET['function'] == 'updateListUsers') {
    $users = $listsDB->retrieveAllUsersOfList($_GET['id']);
    echo json_encode($users);
}

?>
