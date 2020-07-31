import React from "react";
import PropTypes from "prop-types";
// import Button from "../../base/Button";
import { Link } from "react-router-dom";
import Icon from "../../base/icon";
import { Tooltip } from "@material-ui/core";

const BtnEliminar = ({
  Clase = "w3-btn",
  Texto = "Eliminar",
  Destino = null,
  HandleClick = () => {
    console.log("click no definido");
  },
}) => {
  if (!Destino) {
    return (
      <Tooltip title={Texto}>
        <Link to="#" onClick={HandleClick}>
          <Icon Nombre="delete" />
        </Link>
        {/* <Button Clase={Clase} Texto={Texto} OnClick={HandleClick}> */}
        {/* </Button> */}
      </Tooltip>
    );
  }
};

BtnEliminar.propTypes = {
  Texto: PropTypes.string,
  Clase: PropTypes.string,
  Destino: PropTypes.string,
  HandleClick: PropTypes.func,
};

export default BtnEliminar;
