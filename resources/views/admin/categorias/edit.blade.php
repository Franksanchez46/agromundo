{{-- @extends('layouts.app') 

@section('content')
<div class="container">
    <h1>Editar Categoría</h1>

    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $categoria->nombre }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion">{{ $categoria->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
            <small>Imagen actual: <img src="{{ Storage::url($categoria->imagen) }}" width="50"></small>
        </div>

        <div class="mb-3">
            <label for="icono" class="form-label">Icono</label>
            <input type="text" class="form-control" id="icono" name="icono" value="{{ $categoria->icono }}">
        </div>

        <button type="submit" class="btn btn-success">Actualizar Categoría</button>
    </form>
</div>
@endsection --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <br><br>
    <h1>Editar Categoría</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.categorias.update', $categoria->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $categoria->nombre }}" required>
        </div>

        <div class="mb-3">
            <label>Imagen actual:</label><br>
            @if($categoria->imagen)
                <img src="{{ asset('storage/' . $categoria->imagen) }}" alt="imagen" width="100">
            @else
                Sin imagen
            @endif
        </div>

        <div class="mb-3">
            <label>Cambiar Imagen</label>
            <input type="file" name="imagen" class="form-control">
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control">{{ $categoria->descripcion }}</textarea>
        </div>

        <div class="mb-3">
            <label>Icono</label>
            <input type="text" name="icono" class="form-control" value="{{ $categoria->icono }}">
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
@endsection
