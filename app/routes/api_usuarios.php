<?php

/*
----Creado----2020-07-16 16:15:04.3022331 -0300 -03 m=+2.731440101
*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

include_once(app_path().'\core\error_core.php');
include_once(app_path().'\core\jwt_core.php');
include_once(app_path().'\core\security.php');

include_once(app_path().'\controller\usuariosController.php');

Route::post('registrar', function (Request $request) {
	$json = '';
	try {
		$usuarios = new UsuariosController();
		$json = $usuarios->create($request->nombre,$request->apellido,$request->email,$request->usuario,$request->genero,$request->fecha_nac,$request->pass);
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});

?>