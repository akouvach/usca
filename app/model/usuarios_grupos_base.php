<?php

/*
----Creado----2020-07-16 16:15:04.5001787 -0300 -03 m=+2.929385701
*/
include_once(app_path().'\core\crud.php');

class Usuarios_grupos_base extends Crud {

	private $idGrupo;
	private $idUsuario;
	private $activo;
	private $FechaDesde;

	const TABLE = 'usuarios_grupos';

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
			$sql = 'insert into '.self::TABLE.' (idGrupo,idUsuario,activo,FechaDesde) values(?,?,?,?)';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array($this->idGrupo,$this->idUsuario,$this->activo,$this->FechaDesde));
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
			$sql = 'update '.self::TABLE.' set  activo = ? where  idGrupo = ?  and  idUsuario = ?  and  FechaDesde = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->activo , $this->idGrupo , $this->idUsuario , $this->FechaDesde ));
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
			$sql = 'select * from '.self::TABLE.' where  idGrupo = ?  and  idUsuario = ?  and  FechaDesde = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->idGrupo ,  $this->idUsuario ,  $this->FechaDesde));
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
			$sql = 'delete from '.self::TABLE.' where  idGrupo = ?  and  idUsuario = ?  and  FechaDesde = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->idGrupo ,  $this->idUsuario ,  $this->FechaDesde));
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