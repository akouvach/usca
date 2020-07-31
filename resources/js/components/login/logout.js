import React, { useState, useEffect } from "react";
// import { Link } from "react-router-dom";

import { useUsuario } from "../../context/usuarioContext";
import Loading from "../intermedio/loading";

const Logout = (props) => {
  const { logout } = useUsuario();
  const [isLogginOut, isLogginOutSet] = useState(false);

  useEffect(() => {
    isLogginOutSet(true);

    logout();

    isLogginOutSet(false);
    props.history.push("/");
  }, [logout, isLogginOut]);

  return <Loading isLoading={isLogginOut} Texto="Saliendo" />;
};

export default Logout;
