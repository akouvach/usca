<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
// header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Max-Age: 3600");
header("Content-Type: application/json; charset=UTF-8");
// print_r($_SERVER);

include_once '../core/jwt_core.php';
include_once '../core/error_core.php';

require '../autoload.php';

use Firebase\JWT\JWT;

$json = "";

if($_SERVER['REQUEST_METHOD']=='POST') {

    try {

        //Recibo los datos enviados por un fetch post con json
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        //Obtengo el usuario correspondiente
        $result = getCredentials($data);

        //si me trae algún resultado es que encontró la combinación de usuario y contraseña
        if (!is_null($result) && sizeof($result)>0 ){
            $token = array(
                "iss" => $iss,
                "aud" => $aud,
                "iat" => $iat,
                "nbf" => $nbf,
                "data" => array(
                    "id" => $result[0]->id,
                    "nombre" => $result[0]->nombre,
                    "apellido" => $result[0]->apellido,
                    "email" => $result[0]->email
                )
            );

            // genero el token con los datos que me enviaron
            $jwt = JWT::encode($token, $key);

            //Seteo cabesera y devuelvo el token
            http_response_code(200);
            $json = json_encode(array("ok" => true,"jwt" => $jwt));

        } else {
            // este usuario no tiene permisos
            http_response_code(401);    
            $json = json_encode(["ok"=>false,"payload"=>"El usuario no no existe o no tiene permisos"]);
        }

    } catch (Exception $ex){
        $json = json_encode(["ok"=>false,"payload"=>utf8_encode($ex->getMessage())]);       
        http_response_code(500);
    } catch (Error $err){
        $json = json_encode(["ok"=>false,"payload"=> utf8_encode($ex->getMessage())]);
        http_response_code(500);
    }

} else {

    $json = json_encode(["ok"=>false, "payload"=>"Sólo se permites peticiones POST"]);
    http_response_code(501);
    
}

echo $json;

?>
