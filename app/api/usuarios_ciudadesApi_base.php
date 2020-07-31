<?php

/*
----Creado----2020-07-16 16:15:04.4245719 -0300 -03 m=+2.853778901
*/
require_once '../core/error_core.php';
require_once '../core/security.php';
require_once '../core/jwt_core.php';
require_once '../core/headers.php';
require_once '../controller/usuarios_ciudadesController.php';

try {
	$json = '{"rdo":""}';
	$data = file_get_contents('php://input');
	$input = json_decode($data);
	$accion = $input->accion;
	$miController = new Usuarios_ciudadesController;
	switch ($accion) {
		case "GETALL":
			$result = $miController->getAll();
			$json = json_encode(["ok"=>true,"payload"=> $result]);
			break;
		case "GETID":
			$result = $miController->getByPrim();
			$json = json_encode(["ok"=>true,"payload"=> $result]);
			break;
		case "DEL":
			$result = $miController->delByPrim();
			$json = json_encode(["ok"=>true,"payload"=> $result]);
			break;
	}
	http_response_code(200);
} catch (Error $err){
	$json = json_encode(["ok"=>false,"payload"=>utf8_encode($err->getMessage())]);
	http_response_code(500);
} catch (Exception $ex){
	$json = json_encode(["ok"=>false,"payload"=>utf8_encode($ex->getMessage())]);
	http_response_code(500);
} finally {
	echo $json;
}
?>