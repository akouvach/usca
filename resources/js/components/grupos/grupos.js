import React, { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import * as gruposApi from "../../api/gruposApi";
// import BtnAgregar from "../intermedio/botones/btnAgregar";
import BtnEditar from "../intermedio/botones/btnEditar";
import BtnEliminar from "../intermedio/botones/btnEliminar";
import Header from "../base/Header";
import Footer from "../base/Footer";
import { toast } from "react-toastify";
import Loading from "../intermedio/loading";
import Titulo1 from "../intermedio/titulos/titulo1";
import Icon from "../base/icon";
import { Tooltip } from "@material-ui/core";
import { useUsuario } from "../../context/usuarioContext";
// componentDidMount()
// componentDidUpdate()
// componentWillUnmount()

const Grupos = (props) => {
  const [grupos, gruposSet] = useState([]);
  const [isLoading, setIsLoading] = useState(false);
  const { usuario } = useUsuario();

  useEffect(() => {
    setIsLoading(true);
    gruposApi.getMyGroups().then((data) => {
      gruposSet(data);
      setIsLoading(false);
    });
    console.log("usuarioactual", usuario);

    return () => {
      console.log("estoy saliendo");
    };
  }, []);

  function eliminarGrupo(idGrupo) {
    gruposApi.delByPrim(idGrupo).then((data) => {
      console.log(data);
      if (!isNaN(data)) {
        if (data === 1) {
          toast.success("grupo eliminado");
          gruposSet(grupos.filter((grupo) => grupo.id !== idGrupo));
          // props.history.push("/grupos");
        }
      } else {
        if (data && !data.rta) {
          console.log(data.payload);
        }
        toast.error("No se pudo eliminar ");
      }
    });
  }

  return (
    <div className="w3-container">
      <Titulo1 Texto="Grupos">
        <Tooltip title="Agrgar grupo">
          <Link to="/grupos/add">
            <Icon Nombre="group_add" />
          </Link>
        </Tooltip>
      </Titulo1>

      <div className="w3-container">
        <Loading isLoading={isLoading} />
        {grupos.map((item, index) => {
          return (
            <div
              className="w3-container w3-card-4 w3-half w3-padding"
              key={item.id}
            >
              <Header Clase="w3-container w3-blue ">
                <h1>
                  <Link to={"/grupo/" + item.id}>{item.grupo}</Link>
                </h1>
                {item.idCreador === usuario.id && (
                  <div>
                    <BtnEditar Destino={"/grupo/edit/" + item.id} />
                    <BtnEliminar HandleClick={() => eliminarGrupo(item.id)} />
                  </div>
                )}
              </Header>

              <div className="w3-container">
                <p>{item.descripcion}</p>
              </div>

              <Footer Clase="w3-container w3-blue">
                <h5>{item.tags}</h5>
              </Footer>
            </div>
          );
        })}
      </div>
    </div>
  );
};

export default Grupos;
