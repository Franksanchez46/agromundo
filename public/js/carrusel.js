let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const indicators = document.querySelectorAll('.indicator');
const totalSlides = slides.length;
let autoplayInterval;
let isPlaying = true;
const autoplayDuration = 5000; // 5 segundos entre diapositivas

// Precarga de imágenes para mejor desempeño
window.addEventListener('DOMContentLoaded', () => {
  const carrusel = document.querySelector('.carrusel');
  const loader = document.querySelector('.carrusel-loader');
  
  // Función para precargar todas las imágenes
  const preloadImages = () => {
    const slideImages = document.querySelectorAll('.slide img');
    let imagesLoaded = 0;
    
    // Contador de imágenes cargadas
    slideImages.forEach(img => {
      const tempImg = new Image();
      tempImg.src = img.src;
      
      tempImg.onload = () => {
        imagesLoaded++;
        
        if (imagesLoaded === slideImages.length) {
          // Todas las imágenes cargadas
          if (loader) loader.style.opacity = '0';
          
          setTimeout(() => {
            if (loader) loader.style.display = 'none';
            carrusel.classList.add('images-loaded');
            startAutoplay();
          }, 500);
        }
      };
      
      tempImg.onerror = () => {
        imagesLoaded++;
        console.error('Error al cargar la imagen:', img.src);
        
        if (imagesLoaded === slideImages.length) {
          if (loader) loader.style.display = 'none';
          carrusel.classList.add('images-loaded');
          startAutoplay();
        }
      };
    });
  };
  
  preloadImages();
});

// Función para ir a una diapositiva específica con transiciones mejoradas
function goToSlide(index) {
  if (index < 0) index = totalSlides - 1;
  if (index >= totalSlides) index = 0;
  
  // Si no hay cambio, no hacer nada
  if (currentSlide === index) return;
  
  // Actualizar clases para la animación
  slides[currentSlide].classList.add('leaving');
  slides[currentSlide].classList.remove('active');
  
  // Animar la entrada de la nueva diapositiva
  slides[index].classList.add('entering');
  setTimeout(() => {
    slides[index].classList.add('active');
    slides[index].classList.remove('entering');
    slides[currentSlide].classList.remove('leaving');
    
    // Actualizar la región en vivo para lectores de pantalla
    const liveRegion = document.querySelector('.carrusel-live-region');
    if (liveRegion) {
      liveRegion.textContent = `Mostrando diapositiva ${index + 1} de ${totalSlides}`;
    }
    
    // Resetear todas las animaciones previas para los elementos internos
    resetElementAnimations(slides[index]);
    
    // Actualizar indicadores
    indicators.forEach((indicator, i) => {
      indicator.classList.toggle('active', i === index);
      indicator.setAttribute('aria-selected', i === index);
    });
    
    currentSlide = index;
    
    // Actualizar barra de progreso
    resetProgressBar();
  }, 50);
}

// Resetear animaciones de elementos internos para reproducirlas de nuevo
function resetElementAnimations(slide) {
  const animatedElements = [
    slide.querySelector('.etiqueta-descuento'),
    slide.querySelector('.slide-title'),
    slide.querySelector('.slide-description'),
    slide.querySelector('.discount-text'),
    slide.querySelector('.discount-amount'),
    slide.querySelector('.discount-label'),
    slide.querySelector('.btn'),
    slide.querySelector('img')
  ];
  
  animatedElements.forEach(el => {
    if (!el) return;
    
    // Truco para forzar reanimación: remueve y añade la clase active al padre
    el.style.animation = 'none';
    el.offsetHeight; // Trigger reflow
    el.style.animation = '';
  });
}

// Funciones de navegación
function nextSlide() {
  goToSlide(currentSlide + 1);
  if (isPlaying) resetAutoplay();
}

function prevSlide() {
  goToSlide(currentSlide - 1);
  if (isPlaying) resetAutoplay();
}

// Implementar navegación con teclado
document.addEventListener('keydown', (e) => {
  if (e.key === 'ArrowRight') {
    nextSlide();
  } else if (e.key === 'ArrowLeft') {
    prevSlide();
  }
});

// Funciones para autoplay con barra de progreso
function startAutoplay() {
  if (autoplayInterval) clearInterval(autoplayInterval);
  isPlaying = true;
  resetProgressBar();
  autoplayInterval = setInterval(nextSlide, autoplayDuration);
}

function stopAutoplay() {
  if (autoplayInterval) clearInterval(autoplayInterval);
  isPlaying = false;
  const progressBarFill = document.querySelector('.progress-bar-fill');
  if (progressBarFill) progressBarFill.style.width = '0';
}

function resetAutoplay() {
  stopAutoplay();
  startAutoplay();
}

function toggleAutoplay() {
  const playPauseBtn = document.querySelector('.play-pause-btn');
  
  if (isPlaying) {
    stopAutoplay();
    if (playPauseBtn) playPauseBtn.classList.add('paused');
    if (playPauseBtn) playPauseBtn.setAttribute('aria-label', 'Reproducir carrusel');
  } else {
    startAutoplay();
    if (playPauseBtn) playPauseBtn.classList.remove('paused');
    if (playPauseBtn) playPauseBtn.setAttribute('aria-label', 'Pausar carrusel');
  }
}

// Función para actualizar la barra de progreso
function resetProgressBar() {
  const progressBarFill = document.querySelector('.progress-bar-fill');
  if (!progressBarFill) return;
  
  progressBarFill.style.width = '0';
  
  // Animar la barra suavemente
  let startTime;
  let animationFrameId;
  
  function animateProgressBar(timestamp) {
    if (!startTime) startTime = timestamp;
    const elapsed = timestamp - startTime;
    const progress = Math.min(elapsed / autoplayDuration, 1);
    
    progressBarFill.style.width = `${progress * 100}%`;
    
    if (progress < 1 && isPlaying) {
      animationFrameId = requestAnimationFrame(animateProgressBar);
    }
  }
  
  if (animationFrameId) cancelAnimationFrame(animationFrameId);
  animationFrameId = requestAnimationFrame(animateProgressBar);
}

// Detectar si la pestaña está visible para pausar/reanudar autoplay
document.addEventListener('visibilitychange', () => {
  if (document.hidden) {
    // Si la página no está visible, pausamos temporalmente
    stopAutoplay();
  } else {
    // Si la página vuelve a ser visible y estaba en reproducción automática
    if (!document.querySelector('.play-pause-btn.paused')) {
      startAutoplay();
    }
  }
});

// Implementar deslice táctil (swipe) para móviles
let touchStartX = 0;
let touchEndX = 0;

document.querySelector('.carrusel').addEventListener('touchstart', (e) => {
  touchStartX = e.changedTouches[0].screenX;
}, { passive: true });

document.querySelector('.carrusel').addEventListener('touchend', (e) => {
  touchEndX = e.changedTouches[0].screenX;
  handleSwipe();
}, { passive: true });

function handleSwipe() {
  const minSwipeDistance = 50;
  if (touchEndX < touchStartX - minSwipeDistance) {
    // Deslizar a la izquierda - siguiente diapositiva
    nextSlide();
  }
  
  if (touchEndX > touchStartX + minSwipeDistance) {
    // Deslizar a la derecha - diapositiva anterior
    prevSlide();
  }
}