<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <!-- Logo y nombre de la marca -->
        <a class="navbar-brand" href="{{ url('/inicio') }}">
            <i class="fas fa-leaf brand-icon"></i> Agromundo
        </a>

        <!-- Botón para navegación en móviles -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        

        <!-- Menú -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                {{-- <li class="nav-item">
                    <div class="buscador-contenedor">
                        <input type="text" class="buscador-input" placeholder="Buscar">
                        <div class="buscador-boton">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                    </div> --}}

                                        <li class="nav-item">
                        <form action="{{ route('busqueda.productos') }}" method="GET" class="buscador-contenedor" style="display: flex; align-items: center;">
                            <input type="text" class="buscador-input" name="q" placeholder="Buscar productos..." required style="border:none;outline:none;">
                            <button type="submit" class="buscador-boton" style="background:none;border:none;">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </li>


                    {{-- <div class="buscador-contenedor" style="position: relative;">
                        <input type="text" class="buscador-input" id="buscador-navbar" placeholder="Buscar">
                        <div class="buscador-boton" id="buscador-btn">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <div id="buscador-resultados" class="buscador-resultados" style="display:none;"></div>
                    </div> --}}
                

                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/inicio') }}">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                </li>
                @if (Route::currentRouteName() !== 'inicio')<li class="nav-item">
                    <a class="nav-link" href="/inicio#catalogo">
                        <i class="fa-solid fa-boxes-stacked"></i> Catálogo
                    </a>
                </li>
            @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/nosotro') }}">
                        <i class="fa-solid fa-building"></i> Nosotros
                    </a>
                </li>

                @include('components.carrito')


                <!-- Dropdown de cuenta -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="miCuenta" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        ¡Hola, {{ Auth::user()->name }}!
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="miCuenta">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile') }}">Mis datos</a>
                        </li>

                        @auth
    @if (auth()->user()->es_admin)
<form action="{{ route('cambiar.modo') }}" method="POST">
    @csrf
    <button type="submit" class="dropdown-item">
        @if (session('modo_admin') === true)
            Cambiar a usuario
        @else
            Cambiar a administrador
        @endif
    </button>
</form>

    @endif
@endauth

                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Cerrar sesión</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
