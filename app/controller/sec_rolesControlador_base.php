<?php

/*
----Creado----2020-07-16 16:15:03.5009954 -0300 -03 m=+1.930202401
*/
include_once(app_path().'\model\sec_roles.php');

include_once(app_path().'\core\conexion.php');

class Sec_rolesController_base extends Conexion{

	private $model; 

	public function __construct(){
		try {
			parent::__construct();
			$this->model = new Sec_roles($this->pdo);
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


	public function create($id,$rol,$esAdminGlogal,$esAdminGrupo,$esAdminGeografico){


		$this->model->id=$id;
		$this->model->rol=$rol;
		$this->model->esAdminGlogal=$esAdminGlogal;
		$this->model->esAdminGrupo=$esAdminGrupo;
		$this->model->esAdminGeografico=$esAdminGeografico;

		return $this->model->create();
	}


	public function update($id,$rol,$esAdminGlogal,$esAdminGrupo,$esAdminGeografico){

		$this->model->id=$id;
		$this->model->rol=$rol;
		$this->model->esAdminGlogal=$esAdminGlogal;
		$this->model->esAdminGrupo=$esAdminGrupo;
		$this->model->esAdminGeografico=$esAdminGeografico;

		return $this->model->update();
	}
}

?>