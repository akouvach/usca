import React from "react";
import InputText from "../../base/inputText";
import PropTypes from "prop-types";
import Icon from "../../base/icon";
import Mensaje from "../../base/Mensaje";

const Email = ({
  Id = "email",
  PlaceHolder = "Email",
  Valor = "",
  ValorSet = () =>
    console.log("falta agregar la función para asignación en email."),
  Error = "",
}) => {
  return (
    <div>
      <div className="w3-row w3-section">
        <div className="w3-col" style={{ width: "50px" }}>
          <Icon Nombre="email" />
        </div>
        <div className="w3-rest">
          <div className="w3-container">
            <InputText
              Clase="w3-input w3-border"
              Id={Id}
              Tipo="email"
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

Email.propTypes = {
  Id: PropTypes.any.isRequired,
  PlaceHolder: PropTypes.string,
  Valor: PropTypes.string.isRequired,
  ValorSet: PropTypes.func,
  Error: PropTypes.string,
};

export default Email;
