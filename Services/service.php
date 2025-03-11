<?php
require_once '../Controlador/Ciudad_Controller.php';
require_once '../Controlador/Monedas_Controller.php';
header("Content-Type: application/json");

$Response = array("StatusCode" => 200, "Message" => "Operación realizada correctamente");

try {
    $method = $_SERVER['REQUEST_METHOD'];
    $inputJSON = file_get_contents("php://input");
    $datos = json_decode($inputJSON, true);
    //print_r(var_dump($datos));
    if ($method == "GET") {
        $datos = $_GET;
    }

    //print_r($datos);
    switch (strtolower(trim($datos['Controller']))) {
        case "city":
            $Controller_A = new Ciudad_Controller();
            $response = $Controller_A->Operations($method, $datos);

            $Controller_AB = new Moneda_Controller();
            $response_b = $Controller_AB->Operations($method, $datos);

            $Response["Data"] = ["City" => $response, "Monedas" => $response_b];
            break;

        case "money":
            $Controller_B = new Moneda_Controller();
            $response = $Controller_B->Operations($method, $datos);

            if (!isset($response) || empty($response)) {
                var_dump($response);
                throw new Exception("No se pudo procesar la solicitud. aqui?");
            }

            $Response["Data"] = ["Money" => $response['Monedas']];
            break;

        default:
            throw new Exception("Controlador desconocido: " . htmlspecialchars($datos['Controller']));
    }
} catch (Exception $e) {
    $Response["StatusCode"] = 400;
    $Response["Message"] = $e->getMessage();
    error_log($e->getMessage());
}

echo json_encode($Response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
