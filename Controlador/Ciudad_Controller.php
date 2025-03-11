<?php

require_once '../Modelo/Ciudad.php';
require_once '../Services/service.php';

class Ciudad_Controller {
    public $Response = array("StatusCode" => 200, "Message" => "");
    public $apikey = "a21411e5a88c4a5291a173440243010";

    public function Operations($method,$param) {
        try {

            $Controller = new Ciudad();
        

            switch($method) {
                case 'GET':
                    $nombre = $param['Nombre'];
                    $response = $Controller->LoadCity($nombre);
                    switch($response['Code']) {
                        case 200:
                            $this->Response["Ciudad"] = $response['Ciudad'];
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
                case 'POST':
            
                    if (!isset($param['Nombre'])) {
                        $this->Response['Message'] = "Falta el parámetro 'Nombre'";
                        $this->Response['StatusCode'] = 400;
                        //echo json_encode($this->Response);
                        exit();
                    }

                    $nombre = $param['Nombre'];
                    $response = $Controller->CreateCity($nombre);

                    switch ($response['Code']) {
                        case 200:
                            //$this->Response["Ciudad"] = $response['Ciudad'];
                            //echo json_encode($this->Response);
            
                            $this->Response['API_Clima'] = file_get_contents('https://api.weatherapi.com/v1/current.json?key='.$this->apikey.'&q='.urlencode($nombre).'&aqi=yes');
                            
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
                            $this->Response['Message'] = "Error interno del servidor: ".$response['Message'];
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
                    

                    if (!isset($param['Nombre'])) {
                        $this->Response['Message'] = "Falta el parámetro 'Nombre'";
                        $this->Response['StatusCode'] = 400;
                        //echo json_encode($this->Response);
                        exit();
                    }

                    $nombre = $param['Nombre'];
                    $response = $Controller->UpdateCity($nombre);

                    switch ($response['Code']) {
                        case 200:
                            $this->Response["Ciudad"] = $response['Ciudad'];
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
                            $this->Response['Message'] = "Error interno del servidor: ".$response['Message'];
                            $this->Response['StatusCode'] = 500;
                            //echo json_encode($this->Response);
                            break;
                        default:
                            $this->Response['Message'] = "Error al procesar la solicitud";
                            $this->Response['StatusCode'] = 400;
                            //echo json_encode($this->Response);
                            break;
                    }break;
                default:
                    $this->Response['Message'] = "Método no soportado";
                    $this->Response['StatusCode'] = 405;
                    //echo json_encode($this->Response);
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
