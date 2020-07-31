<?php

/*
----Creado----2020-07-16 16:15:04.8189808 -0300 -03 m=+3.248187801
*/
include_once(app_path().'\model\wf_estados.php');

include_once(app_path().'\core\conexion.php');

class Wf_estadosController_base extends Conexion{

	private $model; 

	public function __construct(){
		try {
			parent::__construct();
			$this->model = new Wf_estados($this->pdo);
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


	public function create($id,$estado,$idApp,$esInicial,$esFinal){


		$this->model->id=$id;
		$this->model->estado=$estado;
		$this->model->idApp=$idApp;
		$this->model->esInicial=$esInicial;
		$this->model->esFinal=$esFinal;

		return $this->model->create();
	}


	public function update($id,$estado,$idApp,$esInicial,$esFinal){

		$this->model->id=$id;
		$this->model->estado=$estado;
		$this->model->idApp=$idApp;
		$this->model->esInicial=$esInicial;
		$this->model->esFinal=$esFinal;

		return $this->model->update();
	}
}

?>