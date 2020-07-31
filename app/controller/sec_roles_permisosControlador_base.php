<?php

/*
----Creado----2020-07-16 16:15:03.648875 -0300 -03 m=+2.078082001
*/
include_once(app_path().'\model\sec_roles_permisos.php');

include_once(app_path().'\core\conexion.php');

class Sec_roles_permisosController_base extends Conexion{

	private $model; 

	public function __construct(){
		try {
			parent::__construct();
			$this->model = new Sec_roles_permisos($this->pdo);
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

	public function getByPrim( $idRol, $idMenu){

		$this->model->idRol= $idRol;
		$this->model->idMenu= $idMenu;
		return $this->model->getByPrim();
	}

	public function delByPrim( $idRol, $idMenu){

		$this->model->idRol= $idRol;
		$this->model->idMenu= $idMenu;
		return $this->model->delByPrim();
	}


	public function create($idRol,$idMenu,$fechaDesde){


		$this->model->idRol=$idRol;
		$this->model->idMenu=$idMenu;
		$this->model->fechaDesde=$fechaDesde;

		return $this->model->create();
	}


	public function update($idRol,$idMenu,$fechaDesde){

		$this->model->idRol=$idRol;
		$this->model->idMenu=$idMenu;
		$this->model->fechaDesde=$fechaDesde;

		return $this->model->update();
	}
}

?>