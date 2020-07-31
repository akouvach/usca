import React from "react";
import PropTypes from "prop-types";

const Label = ({
  HtmlFor = "",
  Texto = "completar",
  Clase = "w3-left-align",
}) => {
  return (
    <label htmlFor={HtmlFor} className={Clase}>
      {" "}
      {Texto}{" "}
    </label>
  );
};

Label.propTypes = {
  HtmlFor: PropTypes.string,
  Texto: PropTypes.string.isRequired,
  Clase: PropTypes.string,
};

export default Label;
