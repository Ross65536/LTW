<?
include_once('database/ListsFacade.php');
$listDB = new ListsFacade();

$id = $_POST['id'];
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
print_r($final_items);

try {
  $listDB->updateList($id, $name, $final_items, $users);
  header("Location: single_list.php?id=$id");
} catch (PDOException $e) {
  die($e->getMessage());
}

?>
