<?php

/*
----Creado----2020-07-16 16:15:04.9695418 -0300 -03 m=+3.398748801
*/
include_once(app_path().'\model\wf_estados_cambios_causas.php');

include_once(app_path().'\core\conexion.php');

class Wf_estados_cambios_causasController_base extends Conexion{

	private $model; 

	public function __construct(){
		try {
			parent::__construct();
			$this->model = new Wf_estados_cambios_causas($this->pdo);
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

	public function getByPrim( $idEstadoOrigen, $idEstadoDestino, $idCausa){

		$this->model->idEstadoOrigen= $idEstadoOrigen;
		$this->model->idEstadoDestino= $idEstadoDestino;
		$this->model->idCausa= $idCausa;
		return $this->model->getByPrim();
	}

	public function delByPrim( $idEstadoOrigen, $idEstadoDestino, $idCausa){

		$this->model->idEstadoOrigen= $idEstadoOrigen;
		$this->model->idEstadoDestino= $idEstadoDestino;
		$this->model->idCausa= $idCausa;
		return $this->model->delByPrim();
	}


	public function create($idEstadoOrigen,$idEstadoDestino,$idCausa){


		$this->model->idEstadoOrigen=$idEstadoOrigen;
		$this->model->idEstadoDestino=$idEstadoDestino;
		$this->model->idCausa=$idCausa;

		return $this->model->create();
	}


	public function update($idEstadoOrigen,$idEstadoDestino,$idCausa){

		$this->model->idEstadoOrigen=$idEstadoOrigen;
		$this->model->idEstadoDestino=$idEstadoDestino;
		$this->model->idCausa=$idCausa;

		return $this->model->update();
	}
}

?>