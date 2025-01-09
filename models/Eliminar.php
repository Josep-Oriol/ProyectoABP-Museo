<?php
    require_once "Database.php";
    class Eliminar extends Database {
        public function eliminarRegistro($id, $apartado, $columna){
            if($columna == "numero_registro"){
                $sql = "DELETE FROM {$apartado} WHERE {$columna} = :id";
            }else {
                $sql = "DELETE FROM {$apartado} WHERE id_{$columna} = :id";    
            }
            $db = $this->conectar();
            try {
                $query = $db->prepare($sql);
                $query->bindValue(':id', $id, PDO::PARAM_STR);
                $query->execute();
                return $query->execute();;
            } catch (PDOException $error) {
                echo "<h2>Error al ejecutar la consulta. Error: " . $error->getMessage() . "</h2>";
                return false;
            }
        }
    }
?>