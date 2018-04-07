<?php

class Bootstrap {
    
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {

        $error_controller = ErrorController::getInstance();
        $url = $this->parseUrl();
        
        if(!empty($url[0])){
            $this->controller = ucfirst($url[0]).'Controller';
        }
        
        $this->controller = new $this->controller;
        
        if (isset($url[1])) {
             if (method_exists($this->controller, $url[1])) {
                 $this->method = $url[1];
             }
             else {
                 $error_controller->addError('Undefined method was called');
             }
             if(isset($url[2])){
                 $this->params = array_values(array_slice($url,2));
             }

        }

        $error_controller->checkErrors();
        call_user_func_array([$this->controller,$this->method],$this->params);
        
        /*
        $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : null;
        $url = explode('/', $url);
        $url[0] = empty($url[0]) ? 'Home' : $url[0];
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
        }*/
    }
    
    public function parseUrl(){
        
        if(isset($_GET['url'])){
            $trimed_url = rtrim($_GET['url'],'/');
            $filtred_url = filter_var($trimed_url, FILTER_SANITIZE_URL);
            $url_arr = explode('/',$filtred_url);
            return $url_arr;
        }
    }


}
