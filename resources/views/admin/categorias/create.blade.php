

@extends('layouts.app')

@section('content')
<br>
<h2 class="mi-mt-5"><i class="fa-solid fa-plus"></i> Crear categoría</h2>

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

        <form action="{{ route('admin.categorias.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="mi-formulario-nuevo-producto" placeholder="Nombre de la categoría" required>
            </div>

            <div class="form-group mb-3">
                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" name="imagen" class="mi-formulario-nuevo-producto">
                <div id="preview-container" style="margin-top:10px;">
                    <img id="preview-img" src="#" alt="Previsualización" style="display:none; max-width:100px; max-height:100px; border-radius:8px; object-fit:cover;">
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" class="mi-formulario-nuevo-producto" placeholder="Descripción de la categoría" rows="3"></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="icono">Icono</label>
                <input type="text" id="icono" name="icono" class="mi-formulario-nuevo-producto" placeholder="Icono (clase o texto)">
            </div>

            <div style="text-align: center; margin: 20px 0;">
                <button type="submit" class="mi-button">
                    <span class="mi-shadow"></span>
                    <span class="mi-edge"></span>
                    <span class="mi-front">GUARDAR</span>
                </button>
                <a href="{{ route('admin.categorias.index') }}" class="btn btn-secondary" style="margin-left: 10px;">Cancelar</a>
            </div>
        </form>
    </div>
</main>
@endsection

@section('scripts')
<script>
// Previsualización de imagen
document.getElementById('imagen').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const previewImg = document.getElementById('preview-img');
    if (file) {
        const reader = new FileReader();
        reader.onload = function(ev) {
            previewImg.src = ev.target.result;
            previewImg.style.display = 'block';
        }
        reader.readAsDataURL(file);
    } else {
        previewImg.src = '#';
        previewImg.style.display = 'none';
    }
});
</script>
@endsection
