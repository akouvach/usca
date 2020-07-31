<?php

/*
----Creado----2020-07-16 16:15:02.0958758 -0300 -03 m=+0.525082801
*/
include_once(app_path().'\model\emociones.php');

include_once(app_path().'\core\conexion.php');

class EmocionesController_base extends Conexion{

	private $model; 

	public function __construct(){
		try {
			parent::__construct();
			$this->model = new Emociones($this->pdo);
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


	public function create($id,$emocion,$emoji){


		$this->model->id=$id;
		$this->model->emocion=$emocion;
		$this->model->emoji=$emoji;

		return $this->model->create();
	}


	public function update($id,$emocion,$emoji){

		$this->model->id=$id;
		$this->model->emocion=$emocion;
		$this->model->emoji=$emoji;

		return $this->model->update();
	}
}

?>