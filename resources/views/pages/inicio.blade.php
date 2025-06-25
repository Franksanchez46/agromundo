@extends('layouts.app')

@section('content')
<!-- Sección Héroe -->
<main>
    <section id="inicio" class="agro-hero">
        <div class="hero-overlay"></div>
        <div class="agro-hero-content">
            <div class="agro-hero-caption">
                <span class="agro-hero-badge">Bienvenido a Agromundo</span>
                <h1>Innovación Natural</h1>
                <p class="agro-hero-description">Productos modernos para un campo sostenible y un futuro más verde.</p>
                <div class="agro-hero-buttons">
                    <a href="#catalogo" class="btn agro-btn-primary">
                        <i class="fa-solid fa-boxes-stacked"></i> Ver Catálogos
                    </a>
                    <a href="#contacto" class="btn agro-btn-secondary">
                        <i class="fas fa-envelope me-2"></i> Contáctanos
                    </a>
                </div>
            </div>
        </div>
        <div class="agro-hero-shape"></div>
    </section>
</main>


    @include('partials.carrusel')



    @include('partials.categorias')







            </div>
        </div>
    </section>
</main>
<br><br>

<script src="{{ asset('js/carrusel.js') }}"></script>
<script src="{{ asset('js/verificacion-login.js') }}"></script>





@endsection
