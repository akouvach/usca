<?php

/*
----Creado----2020-07-16 16:15:02.5207422 -0300 -03 m=+0.949949201
*/
include_once(app_path().'\model\geo_paises.php');

include_once(app_path().'\core\conexion.php');

class Geo_paisesController_base extends Conexion{

	private $model; 

	public function __construct(){
		try {
			parent::__construct();
			$this->model = new Geo_paises($this->pdo);
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


	public function create($id,$nombre,$descripcion,$iso3,$codigo){


		$this->model->id=$id;
		$this->model->nombre=$nombre;
		$this->model->descripcion=$descripcion;
		$this->model->iso3=$iso3;
		$this->model->codigo=$codigo;

		return $this->model->create();
	}


	public function update($id,$nombre,$descripcion,$iso3,$codigo){

		$this->model->id=$id;
		$this->model->nombre=$nombre;
		$this->model->descripcion=$descripcion;
		$this->model->iso3=$iso3;
		$this->model->codigo=$codigo;

		return $this->model->update();
	}
}

?>