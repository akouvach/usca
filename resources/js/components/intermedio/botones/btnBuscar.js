import React from "react";
import PropTypes from "prop-types";
import Button from "../../base/Button";
import { Link } from "react-router-dom";

const BtnBuscar = ({
  Clase = "w3-button w3-round w3-black ",
  Texto = "Buscar",
  Destino = "",
  OnClick = () => {
    console.log("On click no definido para el boton buscar");
  },
}) => {
  return (
    <Link to={Destino == "" ? "#" : Destino}>
      <Button Clase={Clase} Texto={Texto} OnClick={OnClick} />
    </Link>
  );
};

BtnBuscar.propTypes = {
  Texto: PropTypes.string,
  Clase: PropTypes.string,
  Destino: PropTypes.string.isRequired,
  OnClick: PropTypes.func,
};

export default BtnBuscar;
