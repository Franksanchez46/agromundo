<div class="ofertas-wrapper">
  <div class="ofertas-header">
    <h2 class="text-3xl font-bold flex items-center gap-2">
      <i class="fas fa-tag text-green-600"></i> Ofertas
      <p class="text-sm text-gray-500">¡Descuentos por tiempo limitado!</p>
    </h2>
  </div>

  <div class="carrusel-container">
    <div class="carrusel-loader">
      <div class="loader-spinner"></div>
    </div>

    <div class="carrusel-live-region" aria-live="polite"></div>

    <div class="progress-bar">
      <div class="progress-bar-fill"></div>
    </div>

    <div class="carrusel" aria-roledescription="carrusel" aria-label="Ofertas destacadas" tabindex="0">
      
  
 @foreach($ofertas as $index => $oferta)
      <div class="slide {{ $index === 0 ? 'active' : '' }}" 
           aria-roledescription="diapositiva" 
           aria-label="{{ $index + 1 }} de {{ count($ofertas) }}" 
           aria-hidden="{{ $index === 0 ? 'false' : 'true' }}">
        
        <div class="ticker-container">
          <div class="ticker-track">
            <span>💥 ¡Ofertas limitadas esta semana! 💥</span>
            <span>🚚 ¡Descuentos exclusivos en referencias seleccionadas! 🚚</span>
            <span>🛒 ¡Productos nuevos disponibles este mes! 🛒</span>
            <span>🎁 ¡Promociones por tiempo limitado! 🎁</span>
          </div>
        </div>

        <div class="slide-content">
          <div class="etiqueta-descuento" tabindex="0">-{{ $oferta->descuento }}%</div>
         {{--  <img src="{{ asset($oferta->imagen) }}" alt="{{ $oferta->alt }}"> --}}
          
<img src="{{ asset('storage/' . $oferta->imagen) }}" alt="{{ $oferta->alt ?? 'Imagen de oferta' }}">



          <div class="slide-info">
            <div data-aos="fade-up">
              <h3 class="slide-title ocultar-en-carrusel">{{ $oferta->titulo }}</h3>
             {{--  <p class="slide-description">{{ $oferta->descripcion }}</p> --}}
            </div>

            <div class="discount-badge">
              <div class="discount-text">¡{{ $oferta->descripcion_breve ?? 'Aprovecha esta oferta especial!' }}</div>
              <div class="discount-amount">{{ $oferta->descuento }} %</div>
              <div class="discount-label">DE DESCUENTO</div>
              {{-- <a href="{{ $oferta->url }}" class="btn" aria-label="Comprar {{ $oferta->titulo }} con {{ $oferta->descuento }}% de descuento">
                Comprar ahora
              </a> --}}

              @php
  $variante = $oferta->variante;
@endphp

<a href="#" class="btn ver-mas-btn-cat"
   data-producto="{{ $oferta->variante->producto->id }}"
   data-nombre="{{ $oferta->variante->producto->nombre }}"
   data-descripcion="{{ $oferta->variante->producto->descripcion }}"
   data-imagen="{{ asset('storage/' . $oferta->variante->producto->imagen) }}"
   data-variantes='@json([$oferta->variante])'
   data-preciobase="{{ $oferta->variante->precio }}"
   data-descuentos='@json([$oferta->variante->id => $oferta->descuento])'>
   Comprar ahora
</a>







            </div>
          </div>
        </div>
      </div>

      
      @endforeach

      <!-- Botones navegación -->
      <button class="carrusel-nav prev" aria-label="Mostrar diapositiva anterior" onclick="prevSlide()">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <path fill="currentColor" d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"/>
        </svg>
      </button>

      <button class="carrusel-nav next" aria-label="Mostrar diapositiva siguiente" onclick="nextSlide()">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <path fill="currentColor" d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
        </svg>
      </button>

      <!-- Indicadores -->
      <div class="carrusel-indicators" role="tablist">
        @foreach($ofertas as $i => $oferta)
        <button class="indicator {{ $i === 0 ? 'active' : '' }}" 
                aria-label="Ver diapositiva {{ $i + 1 }}" 
                aria-selected="{{ $i === 0 ? 'true' : 'false' }}" 
                onclick="goToSlide({{ $i }})">
        </button>
        @endforeach
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="modal-producto-cat" class="modal-cat">
    <div class="modal-contenido-cat">
        <span class="cerrar-cat">&times;</span>
        <img id="modal-imagen-cat" src="" alt="" style="width: 100%; max-height: 300px; object-fit: contain;">
        <h3 id="modal-nombre-cat"></h3>
        <p id="modal-descripcion-cat"></p>
        <div id="modal-variantes"></div>
<p class="precio-original" id="modal-precio-original-cat" style="text-decoration: line-through; color: #6e1010;"></p>
<p class="precio-descuento" id="modal-precio-cat" style="color: #d01010; font-weight: bold;"></p>

        <a href="#" class="agregar-carrito btn-3" id="modal-agregar-cat">Agregar al carrito</a>
    </div>
</div>


@section('styles')
    <link rel="stylesheet" href="{{ asset('css/descripcion.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('js/descripcion.js') }}"></script>
  <script src="{{ asset('js/redireccion.js') }}"></script> {{-- JS nuevo --}}
@endsection

