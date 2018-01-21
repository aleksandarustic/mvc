<?php
class Index_Model extends Model {

    public function __construct() {
        parent::__construct();
    }
    private static function safestrip($string){
       $string = strip_tags($string);
       return $string;
    }
    public function login() {
        $username = self::safestrip($_POST['username']);
        $password = self::safestrip($_POST['password']);
        $sql = 'SELECT * FROM users WHERE username = :username AND password = :password';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user === FALSE) {
            $error =  new Error('Incorect username or password');
            $error->index();
        } else {
            $_SESSION['id'] = $user['id'];
            $_SESSION['loged'] = true;
            $_SESSION['username'] = $user['username'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            header('location:'.BASEURL.'dashboard');

        }
    }
    public function register() {
        $firstname = self::safestrip($_POST['firstname']);
        $lastname = self::safestrip($_POST['lastname']);
        $username = self::safestrip($_POST['username']);
        $password = self::safestrip($_POST['password']);
        $sql = "INSERT INTO users (firstname, lastname, username, password) VALUES (:firstname,:lastname,:username,:password)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':firstname',$firstname);
        $stmt->bindValue(':lastname',$lastname);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password',$password);
        $check = $stmt->execute();
        if($check === TRUE){
            $_SESSION['id'] = $this->db->lastInsertId();
            $_SESSION['loged'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            header('location:'.BASEURL.'dashboard');
        }
        else{
            $error =  new Error($stmt->errorCode());
            $error->index();
        } 
    }

}