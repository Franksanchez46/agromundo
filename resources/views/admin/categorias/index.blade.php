{{-- @extends('layouts.app') <!-- Aquí se usa el layout admin que contiene el navbar y footer del panel de administración -->

@section('content')
<div class="container">
    <h1>Administrar Categorías</h1>
    
    <a href="{{ route('categorias.create') }}" class="btn btn-primary mb-3">Crear Nueva Categoría</a>
    
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Icono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->nombre }}</td>
                    <td>{{ $categoria->descripcion }}</td>
                    <td>
                        @if($categoria->imagen)
                            <img src="{{ Storage::url($categoria->imagen) }}" alt="{{ $categoria->nombre }}" width="50">
                        @endif
                    </td>
                    <td>{{ $categoria->icono }}</td>
                    <td>
                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning">Editar</a>
                        
                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
 --}}

 @extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <h2>Categorías</h2>

<div class="row mb-4 align-items-end justify-content-between">
    <!-- Filtro -->
    <div class="col-md-8">
        <form method="GET" action="{{ route('admin.categorias.index') }}" class="row admin-filtro-form gx-2">
            <div class="col-sm-7 mb-2 mb-sm-0">
                <input type="text" name="nombre" class="form-control filtro-nombre" placeholder="Buscar por nombre" value="{{ request('nombre') }}">
            </div>
            <div class="col-sm-5 d-flex gap-2">
                <button type="submit" class="btn admin-btn-filtrar">
                    <i class="fas fa-search"></i> Filtrar
                </button>
                <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary admin-btn-limpiar">
                    <i class="fas fa-times"></i> Limpiar
                </a>
            </div>
        </form>
    </div>

    <!-- Botón Crear -->
    <div class="col-md-auto mt-2 mt-md-0">
        <a href="{{ route('admin.categorias.create') }}" class="btn admin-btn-filtrar">
            <i class="fas fa-plus"></i> Crear nueva categoría
        </a>
    </div>
</div>



    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Descripción</th>
                <th>Icono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->nombre }}</td>
                    <td>
                        @if($categoria->imagen)
                            <img src="{{ asset('storage/' . $categoria->imagen) }}" alt="imagen" width="60">
                        @else
                            Sin imagen
                        @endif
                    </td>
                    <td>{{ $categoria->descripcion }}</td>
                    <td>{{ $categoria->icono }}</td>
                    <td>
{{--                         <a href="{{ route('admin.categorias.show', $categoria->id) }}" class="btn btn-info btn-sm">Ver</a>
 --}}                   {{--      <a href="{{ route('admin.categorias.edit', $categoria->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Editar</a>
                        <form action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">  <i class="fas fa-trash"></i>Eliminar</button>
                        </form> --}}

                        <a href="{{ route('admin.categorias.edit', $categoria->id) }}" class="btn btn-warning btn-sm">
    <i class="fas fa-edit me-1"></i> Editar
</a>

<form action="{{ route('admin.categorias.destroy', $categoria->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm d-inline-flex align-items-center"
        onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">
        <i class="fas fa-trash me-1"></i> Eliminar
    </button>
</form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
