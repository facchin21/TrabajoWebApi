<?php
    require_once'app/models/config.php';
    
    class MotoModel{
        private $db;    
          function __construct() {       
              $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=tp-web;charset=' . DB_Charset, DB_USER, DB_PASS);    
             }
          function getMotos(){   
                $query = $this->db->prepare('SELECT * FROM motos');
                $query->execute();
                $producto= $query->fetchAll(PDO::FETCH_OBJ);  
                return $producto;
          }

           function getMotoByID($ModeloID){
                $query = $this->db->prepare('SELECT * FROM motos WHERE ModeloID = ?');
                $query->execute([$ModeloID]);
                $producto = $query->fetchAll(PDO::FETCH_OBJ);  
                return $producto;
             }

            function borrarMotoXID($ModeloID){
                  $query =$this-> db->prepare('DELETE FROM motos WHERE ModeloID = ?');
                  $query->execute([$ModeloID]);               
            }

            public function agregarMoto($nombreProducto, $ModeloID, $capacidadTanque , $fuerza, $cinlindrada){
                $query = $this->db->prepare('INSERT INTO motos (nombreProducto, ModeloId, capacidadTanque, fuerza, cinlindrada) VALUES (?,?,?,?, ?)');
                $query->execute([$nombreProducto, $ModeloID, $capacidadTanque , $fuerza, $cinlindrada]); 
                return $this->db->lastInsertId();
            }
            
            public function editarMotoByID($nombreProducto, $ModeloID, $capacidadTanque , $fuerza, $cinlindrada){
               $query = $this->db->prepare('UPDATE motos SET nombreProducto = ?, capacidadTanque = ? , fuerza = ?, cinlindrada = ? WHERE ModeloID = ?');
               $query->execute([$nombreProducto, $capacidadTanque , $fuerza, $cinlindrada, $ModeloID ]); 
            }
            
    }
?>