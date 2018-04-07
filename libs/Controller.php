<?php

class Controller {

    protected $view;
    protected $model = null;

    public function __construct() {
        $this->view = new View();
    }

    public function model($name) {

        $path = './models/' . $name . '_Model.php';

        if (file_exists($path)) {
            require './models/' . $name . '_Model.php';

            $modelName = $name . '_Model';
            $this->model = new $modelName();
        }
    }

}
