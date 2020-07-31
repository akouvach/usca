<?php

// require '../../vendor/autoload.php';
// var_dump(__DIR__);

use Firebase\JWT\JWT;

include_once(app_path().'\controller\usuariosController.php');

// show error reporting
error_reporting(E_ALL);
 
// set your default time-zone
date_default_timezone_set('America/Argentina/Buenos_Aires');
 

class MiJwt
{

    // variables used for jwt
    const KEY = "tu secreto es: la suerte del principiante no puede fallar - twsagi6()";
    const ISS = "http://localhost:8000/api/";
    const AUD = "http://localhost:8000/api/";
    const IAT = 1356999524;
    const NBF = 1357000000;


    public function getCredentials($data){

        try {
            //Abro una instancia del objeto usuario para ir a buscar sus credenciales
            $usr = new UsuariosController();
            //busco que me devuelva las credenciales el usuario y contraseña que le envío
            $result = $usr->getCredentials($data->email, $data->password);
            // var_dump($result);
            return $result;
        } catch (Error $err){
            throw $err;
        } catch (Exception $ex){
            throw $ex;
        }

    }

    public function isAuthenticated($token){
        $key = "tu secreto es: la suerte del principiante no puede fallar - twsagi6()";

        try {
            $plano = JWT::decode($token, $key, array('HS256'));
            return (object)["rta"=>true, "payload"=>$plano->data];        
        } catch (Error $err){        
            return (object)["rta"=>false, "payload"=>$err->__toString()];
        } catch (Exception $ex){
            return (object) ["rta"=>false, "payload"=>$ex->__toString()];
        }
        
    }

    public function encode($t, $k)
    {

        $rta =JWT::encode($t, $k);

        return $rta;
    }


}

?>