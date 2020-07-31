import React from "react";
import PropTypes from "prop-types";

const Msg = ({ Texto = "completar", Clase = "w3-left-align" }) => {
  return <div className={Clase}> {Texto} </div>;
};

Msg.propTypes = {
  Texto: PropTypes.string.isRequired,
  Clase: PropTypes.string,
};

export default Msg;
