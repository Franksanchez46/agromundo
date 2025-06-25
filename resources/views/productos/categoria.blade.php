@extends('layouts.app')

@section('content')
<main class="products container">
    <br><br>

    @if ($categoria)
        <h2><i class="fa {{ $categoria->icono}}"></i> {{ ucwords($categoria->nombre) }}</h2>
    @endif

    <div class="box-container" id="lista-1">
        
        @foreach ($productos as $index => $producto)
        <div class="box {{ $index > 11 ? 'oculto' : '' }}">
                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                <div class="product-txt">
                    <br>
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
    data-preciobase="{{ $producto->precio ?? 0 }}"
    data-descuentos='@json($producto->variantes->pluck("oferta.descuento", "id"))'>
    Ver más
</button>

                </div>
            </div>
        @endforeach
    </div>

    <div class="btn-2" id="load-more">Cargar más</div>
</main>

<!-- Modal -->
<div id="modal-producto-cat" class="modal-cat">
    <div class="modal-contenido-cat">
        <span class="cerrar-cat">&times;</span>
        <img id="modal-imagen-cat" src="" alt="" style="width: 100%; max-height: 300px; object-fit: contain;">
        <h3 id="modal-nombre-cat"></h3>
        <p id="modal-descripcion-cat"></p>
        <div id="modal-variantes"></div>
        <p class="precio" id="modal-precio-cat" ></p>
        

        <a href="#" class="agregar-carrito btn-3" id="modal-agregar-cat">Agregar al carrito</a>
    </div>
</div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/descripcion.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('js/descripcion.js') }}"></script>
  <script src="{{ asset('js/redireccion.js') }}"></script> {{-- JS nuevo --}}

@endsection