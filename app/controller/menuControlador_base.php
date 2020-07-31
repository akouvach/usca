<?php

/*
----Creado----2020-07-16 16:15:03.2118502 -0300 -03 m=+1.641057201
*/
include_once(app_path().'\model\menu.php');

include_once(app_path().'\core\conexion.php');

class MenuController_base extends Conexion{

	private $model; 

	public function __construct(){
		try {
			parent::__construct();
			$this->model = new Menu($this->pdo);
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


	public function create($id,$ruta,$menu,$menuIdPadre){


		$this->model->id=$id;
		$this->model->ruta=$ruta;
		$this->model->menu=$menu;
		$this->model->menuIdPadre=$menuIdPadre;

		return $this->model->create();
	}


	public function update($id,$ruta,$menu,$menuIdPadre){

		$this->model->id=$id;
		$this->model->ruta=$ruta;
		$this->model->menu=$menu;
		$this->model->menuIdPadre=$menuIdPadre;

		return $this->model->update();
	}
}

?>