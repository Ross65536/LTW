<div id="my_lists" class="full-height def-size centered parallax">
  <div class="off-edges white-back">
    <h2>My lists:</h2>
    <?
    if (empty($lists)) {?><p>You have no lists.</p><?}
    $counter = 0;
    foreach ($lists as $list) {
      $creator = $listsDB->displayCreator($list['id']);
      $counter++;?>
      <p>List <?=$counter?>: <a href="single_list.php?id=<?=$list['id']?>"><?=$list['name']?></a> created by <?=$creator?></p>
      <?}  ?>

      <form action="create_list.php">
        <button type="submit" class="btn submit">Create</button>
      </form>
    </div>
</div>
