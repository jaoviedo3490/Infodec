<?php

require_once '../Modelo/Moneda.php';
require_once '../Services/service.php';

class Moneda_Controller {
    public $Response = array("StatusCode" => 200, "Message" => "");

    public function Operations($param,$data) {
        try {
            $Controller = new Moneda();

            switch($param) {
                case 'GET':
                  

                    $response = $Controller->LoadMoney($data['Nombre']);
                    switch($response['Code']) {
                        case 200:
                            $this->Response["Monedas"] = $response['Monedas'];
                            //$this->Response['API_Moneda'] = file_get_contents('https://cdn.dinero.today/api/latest.json');
                            break;
                        case 400:
                            $this->Response['Message'] = "Error al procesar la solicitud";
                            $this->Response['StatusCode'] = 400;
                            //echo json_encode($this->Response);
                            break;
                        case 404:
                            $this->Response['Message'] = "Registro no encontrado";
                            $this->Response['StatusCode'] = 404;
                            //echo json_encode($this->Response);
                            break;
                        case 500:
                            $this->Response['Message'] = "Error interno del servidor";
                            $this->Response['StatusCode'] = 500;
                            //echo json_encode($this->Response);
                            break;
                        default:
                            $this->Response['Message'] = "Error al procesar la solicitud";
                            $this->Response['StatusCode'] = 400;
                            //echo json_encode($this->Response);
                            break;
                    }
                    break;

                case 'POST':

                        $data = file_get_contents('https://cdn.dinero.today/api/latest.json');
                        $data = json_decode($data, true);

                      
                        $datos = $data['rates'];

                        //echo json_encode($datos, JSON_PRETTY_PRINT); 
                        
                        foreach ($datos as $clave => $valor) {
                            //print_r("Datos:".$datos." - Clave: ".$clave." - Valor: ".json_decode($valor,true));
                            $response_ = $Controller->CreateMoney($clave, $valor);
                        }
                    switch ($response_['Code']) {
                        case 200:
                            //$this->Response["Monedas"] = $response_['Monedas'];
                            //$this->Response['Api'] = ConsumeApiExtern('https://api.weatherapi.com/v1/current.json?key=a21411e5a88c4a5291a173440243010&q='.$_GET['Nombre'].'&aqi=yes');
                            $this->Response['StatusCode'] = 200; 
                            break;
                        case 400:
                            $this->Response['Message'] = "Error al procesar la solicitud";
                            $this->Response['StatusCode'] = 400;
                            //echo json_encode($this->Response);
                            break;
                        case 404:
                            $this->Response['Message'] = "Registro no encontrado";
                            $this->Response['StatusCode'] = 404;
                            //echo json_encode($this->Response);
                            break;
                        case 500:
                            $this->Response['Message'] = "Error interno del servidor";
                            $this->Response['StatusCode'] = 500;
                            //echo json_encode($this->Response);
                            break;
                        default:
                            $this->Response['Message'] = "Error al procesar la solicitud";
                            $this->Response['StatusCode'] = 400;
                            //echo json_encode($this->Response);
                            break;
                    }
                    break;

                case 'PUT':
                    $money = file_get_contents("php://input");
                    $data = json_decode($money, true);

                    if (!isset($data['Nombre']) || !isset($data['Valor']) || !isset($data['CodigoV'])) {
                        $this->Response['Message'] = "Datos faltantes";
                        $this->Response['StatusCode'] = 400;
                        //echo json_encode($this->Response);
                        exit();
                    }

                    $nombre = $data['Nombre'];
                    $valor = $data['Valor'];
                    $CodigoV = $data['CodigoV']; 
                    $response = $Controller->UpdateMoney($nombre, $valor, $CodigoV);

                    switch ($response['Code']) {
                        case 200:
                            $this->Response["Monedas"] = $response['Monedas'];
                            //echo json_encode($this->Response);
                            break;
                        case 400:
                            $this->Response['Message'] = "Error al procesar la solicitud";
                            $this->Response['StatusCode'] = 400;
                            //echo json_encode($this->Response);
                            break;
                        case 404:
                            $this->Response['Message'] = "Registro no encontrado";
                            $this->Response['StatusCode'] = 404;
                            //echo json_encode($this->Response);
                            break;
                        case 500:
                            $this->Response['Message'] = "Error interno del servidor";
                            $this->Response['StatusCode'] = 500;
                            //echo json_encode($this->Response);
                            break;
                        default:
                            $this->Response['Message'] = "Error al procesar la solicitud";
                            $this->Response['StatusCode'] = 400;
                            //echo json_encode($this->Response);
                            break;
                    }
                    break;

                default:
                    $this->Response['Message'] = "Método no soportado: parametro";
                    $this->Response['StatusCode'] = 405;
                    echo json_encode($this->Response);
                    break;
            }
        } catch (Exception $except) {
            $this->Response['StatusCode'] = 500;
            $this->Response['Message'] = "Error interno del servidor: " . $except->getMessage();
            error_log("Ocurrió un error en el método Moneda_Controller: " . $except);
            //echo json_encode($this->Response);
        }
        return $this->Response;
    }
} 
?>
