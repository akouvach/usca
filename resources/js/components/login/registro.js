import React, { Component, useState } from "react";
// import Residencia from "../intermedio/residencia";
import Texto from "../intermedio/texto";
import Email from "../intermedio/email";
import Nombre from "../intermedio/nombre";
import Apellido from "../intermedio/apellido";
import Titulo1 from "../intermedio/titulos/titulo1";
import Password from "../intermedio/password";
import BtnEnviar from "../intermedio/botones/btnEnviar";
import Form from "../base/Form";
import * as usuariosApi from "../../api/usuariosApi";
import Encrypt from "../generales/encrypt";
import { toast } from "react-toastify";

const Registro = (props)=>{

  const [user, userSet] = useState({
    nombre:"",usuario:"",apellido:"",email:"", pass:"", genero:"M",fecha_nac:"01-01-91-1970"
  },[])
  const [errors, errorsSet]=useState({})

function handleUpdateUser({target}){
userSet({ ...user, [target.name]: target.value });
console.log(user);
}



  function formIsValid() {
    const _errors = {};
    if (!user.email) _errors.email = "Se requiere un email";
    if (!user.pass) _errors.pass = "Se requiere una password";    
        if (!user.nombre) _errors.nombre = "Se requiere una nombre";
        if (!user.apellido) _errors.apellido = "Se requiere una apellido";        
        
        if (!user.usuario) _errors.usuario = "Se requiere una usuario";
    errorsSet(_errors);
    return Object.keys(_errors).length === 0;
  }


  function handleSubmit(evt) {
    evt.preventDefault();
    if (!formIsValid()) {
      return;
    }

console.log(user);

    let hash = Encrypt.hash(user.pass, { salt: user.email });
    console.log("passsord:", user.pass, "Hash: ", hash);

let _user = { ...user, pass: hash}
    // userSet(_user);

    usuariosApi.registrar(_user).then((data) => {
      console.log("recibido del login:", data);
      if (data==1) {
                toast.success("Registro correcto");
        props.history.push("/");
      } else {
        console.log("error", data);
        toast.error("Registro incorrecto." + data.payload);
      }

    });

  }



    return (

<div className="w3-container">
      <Titulo1 Texto="Registro" />
        <Form Id="formRegistro" OnSubmit={handleSubmit}>

             <Nombre
          Id="usuario"
          Valor={user.usuario}
          ValorSet={handleUpdateUser}
          Error={errors.usuario}
          PlaceHolder="Ingrese su codigo de usuario"
        />

        <Nombre
          Id="nombre"
          Valor={user.nombre}
          ValorSet={handleUpdateUser}
          Error={errors.nombre}
        />

        <Apellido
          Id="apellido"
          Valor={user.apellido}
          ValorSet={handleUpdateUser}
          Error={errors.apellido}
        />

        <Email
          Id="email"
          Valor={user.email}
          ValorSet={handleUpdateUser}
          Error={errors.email}
          />
          
        
        <Password
          Titulo="Contraseña"
          Id="pass"
          PlaceHolder="Ingrese su contraseña"
          Valor={user.pass}
          ValorSet={handleUpdateUser}
          Error={errors.pass}
          />
          


        <BtnEnviar FormId="formRegistro" Texto="Registrese" />
      </Form>


      </div>
      
    );

}

export default Registro;
