<div id="create_list" class="full-height def-size centered parallax">
  <form class="edit-form" action="action_create_list.php" method="post">
    <input type="hidden" name="creator" value="<?=$_SESSION['username']?>"/>
    <input type="hidden" name="type" value="create"/>
    <div id="top_header">
      <div id="main_info" class="one-edge-shadow">
        <input type="text" name="name" placeholder="Name"/>
      </div>
      <div id="image">
        <img class="rounded-img one-edge-shadow" src="images/lists_photos/thumbs_small/default.jpg" alt="List Photo"/>
      </div>
    </div>
    <div class="loader">
    </div>
    <div class="off-edges">
      <div class="blurbs blurbs-2">
        <div class="blurb">
          <div class="list one-edge-shadow">
            <h3 class="dash-bot">Items List</h3>
            <ul id="items_list">
            </ul>
            <p id="empty_task" class="error_message hidden"> Cannot enter an empty task </p>
            <p id="repeated_task" class="error_message hidden"> Task already on list </p>
            <label>
              <input type="text" id="item" placeholder="New Item"/>
              <button type="button" class="btn submit" onclick="addItem()">Add</button>
            </label>
          </div>
        </div>
        <div class="blurb">
          <div class="list one-edge-shadow">
            <h3 class="dash-bot">Users</h3>
            <ul id="users_list">
            </ul>
            <p id="username_wrong" class="error_message hidden"> User does not exist </p>
            <p id="repeated_username" class="error_message hidden"> User already on list </p>
            <p id="own_username" class="error_message hidden"> You cannot add yourself </p>
            <label>
              <input type="text" id="user" placeholder="New User"/>
              <button type="button" class="btn submit" onclick="addUser()">Add</button>
            </label>
          </div>
        </div>
      </div>
      <p id="empty_list" class="error_message hidden"> Items list cannot be empty </p>
      <p id="short_title" class="error_message hidden"> List name too short </p>
    </div>
    <input class="btn submit" type="submit" value="Save"/>
  </form>
</div>
