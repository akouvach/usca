<?php

/*
----Creado----2020-07-16 16:15:04.088809 -0300 -03 m=+2.518016001
*/
include_once(app_path().'\model\temas_relaciones.php');

include_once(app_path().'\core\conexion.php');

class Temas_relacionesController_base extends Conexion{

	private $model; 

	public function __construct(){
		try {
			parent::__construct();
			$this->model = new Temas_relaciones($this->pdo);
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

	public function getByPrim( $idTema, $idTemaRel){

		$this->model->idTema= $idTema;
		$this->model->idTemaRel= $idTemaRel;
		return $this->model->getByPrim();
	}

	public function delByPrim( $idTema, $idTemaRel){

		$this->model->idTema= $idTema;
		$this->model->idTemaRel= $idTemaRel;
		return $this->model->delByPrim();
	}


	public function create($idTema,$idTemaRel){


		$this->model->idTema=$idTema;
		$this->model->idTemaRel=$idTemaRel;

		return $this->model->create();
	}


	public function update($idTema,$idTemaRel){

		$this->model->idTema=$idTema;
		$this->model->idTemaRel=$idTemaRel;

		return $this->model->update();
	}
}

?>