<?php
include_once '../core/error_core.php';
include_once '../core/jwt_core.php';
include_once '../controller/grupo_controller.php';

include_once '../core/security.php';

include_once '../core/headers.php';

try {
    $json = '{"rdo":""}';
    // Takes raw data from the request
    $data = file_get_contents('php://input');
    // Converts it into a PHP object
    $input = json_decode($data);
    $accion = $input->accion;

    $grupo = new GrupoController;
    switch ($accion) {
        case "GETALL":
            echo "GETALL";
            $result = $grupo->getAll();
            $json = json_encode(["ok"=>true,"payload"=> $result]);
            break;
        case "GETID":
            echo "GETID".$input->id;
            $result = $grupo->getById($input->id);
            $json = json_encode(["ok"=>true,"payload"=> $result]);
            break;
        case "DEL":
            echo "DEL".$input->id;
            $result = $grupo->delById($input->id);
            $json = json_encode(["ok"=>true,"payload"=> $result]);
            break;
        }
    
    // set response code
    http_response_code(200);    
} catch (Exception $ex){
    $json = json_encode(["ok"=>false,"payload"=>utf8_encode($ex->getMessage())]);       
    http_response_code(500);
} catch (Error $err){
    $json = json_encode(["ok"=>false,"payload"=> utf8_encode($err->getMessage())]);
    http_response_code(500);
} finally {
    echo $json;
}
    
 
?>


