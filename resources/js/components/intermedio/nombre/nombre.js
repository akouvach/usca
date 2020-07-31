import React from "react";
import PropTypes from "prop-types";
import Texto from "../texto";
import Icon from "../../base/icon";
import Mensaje from "../../base/Mensaje";

const Nombre = ({
  Id = "texto",
  PlaceHolder = "Nombre",
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
          <Icon Nombre="face" />
        </div>
        <div className="w3-rest">
          <Texto
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

Nombre.propTypes = {
  Titulo: PropTypes.string,
  Id: PropTypes.any.isRequired,
  PlaceHolder: PropTypes.string,
  Valor: PropTypes.string.isRequired,
  ValorSet: PropTypes.func.isRequired,
  Error: PropTypes.string,
};

export default Nombre;
