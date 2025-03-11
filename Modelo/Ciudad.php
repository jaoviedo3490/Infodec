<?php
    require_once "../DB/db-connect.php";
    require_once  __DIR__."/../vendor/autoload.php";
    use RedBeanPHP\R;
    class Ciudad{

    
        public $Message = array("Success"=>false,"Message"=>"","Code"=>200);

        public function LoadCity($Nombre){
            try{
                $City = R::findOne('ciudad',"_nombre=?",[$Nombre]);
                if($City->id != 0){
                    $this->Message['Success'] = true;
                    $this->Message["Ciudad"] = $City;
                }else{
                    $this->Message['Code'] = 404;
                }
            }catch(Exception $except){
               $this->Message['Message'] = "Ocurrio un error al crear el registro: ".$except->getMessage();
               $this->Message['Code'] = 500;
               error_log($this->Message['Message']);
            }
            return $this->Message;
        }

        public function CreateCity($Nombre){
            $Conexion = new Conexion();
            try{
                $exist = R::findOne('ciudad',"_nombre=?",[$Nombre]);
                
                if(!$exist){
                    $City = R::dispense('ciudad');
                    $City->Nombre = $Nombre;

                    $id = R::store($City);

                    $this->Message['Success'] =true;
                }else{
                    $this->Message['Code'] = 200;
                }
                
            }catch(Exception $except){
                $this->Message['Message'] = "Ocurrio un error al crear el registro: ".$except->getMessage();
                $this->Message['Code'] = 500;
                error_log($this->Message['Message']);
            }

            return $this->Message;
        }

        

        public function UpdateCity($id,$Nombre){
            try{
                $City = R::load('ciudad',$id);
                if($City->id != 0){
                        $City->Nombre = $Nombre;
                        $id = R::store($City);
                        $this->Message['Success'] = true;
                }else{
                    $this->Message['Code'] = 404;
                }
            }catch(Exception $except){
               $this->Message['Message'] = "Ocurrio un error al crear el registro: ".$except->getMessage();
               $this->Message['Code'] = 500;
               error_log($this->Message['Message']);
            }
            return $this->Message;
        }
    }