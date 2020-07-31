import React from "react";
import PropTypes from "prop-types";
import { Link } from "react-router-dom";
import Icon from "../../base/icon";
import { Tooltip } from "@material-ui/core";

const BtnEditar = ({ Texto = "Editar", Destino = "/" }) => {
  return (
    <Tooltip title={Texto}>
      <Link to={Destino}>
        <Icon Nombre="edit" />
      </Link>
    </Tooltip>
  );
};

BtnEditar.propTypes = {
  Texto: PropTypes.string,
  Destino: PropTypes.string.isRequired,
};

export default BtnEditar;
