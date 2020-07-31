<?php

/*
----Creado----2020-07-16 16:15:04.9289871 -0300 -03 m=+3.358194101
*/
include_once(app_path().'\core\crud.php');

class Wf_estados_cambios_causas_base extends Crud {

	private $idEstadoOrigen;
	private $idEstadoDestino;
	private $idCausa;

	const TABLE = 'wf_estados_cambios_causas';

	public function __construct($pdo){
		parent::__construct($pdo, self::TABLE);
	}

	public function __get($name){
		return $this->$name;
	}

	public function __set($name, $value){
		$this->$name = $value;
	}

	public function create(){


		try {
			$sql = 'insert into '.self::TABLE.' (idEstadoOrigen,idEstadoDestino,idCausa) values(?,?,?)';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array($this->idEstadoOrigen,$this->idEstadoDestino,$this->idCausa));
			$stmt->closeCursor();
			return $result;
		} catch (PDOException $err){
			throw $err;
		} catch (Error $err){
			throw $err;
		} catch (Exception $ex){
			throw $ex;
		}
	}
	public function update(){
		try {
			$sql = 'update '.self::TABLE.' set where  idEstadoOrigen = ?  and  idEstadoDestino = ?  and  idCausa = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->idEstadoOrigen , $this->idEstadoDestino , $this->idCausa ));
			return $result;
		} catch (PDOException $err){
			throw $err;
		} catch (Error $err){
			throw $err;
		} catch (Exception $ex){
			throw $ex;
		}
	}
	public function getByPrim(){
		try {
			$sql = 'select * from '.self::TABLE.' where  idEstadoOrigen = ?  and  idEstadoDestino = ?  and  idCausa = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->idEstadoOrigen ,  $this->idEstadoDestino ,  $this->idCausa));
			$result = $stmt->fetchAll(PDO::FETCH_OBJ);
			return $result;
		} catch (PDOException $err){
			throw $err;
		} catch (Error $err){
			throw $err;
		} catch (Exception $ex){
			throw $ex;
		}
	}
	public function delByPrim(){
		try {
			$sql = 'delete from '.self::TABLE.' where  idEstadoOrigen = ?  and  idEstadoDestino = ?  and  idCausa = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->idEstadoOrigen ,  $this->idEstadoDestino ,  $this->idCausa));
			return $result;
		} catch (PDOException $err){
			throw $err;
		} catch (Error $err){
			throw $err;
		} catch (Exception $ex){
			throw $ex;
		}
	}
}
?>