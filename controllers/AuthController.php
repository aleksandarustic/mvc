<?php

class AuthController extends Controller {

    public function __construct() {
        if (Session::exist()) {
            header('location:' . BASEURL . 'dashboard');
        }
        parent::__construct();
        $this->model('Auth');
    }

    public function index() {
        $this->login();
    }

    public function login() {
        $this->view->title = 'login';
        $this->view->render('auth/login');
    }
    public function register() {
        $this->view->title = 'register';
        $groups = $this->model->getGroups();
        $this->view->groups = $groups;
        $this->view->render('auth/register');
    }

    public function authLogin() {
        $this->model->login();
    }

    public function authRegister() {
        $this->model->register();
    }

}
