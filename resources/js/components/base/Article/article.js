import React from "react";
import PropTypes from "prop-types";

const Article = ({ Clase = "w3-container", children }) => {
  return <article className={Clase}>{children}</article>;
};

Article.propTypes = {
  Clase: PropTypes.string,
};

export default Article;
