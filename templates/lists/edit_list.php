<form class="edit-form" action="action_save_list.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?=$id?>"/>
  <input type="hidden" name="creator" value="<?=$creator?>"/>
  <input type="hidden" name="type" value="edit"/>
  <? if ($creator == 'you') {?>
  <label>
    Title <input type="text" name="name" value="<?=$title?>"/>
  </label>
  <?} else {?>
    <h2><?=$title?></h2>
    <?}?>
    <div id="list_photo">
      <img src="<?=$photo?>" alt="List Image"/>
    </div>
    <h3>Items List</h3>
  <ul id="items_list">
    <div class="loader">

    </div><?
    foreach ($listItems as $item) {
      $name = str_replace(' ', '_', $item['description']);?>
      <li>
        <input type="checkbox" name="<?=$name?>" <?= ($item['done'] == 1 ? 'checked' : '');?>>
        <span class="item"><?=$item['description']?></span>
        <input type="hidden" value="<?=$name?>"  name="items[]"/>
        <button type="button" class="delete-button">X</button>
      </li>
    <?}
    ?>
  </ul>
  <label>
    New Item: <input type="text" id="item"/>
    <button type="button" class="add-btn" onclick="addItem()">Add</button>
  </label>
      <h3>Users</h3>
  <ul id="users_list"><?
      foreach ($listUsers as $user) {?>
          <li>
            <span class="username"><?=$user['username']?></span>
            <input type="hidden" value="<?=$user['username']?>" name="users[]"/>
            <button type="button" class="delete-button">X</button>
          </li>
      <?}
    ?>
  </ul>
  <label>
    New user: <input type="text" id="user"/>
    <button type="button" class="add-btn" onclick="addUser()">Add</button>
  </label>
  <label id="photo">
    <span>Edit Image</span>
    <input type="file" name="list_image_<?=$id?>"  />
  </label>
  <input type="submit" value="Save"/>
</form>
<?if ($creator == "you") {?>
  <form action="action_delete_list.php" method="get" onsubmit="return confirm('Are you sure you want to delete this list?')">
    <input type="hidden" name="id" value="<?=$_GET['id']?>"/>
    <input type="submit" class="delete-btn" value="Delete List"/>
  </form>
<?}
