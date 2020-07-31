<?php

include_once(app_path().'\core\conexion.php');



include_once(app_path().'\controller\gruposController.php');

class BuscarController  extends Conexion {

    public function getGrupos( $parametros){

		try{
			// var_dump($this->usuarioConectado->id);
			$grupo = new GruposController();
			$grupo->usuarioConectado = $this->usuarioConectado;

			return $grupo->buscarGrupos($parametros["grupos"]);
		} catch (Exception $ex){
			throw new Exception($ex);
		}

		
	}
   
}

?>
