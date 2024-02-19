import fox from "@/partials/fox-ax"

/**
 * Realiza una peticion y retorna su data y/o error
 * @param request {Callback}
*/
async function request( request ) {
    let e = null;
    let d = null;
    try {
        const { data } = await request();
        d = data;
    } catch(error) {
        e = error;
        d = error.response?.data;
    } finally {
        return { error: e, data: d }
    }
}

/**  Obtiene todas las citas del usuario en sesion. Canceladas o no */
export async function getAuthCitas( documento ) {
    return request(() => fox.get(`/agenda/${documento}/citas`));
}
