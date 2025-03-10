import axios from "axios";
import ax from "@/partials/ax";
import { hideLoader } from "@/partials/loader";

/**
 * Crea la preferencia para continuar con el proceso de pago.
 * @param {object} st Los datos necesarios para la solicitud
 * @param {string} st.plan Id del plan seleccionado
 * @param {bool}   st.tarjeta Si el usuario desea recibir la tarjeta en casa
*/
export async function createPreference( st, h = true ) {
  let error = null;
  let _data = null;

  try {
    const {data} = await ax
      .post(`/planes/${st.plan}/create-preference`, {
        tarjeta: st.tarjeta
      }).finally(() => h ? hideLoader() : false);
    _data = data;
  } catch(e) {
    error = e;
  } finally {
    return [error, _data];
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
 * Establecer el descuento por nomina.
*/
export async function setNominaPago( pagoId, h = false ) {
  let _data = null;
  let error = null;

  try {
    const {data} = await ax
      .put(`/pagos/${pagoId}/set-nomina`)
      .finally(() => h ? hideLoader() : false);
    _data = data;
  } catch(e) {
    error = e;
  } finally {
    return [error, _data];
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

/**
 * Redime un codigo de regalo
 *
 * @param {string} code Codigo de Regalo
*/
export async function redimir( code ) {
  let _data = null;
  let error = null;

  try {
    const { data } = await ax.post(`/regalo/${code}/redimir`)
    _data = data;
  } catch(e) {
    error = e;
  } finally {
    return [error, _data];
  }
}

/**
 * Crea un nuevo link para el pago
 *
 * @param {string} planId Codigo de Regalo
*/
export async function createOrder( planId ) {
  let _data = null;
  let error = null;

  try {
    const { data } = await ax.get(`/pagos/order/${planId}/create`)
    _data = data;
  } catch(e) {
    error = e;
  } finally {
    return [error, _data];
  }
}
