<?php

class ErrorController extends Controller {
    private $errors = [];
    private static $instance;
    private $layout = 'default';

    public static function getInstance($layout = 'default')
    {
        if (!isset(ErrorController::$instance)) {
            ErrorController::$instance = new ErrorController($layout);
        }
        return ErrorController::$instance;
    }
    public function setLayout($layout) {
        $this->layout = $layout;
    }

    public function __construct() {
        parent::__construct();
        $this->view->title = 'Error';
    }

    public function addError($msg){
        $this->errors[]= $msg;
    }

    public function showError($msg){
        $this->errors[] = $msg;
        $this->checkErrors();
    }

    public function checkErrors(){
        if(!empty($this->errors)){
            $this->view->messages = $this->errors;
            $this->view->layout = $this->layout;
            $this->view->render('error/index');
            exit();
        }
    }

    public function index() {
        $this->view->msg = $this->msg;
        $this->view->render('error/index');
        exit();
    }

}
