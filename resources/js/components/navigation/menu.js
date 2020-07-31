import { NavLink } from "react-router-dom";
import React from "react";
import { useUsuario } from "../../context/usuarioContext";
import Icon from "../base/icon";

import { Tooltip } from "@material-ui/core";
const activeStyle = { color: "red" };

const Menu = () => {
  return (
    <div className="w3-nav">
      <div className="w3-bar w3-light-grey w3-border">
        <div className="w3-row">
          <NavLink to="/" className="w3-bar-item w3-button w3-mobile">
            <button className="w3-button w3-wide w3-large"> eGroup </button>
          </NavLink>

          <Login />
          <Buscar />
          <MisGrupos />

          <Tooltip title="Contacto">
            <NavLink
              to="/contacto"
              activeStyle={activeStyle}
              className="w3-bar-item w3-button w3-mobile w3-right"
            >
              <Icon Nombre="email" />
            </NavLink>
          </Tooltip>
          {/* 
        {MenuPersonal}
        {MiCanasta}
        {Notificaciones}
        {MisGrupos} */}
        </div>
      </div>
    </div>
  );
};

const Buscar = () => {
  console.log("entre a Buscars");
  const { usuario } = useUsuario();

  if (usuario && usuario.nombre) {
    return (
      <Tooltip title="Buscar en el sitio">
        <NavLink
          to="/buscar"
          activeStyle={activeStyle}
          className="w3-bar-item w3-button w3-mobile w3-right"
        >
          <Icon Nombre="search" />
        </NavLink>
      </Tooltip>
    );
  } else {
    return <div></div>;
  }
};

const Login = () => {
  const { usuario } = useUsuario();
  console.log("usuario actual login:", usuario);

  if (usuario && usuario.nombre) {
    return (
      <div className=" w3-right">
        <div className="w3-container">
          <Tooltip
            title={
              usuario.nombre + ", " + usuario.apellido + " (Configuracion)"
            }
          >
            <NavLink
              className="w3-bar-item w3-button"
              activeStyle={activeStyle}
              to="/settings"
            >
              <Icon Nombre="settings" />
            </NavLink>
          </Tooltip>
          <Tooltip title="Salir">
            <NavLink
              className="w3-bar-item w3-button"
              activeStyle={activeStyle}
              to="/logout"
            >
              <Icon Nombre="exit_to_app" />
            </NavLink>
          </Tooltip>
        </div>
      </div>
    );
  } else {
    return (
      <div className="w3-right">
        <Tooltip title="Login/Registro">
          <NavLink
            to="/login"
            activeStyle={activeStyle}
            className="w3-bar-item w3-button w3-mobile w3-right"
          >
            <Icon Nombre="person" />
          </NavLink>
        </Tooltip>
      </div>
    );
  }
};

const MisGrupos = () => {
  console.log("entre a entre a mis grupos");
  const { usuario } = useUsuario();

  if (usuario && usuario.nombre) {
    return (
      <div className="w3-right">
        <Tooltip title="Mis grupos">
          <NavLink
            to="/grupos"
            activeStyle={activeStyle}
            className="w3-bar-item w3-button w3-mobile w3-right"
          >
            <Icon Nombre="groups" />
          </NavLink>
        </Tooltip>
      </div>
    );
  } else {
    return <div></div>;
  }
};

const MenuPersonal = () => {
  console.log("entre a mi menu especial");
  const { usuario } = useUsuario();

  if (usuario && usuario.nombre) {
    return (
      <div className="w3-dropdown-hover w3-right">
        <button className="w3-button"> Mi menu </button>{" "}
        <div className="w3-dropdown-content w3-bar-block w3-card-4">
          <NavLink
            className="w3-bar-item w3-button"
            activeStyle={activeStyle}
            to="/settings"
          >
            Configuracion
          </NavLink>
          <NavLink className="w3-bar-item w3-button" to="/logout">
            Salir
          </NavLink>
        </div>
      </div>
    );
  } else {
    return <div></div>;
  }
};

const MiCanasta = () => {
  console.log("entre a Mi Canasta");
  const { usuario } = useUsuario();

  if (usuario && usuario.nombre) {
    return (
      <div className="w3-dropdown-hover w3-right">
        <button className="w3-button"> Mi Canasta </button>{" "}
        <div className="w3-dropdown-content w3-bar-block w3-card-4">
          <NavLink
            className="w3-bar-item w3-button"
            activeStyle={activeStyle}
            to="/userSettings"
          >
            Configuracion
          </NavLink>
          <NavLink className="w3-bar-item w3-button" to="/avatar">
            Avatar
          </NavLink>
        </div>
      </div>
    );
  } else {
    return <div></div>;
  }
};

const Notificaciones = () => {
  console.log("entre a Notificaciones");
  const { usuario } = useUsuario();

  if (usuario && usuario.nombre) {
    return (
      <div className="w3-dropdown-hover w3-right">
        <button className="w3-button"> Notificaciones </button>{" "}
        <div className="w3-dropdown-content w3-bar-block w3-card-4">
          <NavLink
            className="w3-bar-item w3-button"
            activeStyle={activeStyle}
            to="/userSettings"
          >
            Configuracion
          </NavLink>
          <NavLink className="w3-bar-item w3-button" to="/avatar">
            Avatar
          </NavLink>
        </div>
      </div>
    );
  } else {
    return <div></div>;
  }
};

export default Menu;
