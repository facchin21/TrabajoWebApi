<?php
require_once './config/config.php';
class loginModel extends Model{

    public function getUserByUsername($nombre){
        $query = $this->db->prepare('SELECT * FROM user WHERE nombre= ?');
        $query->execute([$nombre]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}