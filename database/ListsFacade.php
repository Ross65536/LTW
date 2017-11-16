<?php

include_once('database/ConnectionBase.php');

/**
 * Receives the database object (usualy the global $db) and provides a 'wrapper' class for manipulating the users table
 */
class ListsFacade extends ConnectionBase
{
    /////////////////////////////////////////////////////////////
    ////////// public
    /////////////////////////////////////////////////////////////


    public function retrieveAllUsersOfList($id) {

      $stmt = $this->db->prepare('SELECT username FROM list_users WHERE list_id = ?');

      $stmt->execute(array($id));
      $users = $stmt->fetchAll();
      return $users;
    }

}
?>
