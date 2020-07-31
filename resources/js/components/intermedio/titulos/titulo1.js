import React from "react";
import PropTypes from "prop-types";

import Label from "../../base/Label";

const Titulo1 = ({
  Texto = "completar",
  Clase = "w3-teal w3-padding w3-block",
  children,
}) => {
  return (
    <h1>
      <Label Clase={Clase} Texto={Texto} />
      {children}
    </h1>
  );
};

Titulo1.propTypes = {
  Texto: PropTypes.string.isRequired,
  Clase: PropTypes.string,
};

export default Titulo1;
