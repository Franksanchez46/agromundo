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
            <span>🚚 ¡Envío gratis por compras mayores a $100.000! 🚚</span>
            <span>🛒 ¡Productos nuevos disponibles este mes! 🛒</span>
            <span>🎁 ¡Promociones por tiempo limitado! 🎁</span>
          </div>
        </div>

        <div class="slide-content">
          <div class="etiqueta-descuento" tabindex="0">-{{ $oferta->descuento }}%</div>
          <img src="{{ asset($oferta->imagen) }}" alt="{{ $oferta->alt }}">
          
          <div class="slide-info">
            <div data-aos="fade-up">
              <h3 class="slide-title">{{ $oferta->titulo }}</h3>
              <p class="slide-description">{{ $oferta->descripcion }}</p>
            </div>

            <div class="discount-badge">
              <div class="discount-text">¡{{ $oferta->descripcion_breve ?? 'Aprovecha esta oferta especial!' }}</div>
              <div class="discount-amount">{{ $oferta->descuento }} %</div>
              <div class="discount-label">DE DESCUENTO</div>
              <a href="{{ $oferta->url }}" class="btn" aria-label="Comprar {{ $oferta->titulo }} con {{ $oferta->descuento }}% de descuento">
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