import local from "@/partials/ax"

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


/**
 * Actualiza los datos de un beneficiario 
 * @param id number|string 
 * @param data object Datos del beneficiario
 * 
*/
export async function update(id, data) {
    return await request(() => local.put(
        `/auth/beneficiario/${id}/edit`, data));
}

/**
 * Registra un nuevo eneficiario 
 * @param data object Datos del beneficiario
 * 
*/
export async function store(data) {
    return await request(() => local.post(
        "/auth/beneficiario", data
    ));
}
