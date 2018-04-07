<?php

class HomeController extends Controller {

    public function __construct() {
        if (Session::exist()) {
            header('location:' . BASEURL . 'dashboard');
        }
        parent::__construct();
    }

    public function index() {
        $this->view->title = 'Login or Register';
        $this->view->render('home/index');
    }

}
