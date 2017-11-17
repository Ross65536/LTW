<?

include_once('PHP/Session.php');
include_once('database/ListsFacade.php');
$listDB = new ListsFacade();

$id = $_GET['id'];

try {
  $listDB->deleteList($id);
  Session\redirectBack();
} catch (PDOException $e) {
  die($e->getMessage());
}

?>
