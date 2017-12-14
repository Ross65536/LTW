<?php
    namespace Regex;

    $password_regex = "^(?=(?:.*\d.*){2,})(?=(?:.*[A-Z].*){1,})(?=(?:.*[~!@#$%&*()_+{}\-\^\\/].*){1,})[\S]{8,}$";
    $php_password_regex = "/" . $password_regex . "/";
    $password_tip = "Password must be at least <b>8 characters</b> and contain at least: <b>2 numbers</b>, <b>1 uppercase</b> letter and <b>one</b> special character <b>~!@#$%&*()_+{}\-^/</b>";


    function checkStrongPassword($password)
    {
        global $php_password_regex;
        $isMatching = preg_match($php_password_regex, $password) == 1;
        return $isMatching;
    }
?>