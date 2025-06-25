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
            {{-- <div class="form-group mb-3">
                <label for="precio">Precio</label>
                <input type="text" id="precio" name="precio" class="mi-formulario-nuevo-producto" value="{{ old('precio', $producto->precio) }}" required>
            </div> --}}

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
                <div id="preview-container" style="margin-top:10px;">
                    <img id="preview-img" src="{{ asset('storage/' . $producto->imagen) }}" alt="Previsualización" style="max-width:100px;max-height:100px;border-radius:8px;object-fit:cover;">
                </div>
            </div>

            <!-- Variantes -->
            <div class="form-group mb-3">
                <label>Variantes (tamaños y precios)</label>
                <div id="variantes-container">
                    @foreach ($producto->variantes as $index => $variante)
                    <div class="row variante-row mb-2">
                        <div class="col">
                            <input type="text" name="variantes[{{ $index }}][tamaño]" class="form-control" placeholder="Tamaño" value="{{ $variante->tamaño }}">
                        </div>
                        <div class="col">
                            <input type="number" name="variantes[{{ $index }}][precio]" class="form-control" placeholder="Precio" value="{{ $variante->precio }}">
                        </div>
                        <div class="col">
                            <input type="number" name="variantes[{{ $index }}][stock]" class="form-control" placeholder="Stock" value="{{ $variante->stock }}">
                        </div>
                        <div class="col-auto">
<button type="button" class="btn-x-personalizado btn-remove-variante">X</button>
                        </div>
                    </div>
                    @endforeach
                </div>
<button type="button" id="add-variante" class="btn admin-btn-filtrar">
    <i class="fas fa-plus"></i> Agregar variante
</button>
            </div>

            <!-- Errores -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Botón -->
            <div class="d-flex gap-2 justify-content-center my-4">
                <button type="submit" class="btn admin-btn-filtrar">
                    <i class="fas fa-save"></i> Guardar cambios
                </button>

                <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>

        </form>
    </div>
</main>
@endsection

@section('scripts')
<script>
let varianteIndex = {{ count($producto->variantes) }};
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

// Previsualización de imagen nueva
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
