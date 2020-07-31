<?php

/*
----Creado----2020-07-16 16:15:03.3538361 -0300 -03 m=+1.783043101
*/
include_once(app_path().'\model\organigramas.php');

include_once(app_path().'\core\conexion.php');

class OrganigramasController_base extends Conexion{

	private $model; 

	public function __construct(){
		try {
			parent::__construct();
			$this->model = new Organigramas($this->pdo);
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


	public function create($area,$idAreaPadre){


		$this->model->area=$area;
		$this->model->idAreaPadre=$idAreaPadre;

		return $this->model->create();
	}


	public function update($id,$area,$idAreaPadre){

		$this->model->id=$id;
		$this->model->area=$area;
		$this->model->idAreaPadre=$idAreaPadre;

		return $this->model->update();
	}
}

?>