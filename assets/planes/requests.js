import axios from "axios";
import { hideLoader } from "@/partials/loader";

const ax = axios.create({
  baseURL: process.env.API
});

/**
 * Crea la preferencia para continuar con el proceso de pago.
*/
export async function createPreference( planId, h = true ) {
  try {
    const {data} = await ax
      .post(`/planes/${planId}/create-preference`)
      .finally(() => h ? hideLoader() : false);
    return data;
  } catch(e) {
    throw e;
  }
};

/**
 * Obtiene todos los planes disponibles.
*/
export async function getPlanes(h = false) {
  try {
    const {data} = await ax
      .get("/planes/get-available")
      .finally(() => h ? hideLoader() : false);
    return data;
  } catch(e) {
    throw e;
  }
}

/**
 * Elimina un pago de la base de datos.
*/
export async function deletePago( pagoId, h = false) {
  try {
    const {data} = await ax
      .delete(`/pagos/${pagoId}/delete`)
      .finally(() => h ? hideLoader() : false);
    return data;
  } catch(e) {
    throw e;
  }
};
