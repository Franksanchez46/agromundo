@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de Categoría</h1>

    <div class="mb-3">
        <strong>Nombre:</strong> {{ $categoria->nombre }}
    </div>

    <div class="mb-3">
        <strong>Descripción:</strong> {{ $categoria->descripcion ?? 'No registrada' }}
    </div>

    <div class="mb-3">
        <strong>Icono:</strong> {{ $categoria->icono ?? 'No registrado' }}
    </div>

    <div class="mb-3">
        <strong>Imagen:</strong><br>
        @if($categoria->imagen)
            <img src="{{ asset('storage/' . $categoria->imagen) }}" alt="imagen" width="200">
        @else
            No hay imagen
        @endif
    </div>

    <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
