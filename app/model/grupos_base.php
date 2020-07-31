<?php

/*
----Creado----2020-07-16 16:15:02.6279999 -0300 -03 m=+1.057206901
*/
include_once(app_path().'\core\crud.php');

class Grupos_base extends Crud {

	private $id;
	private $descripcion;
	private $grupo;
	private $idCreador;
	private $idOrganigrama;
	private $tipo;
	private $tags;

	const TABLE = 'grupos';

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
			$sql = 'insert into '.self::TABLE.' (descripcion,grupo,idCreador,idOrganigrama,tipo,tags) values(?,?,?,?,?,?)';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array($this->descripcion,$this->grupo,$this->idCreador,$this->idOrganigrama,$this->tipo,$this->tags));
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
			$sql = 'update '.self::TABLE.' set  descripcion = ? , grupo = ? , idCreador = ? , idOrganigrama = ? , tipo = ? , tags = ? where  id = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->descripcion , $this->grupo , $this->idCreador , $this->idOrganigrama , $this->tipo , $this->tags , $this->id ));
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