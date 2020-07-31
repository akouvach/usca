<?php

require_once "gruposControlador_base.php"; 
require_once "organigramasController.php"; 
require_once "usuarios_GruposController.php";

class GruposController extends GruposController_base {

    public function create($descripcion,$grupo,$idCreador,$idOrganigrama,$tipo,$tags){
        
        try {
            $org = new OrganigramasController($this->pdo);
            $usrGrupos = new Usuarios_gruposController($this->pdo);

            if(!$this->beginTrans()){
                throw new Exception("fallo al iniciar la transaccion");
            };

            $org->create("Principal",null);
            // var_dump("organigrama",$descripcion,$grupo,$idCreador,$org->model->id,$tipo,$tags);

            $res = parent::create($descripcion,$grupo,$idCreador,$org->model->id,$tipo,$tags);

            // var_dump("id grupo",$this->model->id);

            $usrGrupos->create($this->model->id, $this->model->idCreador,'S',date("Y-m-d")); 

            // var_dump($usrGrupos->model);

            if(!$this->commitTrans()){
                throw new Exception("Fallo al confirmar la transaccion");
            }
                
            return $res;
        } catch (Exception $ex){
            $this->rollbackTrans();
			throw $ex;
		}
        
	}

    public function getMisGrupos(){
        
        try {
            // var_dump($this->usuarioConectado->id);
            return $this->model->getMisGrupos($this->usuarioConectado->id);
        } catch (Exception $ex){
            throw new Exception($ex->getMessage());
        }
        
    }
    
    
    public function buscarGrupos($texto){
        
        try {
            // var_dump($this->usuarioConectado->id);
            return $this->model->buscarGrupos($this->usuarioConectado->id, $texto);
        } catch (Exception $ex){
            throw new Exception($ex->getMessage());
        }
        
	}


}

?>
