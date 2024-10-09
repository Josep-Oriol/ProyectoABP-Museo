<?php

class Database{
    
    protected $db;
    
    public function conectar(){
        $servername = "bhj7whmm8g7lraocrcgj-mysql.services.clever-cloud.com";
        $dbname = "bhj7whmm8g7lraocrcgj";
        $username = "uzg4eixka4uwk1yt"; 
        $password = "rGDbt4mR8aKmmELLLiXV";

        //creem una nova connexió instancinat l'objecte PDO
		$this->db = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
		// establim el mode PDO error a exception per poder
		// recuperar les excepccions
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         return $this->db;
    
    }
    

}
