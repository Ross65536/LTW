<?php

    /**
     * ex: Session\isLoggedIn(); to call a function in a namespace
     */
    namespace Session;

    /**
     * @return true if user is logged in
     */
    function isLoggedIn()
    {
        return isset($_SESSION['username']);
    }

    
    function redirectIndex() 
    {
        header('Location: index.php');
        exit(0);
    }

    function redirectTo($file) 
    {
        if($file == null)
            throw "Invalid File";
            
        header('Location: ' . $file);
        exit(0);
    }

    function redirectBack()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit(0);        
    }

    function redirectBackIfLoggedIn()
    {
        if(isLoggedIn())
            redirectBack();
    }

    function redirectBackIfNotLoggedIn()
    {
        if(! isLoggedIn())
            redirectBack();
    }

    function logIn($username)
    {
        $_SESSION['username'] = $username;
    }

    function getLoginUsername()
    {
        return $_SESSION['username'];
    }

    /**
     * @return true if user was logged and is then logged out
     */
    function logOut()
    {
        if(isLoggedIn())
        {
            unset($_SESSION['username']);
            return true;
        }
        else
            return false;
    }
?>
