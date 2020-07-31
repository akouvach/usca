<?php

/*
----Creado----2020-07-16 16:15:03.0709368 -0300 -03 m=+1.500143801
*/
include_once(app_path().'\model\grupos_relaciones.php');

include_once(app_path().'\core\conexion.php');

class Grupos_relacionesController_base extends Conexion{

	private $model; 

	public function __construct(){
		try {
			parent::__construct();
			$this->model = new Grupos_relaciones($this->pdo);
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

	public function getByPrim( $grupo_origen, $grupo_destino){

		$this->model->grupo_origen= $grupo_origen;
		$this->model->grupo_destino= $grupo_destino;
		return $this->model->getByPrim();
	}

	public function delByPrim( $grupo_origen, $grupo_destino){

		$this->model->grupo_origen= $grupo_origen;
		$this->model->grupo_destino= $grupo_destino;
		return $this->model->delByPrim();
	}


	public function create($grupo_origen,$grupo_destino,$tipo_relacion,$fechaDesde){


		$this->model->grupo_origen=$grupo_origen;
		$this->model->grupo_destino=$grupo_destino;
		$this->model->tipo_relacion=$tipo_relacion;
		$this->model->fechaDesde=$fechaDesde;

		return $this->model->create();
	}


	public function update($grupo_origen,$grupo_destino,$tipo_relacion,$fechaDesde){

		$this->model->grupo_origen=$grupo_origen;
		$this->model->grupo_destino=$grupo_destino;
		$this->model->tipo_relacion=$tipo_relacion;
		$this->model->fechaDesde=$fechaDesde;

		return $this->model->update();
	}
}

?>