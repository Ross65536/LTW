<?
include_once('database/ListsFacade.php');
include_once('database/ListsHTMLDecorator.php');

$listDB = new ListsHTMLDecorator(new ListsFacade());

$creator = $_POST['creator'];
$name = $_POST['name'];
$items = $_POST['items'];
$checkboxes;
$users = $_POST['users'];

if (!empty($items)) {
  $final_items = array();
  for ($i=0; $i < count($items); $i++) {
    $v = $items[$i];
    $item['description'] = str_replace('_', ' ', $items[$i]);

    if (isset($_POST[$v])) {
      $item['done'] = 1;
    } else {
      $item['done'] = 0;
    }
    array_push($final_items, $item);
  }
}

try {
  $id = $listDB->addList($name, $creator, $final_items, $users);
  header("Location: single_list.php?id=$id");
} catch (PDOException $e) {
  die($e->getMessage());
}

?>
