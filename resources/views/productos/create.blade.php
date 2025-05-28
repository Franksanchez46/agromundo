@extends('layouts.app')

@section('content')
<br>
<h2 class="mi-mt-5"><i class="fa-solid fa-plus"></i> Añadir productos</h2>

<main>
    <div class="mi-formulario-nuevo-producto">
        <!-- Formulario con las funcionalidades de Laravel -->
        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nombre del producto -->
            <div class="form-group mb-3">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="mi-formulario-nuevo-producto" placeholder="Nombre del producto" required>
            </div>

            <!-- Descripción del producto -->
            <div class="form-group mb-3">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" class="mi-formulario-nuevo-producto" placeholder="Descripción del producto" rows="3" required></textarea>
            </div>

            <!-- Precio del producto -->
            <div class="form-group mb-3">
                <label for="precio">Precio</label>
                <input type="text" id="precio" name="precio" class="mi-formulario-nuevo-producto" placeholder="Precio" required>
            </div>

            <!-- Categoría del producto (sin cambios visuales) -->
            <div class="form-group mb-3">
                <label for="categoria_id">Categoría</label>
                <select name="categoria_id" id="categoria_id" class="form-control" required>
                    <option value="">Elija la categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Imagen del producto -->
            <div class="form-group mb-3">
                <label for="imagen">Imagen del producto</label>
                <input type="file" id="imagen" name="imagen" class="mi-formulario-nuevo-producto" required>
            </div>

            <!-- Mensajes de error -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Ups!</strong> Hay algunos problemas con tus datos.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

{{--             <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="alert alert-success">
                    <strong>¡Éxito!</strong> {{ session('success') }}
                </div>
            @endif --}}

            <!-- Botón de enviar -->
            <div style="text-align: center; margin: 20px 0;">
                <button type="submit" class="mi-button">
                    <span class="mi-shadow"></span>
                    <span class="mi-edge"></span>
                    <span class="mi-front">AGREGAR</span>
                </button>
            </div>
        </form>
    </div>
</main>
@endsection
