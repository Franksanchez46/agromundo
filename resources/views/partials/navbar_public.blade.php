<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <!-- Logo y nombre de la marca -->
        <a class="navbar-brand" href="{{ url('/inicio') }}">
            <i class="fas fa-leaf brand-icon"></i> Agromundo
        </a>

        <!-- Botón para navegación en dispositivos móviles -->
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Elementos del menú centrados -->


        

        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                
                <li class="nav-item">
                    <form action="{{ route('busqueda.productos') }}" method="GET" class="buscador-contenedor" style="display: flex; align-items: center;">
                        <input type="text" class="buscador-input" name="q" placeholder="Buscar productos..." required style="border:none;outline:none;">
                        <button type="submit" class="buscador-boton" style="background:none;border:none;">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/inicio') }}">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                </li>
                @if (Route::currentRouteName() !== 'inicio')<li class="nav-item">
                    <a class="nav-link" href="{{ url('/inicio#catalogo') }}">
                        <i class="fa-solid fa-boxes-stacked"></i> Catálogo
                    </a>
                </li>
            @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/nosotro') }}">
                        <i class="fa-solid fa-building"></i> Nosotros
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('/registro') }}">
                        <i class="fas fa-user-plus"></i> Regístrate
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('login') }}">
                        <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
