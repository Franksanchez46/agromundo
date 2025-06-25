@extends('layouts.app')

@section('content')
<br><br>
<h2 class="mi-mt-5"><i class="fa-solid fa-plus"></i> Crear oferta</h2>

<main>
    <div class="mi-formulario-nuevo-producto">
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Ups!</strong> Hay algunos problemas con tus datos.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ofertas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}" class="mi-formulario-nuevo-producto" placeholder="Título" required>
            </div>

            <div class="form-group mb-3">
                <label for="descripcion">Descripción completa</label>
                <textarea id="descripcion" name="descripcion" class="mi-formulario-nuevo-producto" placeholder="Descripción completa" rows="3" required>{{ old('descripcion') }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="descripcion_breve">Descripción breve</label>
                <input type="text" id="descripcion_breve" name="descripcion_breve" value="{{ old('descripcion_breve') }}" class="mi-formulario-nuevo-producto" placeholder="Descripción breve">
            </div>

            <div class="form-group mb-3">
    <label for="descuento">Descuento (%)</label>
    <input type="number" id="descuento" name="descuento" value="{{ old('descuento') }}" class="mi-formulario-nuevo-producto" placeholder="Descuento (%)" required>
</div>


            <div class="form-group mb-3">
                <label for="alt">Texto alternativo de imagen</label>
                <input type="text" id="alt" name="alt" value="{{ old('alt') }}" class="mi-formulario-nuevo-producto" placeholder="Texto alternativo" required>
            </div>

            <div class="form-group mb-3">
                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" name="imagen" class="mi-formulario-nuevo-producto">
                <div id="preview-container" style="margin-top:10px;">
                    <img id="preview-img" src="#" alt="Previsualización" style="display:none; max-width:100px; max-height:100px; border-radius:8px; object-fit:cover;">
                </div>
            </div>

            <div class="form-group mb-3">
    <label for="variante_id">Selecciona una variante del producto</label>
    <select name="variante_id" id="variante_id" class="mi-formulario-nuevo-producto" required>
        <option value="">-- Selecciona una variante --</option>
        @foreach($variantes as $v)
            <option value="{{ $v->id }}" {{ old('variante_id') == $v->id ? 'selected' : '' }}>
                {{ $v->producto->nombre }} - {{ $v->tamaño }} - ${{ number_format($v->precio, 0, ',', '.') }}
            </option>
        @endforeach
    </select>
</div>


            <div style="text-align: center; margin: 20px 0;">
                <button type="submit" class="mi-button">
                    <span class="mi-shadow"></span>
                    <span class="mi-edge"></span>
                    <span class="mi-front">GUARDAR</span>
                </button>
                <a href="{{ route('ofertas.index') }}" class="btn btn-secondary" style="margin-left: 10px;">Cancelar</a>
            </div>
        </form>
    </div>
</main>
@endsection