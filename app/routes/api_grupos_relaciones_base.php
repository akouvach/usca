<?php

/*
----Creado----2020-07-16 16:15:03.1265042 -0300 -03 m=+1.555711201
*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

include_once(app_path().'\core\error_core.php');
include_once(app_path().'\core\jwt_core.php');
include_once(app_path().'\core\security.php');

include_once(app_path().'\controller\grupos_relacionesController.php');

Route::get('grupos_relaciones', function (Request $request) {
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
		$grupos_relaciones = new Grupos_relacionesController();
		$grupos_relaciones->usuarioConectado=$rdo->payload;
		$json =json_encode($grupos_relaciones->getAll());
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});


Route::get('grupos_relaciones/{grupo_origen}/{grupo_destino}', function (Request $request) {
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
		$grupos_relaciones = new Grupos_relacionesController();
		$grupos_relaciones->usuarioConectado=$rdo->payload;
		$json = json_encode($grupos_relaciones->getByPrim($request->grupo_origen,$request->grupo_destino));
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});


Route::post('grupos_relaciones', function (Request $request) {
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
		$grupos_relaciones = new Grupos_relacionesController();
		$grupos_relaciones->usuarioConectado=$rdo->payload;
		$json = $grupos_relaciones->create($request->grupo_origen,$request->grupo_destino,$request->tipo_relacion,$request->fechaDesde);
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});
Route::put('grupos_relaciones', function (Request $request) {
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
		$grupos_relaciones = new Grupos_relacionesController();
		$grupos_relaciones->usuarioConectado=$rdo->payload;
		$json = $grupos_relaciones->update($request->grupo_origen,$request->grupo_destino,$request->tipo_relacion,$request->fechaDesde);
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});
Route::delete('grupos_relaciones', function (Request $request) {
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
		$grupos_relaciones = new Grupos_relacionesController();
		$grupos_relaciones->usuarioConectado=$rdo->payload;
		$json = $grupos_relaciones->delByPrim($request->grupo_origen,$request->grupo_destino); 

		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});
?>