@extends('layouts.app')

@section('content')
<br>
<h2 class="mi-mt-5"><i class="fa-solid fa-pen-to-square"></i> Editar Producto</h2>

<main>
    <div class="mi-formulario-nuevo-producto">
        <form action="{{ route('admin.productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div class="form-group mb-3">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="mi-formulario-nuevo-producto" value="{{ old('nombre', $producto->nombre) }}" required>
            </div>

            <!-- Descripción -->
            <div class="form-group mb-3">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" class="mi-formulario-nuevo-producto" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
            </div>

            <!-- Precio -->
            <div class="form-group mb-3">
                <label for="precio">Precio</label>
                <input type="text" id="precio" name="precio" class="mi-formulario-nuevo-producto" value="{{ old('precio', $producto->precio) }}" required>
            </div>

            <!-- Categoría -->
            <div class="form-group mb-3">
                <label for="categoria_id">Categoría</label>
                <select name="categoria_id" id="categoria_id" class="form-control" required>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ $categoria->id == $producto->categoria_id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Imagen -->
            <div class="form-group mb-3">
                <label for="imagen">Cambiar imagen (opcional)</label>
                <input type="file" id="imagen" name="imagen" class="mi-formulario-nuevo-producto">
                @if($producto->imagen)
                    <p>Imagen actual:</p>
                    <img src="{{ asset('storage/' . $producto->imagen) }}" width="100">
                @endif
            </div>

            <!-- Mensajes de error -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                        {{-- Agrega este botón donde desees, por ejemplo, arriba del formulario --}}
{{--             <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Volver al listado
            </a> --}}
            <!-- Botón -->
            <div style="text-align: center; margin: 20px 0;">
                <button type="submit" class="mi-button">
                    <span class="mi-shadow"></span>
                    <span class="mi-edge"></span>
                    <span class="mi-front">GUARDAR CAMBIOS</span>
                </button>
            </div>
        </form>
    </div>
</main>
@endsection
