import React, { useEffect, useState, useMemo } from "react";
import { getToken, logout, login } from "../api/apiUtils";

const UsuarioContext = React.createContext();

export function UsuarioProvider(props) {
  const [usuario, usuarioSet] = useState(null);
  const [cargandoUsuario, cargandoUsuarioSet] = useState(false);

  useEffect(() => {
    async function cargarUsuario() {
      // console.log("cargando token");
      try {
        let token = getToken();
        if (token) {
          //cargo los datos del usuario
          // console.log("recupere los datos de la sesion", token);
          usuarioSet(token);
          return true;
        }
      } catch (err) {
        console.log(err);
        return false;
      }
    }

    cargarUsuario();
  }, []);

  async function loginUser(email, password) {
    cargandoUsuarioSet(true);
    const { data } = await login(email, password);
    console.log(data);
    cargandoUsuarioSet(false);
  }

  function logoutUser() {
    usuarioSet(null);
    console.log("loggin out", logout());
  }

  const value = useMemo(() => {
    if (!usuario) {
      console.log("no hay usuario");
    }
    return {
      usuario,
      cargandoUsuario,
      setUsuario: (_usuario) => {
        usuarioSet(_usuario);
      },
      logout: () => {
        logoutUser();
      },
      login: (email, password) => {
        loginUser(email, password);
      },
    };
  }, [usuario, cargandoUsuario]);

  return <UsuarioContext.Provider value={value} {...props} />;
}

export function useUsuario() {
  const context = React.useContext(UsuarioContext);
  if (!context) {
    throw new Error(
      "useUsuario debe estar dentro del proveedor UsuarioContext"
    );
  }
  return context;
}
