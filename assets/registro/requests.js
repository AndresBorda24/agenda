import axios from "axios";
import { showLoader, hideLoader } from "@/partials/loader";

const ax = axios.create({
  baseURL: process.env.API
});

/**
 * Intenta registrar la informacion de un nuevo usuario.
*/
export async function saveRegistro( state ) {
    let res = null;
    let error = null;

    try {
        showLoader();
        const { data } = await ax.post("/pacientes/registro", state);
        res = data;
    } catch(e) {
        error = e;
        hideLoader();
    } finally {
        return [ res, error ];
    }
}
