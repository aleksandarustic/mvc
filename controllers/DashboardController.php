<?php

class DashboardController extends Controller {

    public function __construct() {
        if (Session::exist() == false) {
            $error = ErrorController::getInstance();
            $error->showError('You are not loged in');
        }
        parent::__construct();
        $this->model('Dashboard');
    }

    public function index() {
        $this->view->title = 'Dashboard';
        $this->view->profile = $this->model->getProfile();
        $this->view->top_users = $this->model->topUsers($this->view->profile['groupid']);
        $this->view->posts = $this->model->loadPosts($this->view->profile['groupid']);

        $this->view->render('dashboard/index');
    }
    public function group($groupid) {
        $this->view->title = 'Group';
       // $this->view->profile = $this->model->getProfile();
        $this->view->top_users = $this->model->getAllGroupUsers($groupid);
        $this->view->posts = $this->model->loadOtherPosts($groupid);
        $this->view->group = $this->model->getGroupInfo($groupid);
        $this->view->render('dashboard/group');
    }
    
    public function deleteAccount($userid){
        $this->model->deleteAccount($userid);
        $this->logout();
    }

    public function logout() {
        Session::destroy();
        header('location:' . BASEURL);
    }
    public function updateProfile(){
        $this->model->updateProfile();
    }

    public function listAllUsers() {
        $this->view->title = 'All Users';
        $this->view->users = $this->model->getAllUsers();
        $this->view->render('dashboard/list');
    }

    public function groups() {
        $this->view->title = 'Groups';
        $this->view->groups = $this->model->getAllGroups();
        $this->view->render('dashboard/groups');
    }
    public function help() {
        $this->view->title = 'Help';
        $this->view->users = $this->model->getAllUsers();
        $this->view->render('dashboard/help');
    }
    public function events() {
        $this->view->title = 'Events';
        $this->view->profile = $this->model->getProfile();
        $this->view->events = $this->model->getAllEvents();
        $this->view->render('dashboard/events');
    }
    public function profile() {
        $this->view->title = 'Profile';
        $this->view->profile = $this->model->getProfile();
        $this->view->campus = $this->model->getAllCampus();
        $this->view->groups = $this->model->getGroups();
        $this->view->render('dashboard/profile');
    }
    public function user($userid) {
        $this->view->title = 'User profile';
        $this->view->profile = $this->model->getProfile($userid);
        $this->view->campus = $this->model->getAllCampus();
        $this->view->groups = $this->model->getGroups();
        $this->view->render('dashboard/user');
    }

    public function addEvent(){
         $this->model->addEvent();
    }

    public function ajaxAddPost(){
        $data = $this->model->addPost();
        echo json_encode($data);
    }

    public function ajaxAddReply(){
        $data = $this->model->addReply();
        echo json_encode($data);
    }

    public function ajaxUpdatePosts(){
        $data = $this->model->loadPosts($_POST['groupid']);
        echo json_encode($data);
    }
    public function ajaxAddLike(){
        $data = $this->model->AddLike();
        echo json_encode($data);
    }

    public function ajaxRemoveLike(){
        $data = $this->model->removeLike();
        echo json_encode($data);
    }

}
