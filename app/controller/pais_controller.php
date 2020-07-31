<?php

require_once "../model/pais.php";

class PaisController {
  
  private $model;

  public function __construct(){
      $this->model = new Pais();
  }


  public function getAll(){
      return $this->model->getAll();
  }

  public function getById($id){
      return $this->model->getById($id);
  }

}
?>
