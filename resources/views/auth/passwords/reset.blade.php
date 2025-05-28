<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restablecer contraseña</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  <link rel="icon" href="{{ asset('img/Logo.ico') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
  <div class="container">
    <div class="title">Restablecer contraseña</div>
    <div class="content">
      <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="user-details">
          <div class="input-box">
            <span class="details">Correo electrónico</span>
            <div class="input-container">
              <i class="fa-solid fa-envelope"></i>
              <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            @error('email')
              <div style="color: red; margin-top: 5px;">{{ $message }}</div>
            @enderror
          </div>

          <div class="input-box">
            <span class="details">Nueva contraseña</span>
            <div class="input-container">
              <i class="fa-solid fa-lock"></i>
              <input id="password" type="password" name="password" placeholder="Nueva contraseña" required>
            </div>
            @error('password')
              <div style="color: red; margin-top: 5px;">{{ $message }}</div>
            @enderror
          </div>

          <div class="input-box">
            <span class="details">Confirmar contraseña</span>
            <div class="input-container">
              <i class="fa-solid fa-lock"></i>
              <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
            </div>
          </div>
        </div>

        <div class="button">
          <input type="submit" value="Restablecer contraseña">
        </div>

        <div class="forgot-password" style="text-align: center; margin: 10px 0;">
          <a href="{{ route('login') }}">Volver al inicio de sesión</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>