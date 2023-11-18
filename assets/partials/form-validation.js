/**
 * Resalta los inputs con valores invalidos.
 *
 * @param ids Id de los inputs invalidos
*/
function setInvalid(ids) {
    Object.keys(ids).forEach( id => {
        const el = document.getElementById(id);
        const m  = document.createElement('span');

        m.classList.add(
            'text-bg-danger',
            'small',
            'badge',
            'text-wrap',
            'custom-error-msg'
        );
        m.textContent = (typeof ids[ id ] == "string")
            ? ids[ id ]
            : ids[ id ][0];

        if (el) {
            el.classList.add('is-invalid');
            el.parentNode.insertBefore(m, el);
        }
    });

    setTimeout(() => {
        document.getElementById(Object.keys(ids)[0] || '')?.focus();
    }, 0);
}

/**
 * Remueve las clases 'is-invalid' de todos los inputs.
*/
function removeInvalid() {
    document.querySelectorAll(".is-invalid").forEach(el => {
        el.classList.remove("is-invalid");
    });;

    document.querySelectorAll(".custom-error-msg").forEach(el => {
        el.remove();
    });
}

export {setInvalid, removeInvalid}
