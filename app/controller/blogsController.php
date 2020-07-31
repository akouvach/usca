<?php

require_once "blogsControlador_base.php"; 


class BlogsController extends BlogsController_base {

    public function getByGrupo( $idGrupo){

        // var_dump("Get by grupo",$idGrupo);
		$this->model->idGrupo= $idGrupo;
		return $this->model->getAll(['idGrupo'],[[$idGrupo]]);
	}
   
}

?>
