function toastifyError(message) {
    Toastify({
        text: message,
        duration: 4000,
        // destination: "https://github.com/apvarun/toastify-js",
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
        background: "#990000",
        color: "#FFE5E5",
        },
        onClick: function(){} // Callback after click
    }).showToast();
}
function toastifySuccess(message) {
    Toastify({
        text: message,
        duration: 4000,
        // destination: "https://github.com/apvarun/toastify-js",
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "#02730F",
            color: "#DCFEE0",
        },
        onClick: function(){} // Callback after click
    }).showToast();
}