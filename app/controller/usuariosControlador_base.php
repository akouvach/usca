<?php

/*
----Creado----2020-07-16 16:15:04.2393162 -0300 -03 m=+2.668523201
*/
include_once(app_path().'\model\usuarios.php');

include_once(app_path().'\core\conexion.php');

class UsuariosController_base extends Conexion{

	private $model; 

	public function __construct(){
		try {
			parent::__construct();
			$this->model = new Usuarios($this->pdo);
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


	public function create($nombre,$apellido,$email,$usuario,$genero,$fecha_nac,$pass){


		$this->model->nombre=$nombre;
		$this->model->apellido=$apellido;
		$this->model->email=$email;
		$this->model->usuario=$usuario;
		$this->model->genero=$genero;
		$this->model->fecha_nac=$fecha_nac;
		$this->model->pass=$pass;

		return $this->model->create();
	}


	public function update($id,$nombre,$apellido,$email,$usuario,$genero,$fecha_nac,$pass){

		$this->model->id=$id;
		$this->model->nombre=$nombre;
		$this->model->apellido=$apellido;
		$this->model->email=$email;
		$this->model->usuario=$usuario;
		$this->model->genero=$genero;
		$this->model->fecha_nac=$fecha_nac;
		$this->model->pass=$pass;

		return $this->model->update();
	}
}

?>