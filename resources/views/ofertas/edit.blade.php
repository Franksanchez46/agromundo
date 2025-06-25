@extends('layouts.app')

@section('content')
<div class="container">
    <br><br>
    <h2 class="mi-mt-5"><i class="fa-solid fa-pen-to-square"></i> Editar Oferta</h2>


    <div class="mi-formulario-nuevo-producto">
        <form action="{{ route('ofertas.update', $oferta->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Título</label>
                <input type="text" name="titulo" class="mi-formulario-nuevo-producto" value="{{ $oferta->titulo }}" required>
            </div>

            <div class="mb-3">
                <label>Descripción</label>
                <textarea name="descripcion" class="mi-formulario-nuevo-producto" required>{{ $oferta->descripcion }}</textarea>
            </div>

            <div class="mb-3">
                <label>Descripción Breve</label>
                <input type="text" name="descripcion_breve" class="mi-formulario-nuevo-producto" value="{{ $oferta->descripcion_breve }}">
            </div>

            <div class="mb-3">
                <label>Descuento (%)</label>
                <input type="number" name="descuento" class="mi-formulario-nuevo-producto" value="{{ $oferta->descuento }}" required>
            </div>

            <div class="mb-3">
                <label>URL (opcional)</label>
                <input type="url" name="url" class="mi-formulario-nuevo-producto" value="{{ $oferta->url }}">
            </div>

            <div class="mb-3">
                <label>Texto alternativo (alt)</label>
                <input type="text" name="alt" class="mi-formulario-nuevo-producto" value="{{ $oferta->alt }}">
            </div>

            <div class="mb-3">
                <label>Seleccionar Variante del Producto</label>
                <select name="variante_id" class="mi-formulario-nuevo-producto" required>
                    <option value="">-- Selecciona una variante --</option>
                    @foreach ($variantes as $variante)
                        <option value="{{ $variante->id }}"
                            {{ $oferta->variante_id == $variante->id ? 'selected' : '' }}>
                            {{ $variante->producto->nombre }} - {{ $variante->tamaño }} - ${{ number_format($variante->precio, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3" id="imagenActualContainer">
                <label>Imagen actual:</label><br>
                @if($oferta->imagen)
                    <img src="{{ asset('storage/' . $oferta->imagen) }}" alt="{{ $oferta->alt }}" width="150" id="imagenActual">
                @else
                    <p>No hay imagen disponible.</p>
                @endif
            </div>

            <div class="mb-3">
                <label>Cambiar Imagen</label>
                <input type="file" name="imagen" id="imagenInput" class="mi-formulario-nuevo-producto">
            </div>

            <div class="mb-3" id="previewContainer" style="display: none;">
                <label>Previsualización de nueva imagen:</label><br>
                <img id="preview" src="#" alt="Previsualización" style="max-width: 200px;">
            </div>

            <div class="d-flex gap-2 mt-3">
                <!-- Botón verde tipo "mi-button" -->
               <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn admin-btn-filtrar">
                    <i class="fas fa-save"></i> Actualizar
                </button>

                <a href="{{ route('ofertas.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Script para mostrar solo una imagen (actual o nueva) --}}
<script>
document.getElementById('imagenInput').addEventListener('change', function(event) {
    const [file] = event.target.files;
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('previewContainer');
    const imagenActualContainer = document.getElementById('imagenActualContainer');

    if (file) {
        preview.src = URL.createObjectURL(file);
        previewContainer.style.display = 'block';
        imagenActualContainer.style.display = 'none';
    } else {
        previewContainer.style.display = 'none';
        imagenActualContainer.style.display = 'block';
    }
});
</script>
@endsection
