<?php
    require_once('PHP/Captcha.php');

    $bVisibleCaptcha = shouldDisplayCaptcha();

    $captcha_class = $bVisibleCaptcha ? "visible_captcha" : "invisible_captcha";
?>
<div id="google_recaptcha" class="g-recaptcha <?=$captcha_class?>" data-sitekey="6LfWyzwUAAAAAFpS8dvxvhG0avCz_KVuB6seoqIw"></div>