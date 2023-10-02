import axios from "axios";
import { showLoader, hideLoader } from "@/partials/loader";

const ax = axios.create({
  baseURL: process.env.API
});

/**
 * Obtiene informacion basica sobre el usuario que ha iniciado sesion
*/
export async function getUserData() {
  try {
    showLoader();

    const { data } =  await ax
      .get("/auth/basic")
      .finally(hideLoader);

    return data;
  } catch(e) {
    console.error(e);
  }
}

/**
 * @param { object } dt Informacion del formulario.
*/
export async function updateUser( dt ) {
  let res = null;
  let error = null;

  try {
    showLoader();
    const { data } = await ax.put("/auth/update-basic", dt);
    res = data;
  } catch(e) {
    error = e;
  } finally {
    hideLoader();
    return [ res, error ];
  }
}

/**
 * @param { object } dt Informacion del formulario.
*/
export async function updatePassword( state ) {
  let res = null;
  let error = null;

  try {
    showLoader();
    const { data } = await ax.put("/auth/password-update", state);

    res = data;
  } catch(e) {
    error = e;
  } finally {
    hideLoader();
    return [ res, error ]
  }
}
