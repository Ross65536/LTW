<?php
    namespace Forms;

    function generate_random_token() 
    {
        return bin2hex(openssl_random_pseudo_bytes(32));
    }

    function generateFormKey()
    {
        $key = generate_random_token();
        $_SESSION['formKey'] = $key;

        return $key;
    }

    function checkFormKeyCorrect($formKey)
    {
        if (isset($_SESSION['formKey']) && $_SESSION['formKey'] === $formKey) 
            return true;
        else
            return false;
    }
?>