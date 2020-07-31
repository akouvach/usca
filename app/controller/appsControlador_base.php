<?php

/*
----Creado----2020-07-16 16:15:01.820344 -0300 -03 m=+0.249551001
*/
include_once(app_path().'\model\apps.php');

include_once(app_path().'\core\conexion.php');

class AppsController_base extends Conexion{

	private $model; 

	public function __construct(){
		try {
			parent::__construct();
			$this->model = new Apps($this->pdo);
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


	public function create($id,$app,$idWf){


		$this->model->id=$id;
		$this->model->app=$app;
		$this->model->idWf=$idWf;

		return $this->model->create();
	}


	public function update($id,$app,$idWf){

		$this->model->id=$id;
		$this->model->app=$app;
		$this->model->idWf=$idWf;

		return $this->model->update();
	}
}

?>