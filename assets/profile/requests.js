import axios from "axios";
import { showLoader, hideLoader } from "@/partials/loader";
import { removeInvalid, setInvalid } from "@/partials/form-validation";

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
  showLoader();
  removeInvalid();

  const { data } = await ax
    .put("/auth/update-basic", dt)
    .catch(e => setInvalid(e.response?.data?.fields || []))
    .finally(hideLoader);

  return data;
}

/**
 * @param { object } dt Informacion del formulario.
*/
export async function updatePassword( state ) {
  try {
    showLoader();
    removeInvalid();

    const { data } = await ax
      .put("/auth/password-update", state)
      .finally(hideLoader);

    return data;
  } catch(e) {
    setInvalid(e.response?.data?.fields || {});
  }
}
