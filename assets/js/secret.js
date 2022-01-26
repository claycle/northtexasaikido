window.addEventListener('load', (event) => {
    console.log('secret.js Copyright (c) 2022 claycle.com');
});

window.addEventListener('load', (event) => {
    let elements = document.querySelectorAll("[data-secret]");
    elements.forEach(el => {
        el.href = atob(el.dataset.secret);
        console.log("Secret Decoder", el.dataset.secret);
        if (el.dataset.secrettext) {
            el.innerHTML = atob(el.dataset.secrettext);
            console.log("Secret Decoder Text", el.dataset.secrettext);
        }
    });
});
