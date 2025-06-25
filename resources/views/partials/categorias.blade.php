<!-- Catálogo de Productos -->
<br>
<section id="catalogo" class="container-fluid">
    <h2 class="text-center"><i class="fas fa-leaf me-2"></i>Nuestro Catálogo</h2><br><br>

    <div class="container">
        <div class="row mb-5 g-4">

           @foreach ($categorias as $index => $categoria)
    <div class="col-lg-4 col-md-6">
        <div class="card h-100 mb-4">
            @if ($categoria->imagen)
                <img src="{{ asset('storage/' . $categoria->imagen) }}" class="card-img-top categoria-img" alt="{{ $categoria->nombre }}">
            @else
                <img src="{{ asset('categorias/default.jpg') }}" class="card-img-top categoria-img" alt="{{ $categoria->nombre }}">
            @endif

            <div class="card-body text-center">
                <a href="{{ route('productos.categoria.id', ['id' => $categoria->id]) }}" class="categoria-link text-decoration-none text-dark">
                    @if ($categoria->icono)
                        <i class="{{ $categoria->icono }} me-2"></i>
                    @endif
                    <h5 class="card-title"><strong>{{ $categoria->nombre }}</strong></h5>
                </a>
            </div>
        </div>
    </div>

    {{--  Salto de fila después de cada 3 elementos --}}
    @if (($index + 1) % 3 == 0)
        <div class="w-100 d-none d-lg-block"></div>
    @endif
@endforeach

</div>
    </div>
</section>
