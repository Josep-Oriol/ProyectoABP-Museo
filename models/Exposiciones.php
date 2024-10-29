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
}
?>