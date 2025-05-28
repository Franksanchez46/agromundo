<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Agromundo')</title>


    {{-- Estilos --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/productos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/carrusel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alerts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nosotros.css') }}">
    <link rel="stylesheet" href="{{ asset('css/descripcion.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminIndex.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buscador_flotante.css') }}">

    <!-- Splide.js CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css">



    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>
<body data-authenticated="{{ auth()->check() ? 'true' : 'false' }}">

{{-- Navbar dinámico según sesión y rol --}}
@if (auth()->check())
    @if (auth()->user()->rol_id === 1)
        {{-- Administrador autenticado --}}
        @if (session('modo_admin'))
            @include('partials.navbar_admin')
        @else
            @include('partials.navbar_user')
        @endif
    @else
        {{-- Usuario autenticado (no admin) --}}
        @include('partials.navbar_user')
    @endif
@else
    {{-- Visitante no autenticado --}}
    @include('partials.navbar_public')
@endif

{{-- @include('components.buscador-flotante') --}}


        {{-- Mostrar mensajes de éxito y error --}}
{{--         <div class="container mt-3">
 --}}            {{-- Mensaje de error --}}
{{--             @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif --}}
    
            {{-- Mensaje de éxito --}}
{{--             @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
 --}}

    {{-- Contenido de cada página --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/carrito.js') }}"></script>
    <script src="{{ asset('js/descripcion.js') }}"></script>
    <script src="{{ asset('js/buscador_flotante.js') }}"></script>

    <!-- Splide.js JS -->
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js" defer></script>


    @include('components.alerts')

</body>
</html>
