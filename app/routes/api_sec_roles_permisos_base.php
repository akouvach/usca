<?php

/*
----Creado----2020-07-16 16:15:03.7124906 -0300 -03 m=+2.141697601
*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

include_once(app_path().'\core\error_core.php');
include_once(app_path().'\core\jwt_core.php');
include_once(app_path().'\core\security.php');

include_once(app_path().'\controller\sec_roles_permisosController.php');

Route::get('sec_roles_permisos', function (Request $request) {
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
		$sec_roles_permisos = new Sec_roles_permisosController();
		$sec_roles_permisos->usuarioConectado=$rdo->payload;
		$json =json_encode($sec_roles_permisos->getAll());
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});


Route::get('sec_roles_permisos/{idRol}/{idMenu}', function (Request $request) {
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
		$sec_roles_permisos = new Sec_roles_permisosController();
		$sec_roles_permisos->usuarioConectado=$rdo->payload;
		$json = json_encode($sec_roles_permisos->getByPrim($request->idRol,$request->idMenu));
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});


Route::post('sec_roles_permisos', function (Request $request) {
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
		$sec_roles_permisos = new Sec_roles_permisosController();
		$sec_roles_permisos->usuarioConectado=$rdo->payload;
		$json = $sec_roles_permisos->create($request->idRol,$request->idMenu,$request->fechaDesde);
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});
Route::put('sec_roles_permisos', function (Request $request) {
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
		$sec_roles_permisos = new Sec_roles_permisosController();
		$sec_roles_permisos->usuarioConectado=$rdo->payload;
		$json = $sec_roles_permisos->update($request->idRol,$request->idMenu,$request->fechaDesde);
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});
Route::delete('sec_roles_permisos', function (Request $request) {
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
		$sec_roles_permisos = new Sec_roles_permisosController();
		$sec_roles_permisos->usuarioConectado=$rdo->payload;
		$json = $sec_roles_permisos->delByPrim($request->idRol,$request->idMenu); 

		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});
?>