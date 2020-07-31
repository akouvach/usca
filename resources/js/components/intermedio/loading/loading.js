import React from "react";
import PropTypes from "prop-types";
import Label from "../../base/Label";

const Loading = ({ isLoading = false, Texto = "Cargando" }) => {
  return (
    <div className="w3-container">
      {isLoading && <Label Texto={Texto + "..."} />}
    </div>
  );
};

Loading.propTypes = {
  isLoading: PropTypes.bool.isRequired,
  Texto: PropTypes.string,
};

export default Loading;
