<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php

require_once("../model/usuario.php");
$usuario = new Usuario();
// $r = new ReflectionClass($usuario);

// print_r($r->getProperties());

print_r($usuario->getAll());
// $usuario->id=1;
// $usuario->nombre = "Andres";
// $usuario->apellido = "Kouvach";
// $usuario->fecha_nac = "1972-12-30";
// $usuario->email = "akouvach@yahoo.com2";
// $usuario->pass = "Andres";
// $usuario->genero = "M";
// $usuario->ciudad_residencia = '{"idCiudad":1, "idEstado":1, "idPais":1}';

// echo "</br>Valores: </br>";
//
// echo $usuario->nombre;
// echo $usuario->apellido;
// $usuario->create();
//$usuario->update();

echo "</br>";



//print_r($usuarios->getAll());



?>

</body>
</html>
