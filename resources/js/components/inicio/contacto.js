import React, { useState, useEffect } from "react";
import Nombre from "../intermedio/nombre";
import Apellido from "../intermedio/apellido";
import Email from "../intermedio/email";
import Comentario from "../intermedio/comentario";
import BtnEnviar from "../intermedio/botones/btnEnviar";
import Form from "../base/Form";
import { toast } from "react-toastify";
import { sendMail } from "../../api/mailApi";
import Titulo1 from "../intermedio/titulos/titulo1";

const Contacto = (props) => {
  const [contacto, contactoSet] = useState({
    nombre: "",
    apellido: "",
    email: "",
    comentarios: "",
  });
  const [errors, setErrors] = useState({});

  useEffect(() => {
    return () => {
      console.log("estoy saliendo de contacto");
    };
  }, []);

  function handleUpdateContacto(evt) {
    const { target } = evt;
    contactoSet({ ...contacto, [target.name]: target.value });
    // console.log(contacto);
  }

  function formIsValid() {
    const _errors = {};
    if (!contacto.nombre) _errors.nombre = "Se requiere un nombre";
    if (!contacto.apellido) _errors.apellido = "Se requiere un apellido";
    if (!contacto.email) _errors.email = "Se requiere un email";
    if (!contacto.comentarios)
      _errors.comentarios = "Se requiere un comentario";

    setErrors(_errors);

    return Object.keys(_errors).length === 0;
  }

  function EnviarMail(evt) {
    evt.preventDefault();
    if (!formIsValid()) {
      return;
    }
    console.log("voy a guardar", contacto);

    sendMail(
      "akpruebas@gmail.com",
      "Contacto",
      "<p>Mensaje de:" +
        contacto.nombre +
        " " +
        contacto.apellido +
        "(" +
        contacto.email +
        ")</h1>" +
        "<p>" +
        contacto.comentarios +
        "</p>"
    );

    // gruposApi.guardar(grupo);
    toast.success("Email enviado");
    props.history.push("/");
  }

  return (
    <div className="w3-container">
      <Titulo1 Texto="Contacto" />

      <Form Id="miFormContacto" OnSubmit={EnviarMail}>
        <Nombre
          Id="nombre"
          Valor={contacto.nombre}
          ValorSet={handleUpdateContacto}
          Error={errors.nombre}
        />

        <Apellido
          Id="apellido"
          Valor={contacto.apellido}
          ValorSet={handleUpdateContacto}
          Error={errors.apellido}
        />

        <Email
          Id="email"
          Valor={contacto.email}
          ValorSet={handleUpdateContacto}
          Error={errors.email}
        />

        <Comentario
          Id="comentarios"
          Valor={contacto.comentarios}
          ValorSet={handleUpdateContacto}
          Error={errors.comentarios}
        />

        <BtnEnviar Texto="Enviar mensaje" FormId="miFormContacto" />
      </Form>
    </div>
  );
};

export default Contacto;
