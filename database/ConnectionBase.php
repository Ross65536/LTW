<?php
  class ConnectionBase 
  {
    public function __construct() {
      $db = new PDO('sqlite:database/todo.db');
      $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->db = $db;
    }

    function __destruct() 
    {
      $this->db = null;
    }

    protected $db;
  }
?>
