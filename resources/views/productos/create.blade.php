{{-- @extends('layouts.app')

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
{{--             <div style="text-align: center; margin: 20px 0;">
                <button type="submit" class="mi-button">
                    <span class="mi-shadow"></span>
                    <span class="mi-edge"></span>
                    <span class="mi-front">AGREGAR</span>
                </button>
            </div>
        </form>
    </div>
</main>
@endsection --}}

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
                <div id="preview-container" style="margin-top:10px;">
                    <img id="preview-img" src="#" alt="Previsualización" style="display:none;max-width:100px;max-height:100px;border-radius:8px;object-fit:cover;">                </div>
            </div>


            <!-- NUEVO: Variantes dinámicas -->
            <div class="form-group mb-3">
                <label>Variantes (tamaños y precios)</label>
                <div id="variantes-container">
                    <div class="row variante-row mb-2">
                        <div class="col">
                            <input type="text" name="variantes[0][tamaño]" class="form-control" placeholder="Tamaño (ej: 500g)">
                        </div>
                        <div class="col">
                            <input type="number" name="variantes[0][precio]" class="form-control" placeholder="Precio">
                        </div>
                        <div class="col">
                            <input type="number" name="variantes[0][stock]" class="form-control" placeholder="Stock">
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-danger btn-remove-variante">X</button>
                        </div>
                    </div>
                </div>
                <button type="button" id="add-variante" class="btn btn-primary btn-sm mt-2">Agregar variante</button>
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

@section('scripts')
<script>
let varianteIndex = 1;
document.getElementById('add-variante').addEventListener('click', function() {
    const container = document.getElementById('variantes-container');
    const row = document.createElement('div');
    row.className = 'row variante-row mb-2';
    row.innerHTML = `
        <div class="col">
            <input type="text" name="variantes[${varianteIndex}][tamaño]" class="form-control" placeholder="Tamaño (ej: 500g)">
        </div>
        <div class="col">
            <input type="number" name="variantes[${varianteIndex}][precio]" class="form-control" placeholder="Precio">
        </div>
        <div class="col">
            <input type="number" name="variantes[${varianteIndex}][stock]" class="form-control" placeholder="Stock">
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-danger btn-remove-variante">X</button>
        </div>
    `;
    container.appendChild(row);
    varianteIndex++;
});

document.getElementById('variantes-container').addEventListener('click', function(e) {
    if (e.target.classList.contains('btn-remove-variante')) {
        e.target.closest('.variante-row').remove();
    }
});

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