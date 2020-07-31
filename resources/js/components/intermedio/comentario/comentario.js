import React from "react";
import PropTypes from "prop-types";
import TextArea from "../textarea";
import Icon from "../../base/icon";
import Mensaje from "../../base/Mensaje";

const Comentario = ({
  Id = "comentario",
  PlaceHolder = "Comentario",
  Valor = "",
  ValorSet = (valor) => {
    console.log("falta agregar la función para asignación texto.");
  },
  Error = "",
}) => {
  return (
    <div>
      <div className="w3-row w3-section">
        <div className="w3-col" style={{ width: "50px" }}>
          <Icon Nombre="comment" />
        </div>
        <div className="w3-rest">
          <TextArea
            Rows="5"
            Cols="40"
            Titulo=""
            Clase="w3-border"
            Id={Id}
            PlaceHolder={PlaceHolder}
            Valor={Valor}
            ValorSet={ValorSet}
          />
        </div>
      </div>
      {Error && <Mensaje Texto={Error} />}
    </div>
  );
};

Comentario.propTypes = {
  Id: PropTypes.any.isRequired,
  PlaceHolder: PropTypes.string,
  Valor: PropTypes.string.isRequired,
  ValorSet: PropTypes.func,
  Error: PropTypes.string,
};

export default Comentario;
