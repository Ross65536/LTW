<?php
    require __DIR__ . '/../vendor/autoload.php';
    require_once __DIR__ . '/../database/IPattemptsFacade.php';

    $NUM_ATTEMPTS = 2;

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

    function checkShouldDisplayHTMLCaptcha()
    {
        global $NUM_ATTEMPTS; 

        $ipAttemptsDB = new IPattemptsFacade();
        $clientIP = $_SERVER['REMOTE_ADDR'];
        $ipAttemptsDB->tryAddingIP($clientIP); //insert 0 attempts if ip new

        $numAttempts = $ipAttemptsDB->getNumAttempts($clientIP);

        $bShouldDisplay = $numAttempts > $NUM_ATTEMPTS;

        return $bShouldDisplay;
    }

?>