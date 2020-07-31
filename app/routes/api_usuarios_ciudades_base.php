<?php

/*
----Creado----2020-07-16 16:15:04.4518509 -0300 -03 m=+2.881057901
*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

include_once(app_path().'\core\error_core.php');
include_once(app_path().'\core\jwt_core.php');
include_once(app_path().'\core\security.php');

include_once(app_path().'\controller\usuarios_ciudadesController.php');

Route::get('usuarios_ciudades', function (Request $request) {
	$json = '';
	try {
		$token = $request->header('authorization');
		if(is_null($token)){
			throw new Exception('No envio token de autenticacion');
		}
		$token = str_replace('Bearer ','',$token);
		$rdo = verificarSeguridad($token);
		if(!$rdo->ok){
			throw new Exception('Token no autorizado');
		}
		$usuarios_ciudades = new Usuarios_ciudadesController();
		$usuarios_ciudades->usuarioConectado=$rdo->payload;
		$json =json_encode($usuarios_ciudades->getAll());
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});


Route::get('usuarios_ciudades', function (Request $request) {
	$json = '';
	try {
		$token = $request->header('authorization');
		if(is_null($token)){
			throw new Exception('No envio token de autenticacion');
		}
		$token = str_replace('Bearer ','',$token);
		$rdo = verificarSeguridad($token);
		if(!$rdo->ok){
			throw new Exception('Token no autorizado');
		}
		$usuarios_ciudades = new Usuarios_ciudadesController();
		$usuarios_ciudades->usuarioConectado=$rdo->payload;
		$json = json_encode($usuarios_ciudades->getByPrim());
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});


Route::post('usuarios_ciudades', function (Request $request) {
	$json = '';
	try {
		$token = $request->header('authorization');
		if(is_null($token)){
			throw new Exception('No envio token de autenticacion');
		}
		$token = str_replace('Bearer ','',$token);
		$rdo = verificarSeguridad($token);
		if(!$rdo->ok){
			throw new Exception('Token no autorizado');
		}
		$usuarios_ciudades = new Usuarios_ciudadesController();
		$usuarios_ciudades->usuarioConectado=$rdo->payload;
		$json = $usuarios_ciudades->create($request->idUsuario,$request->idCiudad,$request->descripcion,$request->fechaDesde);
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});
Route::put('usuarios_ciudades', function (Request $request) {
	$json = '';
	try {
		$token = $request->header('authorization');
		if(is_null($token)){
			throw new Exception('No envio token de autenticacion');
		}
		$token = str_replace('Bearer ','',$token);
		$rdo = verificarSeguridad($token);
		if(!$rdo->ok){
			throw new Exception('Token no autorizado');
		}
		$usuarios_ciudades = new Usuarios_ciudadesController();
		$usuarios_ciudades->usuarioConectado=$rdo->payload;
		$json = $usuarios_ciudades->update($request->idUsuario,$request->idCiudad,$request->descripcion,$request->fechaDesde);
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});
Route::delete('usuarios_ciudades', function (Request $request) {
	$json = '';
	try {
		$token = $request->header('authorization');
		if(is_null($token)){
			throw new Exception('No envio token de autenticacion');
		}
		$token = str_replace('Bearer ','',$token);
		$rdo = verificarSeguridad($token);
		if(!$rdo->ok){
			throw new Exception('Token no autorizado');
		}
		$usuarios_ciudades = new Usuarios_ciudadesController();
		$usuarios_ciudades->usuarioConectado=$rdo->payload;
		$json = $usuarios_ciudades->delByPrim(); 

		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});
?>