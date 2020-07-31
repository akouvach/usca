<?php

/*
----Creado----2020-07-16 16:15:01.9571466 -0300 -03 m=+0.386353601
*/
include_once(app_path().'\model\blogs.php');

include_once(app_path().'\core\conexion.php');

class BlogsController_base extends Conexion{

	private $model; 

	public function __construct(){
		try {
			parent::__construct();
			$this->model = new Blogs($this->pdo);
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


	public function create($mensaje,$idUsuario,$fecha,$idGrupo,$emociones,$idMensajeRel){


		$this->model->mensaje=$mensaje;
		$this->model->idUsuario=$idUsuario;
		$this->model->fecha=$fecha;
		$this->model->idGrupo=$idGrupo;
		$this->model->emociones=$emociones;
		$this->model->idMensajeRel=$idMensajeRel;

		return $this->model->create();
	}


	public function update($id,$mensaje,$idUsuario,$fecha,$idGrupo,$emociones,$idMensajeRel){

		$this->model->id=$id;
		$this->model->mensaje=$mensaje;
		$this->model->idUsuario=$idUsuario;
		$this->model->fecha=$fecha;
		$this->model->idGrupo=$idGrupo;
		$this->model->emociones=$emociones;
		$this->model->idMensajeRel=$idMensajeRel;

		return $this->model->update();
	}
}

?>