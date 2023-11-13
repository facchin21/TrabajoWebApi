<?php
    class LoginModel{
        private $db;

        public function __construct(){
            $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=tp-web;charset=' . DB_Charset, DB_USER, DB_PASS);
        }

        public function getUser($nombre){
            $query = $this->db->prepare('SELECT * FROM user WHERE nombre=?');
            $query->execute([$nombre]);
            return $query->fetch(PDO::FETCH_OBJ);
        }
    }

?>