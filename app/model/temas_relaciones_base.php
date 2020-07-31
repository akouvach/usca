<?php

/*
----Creado----2020-07-16 16:15:04.0516244 -0300 -03 m=+2.480831401
*/
include_once(app_path().'\core\crud.php');

class Temas_relaciones_base extends Crud {

	private $idTema;
	private $idTemaRel;

	const TABLE = 'temas_relaciones';

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
			$sql = 'insert into '.self::TABLE.' (idTema,idTemaRel) values(?,?)';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array($this->idTema,$this->idTemaRel));
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
			$sql = 'update '.self::TABLE.' set where  idTema = ?  and  idTemaRel = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->idTema , $this->idTemaRel ));
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
			$sql = 'select * from '.self::TABLE.' where  idTema = ?  and  idTemaRel = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->idTema ,  $this->idTemaRel));
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
			$sql = 'delete from '.self::TABLE.' where  idTema = ?  and  idTemaRel = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->idTema ,  $this->idTemaRel));
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