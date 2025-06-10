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
                    <a href="#productos" class="btn agro-btn-primary">
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

    <!-- Catálogo de Productos -->
    <section id="catalogo" class="container-fluid">
        <h2 class="text-center"><i class="fas fa-leaf me-2"></i>Nuestro Catálogo</h2><br><br>

        <div class="container">
            <div class="row mb-5 g-4">


                @include('partials.categorias')



                   {{--          @foreach ($categorias as $categoria)
                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 mb-4">
                        @if ($categoria->imagen)
                            <img src="{{ asset('storage/' . $categoria->imagen) }}" class="card-img-top" alt="{{ $categoria->nombre }}">
                        @else
                            <img src="{{ asset('categorias/default.jpg') }}" class="card-img-top" alt="{{ $categoria->nombre }}">
                        @endif
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                <a href="{{ url('categoria/' . $categoria->slug) }}" target="_blank" class="categoria-link">
                                    @if ($categoria->icono)
                                        <h5 class="card-title"><i class="{{ $categoria->icono }} me-2"></i></h5>
                                    @endif
                                    <strong>{{ $categoria->nombre }}</strong>
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
            @endforeach --}}










                <!-- Producto 1 -->
<div class="col-lg-3 col-md-6">
    <div class="card h-100 mb-4">
        <img src="{{ asset('categorias/pesticidas.jpeg') }}" class="card-img-top" alt="Pesticidas">
        <div class="card-body text-center">
            <h5 class="card-title">
                <a href="{{ url('categoria/pesticidas') }}" target="_blank" class="pesticidas-link">
                    <h5 class="card-title"><i class="fa-solid fa-bug-slash"></i></h5>
                    <strong>Pesticidas</strong>
                </a>
            </h5>
        </div>
    </div>
</div>

<!-- Producto 2 -->
<div class="col-lg-3 col-md-6">
    <div class="card h-100 mb-4">
        <img src="{{ asset('categorias/abono.jpg') }}" class="card-img-top" alt="Abonos">
        <div class="card-body text-center">
            <h5 class="card-title">
                <a href="{{ url('categoria/abonos') }}" target="_blank" class="abonos-link">
                    <h5 class="card-title"><i class="fas fa-leaf me-2"></i></h5>
                    <strong>Abonos</strong>
                </a>
            </h5>
        </div>
    </div>
</div>

<!-- Producto 3 -->
<div class="col-lg-3 col-md-6">
    <div class="card h-100 mb-4">
        <img src="{{ asset('categorias/animales1.png') }}" class="card-img-top" alt="Animales">
        <div class="card-body text-center">
            <h5 class="card-title">
                <a href="{{ url('categoria/animales') }}" target="_blank" class="animales-link">
                    <h5 class="card-title"><i class="fas fa-cow me-2"></i></h5>
                    <strong>Animales</strong>
                </a>
            </h5>
        </div>
    </div>
</div>

<!-- Producto 4 -->
<div class="col-lg-3 col-md-6">
    <div class="card h-100 mb-4">
        <img src="{{ asset('categorias/concentradoC.jpeg') }}" class="card-img-top" alt="Concentrado animales granja">
        <div class="card-body text-center">
            <h5 class="card-title">
                <a href="{{ url('categoria/Concentrado para animales de granja') }}" target="_blank" class="conanimales-link">
                    <h5 class="card-title"><i class="fas fa-box me-2"></i></h5>
                    <strong>Concentrado para animales de granja</strong>
                </a>
            </h5>
        </div>
    </div>
</div>

<!-- Producto 5 -->
<div class="col-lg-3 col-md-6">
    <div class="card h-100 mb-4">
        <img src="{{ asset('categorias/concentradoM2.jpeg') }}" class="card-img-top" alt="Concentrado mascotas">
        <div class="card-body text-center">
            <h5 class="card-title">
                <a href="{{ url('categoria/concentrado mascotas') }}" target="_blank" class="conmascotas-link">
                    <h5 class="card-title"><i class="fas fa-paw me-2"></i></h5>
                    <strong>Concentrado mascotas</strong>
                </a>
            </h5>
        </div>
    </div>
</div>

{{-- <!-- Producto 6 -->
<div class="col-lg-4 col-md-6">
    <div class="card h-100">
        <img src="{{ asset('categorias/concentradoA.jpeg') }}" class="card-img-top" alt="Concentrado aves y roedores">
        <div class="card-body text-center">
            <h5 class="card-title">
                <a href="{{ url('categoria/concentrado-aves-roedores') }}" target="_blank" class="conaves-link">
                    <h5 class="card-title"><i class="fas fa-crow me-2"></i></h5>
                    <strong>Concentrado para aves y roedores</strong>
                </a>
            </h5>
        </div>
    </div>
</div> --}}

<!-- Producto 7 -->
<div class="col-lg-3 col-md-6">
    <div class="card h-100 mb-4">
        <img src="{{ asset('categorias/medicamentos.jpeg') }}" class="card-img-top" alt="Medicamentos mascotas">
        <div class="card-body text-center">
            <h5 class="card-title">
                <a href="{{ url('categoria/medicamentos') }}" target="_blank" class="medicamentos-link">
                    <h5 class="card-title"><i class="fas fa-capsules me-2"></i></h5>
                    <strong>Medicamentos</strong>
                </a>
            </h5>
        </div>
    </div>
</div>

<!-- Producto 8 -->
<div class="col-lg-3 col-md-6">
    <div class="card h-100 mb-4">
        <img src="{{ asset('categorias/herramientas.jpeg') }}" class="card-img-top" alt="Herramientas">
        <div class="card-body text-center">
            <a href="{{ url('categoria/herramientas') }}" target="_blank" class="herramientas-link">
                <i class="fas fa-tractor me-2"></i>
                <h5 class="card-title"><strong>Herramientas</strong></h5>
            </a>
        </div>
    </div>
</div>



            </div>
        </div>
    </section>
</main>
<br><br>

<script src="{{ asset('js/carrusel.js') }}"></script>




@endsection
