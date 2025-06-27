<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Agromundo')</title>

    {{-- Estilos --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
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
    <link rel="stylesheet" href="{{ asset('css/carrito.css') }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="epayco-public-key" content="{{ config('epayco.public_key') }}">
</head>
<body data-authenticated="{{ auth()->check() ? 'true' : 'false' }}">

    <div class="page-wrapper d-flex flex-column min-vh-100">
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

        @include('components.carrito')

        {{-- Contenido principal --}}
        <main class="flex-grow-1">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('partials.footer')
    </div>

    {{-- Scripts --}}
    {{-- Reemplazar @vite con enlaces directos --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/inicio.css') }}" rel="stylesheet">
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
    <link rel="stylesheet" href="{{ asset('css/carrito.css') }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="epayco-public-key" content="{{ config('epayco.public_key') }}">
</head>
<body data-authenticated="{{ auth()->check() ? 'true' : 'false' }}">

    <div class="page-wrapper d-flex flex-column min-vh-100">
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

        @include('components.carrito')

        {{-- Contenido principal --}}
        <main class="flex-grow-1">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('partials.footer')
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/carrito.js') }}"></script>
    <script src="{{ asset('js/descripcion.js') }}"></script>
    <script src="{{ asset('js/buscador_flotante.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js" defer></script>

    <script>
        window.usuarioLogueado = {{ auth()->check() ? 'true' : 'false' }};
        window.rutaLogin = "{{ route('login') }}";
    </script>

    @include('components.alerts')
</body>
</html>

### 🚨 **Problemas Potenciales del Cambio:**

#### **1. Dependencias Faltantes:**
Tu versión actual usa Vite, pero puede que no incluya todos los scripts que tenías antes:
- `js/carrito.js`
- `js/descripcion.js` 
- `js/buscador_flotante.js`

#### **2. Estilos CSS Faltantes:**
Los CSS específicos pueden no estar incluidos en `app.scss`:
- `css/inicio.css`
- `css/productos.css`
- `css/carrusel.css`
- `css/perfil.css`
- `css/navbar.css`
- Y otros...

### 🔧 **Solución Recomendada:**

#### **Opción 1: Volver a la versión anterior (Más seguro para producción)**
```php
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Agromundo')</title>

    {{-- Estilos --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
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
    <link rel="stylesheet" href="{{ asset('css/carrito.css') }}">

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="epayco-public-key" content="{{ config('epayco.public_key') }}">
</head>
<body data-authenticated="{{ auth()->check() ? 'true' : 'false' }}">

    <div class="page-wrapper d-flex flex-column min-vh-100">
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

        @include('components.carrito')

        {{-- Contenido principal --}}
        <main class="flex-grow-1">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('partials.footer')
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/carrito.js') }}"></script>
    <script src="{{ asset('js/descripcion.js') }}"></script>
    <script src="{{ asset('js/buscador_flotante.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js" defer></script>

    <script>
        window.usuarioLogueado = {{ auth()->check() ? 'true' : 'false' }};
        window.rutaLogin = "{{ route('login') }}";
    </script>

    @include('components.alerts')
</body>
</html>
