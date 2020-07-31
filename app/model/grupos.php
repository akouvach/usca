<?php

require_once "grupos_base.php";

class Grupos extends Grupos_base {


    public function getMisGrupos($idUsuario){

        
        try {

            //var_dump($filtro, $filtroValores);
            $select = "SELECT * FROM (SELECT idGrupo FROM usuarios_grupos WHERE idUsuario=? and activo='S') g INNER JOIN grupos ON (grupos.id = g.idgrupo)";
            $filtrosArray = [$idUsuario];
            $stmt = $this->pdo->prepare($select);
            $stmt->execute($filtrosArray);


            // // recorriendo uno a uno
            // $result = [];
            // while ($row = $stmt->fetch()) {
            //     array_push($result, $row);
            // }

            // Trayendo todos juntos
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            //  return array([$select, $filtro, $filtrosArray]);
            $stmt->closeCursor();
            return $result;

        } catch (PDOException $err) {
            throw $err;
        } catch (Error $err){
            throw $err;
        } catch (Exception $ex){
            throw $ex;
        }


    }

    
    public function buscarGrupos($idUsuario,$texto){

        
        try {

            $filtrosArray = [];
            $palabras = explode(";",$texto);
            // var_dump($palabras);
            
            $select = "SELECT * FROM grupos WHERE 1=2 ";
            foreach ($palabras as $valor){
                $select .= "union ";
                $select .= "SELECT * FROM grupos WHERE  ";
                $select .= "descripcion LIKE CONCAT('%',?,'%') ";
                $select .= "OR grupo LIKE CONCAT('%',?,'%') ";
                $select .= "OR tags LIKE CONCAT('%',?,'%') ";

                array_push($filtrosArray,$valor);
                array_push($filtrosArray,$valor);
                array_push($filtrosArray,$valor);
                
            } 


     
 

            // var_dump($select);
            
            
            $stmt = $this->pdo->prepare($select);
            $stmt->execute($filtrosArray);


            // // recorriendo uno a uno
            // $result = [];
            // while ($row = $stmt->fetch()) {
            //     array_push($result, $row);
            // }

            // Trayendo todos juntos
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            //  return array([$select, $filtro, $filtrosArray]);
            $stmt->closeCursor();
            return $result;

        } catch (PDOException $err) {
            throw $err;
        } catch (Error $err){
            throw $err;
        } catch (Exception $ex){
            throw $ex;
        }


    }

}



?>
