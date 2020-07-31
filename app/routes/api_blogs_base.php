<?php

/*
----Creado----2020-07-16 16:15:02.0083728 -0300 -03 m=+0.437579801
*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

include_once(app_path().'\core\error_core.php');
include_once(app_path().'\core\jwt_core.php');
include_once(app_path().'\core\security.php');

include_once(app_path().'\controller\blogsController.php');

Route::get('blogs', function (Request $request) {
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
		$blogs = new BlogsController();
		$blogs->usuarioConectado=$rdo->payload;
		$json =json_encode($blogs->getAll());
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});


Route::get('blogs/{id}', function (Request $request) {
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
		$blogs = new BlogsController();
		$blogs->usuarioConectado=$rdo->payload;
		$json = json_encode($blogs->getByPrim($request->id));
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});


Route::post('blogs', function (Request $request) {
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
		$blogs = new BlogsController();
		$blogs->usuarioConectado=$rdo->payload;
		$json = $blogs->create($request->mensaje,$request->idUsuario,$request->fecha,$request->idGrupo,$request->emociones,$request->idMensajeRel);
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});
Route::put('blogs', function (Request $request) {
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
		$blogs = new BlogsController();
		$blogs->usuarioConectado=$rdo->payload;
		$json = $blogs->update($request->id,$request->mensaje,$request->idUsuario,$request->fecha,$request->idGrupo,$request->emociones,$request->idMensajeRel);
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});
Route::delete('blogs', function (Request $request) {
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
		$blogs = new BlogsController();
		$blogs->usuarioConectado=$rdo->payload;
		$json = $blogs->delByPrim($request->id); 

		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});
?>