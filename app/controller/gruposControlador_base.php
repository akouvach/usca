<?php

/*
----Creado----2020-07-16 16:15:02.6642684 -0300 -03 m=+1.093475401
*/
include_once(app_path().'\model\grupos.php');

include_once(app_path().'\core\conexion.php');

class GruposController_base extends Conexion{

	private $model; 

	public function __construct(){
		try {
			parent::__construct();
			$this->model = new Grupos($this->pdo);
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


	public function create($descripcion,$grupo,$idCreador,$idOrganigrama,$tipo,$tags){


		$this->model->descripcion=$descripcion;
		$this->model->grupo=$grupo;
		$this->model->idCreador=$idCreador;
		$this->model->idOrganigrama=$idOrganigrama;
		$this->model->tipo=$tipo;
		$this->model->tags=$tags;

		return $this->model->create();
	}


	public function update($id,$descripcion,$grupo,$idCreador,$idOrganigrama,$tipo,$tags){

		$this->model->id=$id;
		$this->model->descripcion=$descripcion;
		$this->model->grupo=$grupo;
		$this->model->idCreador=$idCreador;
		$this->model->idOrganigrama=$idOrganigrama;
		$this->model->tipo=$tipo;
		$this->model->tags=$tags;

		return $this->model->update();
	}
}

?>