// public/js/verificacion-login.js
document.addEventListener("DOMContentLoaded", () => {
    /* --------------------------------------------
     *  Si el usuario YA inició sesión,
     *  salimos sin hacer nada → otros scripts seguirán normales
     * -------------------------------------------- */
    if (window.usuarioLogueado) return;

    /* --------------------------------------------
     *  Usuario NO autenticado → interceptamos clics
     * -------------------------------------------- */
    const botonAgregar = document.getElementById("modal-agregar-cat");

    if (botonAgregar) {
        botonAgregar.addEventListener("click", (e) => {
            e.preventDefault();                 // bloquea la acción original
            window.location.href = window.rutaLogin || "/login";
        });
    }
});
