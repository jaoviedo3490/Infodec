<?php
    require_once  __DIR__."/../vendor/autoload.php";
    use RedBeanPHP\R; 

    class Conexion {
        protected $host = "127.0.0.1";
        protected $usuario = "root";
        protected $password = "";
        protected $bd = "infodec";

       
        public function __construct(){
            try{
                R::setup("mysql:host=$this->host;dbname=$this->bd",$this->usuario,$this->password);
               
                if(!R::testConnection()){
                    die("Error al conectar con la base de datos");
                }
            }catch(PDOException $except){
                error_log("Error al intentar conectar el ORM".$except->getMessage());
                die("Error al conectar con la base de datos: ".$except);
            }
        }

        public function getConnection(){
            return R::getDatabaseAdapter();
        }

    }