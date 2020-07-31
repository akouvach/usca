<?php

// require_once "conexion.php";

abstract class Crud {

    private $table;
    protected $pdo;

    public function __construct($pdo, $table){
        $this->table = $table;
        $this->pdo = $pdo;
        //$this->pdo = parent::conexion();
        // try {
        //     $this->pdo = parent::conex();
        //     if(is_null($this->pdo)){
        //         throw new Exception("No se pudo conectar a la base de datos");
        //     }
        // } catch (PDOException $err){
        //     throw $err;
        // } catch (Error $err){
        //     throw $err;
        // } catch (Exception $ex){
        //     throw $ex;
        // }
    }

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }


    public function getAll($filtro=[], $filtroValores=[]){

        try {

            //var_dump($filtro, $filtroValores);
            $select = "select * from $this->table";

            $filtrosArray = [];
            //Veo si me trajo filtros
            if(sizeof($filtro)>0 ){
                //Cada filtro lo debo agregar a el select
                $select = $select . " where ";
                foreach ($filtro as $key=>$valor) {
                    // var_dump($key,$valor);
                    if($key>0){
                        //agrego el AND para concatenar las condiciones
                        $select = $select . " and ";
                    }
                    $select = $select . $valor . " in (";

                    //agrego los valores
                    foreach($filtroValores[$key] as $k=>$v){
                        if($k>0){
                            //agrego la coma
                            $select = $select . ", ";
                        }
                        $select = $select . "?";
                        array_push($filtrosArray,$v); //sumo los valores que se van a parsear en un solo array
                    }
                    $select = $select . ")";
                }
            }
            // var_dump("voy a ejecutar el select");

            $stmt = $this->pdo->prepare($select);
            if(sizeof($filtro)>0 ){
                $stmt->execute($filtrosArray);
            } else {
                $stmt->execute();
            }

            // // recorriendo uno a uno
            // $result = [];
            // while ($row = $stmt->fetch()) {
            //     array_push($result, $row);
            // }

            // Trayendo todos juntos
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            //  return array([$select, $filtro, $filtrosArray]);
            return $result;

        } catch (PDOException $err) {
            throw $err;
        } catch (Error $err){
            throw $err;
        } catch (Exception $ex){
            throw $ex;
        }

    }

    // public function getById($id){

    //     try {
    //         $stmt = $this->pdo->prepare("select * from $this->table where id=?");
    //         $stmt->execute(array($id));
    //         $result = $stmt->fetch(PDO::FETCH_OBJ);
    //         return $result;
    //     } catch (PDOException $err) {
    //         throw $err;
    //     } catch (Error $err){
    //         throw $err;
    //     } catch (Exception $ex){
    //         throw $ex;
    //     }

    // }

    // public function delByPrim(){

    //     try {
    //         $stmt = $this->pdo->prepare("delete from $this->table where id=?");
    //         $stmt->execute(array($id));
    //         $result = $stmt.mysqli_fetch_all(PDO::FETCH_OBJ);
    //         print_r($result);
    //         return $result;
    //     } catch (PDOException $err) {
    //         throw $err;
    //     } catch (Error $err){
    //         throw $err;
    //     } catch (Exception $ex){
    //         throw $ex;
    //     }
    // }




    }



?>
