import { handleResponse, handleError, getToken } from "./apiUtils";
// const baseUrl = process.env.REACT_APP_API_URL + "/grupos/";
const baseClass = "blogs";
const baseUrl = "http://localhost:8000/api/" + baseClass;
// let tokenName = "token";

export async function getLast(idGrupo) {
  let token = getToken();
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

  // baseUrl += "/" + idGrupo;
  // console.log("buscando...", baseUrl + "/grupos/" + idGrupo, token.jwt);
  return fetch(baseUrl + "/grupos/" + idGrupo, miInit)
    .then(handleResponse)
    .catch(handleError);
}
