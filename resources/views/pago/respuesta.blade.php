 {{-- filepath: c:\xampp\htdocs\proyecto\agromundo\resources\views\pago\respuesta.blade.php --}}
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>¡Gracias por tu compra!</title>
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
  <link rel="icon" href="{{ asset('img2/Logo.ico') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="body-default">
  <div class="container container-default" style="max-width: 420px;">
    <div class="title" style="margin-bottom: 30px;">¡Gracias por tu compra!</div>
    <div class="content" style="display: flex; flex-direction: column; align-items: center;">
      <div style="font-size: 4rem; color: #28a745; margin-bottom: 20px;">
        <i class="fas fa-check-circle"></i>
      </div>
      <p style="font-size: 1.2rem; text-align: center; margin-bottom: 30px;">
        Tu pedido ha sido procesado exitosamente.<br>
        Pronto recibirás la confirmación en tu correo.
      </p>
      <a href="#" id="vaciar-y-volver" class="btn btn-success" style="font-size: 1.1rem; background-color: #28a745; border-color: #28a745; width: 100%;">Volver al inicio</a>
    </div>
  </div>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('vaciar-y-volver').addEventListener('click', function(e) {
          e.preventDefault();
          // Primero descuenta el stock
          fetch('{{ route('carrito.descontarStock') }}', {
              method: 'POST',
              headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}',
                  'Accept': 'application/json'
              }
          })
          .then(res => res.json())
          .then(data => {
              // Luego vacía el carrito
              return fetch('{{ route('carrito.vaciar') }}', {
                  method: 'POST',
                  headers: {
                      'X-CSRF-TOKEN': '{{ csrf_token() }}',
                      'Accept': 'application/json'
                  }
              });
          })
          .then(() => {
              window.location.href = "{{ url('/inicio') }}";
          });
      });
  });
  </script>
</body>
</html>