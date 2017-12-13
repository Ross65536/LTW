<?php

include_once('ConnectionBase.php');
include_once(__DIR__ . '/IListsGetInfo.php');

/**
 * Receives the database object (usualy the global $db) and provides a 'wrapper' class for manipulating the users table
 */
class ListsFacade extends ConnectionBase implements IListsGetInfo
{
    /////////////////////////////////////////////////////////////
    ////////// public
    /////////////////////////////////////////////////////////////

    /**
    *
    */
    public function getListMainInfo($id) {
      $stmt = $this->db->prepare('SELECT lists.id, lists.date_created, lists.name, lists.creator, lists.list_image
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
      $created = $this->getAllListsCreatedByUser($username);
      $belongs = $this->getAllListUserBelongs($username);

      return array_merge($created, $belongs);
    }

    function getAllListsCreatedByUser($username) {
      $stmt = $this->db->prepare('SELECT lists.id, lists.name, lists.date_created, lists.creator
        FROM lists
         WHERE lists.creator = ?
         GROUP BY lists.id');

      $stmt->execute(array($username));
      return $stmt->fetchAll();
    }

    function getAllListUserBelongs($username) {
      $stmt = $this->db->prepare('SELECT lists.id, lists.name, lists.date_created, lists.creator
        FROM lists, list_users
         WHERE list_users.username = ? AND lists.id = list_users.list_id
         GROUP BY lists.id');

      $stmt->execute(array($username));
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

    public function itemExists($id, $description) {
      $stmt = $this->db->prepare('SELECT id FROM list_items WHERE list_id = ? AND description = ?');
      $stmt->execute(array($id, $description));

      return($stmt->fetch() != null);
    }

    public function isUserOnList($id, $username) {
      $stmt = $this->db->prepare('SELECT username FROM list_users WHERE list_id = ? AND username = ?');
      $stmt->execute(array($id, $username));

      return($stmt->fetch() != null);
    }

    public function removeUser($id, $username) {
      $stmt = $this->db->prepare('DELETE FROM list_users WHERE list_id = ? AND username = ?');
      $stmt->execute(array($id, $username));
    }

    public function removeItem($id, $description) {
      $stmt = $this->db->prepare('DELETE FROM list_items WHERE list_id = ? AND description = ?');
      $stmt->execute(array($id, $description));
    }

    public function addItem($id, $description) {
      $stmt = $this->db->prepare('INSERT INTO list_items (list_id, description)
      VALUES (?, ?)');
      $stmt->execute(array($id, $description));
    }

    public function addUser($id, $username) {
      $stmt = $this->db->prepare('INSERT INTO list_users (list_id, username) VALUES (?, ?)');
      $stmt->execute(array($id, $username));
    }

    public function updateDone($id, $description, $value) {
      $stmt = $this->db->prepare('UPDATE list_items SET done = ? WHERE list_id = ? AND description = ?');
      $done = $value == 'true' ? 1 : 0;
      $stmt->execute(array($done, $id, $description));
    }


    public function updatePhoto($id) {
      $stmt = $this->db->prepare('UPDATE lists SET list_image = 1 WHERE id = ?');
      $stmt->execute(array($id));

      return true;
    }

    public function getPhoto($id, $size) {
      $stmt = $this->db->prepare('SELECT list_image FROM lists WHERE id = ?');
      $stmt->execute(array($id));



      if ($stmt->fetch()['list_image'] == 0)
       return "images/lists_photos/" . $size . "/default.jpg";
      else {
        return "images/lists_photos/" . $size . "/" . $id . ".jpg";
      }
    }

    public function addList($name, $creator, $items, $users, $photo) {
      $name = $name == "" ? "Default" : $name;
      $stmt = $this->db->prepare('INSERT INTO lists (name, date_created, creator, list_image)
      VALUES (?, ?, ?, ?)');

      $date = date("Y-m-d");
      $stmt->execute(array($name, $date, $creator, $photo));
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

    public function updateList($id, $name, $items, $users, $photo) {
      if ($name != '') {
        $stmt = $this->db->prepare('UPDATE lists SET name = ?, list_image = ? WHERE id = ?');
        $stmt->execute(array($name, $photo, $id));
      }

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
