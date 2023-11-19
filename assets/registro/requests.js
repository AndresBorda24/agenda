import ax from "@/partials/ax";
import { showLoader, hideLoader } from "@/partials/loader";

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
