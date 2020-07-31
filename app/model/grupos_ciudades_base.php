<?php

/*
----Creado----2020-07-16 16:15:02.9052736 -0300 -03 m=+1.334480601
*/
include_once(app_path().'\core\crud.php');

class Grupos_ciudades_base extends Crud {

	private $idCiudad;
	private $idGrupo;
	private $fechaDesde;

	const TABLE = 'grupos_ciudades';

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
			$sql = 'insert into '.self::TABLE.' (idCiudad,idGrupo,fechaDesde) values(?,?,?)';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array($this->idCiudad,$this->idGrupo,$this->fechaDesde));
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
			$sql = 'update '.self::TABLE.' set where  idCiudad = ?  and  idGrupo = ?  and  fechaDesde = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->idCiudad , $this->idGrupo , $this->fechaDesde ));
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
			$sql = 'select * from '.self::TABLE.' where  idCiudad = ?  and  idGrupo = ?  and  fechaDesde = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->idCiudad ,  $this->idGrupo ,  $this->fechaDesde));
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
			$sql = 'delete from '.self::TABLE.' where  idCiudad = ?  and  idGrupo = ?  and  fechaDesde = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->idCiudad ,  $this->idGrupo ,  $this->fechaDesde));
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