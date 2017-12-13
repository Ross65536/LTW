<div id="upload" class="full-height parallax">
  <div class="account centered one-edge-shadow">
    <h2>Current Photo</h2>
    <img class="rounded-img" src="<?=$photo?>" alt="Current Picture"/>
    <form id="photo_upload" action="action_save_user_photo.php?" enctype="multipart/form-data" method="get">
      <div id="photo">
        <input type="hidden" name="username" value="<?=$username?>"/>
        <input type="file" name="user_image_<?=$username?>"/>
        <input type="submit" class="btn submit" value="Change Image"/>
      </div>
    </form>
  </div>
</div>
