<?php
    class VocabulariosController {

        public function EnviarAVocabularios(){
            require_once "views/general/header.php";
            require_once "views/general/vocabularios.php";
            require_once "views/general/footer.html";
        }
        public function campsLlista(){
            require_once "views/general/header.php";
            require_once "views/general/campsLlista.php";
            require_once "views/general/footer.html";
        }
    
    }
?>