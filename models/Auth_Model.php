<?php

class Auth_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public static function safestrip($string) {
        $string = trim($string);
        $string = stripslashes($string);
        $string = htmlspecialchars($string);
        return $string;
    }

    public function getGroups() {
        $sql = 'SELECT * FROM groups';
        $sth = $this->db->query($sql);
        $result = $sth->fetchAll();
        $num_rows = count($result);
        if ($num_rows > 0) {
            return $result;
        } else {
            $error = ErrorController::getInstance();
            $error->showError('There is no groups');
        }
    }

    public function login() {
        $errorController = ErrorController::getInstance();
        $errorController->setLayout('login');

        $email = self::safestrip($_POST['email']);
        $password = self::safestrip($_POST['password']);
        if (empty($email)) {
            $errorController->addError('You must enter email');
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorController->addError('Your email is not valid');
        }
        if (empty($password)) {
            $errorController->addError('You must enter password');
        }

        $errorController->checkErrors();

        $sql = 'SELECT * FROM users WHERE email = :email AND password = :password';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user === FALSE) {
            $errorController->addError('Incorect email or password');
            $errorController->checkErrors();
        } else {
            $_SESSION['id'] = $user['id'];
            $_SESSION['loged'] = true;
            $_SESSION['email'] = $user['email'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            header('location:' . BASEURL . 'dashboard');
        }
    }

    public function register() {

        $errorController = ErrorController::getInstance();
        $errorController->setLayout('register');

        $firstname = self::safestrip($_POST['firstname']);
        $lastname = self::safestrip($_POST['lastname']);
        $email = self::safestrip($_POST['email']);
        $password = self::safestrip($_POST['password']);
        $password_retype = self::safestrip($_POST['password_retype']);
        $avatar_path = 'public/user_images/' . $_FILES['avatar']['name'];
        $group = $_POST['group'];

        if (empty($firstname) || empty($lastname)) {
            $errorController->addError('You must enter first name and last name');
        }

        if (empty($email)) {
            $errorController->addError('You must enter email');
        } else if (!preg_match('/W\d{7}@my.westminster.ac.uk$/i',$email)) {
            $errorController->addError('Your email is not valid');
        } else {
            $stmt = $this->db->prepare('SELECT email FROM users WHERE email=:email');
            $stmt->bindValue(':email', $email);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
              $errorController->addError('Email already Exists,try again with other email');
            }
        }

        if (empty($password)) {
            $errorController->addError('You must enter password');
        } else if ($password != $password_retype) {
            $errorController->addError('Password does not match the confirm password.');
        }

        if ($group == 0) {
            $errorController->addError('You must select group');
        }

        if (preg_match("!image!", $_FILES['avatar']['type'])) {
            copy($_FILES['avatar']['tmp_name'], $avatar_path);
        } else {
            $errorController->addError('Error while uploading avatar');
        }


        $errorController->checkErrors();


        $sql = "INSERT INTO users (firstname, lastname, email, password,avatar) VALUES (:firstname,:lastname,:email,:password,:avatar)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':firstname', $firstname);
        $stmt->bindValue(':lastname', $lastname);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':avatar', $avatar_path);
        $check = $stmt->execute();
        if ($check === TRUE) {
            $_SESSION['id'] = $this->db->lastInsertId();
            $_SESSION['loged'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;

            $sql = "INSERT INTO users_groups (userid, groupid) VALUES (:userid,:groupid)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':userid', $this->db->lastInsertId());
            $stmt->bindValue(':groupid', $group);
            $stmt->execute();

            header('location:' . BASEURL . 'dashboard');
        } else {
            $errorController->addError('Incorect email or password');
            $errorController->checkErrors();
        }
    }

}
