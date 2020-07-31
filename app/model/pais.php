<?php

require_once "../core/crud.php";

class Pais extends Crud {

    private $id;
    private $nombre;
    private $descripcion;
    private $iso3;
    private $codigo;

    const TABLE = "paises";

    public function __construct(){
        parent::__construct(self::TABLE);
    }

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }


    public function create(){
        try {
            $sql = "insert into ".self::TABLE." (id,nombre,descripcion,iso3,codigo) values(?,?,?,?,?)";
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute(array($this->id, $this->nombre, $this->descripion, $this->iso3, $this->codigo));
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
          $sql = "update ".self::TABLE." set nombre=?, descripcion=?, iso3=?, codigo=? where id = ?";
          $stmt = $this->pdo->prepare($sql);
          $result = $stmt->execute(array($this->nombre, $this->descripcion, $this->iso3, $this->codigo, $this->id));
          return $result;
        } catch (PDOException $err){
            throw $err;
        } catch (Error $err){
            throw $err;
        } catch (Exception $ex){
            throw $ex;
        }    }


}



?>
