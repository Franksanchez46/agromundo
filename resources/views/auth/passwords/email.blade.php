<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar contraseña</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link rel="icon" href="{{ asset('img/Logo.ico') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
  <div class="container">
    <div class="title">Recuperar contraseña</div>
    <div class="content">
      <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="user-details">
          <div class="input-box">
            <span class="details">Correo electrónico</span>
            <div class="input-container">
              <i class="fa-solid fa-envelope"></i>
              <input id="email" type="email" name="email" placeholder="Digite su correo electrónico" required autofocus>
            </div>
            @error('email')
              <div style="color: red; margin-top: 5px;">{{ $message }}</div>
            @enderror
          </div>
        </div>

        @if (session('status'))
          <div style="color: green; margin-top: 10px;">{{ session('status') }}</div>
        @endif

        <div class="button">
          <input type="submit" value="Enviar enlace de recuperación">
        </div>

        <div class="forgot-password" style="text-align: center; margin: 10px 0;">
          <a href="{{ route('login') }}">Volver al inicio de sesión</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>