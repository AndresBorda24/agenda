import iziToast from "izitoast";

export function errorAlert(message = "Ha ocurrido un error") {
    iziToast.error({
        title: "Error",
        message: message,
        position: "topRight"
    });
}

export function successAlert(message = "Operaci&oacute;n realizada con &eacute;xito") {
    iziToast.success({
        title: "Exito!",
        message: message,
        position: "topRight"
    });
}
