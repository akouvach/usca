<?php

require_once "usuariosControlador_base.php";


class UsuariosController extends UsuariosController_base {


  public function getCredentials($email, $password){
      return $this->model->getCredentials($email, $password);
  }

}
?>
