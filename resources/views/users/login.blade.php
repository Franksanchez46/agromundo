<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesión</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link rel="icon" href="{{ asset('img/Logo.ico') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>



  <div class="container">
    <div class="title">Inicio de sesión</div>
    <div class="content">

      {{-- Formulario de Laravel con protección CSRF --}}
      <form id="loginForm" action="{{ route('login.attempt') }}" method="POST">
        @csrf

        <div class="user-details">
          <div class="input-box">
            <span class="details">Correo</span>
            <div class="input-container">
              <i class="fa-solid fa-envelope"></i>
              <input type="email" name="email" placeholder="Digite su correo electrónico" required>
            </div>
          </div>

          <div class="input-box">
            <span class="details">Contraseña</span>
            <div class="input-container">
              <i class="fa-solid fa-lock"></i>
              <input type="password" name="password" id="password" placeholder="Digite su contraseña" required>
              <i class="fa-solid fa-eye-slash toggle-password" id="togglePassword"></i>
            </div>
          </div>
        </div>

        @if(session('error'))
          <div style="color: red; margin-top: 10px;">{{ session('error') }}</div>
        @endif

        <div class="button">
          <input type="submit" value="Iniciar sesión">
        </div>

        <div class="signup-link">
          ¿No tienes una cuenta? <a href="{{ url('/registro') }}">Regístrate aquí</a>
        </div>
      </form>
    </div>
  </div>

  {{-- Script para mostrar u ocultar contraseña --}}
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const togglePassword = document.getElementById("togglePassword");
      const passwordInput = document.getElementById("password");

      togglePassword.addEventListener("click", function () {
        if (passwordInput.type === "password") {
          passwordInput.type = "text";
          togglePassword.classList.remove("fa-eye-slash");
          togglePassword.classList.add("fa-eye");
        } else {
          passwordInput.type = "password";
          togglePassword.classList.remove("fa-eye");
          togglePassword.classList.add("fa-eye-slash");
        }
      });
    });
  </script>

@include('components.alerts')

</body>
</html>
