<?php

/*
----Creado----2020-07-16 16:15:04.6825176 -0300 -03 m=+3.111724601
*/
include_once(app_path().'\model\wf.php');

include_once(app_path().'\core\conexion.php');

class WfController_base extends Conexion{

	private $model; 

	public function __construct(){
		try {
			parent::__construct();
			$this->model = new Wf($this->pdo);
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


	public function create($id,$workflow,$idApp){


		$this->model->id=$id;
		$this->model->workflow=$workflow;
		$this->model->idApp=$idApp;

		return $this->model->create();
	}


	public function update($id,$workflow,$idApp){

		$this->model->id=$id;
		$this->model->workflow=$workflow;
		$this->model->idApp=$idApp;

		return $this->model->update();
	}
}

?>