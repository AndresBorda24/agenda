import axios from "axios";

const ax = axios.create({
  baseURL: process.env.API
});

/**
 * Crea la preferencia para continuar con el proceso de pago.
*/
export async function createPreference( planId ) {
  try {
    const {data} = await ax.post("/planes/create-preference", {
      plan: planId
    });
    return data;
  } catch(e) {
    throw e;
  }
};

/**
 * Obtiene todos los planes disponibles.
*/
export async function getPlanes() {
  try {
    const {data} = await ax.get("/planes/get-available");
    return data;
  } catch(e) {
    throw e;
  }
}
