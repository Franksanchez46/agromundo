<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <!-- Marca del panel admin -->
        <a class="navbar-brand" href="{{ route('admin.productos.index') }}">
            <i class="fas fa-tools"></i> Admin Panel
        </a>

        <!-- Botón responsive -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarAdmin" aria-controls="navbarAdmin"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navegación -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarAdmin">
            <ul class="navbar-nav">

                <!-- Enlace a productos -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.productos.index') }}">
                        <i class="fa-solid fa-boxes-stacked"></i> Productos
                    </a>
                </li>

                <!-- Crear producto -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('productos.create') }}">
                        <i class="fa-solid fa-plus"></i> Crear producto
                    </a>
                </li>

                <!-- Menú desplegable del usuario -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-shield"></i> ¡Hola, {{ Auth::user()->name }}!
                    </a>
<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
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

        </div>
    </div>
</nav>
