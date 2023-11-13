<?php
    require_once 'app/controllers/motoController.php';
    require_once 'app/controllers/transaccionesController.php';
    require_once 'app/controllers/loginController.php';

    define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');
    
    $action = 'home'; 
        if (!empty($_GET['action'])) {
            $action = $_GET['action'];
        }
        
    $params = explode('/', $action);

     switch ($params[0]) {
        case 'home':
            $controller = new MotoController();
            $controller->showMotos();
            $controller = new TransaccionesController();
            $controller->showTransacciones();
            break;
        case 'detalleModelo':
            $controller = new MotoController();
            $controller->showMotosDetalles($params[1]);
            break;
            
        case 'borrar':
            $controller = new MotoController();
            $controller->borrarMoto($params[1]);
            break;

        case 'agregar':
            $controller = new MotoController();
            $controller->agregarMoto();
            break;

        case 'editarMoto':
            $controller = new MotoController();
            $controller->editarMoto($params[1]);
            break;
        case 'auth' :
            $controller = new loginController();
            $controller->checkLogin();
            
        case 'login':
            $controller = new loginController();
            $controller->login();
            break;
        case 'logout':
            $controller = new loginController();
            $controller->logout();
            break;
        
        //Transacciones.

        case 'detalleTransacciones':
            $controller = new TransaccionesController();
            $controller->showTransaccionesDetalles($params[1]);
            break;

        case 'borrarTransacciones':
            $controller = new TransaccionesController();
            $controller->borrarTransacciones($params[1]);
            break;
        case 'agregarTransacciones':
            $controller = new TransaccionesController();
            $controller->agregarTransacciones();
            break;
        case 'editarTransaccion':
            $controller = new TransaccionesController();
            $controller->editarTransacciones($params[1]);
            break;
        
            default:
            echo "404 Page Not Found";
            break;
        }
?>