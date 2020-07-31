import { handleResponse, handleError, login, getToken } from "./apiUtils";
// const baseUrl = process.env.REACT_APP_API_URL + "/grupos/";
const baseClass = "sendmail";
const baseUrl = "http://localhost:8000/api/" + baseClass;
let tokenName = "token";

export async function sendMail(to, subject, mensaje) {
  if (!sessionStorage.getItem(tokenName)) {
    // me voy a logonear forzadamente por ahora
    console.log("voy a forzar login");
    login();
  }

  let token = getToken();
  // console.log("El token es: ", token);
  if (!token || token.jwt) return false;

  let data = {};
  data.to = to;
  data.subject = subject;
  data.mensaje = mensaje;
  // let data = {
  //     "payload" : [
  //                     {
  //                         "model":"usuarios",
  //                         "filter": [
  //                             {"field":"id", "value":1}
  //                         ]
  //                     }
  //     ]
  // };
  let miInit = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Authorization: "Bearer " + token.jwt,
    },
    mode: "cors",
    cache: "no-cache",
    credentials: "same-origin",
    body: JSON.stringify(data),
  };

  // el saque el miInit ,
  // body : JSON.stringify(data)

  // console.log("buscando...", baseUrl, token.jwt);
  return fetch(baseUrl, miInit).then(handleResponse).catch(handleError);
}

export function getByPrim(idGrupo) {
  if (!sessionStorage.getItem(tokenName)) {
    // me voy a logonear forzadamente por ahora
    console.log("voy a forzar login");
    login();
  }

  let token = JSON.parse(sessionStorage.getItem(tokenName));
  // console.log("El token es: ", token);
  if (!token.jwt) return false;

  // let data = {
  //     "payload" : [
  //                     {
  //                         "model":"usuarios",
  //                         "filter": [
  //                             {"field":"id", "value":1}
  //                         ]
  //                     }
  //     ]
  // };
  let miInit = {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
      Authorization: "Bearer " + token.jwt,
    },
    mode: "cors",
    cache: "no-cache",
    credentials: "same-origin",
  };

  // el saque el miInit ,
  // body : JSON.stringify(data)

  // console.log("buscando...", baseUrl, token.jwt);

  return fetch(baseUrl + "/" + idGrupo, miInit)
    .then((response) => {
      if (!response.ok) throw new Error("Network response was not ok.");
      return response.json().then((grupos) => {
        if (grupos.length !== 1) throw new Error("Grupo not found: " + idGrupo);
        return grupos[0]; // should only find one course for a given slug, so return it.
      });
    })
    .catch(handleError);
}

export function guardar(grupo) {
  return fetch(baseUrl + (grupo.id || ""), {
    method: grupo.id ? "PUT" : "POST", // POST for create, PUT to update when id already exists.
    headers: { "content-type": "application/json" },
    body: JSON.stringify({
      ...grupo,
      // Parse authorId to a number (in case it was sent as a string).
      idCreador: 1,
    }),
  })
    .then(handleResponse)
    .catch(handleError);
}

export function eliminar(idGrupo) {
  return fetch(baseUrl + idGrupo, { method: "DELETE" })
    .then(handleResponse)
    .catch(handleError);
}
