<?php
    namespace Email;

    $php_email_regex ="/^[\S]+@[\S]+$/";

    function checkValidFormat($email)
    {
        global $php_email_regex;
        
        if($email == "")
            return false;
            
        $isMatching = preg_match($php_email_regex, $email) == 1;
        return $isMatching;
    }

    function domainExists($email, $record = "MX")
    {
        list($user, $domain) = explode("@", $email);
        $domain_exists = checkdnsrr($domain, $record) === TRUE;
        return $domain_exists;
    }

    function checkValid($email)
    {
        if(! checkValidFormat($email) )
            return false;

        if(! domainExists($email))
            return false;

        return true;
    }
    
?>