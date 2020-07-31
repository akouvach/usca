<?php

/*
----Creado----2020-07-16 16:15:03.7580582 -0300 -03 m=+2.187265201
*/
include_once(app_path().'\core\crud.php');

class Sec_roles_usuarios_base extends Crud {

	private $idUsuario;
	private $idRol;
	private $fechaDesde;

	const TABLE = 'sec_roles_usuarios';

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
			$sql = 'insert into '.self::TABLE.' (idUsuario,idRol,fechaDesde) values(?,?,?)';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array($this->idUsuario,$this->idRol,$this->fechaDesde));
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
			$sql = 'update '.self::TABLE.' set where  idUsuario = ?  and  idRol = ?  and  fechaDesde = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->idUsuario , $this->idRol , $this->fechaDesde ));
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
			$sql = 'select * from '.self::TABLE.' where  idUsuario = ?  and  idRol = ?  and  fechaDesde = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->idUsuario ,  $this->idRol ,  $this->fechaDesde));
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
			$sql = 'delete from '.self::TABLE.' where  idUsuario = ?  and  idRol = ?  and  fechaDesde = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->idUsuario ,  $this->idRol ,  $this->fechaDesde));
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