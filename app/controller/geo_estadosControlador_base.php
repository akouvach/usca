<?php

/*
----Creado----2020-07-16 16:15:02.3791424 -0300 -03 m=+0.808349401
*/
include_once(app_path().'\model\geo_estados.php');

include_once(app_path().'\core\conexion.php');

class Geo_estadosController_base extends Conexion{

	private $model; 

	public function __construct(){
		try {
			parent::__construct();
			$this->model = new Geo_estados($this->pdo);
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

	public function getByPrim( $id){

		$this->model->id= $id;
		return $this->model->getByPrim();
	}

	public function delByPrim( $id){

		$this->model->id= $id;
		return $this->model->delByPrim();
	}


	public function create($id,$estado,$idPais){


		$this->model->id=$id;
		$this->model->estado=$estado;
		$this->model->idPais=$idPais;

		return $this->model->create();
	}


	public function update($id,$estado,$idPais){

		$this->model->id=$id;
		$this->model->estado=$estado;
		$this->model->idPais=$idPais;

		return $this->model->update();
	}
}

?>