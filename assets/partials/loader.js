export function showLoader(selector = "#loader") {
    const loader = document.querySelector(selector);

    if (loader) {
        document.body.classList.add('overflow-hidden');
        loader.classList.remove('hidden');
    }
}

export function hideLoader(selector = "#loader") {
    const loader = document.querySelector(selector);

    if (loader) {
        document.body.classList.remove('overflow-hidden');
        loader.classList.add('hidden');
    }
}
