<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>

  <!-- Enlace a estilos y favicon -->
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
  <link rel="icon" href="{{ asset('img2/Logo.ico') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="body-default">
  <div class="container container-default">
    <div class="title">Regístrate</div>
    <div class="content">

      <!-- Formulario usando rutas de Laravel -->
      <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="user-details">

          <div class="input-box">
            <span class="details">Nombre completo</span>
            <div class="input-container">
              <i class="fa-solid fa-user"></i>
              <input type="text" name="name" placeholder="Digite su nombre completo" value="{{ old('name') }}" required>
            </div>
          </div>

          <div class="input-box">
            <span class="details">Correo</span>
            <div class="input-container">
              <i class="fa-solid fa-envelope"></i>
              <input type="email" name="email" placeholder="Digite su correo electrónico"  value="{{ old('email') }}" required>
            </div>
          </div>

          <div class="input-box">
            <span class="details">Celular</span>
            <div class="input-container">
              <i class="fa-solid fa-phone"></i>
              <input type="text" name="telefono" placeholder="Digite su número de celular" value="{{ old('telefono') }}" required>
            </div>
          </div>

          <div class="input-box">
            <span class="details">Contraseña</span>
            <div class="input-container">
              <i class="fa-solid fa-lock"></i>
              <input type="password" id="contraseña" name="password" placeholder="Digite su contraseña" required>
              <i class="fa-solid fa-eye-slash toggle-password" id="togglePassword"></i>
            </div>
          </div>

        </div>

        <div class="input-box">
          <label>
            <input type="checkbox" id="toggleAdmin"> Soy administrador
          </label>
        </div>


<div class="input-box" id="adminCodeField" style="display: none;">
  <span class="details">Código de Administrador</span>
  <div class="input-container">
    <i class="fa-solid fa-key"></i> <!-- icono para código, puedes cambiar el icono si quieres -->
    <input type="text" name="admin_code" placeholder="Ingrese código de administrador" value="{{ old('admin_code') }}">
  </div>
</div>


        <div class="button">
          <input type="submit" value="Registrar">
        </div>

        <div class="signup-link">
          ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Script mostrar/ocultar contraseña -->
  <script>
    document.getElementById("togglePassword").addEventListener("click", function () {
      let passwordInput = document.getElementById("contraseña");
      let icon = this;
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      }
    });
  </script>

<script>
  const toggleAdmin = document.getElementById("toggleAdmin");
  const adminCodeField = document.getElementById("adminCodeField");
  const body = document.body;
  const container = document.querySelector('.container');

  toggleAdmin.addEventListener("change", function () {
    if (this.checked) {
      adminCodeField.style.display = "block";
      body.classList.remove('body-default');
      body.classList.add('body-admin');
      container.classList.remove('container-default');
      container.classList.add('container-admin');
    } else {
      adminCodeField.style.display = "none";
      body.classList.remove('body-admin');
      body.classList.add('body-default');
      container.classList.remove('container-admin');
      container.classList.add('container-default');
    }
  });
</script>


@include('components.alerts')

</body>
</html>
