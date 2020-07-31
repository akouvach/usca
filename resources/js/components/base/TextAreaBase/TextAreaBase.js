import React from "react";
import PropTypes from "prop-types";

const TextAreaBase = ({
  Id = "",
  PlaceHolder = "Introduzca su texto",
  Rows = 2,
  Cols = 50,
  Clase = "w3-input",
  Valor = "",
  ValorSet = () => {
    console.log("falta definir funcion set de input text");
  },
}) => {
  return (
    <textarea
      rows={Rows}
      cols={Cols}
      id={Id}
      name={Id}
      className={"w3-input " + Clase}
      placeholder={PlaceHolder}
      onChange={ValorSet}
      value={Valor}
    />
  );
};

TextAreaBase.propTypes = {
  Cols: PropTypes.number,
  Rows: PropTypes.number,
  Id: PropTypes.any.isRequired,
  PlaceHolder: PropTypes.string,
  Clase: PropTypes.string,
  Valor: PropTypes.any.isRequired,
  ValorSet: PropTypes.func.isRequired,
};

export default TextAreaBase;
