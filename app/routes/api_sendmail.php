<?php

/*
----Creado----2020-07-12 06:50:02.678578 -0300 -03 m=+1.946890801
*/

// require 'vendor/autoload.php';

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

include_once(app_path().'\core\error_core.php');
include_once(app_path().'\core\jwt_core.php');
include_once(app_path().'\core\security.php');



Route::post('sendmail', function (Request $request) {
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

        // $email = new \SendGrid\Mail\Mail(); 
        // $email->setFrom("akpruebas@gmail.com", "eGroups");
        // $email->setSubject("Sending with SendGrid is Fun");
        // $email->addTo("akouvach@yahoo.com", "Example User");
        // $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        // $email->addContent(
        //     "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
        // );


        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom("akpruebas@gmail.com", "eGroups");
        $email->setSubject($request->subject);
        $email->addTo($request->to, $request->to);
        // $email->addContent("text/plain", $request->mensaje);
        $email->addContent("text/html", $request->mensaje);
        // var_dump("variablde de entorno", getenv('SENDGRID_API_KEY'));
        
        // var_dump($request->to,$request->subject,$request->mensaje);
        $sendgrid = new \SendGrid('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');
        try {
            $response = $sendgrid->send($email);
            // print $response->statusCode() . "\n";
            // print_r($response->headers());
            // print $response->body() . "\n";
            $json = json_encode(["rta"=>true,"payload"=>"todo bien"]);
        } catch (Exception $e) {
            $json = json_encode(["rta"=>true,"payload"=>$e->getMessage()]);
        }









	
		http_response_code(200);
	} catch (Exception $ex){
		$json = json_encode(["rta"=>false,"payload"=>utf8_encode($ex->getMessage())]);
		http_response_code(500);
	} finally {
		echo $json;
	}
});

