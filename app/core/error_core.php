
<?php
  set_exception_handler('exceptionHandler');

function exceptionHandler($ex) {
    echo "Excepción no capturada: " , $ex->getMessage(), "\n";
}
  


  

function myError($errorLevel, $errorMessage){    
    
    echo json_encode(
        array(
            "ok" => false,
            "payload" => $errorMessage
        )
    );


    // if($errorLevel==1){
    //     die($errorMessage);
    // } else {
    //     exit;
    // };
}

?>
