import fox from "@/partials/fox-ax"
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
 * Obtiene todas las especialidades y medicos que tengan registros en la
 * agenda
*/
export async function getEspecialidades() {
    return await request(() => fox.get("/agenda/especialidades"));
}

/**
 * Obtiene toda la agenda disponible de un medico.
 * @param med {string} Codigo del medico
*/
export async function getAgenda( med ) {
    return await request(() => fox.get(`/agenda/${med}/libre`));
}

/**
 * Realiza la peticion para (pre)Agendar un usuario
*/
export async function agendar( data ) {
    return await request(() => fox.post("/agenda/agendar", data, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    }));
}

/** Info basica del usuario en sesion */
export async function getAuthInfo() {
    return await request(() => local.get(`/auth/basic`));
}

export async function getBeneficiarioInfo(documento) {
    return await request(() => local.get(`/auth/beneficiario/${documento}/info`));
}

/**
 * Obtiene el listado de las eps disponibles en GEMA.
*/
export async function getListadoEPS() {
    return request(() => fox.get('/agenda/eps'))
}


export async function notificarUsuario(infoCita) {
    return request(() => local.post('/agenda/notificar/nueva-cita', infoCita));
}
