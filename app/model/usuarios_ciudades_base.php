<?php

/*
----Creado----2020-07-16 16:15:04.3511059 -0300 -03 m=+2.780312901
*/
include_once(app_path().'\core\crud.php');

class Usuarios_ciudades_base extends Crud {

	private $idUsuario;
	private $idCiudad;
	private $descripcion;
	private $fechaDesde;

	const TABLE = 'usuarios_ciudades';

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
			$sql = 'insert into '.self::TABLE.' (idUsuario,idCiudad,descripcion,fechaDesde) values(?,?,?,?)';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array($this->idUsuario,$this->idCiudad,$this->descripcion,$this->fechaDesde));
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
			$sql = 'update '.self::TABLE.' set  idUsuario = ? , idCiudad = ? , descripcion = ? , fechaDesde = ? where ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->idUsuario , $this->idCiudad , $this->descripcion , $this->fechaDesde ));
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
			$sql = 'select * from '.self::TABLE.' where ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array());
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
			$sql = 'delete from '.self::TABLE.' where ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array());
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