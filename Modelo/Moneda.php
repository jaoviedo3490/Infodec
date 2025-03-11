<?php

require_once "../DB/db-connect.php";
require_once  __DIR__."/../vendor/autoload.php";
use RedBeanPHP\R;

class Moneda {
    public $Message = array("Success" => false, "Message" => "", "Code" => 200);

    public function CreateMoney($Clave, $Valor) {
       
        try {
            $exist = R::findOne("moneda","_codigo_moneda = ?",[$Clave]);
            //print_r($exist);
            if(!$exist){
                $Moneda = R::dispense('moneda');
                $Moneda->_valor = $Valor;
                $Moneda->_codigo_moneda = $Clave;
                $Moneda = R::store($Moneda);
                
                $this->Message['Success'] = true;
            }else{
                $this->Message['Success'] = true;
            }
            

        } catch (Exception $except) {
            $this->Message['Message'] = "Ocurrió un error al crear el registro: " . $except->getMessage();
            $this->Message['Code'] = 500;
            error_log($this->Message['Message']);
            //print_r("malparido");
        }
        return $this->Message;
    }

    public function LoadMoney($CodigoM) {
        try {
            $Conexion = new Conexion();
           // var_dump($CodigoM);
            $Moneda = R::find('moneda', "_codigo_moneda = ? OR _codigo_moneda = ?", [$CodigoM,'COP']);
            //var_dump($Moneda);
            if ($Moneda) { // Verifica si la moneda existe
                $this->Message['Success'] = true;
                $this->Message['Message'] = "";
                $this->Message['Monedas'] = $Moneda;
            } else {
                $this->Message['Message'] = "No se encontró la moneda con el código: $CodigoM";
                $this->Message['Code'] = 404;
            }
        } catch (Exception $except) {
            $this->Message['Message'] = "Error al cargar el registro: " . $except;
            $this->Message['Code'] = 500;
            error_log($this->Message['Message']);
            print_r($except);
        }
        return $this->Message;
    }

    public function UpdateMoney($ID, $Valor, $CodeM) {
     
        try {
            $MonedaObj = R::load('moneda', $ID);

            if ($MonedaObj->id) {
                $MonedaObj->Valor = $Valor;
                $MonedaObj->CodigoMoneda = $CodeM;
                R::store($MonedaObj);

                $this->Message['Success'] = true;
            } else {
                $this->Message['Message'] = "No se encontró el registro con ID: $ID.";
                $this->Message['Code'] = 404;
            }
        } catch (Exception $except) {
            $this->Message['Message'] = "Ocurrió un error al actualizar los registros: " . $except->getMessage();
            $this->Message['Code'] = 500;
            error_log($this->Message['Message']);
        }

        return $this->Message;
    }
}
