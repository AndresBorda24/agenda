import local from "@/partials/ax"

/**
 * Realiza una peticion y retorna su data y/o error
*/
async function request<T>(request: CallableFunction): Promise<{
    data: T,
    error: Error
}> {
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

export function getProcessUrl(itemId: string|number) {
    return request<{
        url: string
    }>(() => local.get(`/pagos/order/${itemId}/new`));
}
