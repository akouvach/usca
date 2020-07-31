import React from "react";
import PropTypes from "prop-types";

const BlogMensaje = ({ MensajePadre = 0 }) => {
  return <div>Agregar mensaje</div>;
};

BlogMensaje.propTypes = {
  MensajePadre: PropTypes.number.isRequired,
};

export default BlogMensaje;
