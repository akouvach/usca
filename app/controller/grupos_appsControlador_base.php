<?php

/*
----Creado----2020-07-16 16:15:02.7983632 -0300 -03 m=+1.227570201
*/
include_once(app_path().'\model\grupos_apps.php');

include_once(app_path().'\core\conexion.php');

class Grupos_appsController_base extends Conexion{

	private $model; 

	public function __construct(){
		try {
			parent::__construct();
			$this->model = new Grupos_apps($this->pdo);
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

	public function getByPrim( $idGrupo, $idApp){

		$this->model->idGrupo= $idGrupo;
		$this->model->idApp= $idApp;
		return $this->model->getByPrim();
	}

	public function delByPrim( $idGrupo, $idApp){

		$this->model->idGrupo= $idGrupo;
		$this->model->idApp= $idApp;
		return $this->model->delByPrim();
	}


	public function create($idGrupo,$idApp,$idWf){


		$this->model->idGrupo=$idGrupo;
		$this->model->idApp=$idApp;
		$this->model->idWf=$idWf;

		return $this->model->create();
	}


	public function update($idGrupo,$idApp,$idWf){

		$this->model->idGrupo=$idGrupo;
		$this->model->idApp=$idApp;
		$this->model->idWf=$idWf;

		return $this->model->update();
	}
}

?>