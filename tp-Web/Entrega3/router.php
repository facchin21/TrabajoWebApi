<?php
    require_once './config/config.php';
    require_once 'libs/router.php';
    require_once './app/controllers/motoController.php';
    require_once './app/controllers/transaccionesController.php';
    require_once './app/controllers/userapicontroller.php';
    

    $router = new Router();
    $router->addRoute('motos/nombreProducto/:nombreProducto', 'GET', 'MotoController', 'getMotoByNombreProducto');
    $router->addRoute('motos', 'GET', 'MotoController', 'getMotos');
    $router->addRoute('motos', 'POST', 'MotoController', 'addMoto');
    $router->addRoute('motos/:ID', 'GET', 'MotoController', 'getMotos');
    $router->addRoute('motos/:ID', 'PUT', 'MotoController', 'updateMoto');
    $router->addRoute('motos/:ID', 'DELETE', 'MotoController', 'deleteMoto');

    
    $router->addRoute('transacciones/canal/:CANAL', 'GET', 'transaccionesController', 'getTransaccionByCanal');
    $router->addRoute('transacciones/orden/:ORDER',  'GET', 'transaccionesController', 'getByOrder');
    $router->addRoute('transacciones', 'GET', 'transaccionesController', 'get');
    $router->addRoute('transacciones', 'POST', 'transaccionesController', 'add');
    $router->addRoute('transacciones/:ID', 'GET', 'transaccionesController', 'get');
    $router->addRoute('transacciones/:ID', 'PUT', 'transaccionesController', 'update');
    $router->addRoute('transacciones/:ID', 'DELETE', 'transaccionesController', 'delete');
    
    
    // localhost/web2/Entrega3/api/auth/token
    $router->addRoute('auth/token', 'GET', 'UserApiController', 'getToken');
    
    
    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
?>