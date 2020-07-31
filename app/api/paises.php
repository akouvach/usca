<?php
include_once '../core/headers.php';

include_once '../core/error_core.php';
include_once '../core/jwt_core.php';
include_once '../controller/pais_controller.php';
include_once '../core/security.php';

// $verificar = verificarSeguridad($key);

// if(!$verificar->ok){
//     http_response_code($verificar->errorcode);
//     echo json_encode($verificar);
//     exit();
// }


try {

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $pais = new Pais;

    //armo un array con los campos y otro con los valores
    $arrayCampos=[];
    $arrayValores=[];
    foreach($data->payload->filter as $key=>$value){
        array_push($arrayCampos,$value->field);
        array_push($arrayValores, $value->value);        
    }
    if(sizeof($arrayCampos)>0)
        $result = $pais->getAll($arrayCampos, $arrayValores);
    else 
        $result = $pais->getAll();

    $json = json_encode(["ok"=>true,"payload"=> $result]);
    // $json = json_encode(["ok"=>true,"payload"=>array($arrayCampos, $arrayValores)]);
    // set response code
    http_response_code(200);    
} catch (Exception $ex){
    $json = json_encode(["ok"=>false,"payload"=>utf8_encode($ex->getMessage())]);       
    http_response_code(500);
} catch (Error $err){
    $json = json_encode(["ok"=>false,"payload"=> utf8_encode($ex->getMessage())]);
    http_response_code(500);
} finally {
    echo $json;
}
    
 
?>


