 {{-- resources/views/components/cart-modal.blade.php --}}
<div id="cart-modal" class="modal-cat">
    <div class="modal-contenido-cat" style="min-width: 350px; position: relative;">
        <span class="cerrar-cat" onclick="cerrarCarrito()">&times;</span>
        <h4>Carrito de compras</h4>
        <div id="cart-content">
            <!-- Aquí se cargan los productos del carrito por JS -->
        </div>
<div id="cart-footer">
    <div id="cart-total" style="margin-bottom: 10px;"></div>
    <div style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: space-between;">
        <button class="btn btn-danger" style="flex: 1; min-width: 140px;" onclick="vaciarCarrito()">Vaciar carrito</button>
        <div id="epayco-button-container" style="flex: 1; min-width: 140px; display: flex; justify-content: center;"></div>
    </div>
</div>

    </div>
</div>