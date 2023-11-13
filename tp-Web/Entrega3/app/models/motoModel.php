<?php
include_once './config/config.php';
require_once './app/models/model.php';
class MotoModel extends Model {

	public function GetMotos(){
        $query = $this->db->prepare( "select * from motos");
        $query->execute();
        $tareas = $query->fetchAll(PDO::FETCH_OBJ);
        return $tareas;
    }

    public function GetMotoById($ModeloID){
        $query = $this->db->prepare( "select * from motos where ModeloID = ?");
        $query->execute([$ModeloID]);
        $producto = $query->fetch(PDO::FETCH_OBJ);
        
        return $producto;
    }

    public function agregarMoto($nombreProducto, $capacidadTanque , $fuerza, $cinlindrada){
        $query = $this->db->prepare("INSERT INTO motos (nombreProducto, capacidadTanque , fuerza, cinlindrada) VALUES (?,?,?,?)");
        $query->execute([$nombreProducto, $capacidadTanque, $fuerza, $cinlindrada]);
        return $this->db->lastInsertId();
    }

    public function BorrarMoto($ModeloID){
        $query = $this->db->prepare("DELETE FROM motos WHERE ModeloID = ?");
        $query->execute(array($ModeloID));
    }
    
    public function editarMotoByID($ModeloID,$nombreProducto, $capacidadTanque , $fuerza, $cinlindrada){
        $query = $this->db->prepare('UPDATE motos SET nombreProducto = ?, capacidadTanque = ? , fuerza = ?, cinlindrada = ? WHERE ModeloID = ?');
        $query->execute([$nombreProducto, $capacidadTanque , $fuerza, $cinlindrada, $ModeloID]); 
    }

    public function getMotoByNombreProducto($nombreProducto) {
        $query = $this->db->prepare('SELECT * FROM motos WHERE nombreProducto = ?');
        $query->execute([$nombreProducto]);

        $moto = $query->fetchAll(PDO::FETCH_OBJ);
        return $moto;
    }
}
?>
