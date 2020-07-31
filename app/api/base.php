<?php

include_once '../core/jwt_core.php';
include_once '../core/error_core.php';

$json = "";

if($_SERVER['REQUEST_METHOD']=='POST') {

    $authToken = getallheaders()["Authorization"];
    $authToken = str_replace("Bearer ","",$authToken); 

    try {
        $auth = isAuthenticated($authToken, $key);
        if($auth->ok){
            //Tengo  código correctos.  Voy a hacer lo que corresponda aquí

            // ************ Acá va el código que quiero ejecutar



            $usr = new UsuarioController;
            $result = $usr->getAll();
            $json = json_encode(["ok"=>true,"payload"=> $result]);





            // ************ hasta acá ***********

            // set response code. En la variable $json debo dejar la respuesta
            http_response_code(200);
        } else {
            $json = json_encode(["ok"=>false, "payload"=>"Token expirado. Vuelva a ingresar al sistema"]);
            http_response_code(401);
        }
    } catch (Exception $ex){
        $json = json_encode(["ok"=>false,"payload"=>utf8_encode($ex->getMessage())]);       
        http_response_code(500);
    } catch (Error $err){
        $json = json_encode(["ok"=>false,"payload"=> utf8_encode($err->getMessage())]);
        http_response_code(500);
    }
   

} else {

    $json = json_encode(["ok"=>false, "payload"=>"Sólo se permites peticiones POST"]);
    http_response_code(501);
    
}

echo $json;

?>
