<?php

/*
----Creado----2020-06-20 09:49:59.4860805 -0300 -03 m=+0.319893001
*/
include_once(app_path() . '\model\usuarios.php');

class UsuariosController_base {

    private $model;

	public function __construct(){
		$this->model = new Usuarios();
	}

	public function getAll(){
		return $this->model->getAll();
	}

	public function getByPrim( $id){
		return $this->model->getByPrim( $id);
	}

	public function delByPrim( $id){
		return $this->model->delByPrim( $id);
	}
}
?>
