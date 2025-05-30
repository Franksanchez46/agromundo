 {{-- resources/views/components/cart-modal.blade.php --}}
<div id="cart-modal" class="modal-cat">
    <div class="modal-contenido-cat" style="min-width: 350px; position: relative;">
        <span class="cerrar-cat" onclick="cerrarCarrito()">&times;</span>
        <h4>Carrito de compras</h4>
        <div id="cart-content">
            <!-- Aquí se cargan los productos del carrito por JS -->
        </div>
        <div id="cart-footer">
            <div id="cart-total"></div>
            <button class="btn btn-danger" onclick="vaciarCarrito()">Vaciar carrito</button>
        </div>
    </div>
</div>