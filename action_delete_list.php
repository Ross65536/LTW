<?

include_once('PHP/Session.php');
include_once('database/ListsFacade.php');
include_once('database/ListsHTMLDecorator.php');

$listDB = new ListsHTMLDecorator(new ListsFacade());

$id = $_GET['id'];

try {
  $listDB->deleteList($id);

  $php_index_path = 'index.php';
  Session\redirectTo($php_index_path);
} catch (PDOException $e) {
  die($e->getMessage());
}

?>
