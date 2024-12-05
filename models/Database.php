<?php

require_once __DIR__ . "/../config.php"; // Incluir el archivo de configuración

class Database {
    
    protected $db;
    
    public function conectar() {
        // Usar las constantes definidas en config.php
        $servername = DB_HOST;
        $dbname = DB_NAME;
        $username = DB_USER;
        $password = DB_PASSWORD;
        
        // Crear una nueva conexión instanciando el objeto PDO
        try {
            $this->db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // Establecer el modo de error de PDO a Exception
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->db;
        } catch (PDOException $e) {
            echo "Error en la conexión: " . $e->getMessage();
        }
    }

    public function copiaSeguridad($idCopia){
        $servername = DB_HOST;
        $dbname = DB_NAME;
        $username = DB_USER;
        $password = DB_PASSWORD;

        $archivoCopia = 'copia_de_seguretat_Id' . $idCopia . "_" . date('Y-m-d_H-i-s') . '.sql';

        $comandoCopia = "mysqldump -u {$username} -h {$servername} {$dbname} > {$archivoCopia}";
        
        $resultado = null;
        $salida = [];
        exec($comandoCopia, $salida, $resultado);


        if($resultado === 0){
            echo "copia de seguridad hecha con exito";
        }
    }
}
