<?php
    class MotoView{
        public function mostrarMotos($producto) {    
            $count = count($producto);          
            require 'app/templates/inicio.phtml';     
        }
        public function detalleMoto($producto){
            $count = count($producto);          
            require 'app/templates/detalleMoto.phtml';
        }
        function ShowHomeLocation(){          
            header("Location: ".BASE_URL."home");
        } 
        function MostrarErrorBorrar(){
            require'app/templates/error.phtml';
        }
        function volver($volver){
            $volver = "Volver a inicio <a href='" . BASE_URL . "home'>  hace clic aca </a>.";
            echo $volver;
        }
        function showError($msg){
            echo '<h1>error</h1>';
            echo "<h2>$msg</h2>";
        }
        function mostrarErrorRelacion(){
            require'app/templates/errorRelacion.phtml';
        }
    }
?>