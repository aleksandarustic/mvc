<?php

class Error extends Controller {
    private $msg;
    public function __construct($msg) {
        parent::__construct();
        $this->msg = $msg;
    }

    public function index() {
        $this->view->msg = $this->msg;
        $this->view->render('error/index');
        exit();
    }

}
