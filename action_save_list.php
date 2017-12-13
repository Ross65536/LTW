<?
include_once('database/ListsFacade.php');
include_once('upload.php');
$listDB = new ListsFacade();

$id = $_POST['id'];
$name = $_POST['name'];
$items = $_POST['items'];
$checkboxes;
$users = $_POST['users'];
$image = $_FILES["list_image_" . $id];

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

$hasUpdatedImage = $image['tmp_name'] == "" ? 0 : 1;

if ($hasUpdatedImage == 1) {
    upload($image, $id, "lists_photos");
}

try {
  $listDB->updateList($id, $name, $final_items, $users, $hasUpdatedImage);
  header("Location: single_list.php?id=$id");
} catch (PDOException $e) {
  die($e->getMessage());
}
?>
