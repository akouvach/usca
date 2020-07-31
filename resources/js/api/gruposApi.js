import { handleResponse, handleError, getToken } from "./apiUtils";
// const baseUrl = process.env.REACT_APP_API_URL + "/grupos/";
const baseClass = "grupos";
const baseUrl = "http://localhost:8000/api/" + baseClass;
// let tokenName = "token";

export async function getAll() {
  let token = getToken();
  // console.log("El token es: ", token);
  if (!token || !token.jwt) return false;

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
  return fetch(baseUrl, miInit).then(handleResponse).catch(handleError);
}

export async function getMyGroups() {
  let token = getToken();
  // console.log("El token es: ", token);
  if (!token || !token.jwt) return false;

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
  return fetch(baseUrl + "/misgrupos", miInit)
    .then(handleResponse)
    .catch(handleError);
}

export function getByPrim(idGrupo) {
  let token = getToken();
  // console.log("El token es: ", token);
  if (!token || !token.jwt) return false;

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

  console.log("buscando...", baseUrl + "/" + idGrupo, token.jwt);

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
  let token = getToken();
  // console.log("El token es: ", token);
  if (!token || !token.jwt) return { rta: false };

  let miInit = {
    method: grupo.id ? "PUT" : "POST",
    headers: {
      "Content-Type": "application/json",
      Authorization: "Bearer " + token.jwt,
    },
    mode: "cors",
    cache: "no-cache",
    credentials: "same-origin",
    body: JSON.stringify(grupo),
  };

  return fetch(baseUrl, miInit).then(handleResponse).catch(handleError);
}

export function delByPrim(idGrupo) {
  let token = getToken();
  // console.log("El token es: ", token);
  if (!token || !token.jwt) return false;

  let miInit = {
    method: "DELETE",
    headers: {
      "Content-Type": "application/json",
      Authorization: "Bearer " + token.jwt,
    },
    mode: "cors",
    cache: "no-cache",
    credentials: "same-origin",
  };

  return fetch(baseUrl + "/" + idGrupo, miInit)
    .then(handleResponse)
    .catch(handleError);
}
