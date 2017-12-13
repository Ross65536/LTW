<?php
    namespace Regex;

    $password_regex = "^(?=(?:.*\d.*){2,})(?=(?:.*[A-Z].*){1,})(?=(?:.*[~!@#$%&*()_+{}\-\^\\/].*){1,})[\S]{8,}$";
    $php_password_regex = "/" . $password_regex . "/";
    $password_tip = "Password must be at least 8 characters and contain at least: 2 numbers, 1 uppercase letter, one of these characters: <b>~!@#$%&*()_+{}\-^/</b> and contain no spaces or tabs";


    function checkStrongPassword($password)
    {
        global $php_password_regex;
        $isMatching = preg_match($php_password_regex, $password) == 1;
        return $isMatching;
    }
?>