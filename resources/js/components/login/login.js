import React, { useState } from "react";
import { Link } from "react-router-dom";
import Email from "../intermedio/email";
import Password from "../intermedio/password";
import Titulo1 from "../intermedio/titulos/titulo1";
import BtnEnviar from "../intermedio/botones/btnEnviar";
import Form from "../../components/base/Form";
// import Usuario from '../usuario/usuario';
import Encrypt from "../generales/encrypt";
import * as usuariosApi from "../../api/usuariosApi";
import { useUsuario } from "../../context/usuarioContext";
import { toast } from "react-toastify";

const Login = (props) => {
  const [errors, errorsSet] = useState({});
  const [login, loginSet] = useState({});
  const { setUsuario } = useUsuario();

  // const verificarContrasenia = (ev) => {
  //   ev.preventDefault();
  //   console.log(
  //     "verificando contrasenia",
  //     this.state.email,
  //     this.state.password
  //   );
  //   //console.log("datos del usuario ", Usuario.get());
  //   let hash = Encrypt.hash(this.state.password, {salt:});
  //   console.log("passsord:", this.state.password, "Hash: ", hash);
  //   setTimeout(() => {
  //     console.log("Comparacion: ", Encrypt.compare(this.state.password, hash));
  //   }, 5 * 1000);
  // };

  function formIsValid() {
    const _errors = {};
    if (!login.email) _errors.email = "Se requiere un email";
    if (!login.pass) _errors.pass = "Se requiere una password";
    errorsSet(_errors);
    return Object.keys(_errors).length === 0;
  }

  function handleChangeLogin(evt) {
    const { target } = evt;
    // console.log(target.name, target.value);
    loginSet({ ...login, [target.name]: target.value });
  }

  function handleSubmit(evt) {
    evt.preventDefault();
    if (!formIsValid()) {
      return;
    }

    let hash = Encrypt.hash(login.pass, { salt: login.email });
    console.log("passsord:", login.pass, "Hash: ", hash);

    usuariosApi.usuarioLogin(login.email, hash).then((data) => {
      console.log("recibido del login:", data);
      if (data.rta) {
        let _usuario = {};
        _usuario.nombre = data.payload.nombre;
        _usuario.apellido = data.payload.apellido;
        _usuario.id = data.payload.id;
        _usuario.email = data.payload.email;
        _usuario.jwt = data.jwt;
        setUsuario(_usuario);
        toast.success("login correcto");
        props.history.push("/");
      } else {
        console.log("error", data);
        toast.error("login incorrecto");
      }

      // console.log(data.rta, data.payload.pass);
      // if (data.rta && Encrypt.compare(login.pass, data.payload.password)) {
      //   //login correcto
      // }
    });
    // setTimeout(() => {
    //   console.log("Comparacion: ", Encrypt.compare(this.state.password, hash));
    // }, 5 * 1000);

    // gruposApi.guardar(grupo).then(() => {
    //   toast.success("grupo grabado");
    //   props.history.push("/grupos");
    // });
  }

  return (
    <div className="w3-container">
      <Titulo1 Texto="Login" />
      <Form Id="formLogin" OnSubmit={handleSubmit}>
        <Email
          Titulo="Email"
          Id="email"
          PlaceHolder="Ingrese su correo"
          Valor={login.email}
          ValorSet={handleChangeLogin}
          Error={errors.email}
        />
 
        <Password
          Titulo="Contraseña"
          Id="pass"
          PlaceHolder="Ingrese su contraseña"
          Valor={login.pass}
          ValorSet={handleChangeLogin}
          Error={errors.pass}
        />

        <BtnEnviar FormId="formLogin" Texto="Login" />
      </Form>

      <div className="w3-row w3-padding">
        ¿No se encuentra registrado? <Link to="/registro">Regístrese</Link>.
      </div>
    </div>
  );
};

export default Login;
