<?php

    class Sql {

        private static $pdo;
        
        public static function conectar() {
            if(self::$pdo == null){
              try {
                self::$pdo = new PDO('mysql:host='.HOST.';dbname='.DB,USER,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
              }catch(Exception $e) {
                echo 'Erro ao se conectar';
              }
            }
            return self::$pdo;     
        }
    }

?>