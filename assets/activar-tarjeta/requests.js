import axios from "axios";

const ax = axios.create({
  baseURL: process.env.API
});

/**
 * Se encarga de realzar la solicitud que relaciona un usuario con una
 * tarhjeta.
 *
 * @param {string} serial EL consecutivo de la tarjeta.
*/
export async function activarTarjeta( serial ) {
    let _data = null;
    let error = null;
    try {
        const { data } = await ax.post("/set-card-serial", { serial });
        _data = data;
    } catch(e) {
        error = e;
    } finally {
        return [error, _data];
    }
}
