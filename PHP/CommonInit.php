<?php
/**
 * So colocar aqui codigo que devia de aparecer em todas as paginas web.
 * 
 */

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();
    include_once(__DIR__ . '/Session.php'); 

?>