<?php
    require_once './app/controllers/controller.php';
    require_once 'app/helpers/api.helper.php';
    require_once 'app/models/loginmodels.php';
    

    class UserApiController extends Controller {
        private $authHelper;

        function __construct() {
            parent::__construct();
            $this->authHelper = new AuthHelper();
            $this->model = new loginModel();
        }

        function getToken($params = []) {
            $basic = $this->authHelper->getAuthHeaders();

            if(empty($basic)) {
                $this->view->response('No envió encabezados de autenticación.', 401);
                return;
            }

            $basic = explode(" ", $basic);

            if($basic[0]!="Basic") {
                $this->view->response('Los encabezados de autenticación son incorrectos. ', 401);
                return;
            }

            $userpass = base64_decode($basic[1]);
            $userpass = explode(":", $userpass); 

            $nombre = $userpass[0];
            $password = $userpass[1];

            $user = $this->model->getUserByUsername($nombre);

            $userdata = [ "name" => $user];
       
            if($user && password_verify($password, $user->password)) {
                            
                $token = $this->authHelper->createToken($userdata);
                $this->view->response($token, 200);
                return;
            } else {
                $this->view->response('El usuario o contraseña son incorrectos.', 401);
                return;
            }
        }
    }