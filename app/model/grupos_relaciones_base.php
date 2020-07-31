<?php

/*
----Creado----2020-07-16 16:15:03.0343246 -0300 -03 m=+1.463531601
*/
include_once(app_path().'\core\crud.php');

class Grupos_relaciones_base extends Crud {

	private $grupo_origen;
	private $grupo_destino;
	private $tipo_relacion;
	private $fechaDesde;

	const TABLE = 'grupos_relaciones';

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
			$sql = 'insert into '.self::TABLE.' (grupo_origen,grupo_destino,tipo_relacion,fechaDesde) values(?,?,?,?)';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array($this->grupo_origen,$this->grupo_destino,$this->tipo_relacion,$this->fechaDesde));
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
			$sql = 'update '.self::TABLE.' set  tipo_relacion = ? , fechaDesde = ? where  grupo_origen = ?  and  grupo_destino = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->tipo_relacion , $this->fechaDesde , $this->grupo_origen , $this->grupo_destino ));
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
			$sql = 'select * from '.self::TABLE.' where  grupo_origen = ?  and  grupo_destino = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->grupo_origen ,  $this->grupo_destino));
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
			$sql = 'delete from '.self::TABLE.' where  grupo_origen = ?  and  grupo_destino = ? ';
			$stmt = $this->pdo->prepare($sql);
			$result = $stmt->execute(array( $this->grupo_origen ,  $this->grupo_destino));
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