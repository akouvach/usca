import React from "react";
import PropTypes from "prop-types";

const Button = ({
  Clase = "w3-padding-small w3-blue w3-block",
  Texto = "Enviar",
  Habilitado = true,
  Tipo = "button",
  FormId = "falta el form id",
  OnClick = () => console.log("click no definido"),
}) => {
  return (
    <div className="w3-container">
      <button
        type={Tipo}
        className={"w3-button " + Clase}
        disabled={!Habilitado}
        onClick={OnClick}
        form={FormId}
      >
        {Texto}
      </button>
    </div>
  );
};

Button.propTypes = {
  Clase: PropTypes.string,
  Texto: PropTypes.string.isRequired,
  Habilitado: PropTypes.bool,
  Tipo: PropTypes.string,
  OnClick: PropTypes.func,
  FormId: PropTypes.string,
};

export default Button;
