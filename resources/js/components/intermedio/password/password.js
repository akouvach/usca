import React from "react";

import InputText from "../../base/inputText";
import PropTypes from "prop-types";
import Icon from "../../base/icon";
import Mensaje from "../../base/Mensaje";

const Password = ({
  Titulo = "",
  Id = "password",
  PlaceHolder = "Introduzca su contraseña",
  Valor = "",
  ValorSet = (valor) => {
    console.log("falta agregar la función para asignación en password.");
  },
  Error = "",
}) => {
  return (
    <div>
      <div className="w3-row w3-section">
        <div className="w3-col" style={{ width: "50px" }}>
          <Icon Nombre="lock" />
        </div>
        <div className="w3-rest">
          <div className="w3-container">
            <InputText
              Clase="w3-input w3-border"
              Id={Id}
              Tipo="password"
              PlaceHolder={PlaceHolder}
              Valor={Valor}
              ValorSet={ValorSet}
            />
          </div>
        </div>
      </div>
      {Error && <Mensaje Texto={Error} />}
    </div>
  );
};

Password.propTypes = {
  Titulo: PropTypes.string,
  Id: PropTypes.any.isRequired,
  PlaceHolder: PropTypes.string,
  Valor: PropTypes.string.isRequired,
  ValorSet: PropTypes.func.isRequired,
  Error: PropTypes.string,
};

export default Password;
