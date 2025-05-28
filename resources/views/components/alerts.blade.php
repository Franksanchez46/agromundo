{{-- resources/views/components/alerts.blade.php --}}

<!-- Vinculando el CSS personalizado para las alertas -->
<link rel="stylesheet" href="{{ asset('css/alerts.css') }}">

<!-- Incluyendo el script de SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        // Prevenir que el formulario o el contenido de fondo se mueva al mostrar la alerta
        document.body.style.overflow = 'auto'; // Reestablecer overflow para que no haya desplazamiento
        document.body.style.paddingRight = '0'; // Reestablecer paddingRight al valor original

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: @json(session('success')),
                timer: 2300,
                showConfirmButton: false,
                scrollbarPadding: false,
                backdrop: true,
                customClass: {
                    popup: 'swal2-popup'  // Asegura que el modal tenga la clase swal2-popup
                }
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: @json(session('error')),
                timer: 2000,
                showConfirmButton: false,
                scrollbarPadding: false,
                backdrop: true,
                customClass: {
                    popup: 'swal2-popup'  // Asegura que el modal tenga la clase swal2-popup
                }
            });
        @endif

        @if (session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Información',
                text: @json(session('info')),
                timer: 2000,
                showConfirmButton: false,
                scrollbarPadding: false,
                backdrop: true,
                customClass: {
                    popup: 'swal2-popup'  // Asegura que el modal tenga la clase swal2-popup
                }
            });
        @endif

        @if (session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Advertencia',
                text: @json(session('warning')),
                timer: 2000,
                showConfirmButton: false,
                scrollbarPadding: false,
                backdrop: true,
                customClass: {
                    popup: 'swal2-popup'  // Asegura que el modal tenga la clase swal2-popup
                }
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Errores de validación',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                timer: 3000,
                showConfirmButton: false,
                scrollbarPadding: false,
                backdrop: true,
                customClass: {
                    popup: 'swal2-popup'  // Asegura que el modal tenga la clase swal2-popup
                }
            });
        @endif

    });
</script>
