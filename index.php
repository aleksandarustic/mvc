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
        require_once 'controllers/ErrorController.php';
        $error_controller = ErrorController::getInstance();
        $error_controller->addError('Sorry, that page does not exist');
        $error_controller->checkErrors();
    }
    
}
require_once 'config/config.php';
require_once 'config/mail.php';
require_once 'libs/lib.php';


require_once 'libs/PHPMailer/src/Exception.php';
require_once 'libs/PHPMailer/src/PHPMailer.php';
require_once 'libs/PHPMailer/src/SMTP.php';

$app = new Bootstrap();





