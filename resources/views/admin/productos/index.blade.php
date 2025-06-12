@extends('layouts.app')

@section('content')
<div class="container mt-4">
    
    <h2>Gestión de Productos</h2>

    <form method="GET" action="{{ route('admin.productos.index') }}" class="row mb-4 admin-filtro-form">
        <div class="col-md-4 mb-2">
            <input type="text" name="nombre" class="form-control filtro-nombre" placeholder="Buscar por nombre" value="{{ request('nombre') }}">
        </div>

        <div class="col-md-4 mb-2">
            <select name="categoria" class="form-control filtro-categoria">
                <option value="">-- Todas las categorías --</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 mb-2 filtro-botones">
            <button type="submit" class="btn admin-btn-filtrar">
                <i class="fas fa-search"></i> Filtrar
            </button>
            <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary admin-btn-limpiar">
                <i class="fas fa-times"></i> Limpiar
            </a>
        </div>

                    <!-- Botón Crear producto (mismo estilo que filtrar) -->
        <div class="row">
        <div class="col text-end">
            <a href="{{ route('productos.create') }}" class="btn admin-btn-filtrar">
                <i class="fas fa-plus"></i> Crear nuevo producto
            </a>
        </div>
        </div>
    </form>




    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr>
                <td><img src="{{ asset('storage/' . $producto->imagen) }}" width="80"></td>
                <td>{{ $producto->nombre }}</td>
                <td>${{ number_format($producto->precio, 0, ',', '.') }}</td>
                <td>{{ $producto->categoria->nombre }}</td>
                <td>
                    <a href="{{ route('admin.productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
