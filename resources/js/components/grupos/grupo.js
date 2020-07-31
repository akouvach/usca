import React, { useState, useEffect } from "react";
import { useParams, Link } from "react-router-dom";

import * as gruposApi from "../../api/gruposApi";
import Blog from "../blogs/blog";
// import { useUsuario } from "../../context/usuarioContext";

// componentDidMount()
// componentDidUpdate()
// componentWillUnmount()

const Grupo = () => {
  // const [contador, contadorSet ] = useState(0);
  // const { usuario } = useUsuario();
  const [grupo, grupoSet] = useState({});
  //   const idGrupo = 21;

  let { idGrupo } = useParams();

  useEffect(() => {
    console.log("me ejecuté en el inicio del grupo");

    gruposApi.getByPrim(idGrupo).then((data) => {
      console.log("getByPrim", data);
      grupoSet(data);
    });

    return () => {
      console.log("estoy saliendo del grupo");
    };
  }, []);

  return (
    <div className="w3-container">
      <div className="w3-container w3-teal">
        <h2>
          <Link to="/grupos">Grupos</Link> / {grupo.grupo}
        </h2>
      </div>
      <div className="w3-container">
        <h3>Blog</h3>
        <Blog IdGrupo={idGrupo} />
      </div>
    </div>
  );
};

export default Grupo;
