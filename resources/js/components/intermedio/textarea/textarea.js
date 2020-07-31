import React from "react";
import PropTypes from "prop-types";
import Label from "../../base/Label";
import TextAreaBase from "../../base/TextAreaBase";
import Mensaje from "../../base/Mensaje";

const TextArea = ({
  Titulo = "Texto",
  Rows = 2,
  Cols = 50,
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
      <TextAreaBase
        Id={Id}
        Cols={Cols}
        Rows={Rows}
        Clase={Clase}
        PlaceHolder={PlaceHolder}
        Valor={Valor}
        ValorSet={ValorSet}
      />
      {Error && <Mensaje Texto={Error} />}
    </div>
  );
};

TextArea.propTypes = {
  Titulo: PropTypes.string,
  Id: PropTypes.any.isRequired,
  Cols: PropTypes.number,
  Rows: PropTypes.number,
  Clase: PropTypes.string,
  PlaceHolder: PropTypes.string,
  Valor: PropTypes.string.isRequired,
  ValorSet: PropTypes.func.isRequired,
  Error: PropTypes.string,
};

export default TextArea;
