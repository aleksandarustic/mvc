<?php
Session::start();

function __autoload($className) {
    if (file_exists('controllers/'.$className.'.php')) {
         require_once( "controllers/$className.php" );
    }
    elseif(file_exists('models/'.$className.'.php')){
         require_once( "models/$className.php" );
    }
    elseif(file_exists('libs/'.$className.'.php')){
        require_once( "libs/$className.php" );
    }
    else{
        require 'controllers/error.php';
        $controller = new Error('Stranica ne postoji !');
        $controller->index();
    }
    
}
require_once 'config/config.php';

$app = new Bootstrap();





