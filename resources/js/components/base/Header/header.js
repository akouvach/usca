import React from "react";
import PropTypes from "prop-types";

const Header = ({ Clase = "w3-container", children }) => {
  return <header className={Clase}>{children}</header>;
};

Header.propTypes = {
  Clase: PropTypes.string,
};

export default Header;
