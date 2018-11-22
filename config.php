<?php

    // Application debug 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Initialize the session
    session_start();

    /* Configuration available through the project */
    define('DIR_BASE',      dirname( __FILE__ ) . '/');
    define('DIR_UTILS',     DIR_BASE . 'utils/');
    define('DIR_VIEWS',     DIR_BASE . 'views/');
    define('DIR_CTLS',      DIR_BASE . 'controllers/');

    /* Database credentials  */
    define('DB_HOST', 'localhost');
    define('DB_PORT', '3306');
    define('DB_USERNAME', 'unuservize');
    define('DB_PASSWORD', 'KelBemar590251');
    define('DB_NAME', 'gsa');

    /* Constants to use */
    define('CONST_EMAIL', 'your@email.com');

    /* Controllers Autoloader */
    spl_autoload_register(function ($controllerName) {
        require DIR_CTLS.$controllerName . '.php';
    });

?>