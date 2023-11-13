<?php
   include_once './config/config.php';
   require_once './app/models/model.php';
    
    class TransaccionesModel extends Model{

        
         function getTransacciones(){
            $query = $this->db->prepare('SELECT * FROM transacciones');
            $query->execute();
            $transaccion= $query->fetchAll(PDO::FETCH_OBJ);  
            return $transaccion;
         }
         function getTransaccionByID($transacionesID){
            $query = $this->db->prepare('SELECT * FROM transacciones WHERE transacionesID = ?');
            $query->execute([$transacionesID]);
            $transaccion = $query->fetchAll(PDO::FETCH_OBJ);  
            return $transaccion;
         }

         function borrarTransacionByID($transacionesID){
            $query =$this-> db->prepare('DELETE FROM transacciones WHERE transacionesID = ?');
            $query->execute([$transacionesID]); 
         }
         function agregarTransaccion($canal, $modeloID, $precio, $descuento){
            $query = $this->db->prepare('INSERT INTO transacciones (canal, modeloID, precio, descuento) VALUES (?,?,?,?)');
            $query->execute([$canal, $modeloID, $precio, $descuento]); 
            return $this->db->lastInsertId();
         }

         function editarTransaccionesByID($transacionesID,$canal, $precio, $descuento){  
            $query = $this->db->prepare('UPDATE transacciones SET canal = ? , precio = ?, descuento = ? WHERE transacionesID = ?');
            $query->execute([$canal, $precio, $descuento, $transacionesID]);
         }

         function getTransaccionesOrdenadas($orden) {
            $query = $this->db->prepare('SELECT * FROM transacciones ORDER BY precio ' . $orden);
            $query->execute();
            
            $transacciones = $query->fetchAll(PDO::FETCH_OBJ);
            return $transacciones;
        }
        
        public function getTransaccionByCanal($canal) {
         $query = $this->db->prepare('SELECT * FROM transacciones WHERE canal = ?');
         $query->execute([$canal]);
 
         $transaccion = $query->fetchAll(PDO::FETCH_OBJ);
         return $transaccion;
         }
   }
    
?>