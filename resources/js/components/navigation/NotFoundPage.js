import React from "react";
import { Link } from "react-router-dom";

const NotFoundPage = () => {
  return (
    <div>
      <h2>Página no encontrada</h2>
      <p>
        <Link to="/">Inicio</Link>
      </p>
    </div>
  );
};

export default NotFoundPage;
