<form action="action_save_list.php" method="post">
  <input type="hidden" name="id" value="<?=$_GET['id']?>"/>
  <input type="hidden" name="creator" value="<?=$creator?>"/>
  <label>
    Title <input type="text" name="name" value="<?=$title?>"/>
  </label>
  <ul id="items_list">
    <h3>Items List</h3><?
    foreach ($listItems as $item) {
      $name = str_replace(' ', '_', $item['description']);?>
      <li>
        <input type="checkbox" name="<?=$name?>" <?= ($item['done'] == 1 ? 'checked' : '');?>>
        <?=$item['description']?>
        <input type="hidden" value="<?=$name?>"  name="items[]"/>
        <button type="button" class="delete-button">X</button>
      </li>
    <?}
    ?>
  </ul>
  <label>
    New Item: <input type="text" id="item"/>
    <button type="button" onclick="addItem()">Add</button>
  </label>
  <ul id="users_list">
      <h3>Users</h3><?
      foreach ($listUsers as $user) {?>
          <li>
            <?=$user['username']?>
            <input type="hidden" value="<?=$user['username']?>" name="users[]"/>
            <button type="button" class="delete-button">X</button>
          </li>
      <?}
    ?>
  </ul>
  <label>
    New user: <input type="text" id="user"/>
    <button type="button" onclick="addUser()">Add</button>
  </label>
  <input type="submit" value="Save"/>
</form>
<?if ($creator == "you") {?>
  <form action="action_delete_list.php" method="get" onsubmit="return confirm('Are you sure you want to delete this list?')">
    <input type="hidden" name="id" value="<?=$_GET['id']?>"/>
    <input type="submit" value="Delete List"/>
  </form>
<?}?>
