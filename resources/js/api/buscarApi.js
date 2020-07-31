import { handleResponse, handleError, getToken } from "./apiUtils";
// const baseUrl = process.env.REACT_APP_API_URL + "/grupos/";
const baseClass = "buscar";
const baseUrl = "http://localhost:8000/api/" + baseClass;
// let tokenName = "token";

export async function getGrupos(texto) {
  let token = getToken();
  // console.log("El token es: ", token);
  if (!token || !token.jwt) return false;

  let data = { parametros: { grupos: texto } };

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
  return fetch(baseUrl + "/grupos", miInit)
    .then(handleResponse)
    .catch(handleError);
}
