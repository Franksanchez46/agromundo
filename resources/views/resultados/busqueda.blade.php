@extends('layouts.app')

@section('content')
<main class="products container">
    <br><br>
    <h2>
        <i class="fa fa-search"></i> Resultados de búsqueda
        @if($q)
            para "{{ $q }}"
        @endif
    </h2>

    @if($productos->count())
        <div class="box-container" id="lista-1">
            @foreach ($productos as $producto)
                <div class="box">
                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                    <div class="product-txt">
                        <h3 class="nombre-corto" data-fullnombre="{{ $producto->nombre }}">
                            {{ \Illuminate\Support\Str::limit($producto->nombre, 22) }}
                        </h3>
                        <p class="descripcion-corta-cat" data-fulltext="{{ $producto->descripcion }}">
                            {{ \Illuminate\Support\Str::limit($producto->descripcion, 80) }}
                        </p>
                        <button class="ver-mas-btn-cat"
                            data-producto="{{ $producto->id }}"
                            data-nombre="{{ $producto->nombre }}"
                            data-descripcion="{{ $producto->descripcion }}"
                            data-imagen="{{ asset('storage/' . $producto->imagen) }}"
                            data-variantes='@json($producto->variantes)'
                            data-preciobase="{{ $producto->precio ?? 0 }}">
                            Ver más
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No se encontraron productos para tu búsqueda.</p>
    @endif
</main>

<!-- Modal igual al de categoría -->
<div id="modal-producto-cat" class="modal-cat">
    <div class="modal-contenido-cat">
        <span class="cerrar-cat">&times;</span>
        <img id="modal-imagen-cat" src="" alt="" style="width: 100%; max-height: 300px; object-fit: contain;">
        <h3 id="modal-nombre-cat"></h3>
        <p id="modal-descripcion-cat"></p>
        <div id="modal-variantes"></div>
        <p class="precio" id="modal-precio-cat"></p>
        <a href="#" class="agregar-carrito btn-3" id="modal-agregar-cat">Agregar al carrito</a>
    </div>
</div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/descripcion.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/descripcion.js') }}"></script>
@endsection