<?php
    require_once 'app/views/loginView.php';
    require_once 'app/models/loginModel.php';

    class loginController{
        private $model;
        private $view;
        
        public function __construct(){
            $this->model = new loginModel();
            $this->view = new loginView();
        }

        public function login(){
            $this->view->mostrarLogin();
        }
        
        public function checkLogin(){
            $nombre = $_POST['nombre'];
            $password = $_POST['password'];
            if (empty($nombre) || empty($password)) {
                $this->view->mostrarLogin('Faltan completar datos');
                die;
            }
            $user = $this->model->getUser($nombre);
            if($user && password_verify($password, $user->password)){
                session_start();
                $_SESSION['USER_ID'] = $user->userID;
                $_SESSION['USER_NAME'] = $user->nombre;
                $_SESSION['logged'] = true;
                header("Location: " . BASE_URL . "home");
                die;
            }else{
                $this->view->mostrarLogin('usuario o contraseña incorrecta');
                die;
            }
        }

        public function logout(){
            session_start();
            session_destroy();
            header("Location: " . BASE_URL . "home");
        }
    }
?>