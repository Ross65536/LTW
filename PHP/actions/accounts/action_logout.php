<?php 
  include_once(__DIR__ . '/../../CommonInit.php');

  Session\logOut();

  $php_index_path = '../../../index.php';
  Session\redirectTo($php_index_path);
?>
