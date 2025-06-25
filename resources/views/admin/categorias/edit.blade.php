@extends('layouts.app')

@section('content')
<br>
<h2 class="mi-mt-5"><i class="fa-solid fa-pen-to-square"></i> Editar Categoría</h2>

<main>
    <div class="mi-formulario-nuevo-producto">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form action="{{ route('admin.categorias.update', $categoria->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label>Nombre</label>
                <input type="text" name="nombre" class="mi-formulario-nuevo-producto" value="{{ $categoria->nombre }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Imagen actual:</label><br>
                @if($categoria->imagen)
                    <img src="{{ asset('storage/' . $categoria->imagen) }}" alt="imagen" width="100">
                @else
                    Sin imagen
                @endif
            </div>

            <div class="form-group mb-3">
                <label>Cambiar Imagen</label>
                <input type="file" name="imagen" class="mi-formulario-nuevo-producto">
            </div>

            <div class="form-group mb-3">
                <label>Descripción</label>
                <textarea name="descripcion" class="mi-formulario-nuevo-producto">{{ $categoria->descripcion }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label>Icono</label>
                <input type="text" name="icono" class="mi-formulario-nuevo-producto" value="{{ $categoria->icono }}">
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn admin-btn-filtrar">
                    <i class="fas fa-save"></i> Actualizar
                </button>

                <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</main>
@endsection

