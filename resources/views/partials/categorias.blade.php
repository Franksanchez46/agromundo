<!-- Catálogo de Productos -->
<section id="catalogo" class="container-fluid">
    <h2 class="text-center"><i class="fas fa-leaf me-2"></i>Nuestro Catálogo</h2><br><br>

    <div class="container">
        <div class="row mb-5 g-4">
@foreach ($categorias as $categoria)
    <div class="col-lg-3 col-md-6">
        <div class="card h-100 mb-4">
            @if ($categoria->imagen)
                <img src="{{ asset('storage/' . $categoria->imagen) }}" class="card-img-top" alt="{{ $categoria->nombre }}">
            @else
                <img src="{{ asset('categorias/default.jpg') }}" class="card-img-top" alt="{{ $categoria->nombre }}">
            @endif
            <div class="card-body text-center">
               {{--  <a href="{{ url('categoria/' . $categoria->slug) }}" target="_blank" class="{{ strtolower($categoria->slug) }}-link"> --}}
               {{--  <a href="{{ url('categoria/' . $categoria->slug) }}" target="_blank" class="categoria-link text-decoration-none text-dark"> --}}
                <a href="{{ url('categoria/' . $categoria->slug) }}" target="_blank" class="categoria-link">


                    <a href="{{ route('productos.categoria.id', ['id' => $categoria->id]) }}" class="categoria-link">


                @if ($categoria->icono)
                        <i class="{{ $categoria->icono }} me-2"></i>
                    @endif
                    <h5 class="card-title"><strong>{{ $categoria->nombre }}</strong></h5>
                </a>
            </div>
        </div>
    </div>
@endforeach

        </div>
    </div>
</section>
