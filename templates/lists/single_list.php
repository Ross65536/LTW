<div class="def-size centered">
  <div id="top_header">
    <div id="main_info" class="one-edge-shadow">
      <p><?=$main_info['name']?></p>
      <p>Created by <?=$creator?> on <?=$main_info['date_created']?></p>
    </div>
    <div id="image">
      <img class="rounded-img one-edge-shadow" src="<?=$photo?>" alt="List Photo"/>
    </div>
  </div>
  <div class="off-edges">
    <div class="blurbs blurbs-2">
        <div class="blurb">
          <ul id="items_list" class="list one-edge-shadow">
            <h3>List Items</h3>
            <?if (empty($listItems)) {?>
              <li>
                No items were added here yet.
              </li>
            <?} else
            foreach ($listItems as $item) {?>
              <li <?if ($item['done'] == 1) {
                echo 'style="text-decoration: line-through"';
              }$name = str_replace(' ', '_', $item['description']);?>>
                <input type="checkbox" name="<?=$name?>" <?= ($item['done'] == 1 ? 'checked' : '');?>disabled>
                <span class="item"><?=$item['description']?></span>
                <input type="hidden" value="<?=$item['description']?>" name="items[]"/>
              </li>
            <?}?>
          </ul>
      </div>
      <div class="blurb">
        <ul id="users_list" class="list one-edge-shadow">
          <h3>Users</h3>
          <?if (empty($listUsers)) {?>
            <li>
              No users were added here yet.
            </li>
          <?}foreach ($listUsers as $user) {?>
            <li>
              <span class="username"><?=$user['username']?></span>
              <input type="hidden" value="<?=$user['username']?>" name="users[]"/>
            </li>
          <?}?>
        </ul>
      </div>
    </div>
  </div>
  <form action='edit_list.php' method="get">
    <input type="hidden" name="id" value="<?=$_GET['id']?>"/>
    <button type="submit" class="btn submit">Edit</button>
  </form>
</div>
