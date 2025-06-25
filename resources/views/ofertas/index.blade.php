@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Gestión de Ofertas</h2>
   <a href="{{ route('ofertas.create') }}" class="btn admin-btn-filtrar">
    <i class="fas fa-plus"></i> Crear nueva oferta
</a>
  </div>


  <table class="table table-bordered">
    <thead>
      <tr>
        {{-- <th>ID</th> --}}
        <th>Título</th>
        <th>Descripción</th>
        <th>Imagen</th>
        <th>Descuento</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($ofertas as $oferta)
      <tr>
        {{-- <td>{{ $oferta->id }}</td> --}}
        <td>{{ $oferta->titulo }}</td>
        <td>{{ $oferta->descripcion }}</td>
        <td>
         {{--  <img src="{{ asset($oferta->imagen) }}" alt="logo" width="80"> --}}
         <img src="{{ asset('storage/' . $oferta->imagen) }}" alt="{{ $oferta->alt ?? 'imagen' }}" width="80">

        </td>
        <td>{{ $oferta->descuento }}%</td>
        <td>
          <a href="{{ route('ofertas.edit', $oferta->id) }}" class="btn btn-warning btn-sm">
    <i class="fas fa-edit me-1"></i> Editar
</a>

<form action="{{ route('ofertas.destroy', $oferta->id) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger btn-sm d-inline-flex align-items-center"
        onclick="return confirm('¿Estás seguro de eliminar esta oferta?')">
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
