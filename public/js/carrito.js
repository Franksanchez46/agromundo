document.addEventListener('DOMContentLoaded', function () {
    let productoActualBtn = null;

    function actualizarContadorCarrito(carrito) {
        const contador = document.getElementById('contador-carrito');
        if (contador) {
            contador.textContent = carrito ? Object.keys(carrito).length : 0;
        }
    }

    // Abrir modal de producto y cargar variantes
    document.querySelectorAll('.ver-mas-btn-cat').forEach(function(btn) {
        btn.addEventListener('click', function() {
            productoActualBtn = btn;
            document.getElementById('modal-producto-cat').classList.add('show');
            document.getElementById('modal-imagen-cat').src = btn.getAttribute('data-imagen');
            document.getElementById('modal-nombre-cat').textContent = btn.getAttribute('data-nombre');
            document.getElementById('modal-descripcion-cat').textContent = btn.getAttribute('data-descripcion');
            document.getElementById('modal-variantes').innerHTML = '';
            document.getElementById('modal-precio-cat').textContent = '';

            const variantes = JSON.parse(btn.getAttribute('data-variantes'));
            if (variantes && variantes.length > 0) {
                let variantesHtml = '<div class="tamanos">';
                variantes.forEach((variante, idx) => {
                    variantesHtml += `<button type="button" class="btn-tamano ${idx === 0 ? 'activo' : ''}" data-precio="${variante.precio}" data-variante="${variante.id}">${variante.tamaño}</button>`;
                });
                variantesHtml += '</div>';
                document.getElementById('modal-variantes').innerHTML = variantesHtml;
                document.getElementById('modal-precio-cat').innerHTML = '$<span class="precio-variante">' + parseInt(variantes[0].precio).toLocaleString('es-CO') + '</span>';
                document.getElementById('modal-agregar-cat').setAttribute('data-variante', variantes[0].id);

                document.querySelectorAll('#modal-variantes .btn-tamano').forEach(function(btnVar) {
                    btnVar.addEventListener('click', function() {
                        document.querySelectorAll('#modal-variantes .btn-tamano').forEach(b => b.classList.remove('activo'));
                        btnVar.classList.add('activo');
                        document.getElementById('modal-precio-cat').innerHTML = '$<span class="precio-variante">' + parseInt(btnVar.getAttribute('data-precio')).toLocaleString('es-CO') + '</span>';
                        document.getElementById('modal-agregar-cat').setAttribute('data-variante', btnVar.getAttribute('data-variante'));
                    });
                });
            } else {
                let precioBase = btn.getAttribute('data-preciobase');
                if (precioBase && parseFloat(precioBase) > 0) {
                    document.getElementById('modal-precio-cat').innerHTML = '$<span class="precio-variante">' + parseInt(precioBase).toLocaleString('es-CO') + '</span>';
                } else {
                    document.getElementById('modal-precio-cat').textContent = 'No disponible';
                }
                document.getElementById('modal-agregar-cat').removeAttribute('data-variante');
            }
        });
    });

    // Cerrar modales
    document.body.addEventListener('click', function(e) {
        if (e.target.classList.contains('cerrar-cat')) {
            let modalProducto = document.getElementById('modal-producto-cat');
            let modalCarrito = document.getElementById('cart-modal');
            if (modalProducto) modalProducto.classList.remove('show');
            if (modalCarrito) modalCarrito.classList.remove('show');
        }
    });

    // Agregar al carrito
    if (document.getElementById('modal-agregar-cat')) {
        document.getElementById('modal-agregar-cat').addEventListener('click', function(e) {
            e.preventDefault();

            if (!productoActualBtn) {
                alert('Error interno: producto no identificado.');
                return;
            }

            // Tomar los datos en español
            const producto_id = productoActualBtn.getAttribute('data-producto');
            const nombre = productoActualBtn.getAttribute('data-nombre');
            const imagen = productoActualBtn.getAttribute('data-imagen');
            const variante_id = document.getElementById('modal-agregar-cat').getAttribute('data-variante') || null;
            const tamañoBtn = document.querySelector('#modal-variantes .btn-tamano.activo');
            const tamaño = tamañoBtn ? tamañoBtn.textContent : '';
            const precio = tamañoBtn ? tamañoBtn.getAttribute('data-precio') : productoActualBtn.getAttribute('data-preciobase');

            if (!producto_id || (!variante_id && tamaño)) {
                alert('Seleccione una variante válida.');
                return;
            }

            // Asignar a variables en inglés para el backend
            const product_id = producto_id;
            const price = precio;
            const quantity = 1; // o la cantidad seleccionada

            // Justo antes del fetch
            console.log('Agregando al carrito:', {
                product_id, variante_id, nombre, tamaño, price, quantity, imagen
            });

            fetch('/carrito/agregar', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    product_id,
                    variante_id,
                    nombre,
                    tamaño,
                    price,
                    quantity,
                    imagen
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    fetch('/carrito/contenido')
                        .then(res => res.json())
                        .then(data => actualizarContadorCarrito(data.carrito));
                    document.getElementById('modal-producto-cat').classList.remove('show');
                    abrirCarrito();
                } else {
                    alert('No se pudo agregar al carrito');
                }
            });
        });
    }

    // Modal del carrito
    window.abrirCarrito = function() {
        document.getElementById('cart-modal').classList.add('show');
        fetch('/carrito/contenido')
            .then(res => res.json())
            .then(data => {
                let html = '';
                let total = 0;
                if (Object.keys(data.carrito).length === 0) {
                    html = '<p>El carrito está vacío.</p>';
                } else {
                    for (let key in data.carrito) {
                        let item = data.carrito[key];
                        total += parseInt(item.price) * parseInt(item.quantity);
                        html += `
    <div style="display:flex;align-items:center;gap:10px;">
        <img src="${item.imagen ? item.imagen : '/ruta/por-defecto.jpg'}" alt="${item.nombre}" style="width:50px;height:50px;object-fit:cover;border-radius:8px;">
        <div>
            <b>${item.nombre}</b> ${item.tamaño ? '(' + item.tamaño + ')' : ''}<br>
Precio: $${!isNaN(item.price) && !isNaN(item.quantity) 
    ? (Number(item.price) * Number(item.quantity)).toLocaleString('es-CO') 
    : '0'}<br>
            Cantidad: 
            <button class="btn-carrito btn-carrito-menos" onclick="actualizarCantidad('${item.product_id}','${item.variante_id}',${item.quantity-1})">-</button>
            <span style="display:inline-block;width:24px;text-align:center;">${item.quantity}</span>
            <button class="btn-carrito btn-carrito-mas" onclick="actualizarCantidad('${item.product_id}','${item.variante_id}',${item.quantity+1})">+</button>
            <button class="btn-carrito btn-carrito-x" onclick="eliminarDelCarrito('${item.product_id}','${item.variante_id}')">&times;</button>
        </div>
    </div>
    <hr>
                        `;
                    }
                }
                document.getElementById('cart-content').innerHTML = html;
                document.getElementById('cart-total').innerHTML = `<b>Total: $${total.toLocaleString('es-CO')}</b>`;
            });
    };

    window.cerrarCarrito = function() {
        document.getElementById('cart-modal').classList.remove('show');
    };

    window.vaciarCarrito = function() {
        fetch('/carrito/vaciar', {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content}
        }).then(() => {
            abrirCarrito();
            fetch('/carrito/contenido')
                .then(res => res.json())
                .then(data => actualizarContadorCarrito(data.carrito));
        });
    };

    window.actualizarCantidad = function(product_id, variante_id, quantity) {
        if (quantity < 1) return;
        fetch('/carrito/actualizar', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({product_id, variante_id, quantity})
        }).then(() => {
            abrirCarrito();
            fetch('/carrito/contenido')
                .then(res => res.json())
                .then(data => actualizarContadorCarrito(data.carrito));
        });
    };

    window.eliminarDelCarrito = function(product_id, variante_id) {
        fetch('/carrito/eliminar', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({product_id, variante_id})
        }).then(() => {
            abrirCarrito();
            fetch('/carrito/contenido')
                .then(res => res.json())
                .then(data => actualizarContadorCarrito(data.carrito));
        });
    };

    // Contador del carrito al cargar la página
    fetch('/carrito/contenido')
        .then(res => res.json())
        .then(data => {
            actualizarContadorCarrito(data.carrito);
        });
});