<?php
    require __DIR__ . '/../vendor/autoload.php';

    function checkCaptchaSucces($bUseGET = true)
    {
        $CAPTCHA = "g-recaptcha-response";
        if($bUseGET && !isset($_GET[$CAPTCHA]) )
            return false;
        if(!$bUseGET && !isset($_POST[$CAPTCHA]) )
            return false;

        $clientKey = $bUseGET ? $_GET[$CAPTCHA] : $_POST[$CAPTCHA];

        $secret = "6LfWyzwUAAAAAFim0Zj5NON6gYMokVRMWkAoBk9V";
        $recaptcha = new \ReCaptcha\ReCaptcha($secret);
        $resp = $recaptcha->verify($clientKey, $_SERVER['REMOTE_ADDR']);
        if ($resp->isSuccess()) 
            return true;
        else 
            return false;
    }

?>