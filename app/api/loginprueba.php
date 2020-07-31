<?php

include_once '../core/jwt_core.php';

require '../../vendor/autoload.php';
require_once "../controller/usuario_controller.php";

use Firebase\JWT\JWT;

// required headers
header("Access-Control-Allow-Origin: http://localhost/egroups/api/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// database connection will be here

$json = file_get_contents('php://input');
$data = json_decode($json);

$usr = new UsuarioController();

$result = $usr->getCredentials("akouvach@yahoo.com", "akouvach");

echo $result[0]->email;

?>
