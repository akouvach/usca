import React from "react";
import PropTypes from "prop-types";
import Label from "../../base/Label";
import InputText from "../../base/inputText";
import Mensaje from "../../base/Mensaje";

const Texto = ({
  Titulo = "Texto",
  Clase = "",
  Id = "texto",
  PlaceHolder = "introduzca su Texto",
  Valor = "",
  ValorSet = (valor) => {
    console.log("falta agregar la función para asignación texto.");
  },
  Error = "",
}) => {
  return (
    <div className="w3-container">
      {Titulo !== "" && <Label Texto={Titulo} htmlFor={Id} />}
      <InputText
        Id={Id}
        Clase={"w3-input " + Clase}
        Tipo="text"
        PlaceHolder={PlaceHolder}
        Valor={Valor}
        ValorSet={ValorSet}
      />
      {Error && <Mensaje Texto={Error} />}
    </div>
  );
};

Texto.propTypes = {
  Titulo: PropTypes.string.isRequired,
  Clase: PropTypes.string,
  Id: PropTypes.any.isRequired,
  PlaceHolder: PropTypes.string,
  Valor: PropTypes.string.isRequired,
  ValorSet: PropTypes.func,
  Error: PropTypes.string,
};

export default Texto;
