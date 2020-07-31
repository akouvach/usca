<?php

/*
----Creado----2020-07-16 16:15:05.0332684 -0300 -03 m=+3.462475401
*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

include_once(app_path().'\core\error_core.php');
include_once(app_path().'\core\jwt_core.php');
include_once(app_path().'\core\security.php');

include_once(app_path().'\controller\wf_estados_cambios_causasController.php');

Route::get('wf_estados_cambios_causas', function (Request $request) {
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
		$wf_estados_cambios_causas = new Wf_estados_cambios_causasController();
		$wf_estados_cambios_causas->usuarioConectado=$rdo->payload;
		$json =json_encode($wf_estados_cambios_causas->getAll());
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});


Route::get('wf_estados_cambios_causas/{idEstadoOrigen}/{idEstadoDestino}/{idCausa}', function (Request $request) {
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
		$wf_estados_cambios_causas = new Wf_estados_cambios_causasController();
		$wf_estados_cambios_causas->usuarioConectado=$rdo->payload;
		$json = json_encode($wf_estados_cambios_causas->getByPrim($request->idEstadoOrigen,$request->idEstadoDestino,$request->idCausa));
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});


Route::post('wf_estados_cambios_causas', function (Request $request) {
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
		$wf_estados_cambios_causas = new Wf_estados_cambios_causasController();
		$wf_estados_cambios_causas->usuarioConectado=$rdo->payload;
		$json = $wf_estados_cambios_causas->create($request->idEstadoOrigen,$request->idEstadoDestino,$request->idCausa);
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});
Route::put('wf_estados_cambios_causas', function (Request $request) {
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
		$wf_estados_cambios_causas = new Wf_estados_cambios_causasController();
		$wf_estados_cambios_causas->usuarioConectado=$rdo->payload;
		$json = $wf_estados_cambios_causas->update($request->idEstadoOrigen,$request->idEstadoDestino,$request->idCausa);
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});
Route::delete('wf_estados_cambios_causas', function (Request $request) {
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
		$wf_estados_cambios_causas = new Wf_estados_cambios_causasController();
		$wf_estados_cambios_causas->usuarioConectado=$rdo->payload;
		$json = $wf_estados_cambios_causas->delByPrim($request->idEstadoOrigen,$request->idEstadoDestino,$request->idCausa); 

		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});
?>