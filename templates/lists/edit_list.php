<div class="def-size centered">
	<div class="off-edges white-back">
		<form class="edit-form" action="action_save_list.php" method="post" enctype="multipart/form-data">
		  <input type="hidden" name="id" value="<?=$id?>"/>
		  <input type="hidden" name="creator" value="<?=$creator?>"/>
		  <input type="hidden" name="type" value="edit"/>
			<div id="top_header">
		    <div id="main_info" class="one-edge-shadow">
					<? if ($creator == 'you') {?>
				  <label>
					Title <input type="text" name="name" value="<?=$title?>"/>
				  </label>
				  <?} else {?>
					<h2><?=$title?></h2>
					<?}?>
		    </div>
		    <div id="image">
		      <img class="rounded-img one-edge-shadow" src="<?=$photo?>" alt="List Photo"/>
		    </div>
		  </div>
			<div class="blurbs blurbs-2">
				<div class="blurb">
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
							<button type="button" class="btn">X</button>
						</li>
						<?}
						?>
					</ul>
				<label>
					<input type="text" id="item" placeholder="New Item"/>
					<button type="button" class="btn" onclick="addItem()">Add</button>
				</label>
			</div>
				<div class="blurb">
					<h3>Users</h3>
					<ul id="users_list"><?
						foreach ($listUsers as $user) {?>
							<li>
								<span class="username"><?=$user['username']?></span>
								<input type="hidden" value="<?=$user['username']?>" name="users[]"/>
								<button type="button" class="btn">X</button>
							</li>
						<?}
						?>
					</ul>
					<label>
						<input type="text" id="user" placeholder="New User"/>
						<button type="button" class="btn" onclick="addUser()">Add</button>
					</label>
				</div>
			</div>
			<label id="photo">
				<span>Edit Image</span>
				<input type="file" name="list_image_<?=$id?>"  />
			</label>
			<input type="submit" class="btn submit" value="Save"/>
		</form>
		<?if ($creator == "you") {?>
			<form action="action_delete_list.php" method="get" onsubmit="return confirm('Are you sure you want to delete this list?')">
				<input type="hidden" name="id" value="<?=$_GET['id']?>"/>
				<input type="submit" class="btn" value="Delete List"/>
			</form>
		<?} ?>
	</div>
</div>
