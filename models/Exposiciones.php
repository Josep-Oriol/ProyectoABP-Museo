<?php
require_once "Database.php";
class Exposiciones extends Database{
    public function generarTablas(){
        $sql = "SELECT * FROM exposiciones";
        $db = $this->conectar();
        try{
            $query = $db->prepare($sql);
            $query->execute();
        }
        catch(PDOException $error){
            echo $error->getMessage();
        }
        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
    
    public function eliminarExposicion($id){
        $db = $this->conectar();
        $sql = "UPDATE obras SET FK_id_exposicion = NULL";
        $sql2 = "DELETE FROM exposiciones e WHERE ID_exposicion LIKE $id";
        try{
            $query = $db->prepare($sql);
            $query->execute();
            $query2 = $db->prepare($sql2);
            $query2->execute();
        }
        catch(PDOException $error){
            echo $error->getMessage();
        }
    }
}
?>