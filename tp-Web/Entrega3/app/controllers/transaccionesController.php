<?php
    require_once './app/controllers/controller.php';
    require_once './app/models/transaccionesModel.php';

    class TransaccionesController extends Controller{ 
        private $AuthHelper;

        function __construct(){
            parent::__construct();
            $this->model = new TransaccionesModel();
            $this->AuthHelper = new AuthHelper();
        }

    // localhost/web2/Entrega3/api/transacciones/

        function get($params = []) {
            if (empty($params)) {
                $transaccion = $this->model->getTransacciones();
                $this->view->response($transaccion, 200);
            } else {
                if (is_numeric($params[':ID'])) {
                    $transaccion = $this->model->getTransaccionByID($params[':ID']);
                    if (!empty($transaccion)) {
                        $this->view->response($transaccion, 200);
                    } else {
                        $this->view->response('Transaccion inexistente', 404);
                    }
                } else {
                    $this->view->response('Parametros desconocidos', 400);
                }
            }
        }

        // localhost/web2/Entrega3/api/transacciones/3213219 SE DEBE ELEGIR EL ID CORRESPONDIENTE A ELIMINAR.

        function delete($params = []){
            {
                $user = $this->AuthHelper->currentUser();
                if (!$user) {
                     $this->view->response('Unauthorized', 401);
                return;
                }   
            }
            if (is_numeric($params[':ID'])) {
                $id = $params[':ID'];
                $transaccion = $this->model->getTransaccionByID($id);
                if ($transaccion) {
                    $this->model->borrarTransacionByID($id);
                    $this->view->response('Se elimino la transaccion', 200);
                } else {
                    $this->view->response('No existe la transaccion', 404);
                }
            } else {
                $this->view->response('Parametros desconocidos', 400);
            }
        }

        // localhost/web2/Entrega3/api/transacciones/ Y CREAR EL RAW CORRESPONDIENTE.

        function add($params = []){
            {
                $user = $this->AuthHelper->currentUser();
                if (!$user) {
                     $this->view->response('Unauthorized', 401);
                return;
                }   
            }
                $body = $this->getData();
                $canal = $body->canal;
                $modeloID = $body->modeloID;
                $precio = $body->precio;
                $descuento = $body->descuento;

                $id = $this->model->agregarTransaccion($canal, $modeloID, $precio, $descuento);
                $this->view->response("Transaccion con el id: " . $id ." agregada con exito!" ,  201);
        }

        // localhost/web2/Entrega3/api/transacciones/3213229  SE DEBE ELEGIR EL ID CORRESPONDIENTE A EDITAR.

        function update($params = []){
            {
                $user = $this->AuthHelper->currentUser();
                if (!$user) {
                     $this->view->response('Unauthorized', 401);
                return;
                }   
            }
            if (is_numeric($params[':ID'])) {
                $transacionesID = $params[':ID'];
                $transaccion = $this->model->getTransaccionByID($transacionesID);

                if($transaccion){
                    $body = $this->getData();
                    $canal = $body->canal;
                    $precio = $body->precio;
                    $descuento = $body->descuento;

                    $this->model->editarTransaccionesByID($transacionesID ,$canal, $precio, $descuento);
                    $this->view->response("Transaccion con el id: " . $transacionesID ." actualizada con exito" , 200);
                } else {
                    $this->view->response("No se encontro la transaccion con el id: " . $transacionesID, 404);
                }
            } else {
                $this->view->response('Parametros desconocidos', 400);
            }
        }

        // ORDENA POR PRECIO ASCENDENTE O DESENDENTE.
        // localhost/web2/Entrega3/api/transacciones/orden/desc

        function getByOrder($params = []) {
            switch ($params[':ORDER']) {
                case 'asc':
                    $transaciones = $this->model->getTransaccionesOrdenadas($params[':ORDER']);
                    $this->view->response($transaciones, 200);
                    break;
                case 'desc':
                    $transaciones = $this->model->getTransaccionesOrdenadas($params[':ORDER']);
                    $this->view->response($transaciones, 200);
                    break;
                default:
                    $this->view->response('Parametro desconocido', 400);
                    break;
            }
        }

        // FILTRA SOLO POR CANALES.
        // localhost/web2/Entrega3/api/transacciones/canal/web

        function getTransaccionByCanal($params = []) {
            if (!empty($params[':CANAL'])) {
                $canal = $params[':CANAL'];
                $transaccion = $this->model->getTransaccionByCanal($canal);
    
                if ($transaccion) {
                    $this->view->response($transaccion, 200);
                } else {
                    $this->view->response('No se encontraron transaccion con ese canal', 404);
                }
            } else {
                $this->view->response('Falta el parámetro del canal', 400);
            }
        }
    }
?>