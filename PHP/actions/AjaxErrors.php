<?php

    final class AjaxErrors
    {
        public static function getSingleton()
        {
            if(AjaxErrors::$singletonInstance === null)
                AjaxErrors::$singletonInstance = new AjaxErrors();

            return AjaxErrors::$singletonInstance;
        }
        
        
        

        private static $singletonInstance = null;
        private function __construct()
        {
            echo "hi";
        }
    }

    $errors = AjaxErrors::getSingleton();

?>