<?php
    include_once("PHP/Forms.php");
    $key = Forms\generateFormKey();
?>
<input type="hidden" name="form_key" value="<?=$key?>">
