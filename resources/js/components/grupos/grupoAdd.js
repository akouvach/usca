import React, { useState, useEffect } from "react";
//import { Link } from "react-router-dom";
import Titulo1 from "../intermedio/titulos/titulo1";

import Texto from "../intermedio/texto";
import TextArea from "../intermedio/textarea";
import BtnEnviar from "../intermedio/botones/btnEnviar";
import Form from "../base/Form";
import { useUsuario } from "../../context/usuarioContext";

import { toast } from "react-toastify";
import * as gruposApi from "../../api/gruposApi";

const GrupoAdd = (props) => {
  const { usuario } = useUsuario();
  const [errors, setErrors] = useState({});
  const [grupo, setGrupo] = useState({
    grupo: "",
    descripcion: "",
    idCreador: usuario.id || 0,
    idOrganigrama: 0,
    tipo: "U",
    tags: "",
  });

  useEffect(() => {
    console.log("param.." + props.match.params.idGrupo);
    if (props.match.params.idGrupo) {
      //voy a buscar los datos de este grupo
      gruposApi.getByPrim(props.match.params.idGrupo).then((data) => {
        setGrupo(data);
        console.log(data);
      });
    }
  }, [props.match.params.idGrupo]);

  function formIsValid() {
    const _errors = {};
    console.log("validando...", grupo);
    if (!grupo.grupo) _errors.grupo = "Se requiere un nombre de grupo";
    if (!grupo.descripcion)
      _errors.descripcion = "Se requiere una descripción del grupo";
    if (!grupo.tags) _errors.tags = "Se requiere algun tag (separados por ;)";
    setErrors(_errors);

    return Object.keys(_errors).length === 0;
  }

  function handleChangeGrupo(evt) {
    const { target } = evt;
    // console.log(target.name, target.value);
    setGrupo({ ...grupo, [target.name]: target.value });
    // console.log(grupo);
  }

  function handleSubmit(evt) {
    evt.preventDefault();
    if (!formIsValid()) {
      return;
    }

    console.log("voy a guardar", grupo);

    try {
      gruposApi.guardar(grupo).then((data) => {
        console.log(data);
        if (data == 1) {
          toast.success("grupo grabado");
        } else {
          toast.error(data);
        }

        props.history.push("/grupos");
      });
    } catch (err) {
      console.log(err);
    }
  }

  return (
    <div className="w3-container">
      <Titulo1 Texto={"Grupos - " + grupo.id ? "Modificar" : "Agregar"} />

      <Form OnSubmit={handleSubmit} Id="grupoDetalle">
        <Texto
          Titulo=""
          Id="grupo"
          Valor={grupo.grupo}
          ValorSet={handleChangeGrupo}
          PlaceHolder="Nombre del grupo"
          Error={errors.grupo}
        />

        <Texto
          Titulo=""
          Id="descripcion"
          Valor={grupo.descripcion}
          ValorSet={handleChangeGrupo}
          PlaceHolder="Descripcion del grupo"
          Error={errors.descripcion}
        />

        <TextArea
          Titulo=""
          PlaceHolder="Tags asociados a este grupo.  Palabras claves asociadas al grupo (separadas por ;) "
          Id="tags"
          Valor={grupo.tags}
          ValorSet={handleChangeGrupo}
          Error={errors.tags}
        />

        <br />
        {grupo.idGrupo}
        <BtnEnviar
          FormId="grupoDetalle"
          Texto={grupo.id ? "Modificar" : "Agregar"}
        />
      </Form>
    </div>
  );
};

export default GrupoAdd;
