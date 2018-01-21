<?php

class Dashboard extends Controller {

    public function __construct() {
        if (Session::exist() == false) {
            $error = new Error('You are not loged in');
            $error->index();
        }
        parent::__construct();
    }

    public function index() {
        $this->view->title = 'Dashboard';
        $this->view->render('dashboard/index');
    }

    public function logout() {
        Session::destroy();
        header('location:' . BASEURL);
    }

    public function listAllUsers() {
        $this->view->title = 'All Users';
        $this->view->users = $this->model->getAllUsers();
        $this->view->render('dashboard/list');
    }

}
