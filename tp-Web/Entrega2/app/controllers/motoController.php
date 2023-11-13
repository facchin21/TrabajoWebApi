<?php
    include_once 'app/models/motoModel.php';
    include_once 'app/views/motoView.php';

    class MotoController{
        private $model;
        private $view;
        
        function __construct(){
            $this->model = new MotoModel();
            $this->view = new MotoView();
        }

        public function showMotos() {
            $motos = $this->model->getMotos();
            $this->view->mostrarMotos($motos);
        }

        public function showMotosDetalles($ModeloID){
            $motos = $this->model->getMotoByID($ModeloID);
            $this->view->detalleMoto($motos);
        }

        public function borrarMoto($ModeloID){
            try{
                $resultado = $this->model->borrarMotoXID($ModeloID);
                if($resultado !== false ){
                    header("Location: " . BASE_URL . "home");
                }
            }catch(PDOException $e){
                header("refresh:5;url=" .BASE_URL ."home");
                $this->view->mostrarErrorRelacion();
            }
        }
        public function agregarMoto(){
            $nombreProducto = $_POST['nombreProducto'];
            $ModeloID = $_POST['ModeloID'];
            $capacidadTanque = $_POST['capacidadTanque'];
            $fuerza = $_POST['fuerza'];
            $cinlindrada = $_POST['cinlindrada'];             
            try{
                if(empty ($nombreProducto) || empty ($ModeloID) || empty ($capacidadTanque) || empty($fuerza) || empty($cinlindrada)){
                    $this->view->showError("Debe completar todos los campos");
                    return;
                }
                $resultado = $this->model->agregarMoto($nombreProducto, $ModeloID, $capacidadTanque , $fuerza, $cinlindrada);
                if($resultado !== false){
                    header("Location: " . BASE_URL . "home");
                }
            }catch(PDOException $e){
                header("refresh:5;url=" .BASE_URL ."home");
                $this->view->MostrarErrorBorrar();
            }
        }

        public function editarMoto(){
             if(!empty($_POST['nombreProducto'] ||!empty($_POST['ModeloID']) || !empty($_POST['capacidadTanque']) || !empty($_POST['fuerza']) || !empty($_POST['cinlindrada']) )){
                $nombreProducto = $_POST['nombreProducto'];
                $ModeloID = $_POST['ModeloID'];
                $capacidadTanque = $_POST['capacidadTanque'];
                $fuerza = $_POST['fuerza'];
                $cinlindrada = $_POST['cinlindrada'];  
                $this->model->editarMotoByID($nombreProducto, $ModeloID, $capacidadTanque , $fuerza, $cinlindrada);
                $this->view->ShowHomeLocation(); 
             }
        }
    }
    
?>