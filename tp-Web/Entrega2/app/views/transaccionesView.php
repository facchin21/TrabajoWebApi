<?php
    class TransaccionesView{
        public function mostrarTransacciones($transaccion) {    
            $count = count($transaccion);          
            require 'app/templates/transaccionesinicio.phtml';
        }
        public function detalleTransacciones($transaccion){
            $count = count($transaccion);          
            require 'app/templates/detalleTransacciones.phtml';
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
        function MostrarErrorBorrarInexistente(){
            require'app/templates/errorInexistente.phtml';
        }
    }
?>