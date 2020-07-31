import React from "react";
import PropTypes from "prop-types";
import Button from "../../base/Button";

const BtnEnviar = ({
  FormId = "",
  Clase = "w3-black w3-round-xxlarge",
  Texto = "Enviar",
  HandleSubmit = (valor) => {
    console.log(
      "falta agregar la función para hacerse cargo de la acci[on que realiza el bot[on]]."
    );
  },
}) => {
  return <Button Clase={Clase} Tipo="submit" Texto={Texto} FormId={FormId} />;
};

BtnEnviar.propTypes = {
  FormId: PropTypes.string,
  Texto: PropTypes.string,
  Clase: PropTypes.string,
  HandleSubmit: PropTypes.func,
};

export default BtnEnviar;
