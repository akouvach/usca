

<?php

include_once(app_path().'\core\headers.php');


// header('Access-Control-Allow-Origin: *');
// header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
// header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
// header("Allow: GET, POST, OPTIONS, PUT, DELETE");
// header("Access-Control-Max-Age: 3600");
// header("Content-Type: application/json; charset=UTF-8");
// print_r($_SERVER);

include_once(app_path().'\core\jwt_core.php');
include_once(app_path().'\core\error_core.php');

// require_once '../../vendor/autoload.php'; 

use Firebase\JWT\JWT;

class Login {

 
    public function getToken($credenciales){
        $json="";

        try {

            $mi_jwt = new MiJwt();

            //Obtengo el usuario correspondiente
            $result = $mi_jwt->getCredentials($credenciales);
// var_dump($result);
    

            //si me trae algún resultado es que encontró la combinación de usuario y contraseña
            if (!is_null($result) && sizeof($result)>0 ){
                $token = array(
                    "iss" => $mi_jwt::ISS,
                    "aud" => $mi_jwt::AUD,
                    "iat" => $mi_jwt::IAT,
                    "nbf" => $mi_jwt::NBF,
                    "data" => array(
                        "id" => $result[0]->id,
                        "nombre" => $result[0]->nombre,
                        "apellido" => $result[0]->apellido,
                        "email" => $result[0]->email
                    )
                );

                // genero el token con los datos que me enviaron
                $jwt = $mi_jwt->encode($token, $mi_jwt::KEY);
                
                $json = json_encode(array("rta" => true,"jwt" => $jwt, "payload"=>$result[0]));

            } else {
                $json = json_encode(["rta"=>false,"payload"=>"El usuario no no existe o no tiene permisos"]);
            }

        } catch (Exception $ex) {

            $json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);       

        } finally {

            return $json;
        }
        

    }


}


?>
