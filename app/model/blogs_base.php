<?php

/*
----Creado----2020-07-16 16:15:01.9209668 -0300 -03 m=+0.350173801
*/
include_once(app_path().'\core\crud.php');

class Blogs_base extends Crud {

	private $id;
	private $mensaje;
	private $idUsuario;
	private $fecha;
	private $idGrupo;
	private $emociones;
	private $idMensajeRel;

	const TABLE = 'blogs';

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
			$sql = 'insert into '.self::TABLE.' (mensaje,idUsuario,fecha,idGrupo,emociones,idMensajeRel) values(?,?,?,?,?,?)';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array($this->mensaje,$this->idUsuario,$this->fecha,$this->idGrupo,$this->emociones,$this->idMensajeRel));
			$this->id = $this->pdo->lastInsertId();
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
			$sql = 'update '.self::TABLE.' set  mensaje = ? , idUsuario = ? , fecha = ? , idGrupo = ? , emociones = ? , idMensajeRel = ? where  id = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->mensaje , $this->idUsuario , $this->fecha , $this->idGrupo , $this->emociones , $this->idMensajeRel , $this->id ));
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
			$sql = 'select * from '.self::TABLE.' where  id = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->id));
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
			$sql = 'delete from '.self::TABLE.' where  id = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->id));
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