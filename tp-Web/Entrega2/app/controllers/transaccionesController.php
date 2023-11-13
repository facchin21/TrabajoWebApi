<?php
    include_once 'app/models/transaccionesModel.php';
    include_once 'app/views/transaccionesView.php';
    
    class TransaccionesController{
        private $model;
        private $view;
        
        function __construct(){
            $this->model = new TransaccionesModel();
            $this->view = new TransaccionesView();
        }
        
        function showTransacciones(){
            $transaciones = $this->model->getTransacciones();
            $this->view->mostrarTransacciones($transaciones);
        }
        
        public function showTransaccionesDetalles($transacionesID){
            $transaccion = $this->model->getTransaccionesByID($transacionesID);
            $this->view->detalleTransacciones($transaccion);
        }


        public function borrarTransacciones($transacionesID){
            try{
                $resultado = $this->model->borrarTransacionXID($transacionesID);
                if($resultado !== false ){
                    header("Location: " . BASE_URL . "home");
                }
            }catch(PDOException $e){
                header("refresh:5;url=" .BASE_URL ."home");
                $this->view->MostrarErrorBorrar();
            }
        }

        public function agregarTransacciones(){
            $transacionesID = $_POST['transacionesID'];             
            $canal = $_POST['canal'];
            $modeloID = $_POST['modeloID'];
            $precio = $_POST['precio'];
            $descuento = $_POST['descuento'];
            try{
                if(empty ($canal) || empty ($modeloID) || empty($precio) || empty($transacionesID)){
                    $this->view->showError("Debe completar todos los campos");
                    return;
                }
                $resultado = $this->model->agregarTransaccion($transacionesID, $canal, $modeloID, $precio, $descuento);
                if($resultado !== false){
                    header("Location: " . BASE_URL . "home");
                }
            }catch(PDOException $e){
                header("refresh:5;url=" .BASE_URL ."home");
                $this->view->MostrarErrorBorrarInexistente();
            }
        }
        public function editarTransacciones(){
            if(!empty($_POST['transacionesID'] ||!empty($_POST['canal']) || !empty($_POST['modeloID']) || !empty($_POST['precio']) || !empty($_POST['descuento']) )){
                $transacionesID = $_POST['transacionesID'];             
                $canal = $_POST['canal'];
                $modeloID = $_POST['modeloID'];
                $precio = $_POST['precio'];
                $descuento = $_POST['descuento'];  
                $this->model->editarTransaccionesByID($transacionesID, $canal, $modeloID, $precio, $descuento);
                $this->view->ShowHomeLocation(); 
             }
        }
    }
?>