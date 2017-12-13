<div id="edit_list" class="full-height def-size centered parallax">
	<form class="edit-form" action="action_save_list.php" method="post" enctype="multipart/form-data">
	  <input type="hidden" name="id" value="<?=$id?>"/>
	  <input type="hidden" name="creator" value="<?=$creator?>"/>
	  <input type="hidden" name="type" value="edit"/>
		<div id="top_header">
	    <div id="main_info" class="one-edge-shadow">
				<? if ($creator == 'you') {?>
			  <label>
					<input type="text" name="name" placeholder="Title" value="<?=$title?>"/>
			  </label>
			  <?} else {?>
				<h2><?=$title?></h2>
				<?}?>
	    </div>
	    <div id="image">
	      <img class="rounded-img one-edge-shadow" src="<?=$photo?>" alt="List Photo"/>
	    </div>
	  </div>
		<div class="off-edges">
			<div class="blurbs blurbs-2">
				<div class="blurb">
					<div class="list one-edge-shadow">
						<h3 class="dash-bot">Items List</h3>
						<ul id="items_list">
							<div class="loader">

							</div><?
							foreach ($listItems as $item) {
								$name = str_replace(' ', '_', $item['description']);?>
								<li>
									<input type="checkbox" name="<?=$name?>" <?= ($item['done'] == 1 ? 'checked' : '');?>>
									<span class="item default"><?=$item['description']?></span>
									<input type="hidden" value="<?=$name?>"  name="items[]"/>
									<button type="button" class="btn delete">X</button>
								</li>
								<?}
								?>
							</ul>
							<label>
								<input type="text" id="item" placeholder="New Item"/>
								<button type="button" class="btn submit" onclick="addItem()">Add</button>
							</label>
					</div>
					</div>
					<div class="blurb">
						<div class="list one-edge-shadow">
							<h3 class="dash-bot">Users</h3>
							<ul id="users_list"><?
							foreach ($listUsers as $user) {?>
								<li>
									<span class="username default"><?=$user['username']?></span>
									<input type="hidden" value="<?=$user['username']?>" name="users[]"/>
									<button type="button" class="btn delete">X</button>
								</li>
								<?}
								?>
							</ul>
							<label>
								<input type="text" id="user" placeholder="New User"/>
								<button type="button" class="btn submit" onclick="addUser()">Add</button>
							</label>
						</div>
					</div>
				</div>
				<label id="photo" class="list one-edge-shadow">
					<h3 class="dash-bot">Edit Image</h3>
					<input type="file" name="list_image_<?=$id?>"  />
				</label>
				<input type="submit" class="btn submit" value="Save"/>
			</form>
			<?if ($creator == "you") {?>
				<form id="delete" action="action_delete_list.php" method="get" onsubmit="return confirm('Are you sure you want to delete this list?')">
					<input type="hidden" name="id" value="<?=$_GET['id']?>"/>
					<input type="submit" class="btn delete" value="Delete List"/>
				</form>
				<?} ?>
		</div>
</div>
