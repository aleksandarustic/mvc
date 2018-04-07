<?php

class Session {

    public static function start() {
        session_start();
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }
    public static function exist(){
        if(isset($_SESSION['loged'])){
            return true;
        }
        else{
            return false;
        }
    }

    public static function get($key) {
        return $_SESSION[$key];
    }
    
    public static function destroy(){
        unset($_SESSION);
        session_destroy();
    }

}
