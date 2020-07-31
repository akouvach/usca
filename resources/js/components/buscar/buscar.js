import React, { useState, useEffect } from "react";
import BuscarTexto from "../intermedio/buscar";
import * as buscarApi from "../../api/buscarApi";
import Loading from "../intermedio/loading";
import Titulo1 from "../intermedio/titulos/titulo1";

const Buscar = (props) => {
  const [buscar, buscarSet] = useState("");
  const [grupos, gruposSet] = useState([]);
  const [errors, setErrors] = useState({});
  const [isLoading, isLoadingSet] = useState(false);

  useEffect(() => {
    return () => {
      console.log("estoy saliendo de contacto");
    };
  }, []);

  function handleUpdateBuscar({ target }) {
    buscarSet(target.value);
  }

  function formIsValid() {
    const _errors = {};
    if (!buscar) _errors.texto = "Se requiere un texto";

    setErrors(_errors);

    return Object.keys(_errors).length === 0;
  }

  function Buscar(evt) {
    evt.preventDefault();
    if (!formIsValid()) {
      return;
    }
    console.log("voy a buscar", buscar);

    //  setIsLoading(true);
    buscarApi.getGrupos(buscar).then((data) => {
      if (data.rta) {
        console.log(data.payload);
        gruposSet(data.payload);
      }
      // setIsLoading(false);
    });
  }

  return (
    <div className="w3-container">
      <Titulo1 Texto="Buscar" />

      <BuscarTexto
        Id="texto"
        Valor={buscar}
        ValorSet={handleUpdateBuscar}
        Error={errors.texto}
        OnClick={Buscar}
      />

      <div class="w3-responsive">
        <Loading isLoading={isLoading} />
        <table class="w3-table-all">
          <tr>
            <th>Grupo</th>
            <th>Descripcion</th>
            <th>Tags</th>
          </tr>

          {grupos.map((item) => {
            return (
              <tr>
                <td> {item.grupo} </td>
                <td> {item.descripcion} </td>
                <td> {item.tags} </td>
              </tr>
            );
          })}
        </table>
      </div>
    </div>
  );
};

export default Buscar;
