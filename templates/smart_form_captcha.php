<?php
    require_once('PHP/Captcha.php');

    $bIncludeCaptcha = checkShouldDisplayHTMLCaptcha();
    if($bIncludeCaptcha)
        include_once('templates/form_captcha.php');    
?>