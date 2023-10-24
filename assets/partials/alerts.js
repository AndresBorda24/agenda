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

export function questionAlert({
    message = "Pregunta?",
    yes = "Si",
    no = "No",
    yesAction = (i, t) => i.hide({ transitionOut: 'fadeOut' }, t, 'button'),
    noAction = (i, t) => i.hide({ transitionOut: 'fadeOut' }, t, 'button'),
} = {}) {
    iziToast.question({
        timeout: false,
        close: false,
        progressBar: false,
        theme: "dark",
        drag: false,
        overlay: true,
        displayMode: 'once',
        id: 'question-1',
        zindex: 999,
        title: false,
        message: message,
        position: 'center',
        backgroundColor: "var(--blue-800)",
        buttons: [
            ['<button><b>Si</b></button>', yesAction, true],
            ['<button>No</button>', noAction],
        ]
    });
}
