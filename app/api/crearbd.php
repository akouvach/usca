<!DOCTYPE html>
<html>
<body>

<h1> Crear modelo </h1>

<?php

include_once "../core/conexion.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $nombre = $_REQUEST['bd'];
    if (empty($nombre)) {
        echo "Ingrese un nombre para la base de datos";
    } else {

        $bd = new Conexion();
        $rdo = $bd->crearModelo($nombre);
        if($rdo == ""){
            echo "Base de datos creada exitosamente";
            
        } else {
            echo $rdo;
        }

    }
  }
else 
{
?>
    <form action=crearbd.php method=post>
        <h3> Ingrese nombre de base de datos </h3>
        <input type=text name=bd id=bd>
        <input type=submit value="crear">
    </form>

<?php

}

?>



</body>
</html>


