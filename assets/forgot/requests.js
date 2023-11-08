import axios from "axios";

const ax = axios.create({
  baseURL: process.env.API
});

/**
 * Se encarga de realzar la solicitud que genera el codigo de recuperacion
 *
 * @param {string} serial Documento de identidad del usuario
*/
export async function startResetPasswd( doc ) {
    let _data = null;
    let error = null;
    try {
        const { data } = await ax.post("/start-reset-passwd", { doc });
        _data = data;
    } catch(e) {
        error = e;
    } finally {
        return [error, _data];
    }
}
