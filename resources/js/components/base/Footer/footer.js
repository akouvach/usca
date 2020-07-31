import React from "react";
import PropTypes from "prop-types";

const Footer = ({ Clase = "w3-container", children }) => {
  return <footer className={Clase}>{children}</footer>;
};

Footer.propTypes = {
  Clase: PropTypes.string,
};

export default Footer;
