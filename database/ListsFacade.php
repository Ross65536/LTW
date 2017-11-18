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

    /**
    *
    */
    public function getListMainInfo($id) {
      $stmt = $this->db->prepare('SELECT lists.id, lists.date_created, lists.name, lists.creator
      FROM lists WHERE lists.id = ?');

      $stmt->execute(array($id));
      return $stmt->fetch();
    }

    public function retrieveAllUsersOfList($id) {

      $stmt = $this->db->prepare('SELECT username FROM list_users WHERE list_id = ?');

      $stmt->execute(array($id));
      return $stmt->fetchAll();
    }

    public function retrieveAllListsOfUser($username) {
      $stmt = $this->db->prepare('SELECT lists.id, lists.name, lists.date_created, lists.creator
        FROM lists,list_users
         WHERE lists.creator = ? OR list_users.username = ? AND lists.id = list_users.list_id
         GROUP BY lists.id');

      $stmt->execute(array($username, $username));
      return $stmt->fetchAll();
    }

    public function getListName($id) {
      $stmt = $this->db->prepare('SELECT name FROM lists WHERE id = ?');
      $stmt->execute(array($id));

      return $stmt->fetch()['name'];
    }

    public function getListCreator($id) {
      $stmt = $this->db->prepare('SELECT users.username FROM lists, users WHERE lists.id = ? AND lists.creator = users.username');
      $stmt->execute(array($id));

      return $stmt->fetch()['username'];
    }

    public function getListItems($id) {
      $stmt = $this->db->prepare('SELECT * FROM list_items, lists WHERE list_items.list_id = ? GROUP BY list_items.id');
      $stmt->execute(array($id));

      return $stmt->fetchAll();
    }


    public function getListUsers($id) {
      $stmt = $this->db->prepare('SELECT * FROM list_users, lists WHERE list_users.list_id = ? GROUP BY list_users.username');
      $stmt->execute(array($id));

      return $stmt->fetchAll();
    }

    public function displayCreator($id) {
      $creator = $this->getListCreator($id);
      if ( $creator == $_SESSION['username']) {
        return "you";
      } else {
        return $creator;
      }
    }

    public function addList($name, $creator, $items, $users) {
      $stmt = $this->db->prepare('INSERT INTO lists (name, date_created, creator)
      VALUES (?, ?, ?)');

      $date = date("Y-m-d");
      $stmt->execute(array($name, $date, $creator));
      $id = $this->db->lastInsertId('lists');

      $stmt = $this->db->prepare('INSERT INTO list_items (list_id, description, done)
      VALUES (?, ?, ?)');

      foreach ($items as $item) {
        $stmt->execute(array($id, $item['description'], $item['done']));
      }

      $stmt = $this->db->prepare('INSERT INTO list_users (list_id, username)
      VALUES (?, ?)');

      foreach ($users as $user) {
        $stmt->execute(array($id, $user));
      }

      return $id;
    }

    public function updateList($id, $name, $items, $users) {
      $stmt = $this->db->prepare('UPDATE lists SET name = ? WHERE id = ?');
      $stmt->execute(array($name, $id));

      $stmt = $this->db->prepare('DELETE FROM list_items WHERE list_id = ?');
      $stmt->execute(array($id));

      $stmt = $this->db->prepare('INSERT INTO list_items (list_id, description, done)
      VALUES (?, ?, ?)');

      foreach ($items as $item) {
        $stmt->execute(array($id, $item['description'], $item['done']));
      }

      $stmt = $this->db->prepare('DELETE FROM list_users WHERE list_id = ?');
      $stmt->execute(array($id));

      $stmt = $this->db->prepare('INSERT INTO list_users (list_id, username)
      VALUES (?, ?)');

      foreach ($users as $user) {
        $stmt->execute(array($id, $user));
      }
    }

    public function deleteList($id) {
      $stmt = $this->db->prepare('DELETE FROM list_items WHERE list_id = ?');
      $stmt->execute(array($id));

      $stmt = $this->db->prepare('DELETE FROM list_users WHERE list_id = ?');
      $stmt->execute(array($id));

      $stmt = $this->db->prepare('DELETE FROM lists WHERE id = ?');
      $stmt->execute(array($id));
    }

}
?>
