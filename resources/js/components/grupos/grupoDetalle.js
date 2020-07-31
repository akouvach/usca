import React from "react";
import Texto from "../intermedio/texto";
import TextArea from "../intermedio/textarea";
import BtnEnviar from "../intermedio/botones/btnEnviar";
import Form from "../base/Form";
import PropTypes from "prop-types";

const GrupoDetalle = ({
  grupo = {},
  errors = {},
  onSubmit = () => {
    console.log("falta definir funcion de submit");
  },
  grupoHandler = () => {
    console.log("falta definir funcion de hander para cambios de grupo");
  },
}) => {
  //console.log("error", props.errors);
  return (
    <Form OnSubmit={onSubmit} Id="grupoDetalle">
      <Texto
        Titulo="Nombre"
        Id="grupo"
        Valor={grupo.grupo}
        ValorSet={grupoHandler}
        Error={errors.grupo}
      />

      <Texto
        Titulo="Descripcion"
        Id="descripcion"
        Valor={grupo.descripcion}
        ValorSet={grupoHandler}
        Error={errors.descripcion}
      />

      <TextArea
        Titulo="Tags"
        Cols={40}
        Rows={3}
        Id="Tags"
        Valor={grupo.tags}
        ValorSet={grupoHandler}
        Error={errors.tags}
      />

      <br />
      <BtnEnviar FormId="grupoDetalle" Texto="Agregar grupo" />
    </Form>
  );
};

GrupoDetalle.propTypes = {
  grupo: PropTypes.object.isRequired,
  errors: PropTypes.object.isRequired,
  onSubmit: PropTypes.func.isRequired,
  grupoHandler: PropTypes.func.isRequired,
};

export default GrupoDetalle;
