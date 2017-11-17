<form action="action_create_list.php" method="post">
  <input type="hidden" name="creator" value="<?=$_SESSION['username']?>"/>
  <label>
    Title <input type="text" name="name"/>
  </label>
  <ul id="items_list">
    <h3>Items List</h3>
  </ul>
  <label>
    New Item: <input type="text" id="item"/>
    <button type="button" onclick="addItem()">Add</button>
  </label>
  <ul id="users_list">
    <h3>Users Added</h3>
  </ul>
  <label>
    Username: <input type="text" id="user"/>
    <button type="button" onclick="addUser()">Add</button>
  </label>
  <input style="display: none" type="submit" value="Save"/>
</form>
