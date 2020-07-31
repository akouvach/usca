<?php

/*
----Creado----2020-07-16 16:15:04.538472 -0300 -03 m=+2.967679001
*/
include_once(app_path().'\model\usuarios_grupos.php');

include_once(app_path().'\core\conexion.php');

class Usuarios_gruposController_base extends Conexion{

	private $model; 

	public function __construct(){
		try {
			parent::__construct();
			$this->model = new Usuarios_grupos($this->pdo);
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

	public function getByPrim( $idGrupo, $idUsuario, $FechaDesde){

		$this->model->idGrupo= $idGrupo;
		$this->model->idUsuario= $idUsuario;
		$this->model->FechaDesde= $FechaDesde;
		return $this->model->getByPrim();
	}

	public function delByPrim( $idGrupo, $idUsuario, $FechaDesde){

		$this->model->idGrupo= $idGrupo;
		$this->model->idUsuario= $idUsuario;
		$this->model->FechaDesde= $FechaDesde;
		return $this->model->delByPrim();
	}


	public function create($idGrupo,$idUsuario,$activo,$FechaDesde){


		$this->model->idGrupo=$idGrupo;
		$this->model->idUsuario=$idUsuario;
		$this->model->activo=$activo;
		$this->model->FechaDesde=$FechaDesde;
 

		// var_dump($this->model);
		return $this->model->create();
	}


	public function update($idGrupo,$idUsuario,$activo,$FechaDesde){

		$this->model->idGrupo=$idGrupo;
		$this->model->idUsuario=$idUsuario;
		$this->model->activo=$activo;
		$this->model->FechaDesde=$FechaDesde;

		return $this->model->update();
	}
}

?>