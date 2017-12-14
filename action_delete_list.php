<?

include_once('PHP/Session.php');
include_once('database/ListsFacade.php');
$listDB = new ListsFacade();

$id = $_GET['id'];

try {
  $listDB->deleteList($id);

  $php_index_path = 'my_lists.php';
  Session\redirectTo($php_index_path);
} catch (PDOException $e) {
  die($e->getMessage());
}

?>
