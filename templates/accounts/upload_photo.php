<h2>Current Photo</h2>
<img src="<?=$photo?>" alt="Current Picture"/>
<form id="photo_upload" action="action_save_user_photo.php?" enctype="multipart/form-data" method="get">
  <label id="photo">
      <span> Change Image </span>
      <input type="hidden" name="username" value="<?=$username?>"/>
      <input type="file" name="user_image_<?=$username?>"/>
      <input type="submit" value="Upload Image"/>
  </label>
</form>
