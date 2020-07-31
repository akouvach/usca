<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once "../controller/usuario_controller.php";

$usr = new UsuarioController();

$result = $usr->getAll();

// set response code - 200 OK
http_response_code(200);

// show products data in json format
echo json_encode($result);


?>
