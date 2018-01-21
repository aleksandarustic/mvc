<?php

class Bootstrap {

    public function __construct() {

        $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : null;
        $url = explode('/', $url);
        $url[0] = empty($url[0]) ? 'Index' : $url[0];
        $controller =  new $url[0];
        $controller->loadModel($url[0]);

        if (isset($url[2])) {
            if (method_exists($controller, $url[1])) {
                $controller->{$url[1]}($url[2]);
            } else {
                 $this->error('Undefined metod was called');
            }
        } else {
            if (isset($url[1])) {
                if (method_exists($controller, $url[1])) {
                    $controller->{$url[1]}();
                } else {
                    $this->error('Undefined metod was called');
                }
            } else {
                $controller->index();
            }
        }
    }

    public function error($msg) {
        $controller = new Error($msg);
        $controller->index();
        return false;
    }

}
