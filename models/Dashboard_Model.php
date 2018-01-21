<?php

class Dashboard_Model extends Model {

    public function __construct() {
        parent::__construct();
    }
    public function getAllUsers(){
        $sql = 'SELECT * FROM users ORDER BY datecreation DESC';
        $sth = $this->db->query($sql);
        $result = $sth->fetchAll();
        $num_rows = count($result);
        if($num_rows > 0){
            return $result;
        }
        else{
            $error =  new Error('There is not users');
            $error->index(); 
        }
    }

}