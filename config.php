<?php

    $load = function($class)
    {
        include('classes/'.$class.'.php');
    };

    spl_autoload_register($load);
    
    define("FONT",'https://fonts.googleapis.com/css?family=Baloo+Thambi+2&display=swap');
    // PATCH

    define("MAIN_PATH", 'http://localhost/Php-Stock-System/');
    
    // CONNECT DB

    define('HOST','localhost');
    define('USER','rooter');
    define('PASSWORD','');
    define('DB','stock');

?>