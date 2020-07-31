import React from "react";
import PropTypes from "prop-types";
// import { AddCircle, AccountCircle, ThreeDRotation } from '@material-ui/icons';
// revisar https://material.io/resources/icons/?style=round
// para ver los iconos
const Icon = ({ Nombre = "add" }) => {
  return <i className="material-icons">{Nombre}</i>;
};

Icon.propTypes = {
  Nombre: PropTypes.string.isRequired,
};

export default Icon;
