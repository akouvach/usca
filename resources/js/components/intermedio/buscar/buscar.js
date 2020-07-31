import React from "react";
import PropTypes from "prop-types";
import Texto from "../texto";
import BtnBuscar from "../botones/btnBuscar";
import Mensaje from "../../base/Mensaje";

const Buscar = ({
  Id = "texto",
  PlaceHolder = "Texto a buscar",
  Valor = "",
  ValorSet = (valor) => {
    console.log("falta agregar la función para asignación texto.");
  },
  Error = "",
  OnClick = () => {
    console.log("no definio un elemento on click");
  },
}) => {
  return (
    <div>
      <div className="w3-row w3-section">
        <div className="w3-threequarter">
          <Texto
            Titulo=""
            Clase="w3-border"
            Id={Id}
            PlaceHolder={PlaceHolder}
            Valor={Valor}
            ValorSet={ValorSet}
          />
        </div>
        <div className="w3-rest">
          <BtnBuscar OnClick={OnClick} />
        </div>
      </div>
      {Error && <Mensaje Texto={Error} />}
    </div>
  );
};

Buscar.propTypes = {
  Titulo: PropTypes.string,
  Id: PropTypes.any.isRequired,
  PlaceHolder: PropTypes.string,
  Valor: PropTypes.string.isRequired,
  ValorSet: PropTypes.func.isRequired,
  Error: PropTypes.string,
  OnClick: PropTypes.func,
};

export default Buscar;
