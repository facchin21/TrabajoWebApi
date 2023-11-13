<?php
require_once './app/controllers/controller.php';
require_once './app/models/motoModel.php';

class MotoController extends Controller{
    private $AuthHelper;
    function  __construct(){
        parent::__construct();
        $this->model = new MotoModel();
        $this->AuthHelper = new AuthHelper();
    }

    // localhost/web2/Entrega3/api/motos/

    function getMotos($params = []) {
        {
            $user = $this->AuthHelper->currentUser();
            if (!$user) {
                 $this->view->response('Unauthorized', 401);
            return;
            }   
        }
        if (empty($params)) {
            $motos = $this->model->GetMotos();
            $this->view->response($motos, 200);
        } else {
            if (is_numeric($params[':ID'])) {
                $motos = $this->model->GetMotoById($params[':ID']);
                if (!empty($motos)) {
                    $this->view->response($motos, 200);
                } else {
                    $this->view->response('No existe ese modelo id', 404);
                }
            } else {
                $this->view->response('modelo id desconocido', 400);
            }
        }
    }

    // localhost/web2/Entrega3/api/motos/ Y CREAR EL RAW CORRESPONDIENTE.

    function addMoto($params = []){
        {$user = $this->AuthHelper->currentUser();
            if (!$user) {
                 $this->view->response('Unauthorized', 401);
            return;
            }   }
        $body = $this->getData();
        $nombreProducto = $body->nombreProducto;
        $capacidadTanque= $body->capacidadTanque;
        $fuerza= $body->fuerza;
        $cinlindrada= $body->cinlindrada;
       
        $id = $this->model->agregarMoto($nombreProducto, $capacidadTanque , $fuerza, $cinlindrada);
        $this->view->response("Se agrego correctamente la moto con el id ". $id, 201);
    }

    // localhost/web2/Entrega3/api/motos/3213219 SE DEBE ELEGIR EL ID CORRESPONDIENTE A ELIMINAR.

    function deleteMoto($params = []){
        {
            $user = $this->AuthHelper->currentUser();
            if (!$user) {
                 $this->view->response('Unauthorized', 401);
            return;
            }   
        }
        if (is_numeric($params[':ID'])) {
            $id = $params[':ID'];
            $moto = $this->model->GetMotoById($id);
            if ($moto) {
                $this->model->BorrarMoto($id);
                $this->view->response('Se elimino el modelo de moto', 200);
            } else {
                $this->view->response('No existe el modelo de moto', 404);
            }
        } else {
            $this->view->response('Parametros desconocidos', 400);
        }
    }
    // localhost/web2/Entrega3/api/motos/321321  SE DEBE ELEGIR EL ID CORRESPONDIENTE A EDITAR.

    function updateMoto($params = []){
        {
            $user = $this->AuthHelper->currentUser();
            if (!$user) {
                 $this->view->response('Unauthorized', 401);
            return;
            }   
        }
        if (is_numeric($params[':ID'])) {
            $ModeloID = $params[':ID'];
            $moto = $this->model->GetMotoById($ModeloID);

            if($moto){
                $body = $this->getData();
                $nombreProducto = $body->nombreProducto;
                $capacidadTanque = $body->capacidadTanque;
                $fuerza = $body->fuerza;
                $cinlindrada = $body->cinlindrada;

                $this->model->editarMotoByID($ModeloID,$nombreProducto, $capacidadTanque , $fuerza, $cinlindrada);
                $this->view->response("Se actualizaron los datos del modelo con el id: " . $ModeloID, 200);
            } else {
                $this->view->response("No se encontro un modelo con el id: " . $ModeloID, 404);
            }
        } else {
            $this->view->response('Parametros desconocidos', 400);
        }
    }

        // FILTRA SOLO POR NOMBRE PRODUCTO.
        // localhost/web2/Entrega3/api/motos/nombreProducto/carlos

        function getMotoByNombreProducto($params = []) {
            if (!empty($params[':nombreProducto'])) {
                $nombreProducto = $params[':nombreProducto'];
                $moto = $this->model->getMotoByNombreProducto($nombreProducto);
    
                if ($moto) {
                    $this->view->response($nombreProducto, 200);
                } else {
                    $this->view->response('No se encontraron motos con ese nombre producto', 404);
                }
            } else {
                $this->view->response('Falta el parámetro del Nombre Producto', 400);
            }
        }

}

?>