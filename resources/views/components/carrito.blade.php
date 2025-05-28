<!-- Ícono del carrito en el navbar -->
<li class="nav-item position-relative">
    <a class="nav-link carrito-icono" href="#" id="carrito-icono">
        <i class="fas fa-shopping-cart"></i>
        <span class="badge bg-success position-absolute top-0 start-100 translate-middle" id="carrito-contador">0</span>
    </a>
</li>
<!-- Carrito flotante -->
    <div class="dropdown-menu p-3 carrito-dropdown"
        id="carrito-dropdown"
        style="display: none; position: absolute; right: 0; top: 100%; z-index: 1050; width: 300px; background-color: white; border-radius: 10px;">
        
        <h6 class="fw-bold carrito-titulo">Carrito</h6>
        <ul class="list-group mb-2 carrito-lista" id="carrito-lista" style="max-height: 200px; overflow-y: auto;"></ul>
        <div class="dropdown-divider"></div>
        <div class="px-1 pb-2">
            <button class="btn btn-sm btn-danger w-100 carrito-vaciar" id="carrito-vaciar">Vaciar carro</button>
        </div>
        <div class="mt-2">
            <strong>Total: $<span id="carrito-total">0</span></strong>
        </div>
        <button class="btn btn-success btn-sm w-100 mt-2 carrito-finalizar">Finalizar compra</button>
    </div>
