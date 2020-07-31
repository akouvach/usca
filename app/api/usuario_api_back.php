<?php
include_once '../core/error_core.php';
include_once '../core/jwt_core.php';
include_once '../controller/usuario_controller.php';

// required headers
header("Access-Control-Allow-Origin: http://localhost/api/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
if($_SERVER['REQUEST_METHOD']=='POST') {

    $authToken = getallheaders()["Authorization"];
    $authToken = str_replace("Bearer ","",$authToken); 
    $json = "";

    try {
        $auth = isAuthenticated($authToken, $key);
        if($auth->ok){
            //Tengo  código correctos.  Voy a hacer lo que corresponda aquí
            $usr = new UsuarioController;
            $result = $usr->getAll();
            $json = json_encode(["ok"=>true,"payload"=> $result]);
            // set response code
            http_response_code(200);
        } else {
            $json = json_encode(["ok"=>false, "payload"=>"Token expirado. Vuelva a ingresar al sistema"]);
            http_response_code(401);
        }
    } catch (Exception $ex){
        $json = json_encode(["ok"=>false,"payload"=>utf8_encode($ex->getMessage())]);       
        http_response_code(500);
    } catch (Error $err){
        $json = json_encode(["ok"=>false,"payload"=> utf8_encode($ex->getMessage())]);
        http_response_code(500);
    } finally {
        echo $json;
    }
    
} else {

    $json = json_encode(["ok"=>false,"payload"=> "Solo peticiones POST"]);
    echo $json;
}

// $json_string = json_decode($data);

// switch (json_last_error()) {
//     case JSON_ERROR_NONE:
//         $rta = $rta . ' - No errors';
//     break;
//     case JSON_ERROR_DEPTH:
//         $rta = $rta .  ' - Maximum stack depth exceeded';
//     break;
//     case JSON_ERROR_STATE_MISMATCH:
//         $rta = $rta .  ' - Underflow or the modes mismatch';
//     break;
//     case JSON_ERROR_CTRL_CHAR:
//         $rta = $rta .  ' - Unexpected control character found';
//     break;
//     case JSON_ERROR_SYNTAX:
//         $rta = $rta .  ' - Syntax error, malformed JSON';
//     break;
//     case JSON_ERROR_UTF8:
//         $rta = $rta .  ' - Malformed UTF-8 characters, possibly incorrectly encoded';
//     break;
//     default:
//         $rta = $rta .  ' - Unknown error';
//     break;
// }
 
?>


