<?php

/*
----Creado----2020-07-16 16:15:04.3899909 -0300 -03 m=+2.819197901
*/
include_once(app_path().'\model\usuarios_ciudades.php');

include_once(app_path().'\core\conexion.php');

class Usuarios_ciudadesController_base extends Conexion{

	private $model; 

	public function __construct(){
		try {
			parent::__construct();
			$this->model = new Usuarios_ciudades($this->pdo);
		} catch (Exception $ex){
			throw $ex;
		}
	}


	public function __get($name){
		return $this->$name;
	}


	public function __set($name, $value){
		$this->$name = $value;
	}


	public function getAll(){
		return $this->model->getAll();
	}

	public function getByPrim(){

		return $this->model->getByPrim();
	}

	public function delByPrim(){

		return $this->model->delByPrim();
	}


	public function create($idUsuario,$idCiudad,$descripcion,$fechaDesde){


		$this->model->idUsuario=$idUsuario;
		$this->model->idCiudad=$idCiudad;
		$this->model->descripcion=$descripcion;
		$this->model->fechaDesde=$fechaDesde;

		return $this->model->create();
	}


	public function update($idUsuario,$idCiudad,$descripcion,$fechaDesde){

		$this->model->idUsuario=$idUsuario;
		$this->model->idCiudad=$idCiudad;
		$this->model->descripcion=$descripcion;
		$this->model->fechaDesde=$fechaDesde;

		return $this->model->update();
	}
}

?>