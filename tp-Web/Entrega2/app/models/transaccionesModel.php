<?php
    require_once'app/models/config.php';
    
    class TransaccionesModel{
    private $db;    
          function __construct() {       
              $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=tp-web;charset=' . DB_Charset, DB_USER, DB_PASS);    
             }
        
         function getTransacciones(){
            $query = $this->db->prepare('SELECT * FROM transacciones');
            $query->execute();
            $transaccion= $query->fetchAll(PDO::FETCH_OBJ);  
            return $transaccion;
         }
         function getTransaccionesByID($transacionesID){
            $query = $this->db->prepare('SELECT * FROM transacciones WHERE transacionesID = ?');
            $query->execute([$transacionesID]);
            $transaccion = $query->fetchAll(PDO::FETCH_OBJ);  
            return $transaccion;
         }

         function borrarTransacionXID($transacionesID){
            $query =$this-> db->prepare('DELETE FROM transacciones WHERE transacionesID = ?');
            $query->execute([$transacionesID]); 
         }
         function agregarTransaccion($transacionesID, $canal, $modeloID, $precio, $descuento){
            $query = $this->db->prepare('INSERT INTO transacciones (transacionesID, canal, modeloID, precio, descuento) VALUES (?,?,?,?,?)');
            $query->execute([$transacionesID, $canal, $modeloID, $precio, $descuento]); 
            return $this->db->lastInsertId();
         }

         function editarTransaccionesByID($transacionesID, $canal, $modeloID, $precio, $descuento){
            $query = $this->db->prepare('UPDATE transacciones SET canal = ?, modeloID = ? , precio = ?, precio = ? WHERE transacionesID = ?');
            $query->execute([$canal, $modeloID , $precio, $descuento, $transacionesID ]);
         }
    }
    
?>