document.addEventListener("DOMContentLoaded", function () {
    const botonAgregar = document.getElementById("modal-agregar-cat");

    if (botonAgregar) {
        botonAgregar.addEventListener("click", function (e) {
            e.preventDefault();

            // Esta variable viene desde Blade y debe ser agregada dinámicamente
            if (!window.usuarioLogueado) {
                window.location.href = "/login"; // O usa route('login') si lo pasas desde backend
            } else {
                // Aquí sigue el flujo normal del carrito si el usuario está logueado
                console.log("Agregar al carrito - usuario logueado (ejecuta tu lógica aquí)");
            }
        });
    }
});
