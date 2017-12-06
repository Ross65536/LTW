
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
  <input type="submit" value="Create New"/>
</form>
