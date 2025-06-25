document.addEventListener('DOMContentLoaded', function () {
    let productoActualBtn = null;
     const modal = document.getElementById('modal-producto-cat');

    // También puedes cerrar haciendo clic fuera del modal
    window.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    /* ------------------------------------------------------------------
     * 1. CONTADOR DEL CARRITO
     * ------------------------------------------------------------------ */
    function actualizarContadorCarrito(carrito) {
        const contador = document.getElementById('contador-carrito');
        if (contador) {
            contador.textContent = carrito ? Object.keys(carrito).length : 0;
        }
    }

    /* ------------------------------------------------------------------
     * 2. MODAL DEL PRODUCTO
     * ------------------------------------------------------------------ */

document.querySelectorAll('.ver-mas-btn-cat').forEach(function (btn) {
    btn.addEventListener('click', function () {
        productoActualBtn = btn;

        

        const modal = document.getElementById('modal-producto-cat');
        modal.classList.add('show');

        document.getElementById('modal-imagen-cat').src  = btn.dataset.imagen;
        document.getElementById('modal-nombre-cat').textContent = btn.dataset.nombre;
        document.getElementById('modal-descripcion-cat').textContent = btn.dataset.descripcion;

        const contVariantes = document.getElementById('modal-variantes');
        const contPrecio    = document.getElementById('modal-precio-cat');
        const btnAgregar    = document.getElementById('modal-agregar-cat');

        contVariantes.innerHTML = '';
        contPrecio.innerHTML    = '';

        const variantes     = JSON.parse(btn.dataset.variantes || '[]');
        const descuentosObj = JSON.parse(btn.dataset.descuentos || '{}');
        const precioBaseB   = parseFloat(btn.dataset.preciobase || 0);

        if (variantes.length > 0) {
            let variantesHtml = '<div class="tamanos">';
            variantes.forEach((v, idx) => {
                variantesHtml += `
<button type="button"
        class="btn-tamano ${idx===0 ? 'activo' : ''}"
        data-precio="${v.precio}"
        data-variante="${v.id}">
    ${v.tamaño}
</button>`;
            });
            variantesHtml += '</div>';
            contVariantes.innerHTML = variantesHtml;

            const primerVar  = variantes[0];
            const descuento1 = parseFloat(descuentosObj[primerVar.id] || 0);
            pintarPrecio(primerVar.precio, descuento1);

            btnAgregar.dataset.variante = primerVar.id;
            btnAgregar.dataset.precio   = calcularFinal(primerVar.precio, descuento1);

            document.querySelectorAll('#modal-variantes .btn-tamano')
                .forEach(function (btnVar) {
                    btnVar.addEventListener('click', function () {
                        document.querySelectorAll('#modal-variantes .btn-tamano')
                                .forEach(b => b.classList.remove('activo'));
                        btnVar.classList.add('activo');

                        const precioVar   = parseFloat(btnVar.dataset.precio);
                        const idVariante  = btnVar.dataset.variante;
                        const descVar     = parseFloat(descuentosObj[idVariante] || 0);

                        pintarPrecio(precioVar, descVar);
                        btnAgregar.dataset.variante = idVariante;
                        btnAgregar.dataset.precio   = calcularFinal(precioVar, descVar);
                    });
                });
        } else {
            const descuento = 0; // o podrías verificar si hay oferta general
            if (precioBaseB > 0) {
                pintarPrecio(precioBaseB, descuento);
                btnAgregar.dataset.precio = calcularFinal(precioBaseB, descuento);
            } else {
                contPrecio.textContent = 'No disponible';
                delete btnAgregar.dataset.precio;
            }
            delete btnAgregar.dataset.variante;
        }

        function calcularFinal(precio, desc) {
            return Math.round(precio - (precio * (desc / 100)));
        }

        function pintarPrecio(precio, desc) {
            const final = calcularFinal(precio, desc);
            if (desc > 0) {
                contPrecio.innerHTML =
                  `<span id="precio-original-cat" style="text-decoration:line-through;opacity:.6; color:#d01010;">
                      $${Number(precio).toLocaleString('es-CO')}
                   </span>
                   <span id="precio-descuento-cat" style="margin-left:8px;font-weight:bold;color:#106e45">
                      $${Number(final).toLocaleString('es-CO')}
                   </span>`;
            } else {
                contPrecio.innerHTML =
                  `<span id="precio-descuento-cat" style="font-weight:bold">
                      $${Number(precio).toLocaleString('es-CO')}
                   </span>`;
            }
        }
    });

    // dentro del click del ver-mas-btn-cat
const cerrarBtn = modal.querySelector('.cerrar-cat');
if (cerrarBtn) {
    cerrarBtn.addEventListener('click', function () {
        modal.classList.remove('show');
    });
}

});


        /* ------------------------------------------------------------------
 * 4. AGREGAR AL CARRITO
 * ------------------------------------------------------------------ */
if (document.getElementById('modal-agregar-cat')) {
    document.getElementById('modal-agregar-cat').addEventListener('click', function (e) {
        e.preventDefault();

        if (!productoActualBtn) {
            alert('Error interno: producto no identificado.');
            return;
        }

        const producto_id = productoActualBtn.dataset.producto;
        const nombre      = productoActualBtn.dataset.nombre;
        const imagen      = productoActualBtn.dataset.imagen;

        const precio      = this.dataset.precio;               // 👈  ahora siempre el precio con descuento
        const variante_id = this.dataset.variante || null;
        const tamaño      = document.querySelector('#modal-variantes .btn-tamano.activo')
                              ? document.querySelector('#modal-variantes .btn-tamano.activo').textContent
                              : '';

        if (!producto_id) {
            alert('Seleccione una variante válida.');
            return;
        }

        fetch('/carrito/agregar', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                product_id: producto_id,
                variante_id,
                nombre,
                tamaño,
                price: precio,
                quantity: 1,
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


    /* ------------------------------------------------------------------
     * 5. FUNCIONES DEL CARRITO
     * ------------------------------------------------------------------ */
    // === EPAYCO: genera (o regenera) el botón de pago según el total
    function mostrarBotonPago(total) {
        const container = document.getElementById('epayco-button-container');
        if (!container) return;

        container.innerHTML = ''; // Limpia botones anteriores

        // Obtén la public key desde la meta
        const publicKey = document.querySelector('meta[name="epayco-public-key"]').content;

        // 1. Verifica si ya hay un script de ePayco en la página
let oldScript = document.querySelector('script.epayco-button');

// 2. Si existe, elimínalo
if (oldScript) oldScript.remove();

    // ——— limpia scripts anteriores ———
    container.innerHTML = '';
    const old = document.querySelector('script.epayco-button');
    if (old) old.remove();

    // ——— total entero en string ———
    const amount = Math.round(total).toString();      // «4500», «823000», etc.


        const script = document.createElement('script');
        script.src   = "https://checkout.epayco.co/checkout.js";
        script.className = "epayco-button";

        

        script.dataset.epaycoKey            = publicKey;
        script.dataset.epaycoAmount         = total.toFixed();
        script.dataset.epaycoAmount         = total.toString(); // Asegúrate de que sea un string
        script.dataset.epaycoName           = "Carrito Agromundo";
        script.dataset.epaycoDescription    = "Pago de productos";
        script.dataset.epaycoCurrency       = "cop";
        script.dataset.epaycoCountry        = "CO";
        script.dataset.epaycoTest           = "false"; // cambia a "false" en prod
        script.dataset.epaycoExternal       = "false"; // "false" para pagos directos

script.dataset.epaycoResponse = "http://127.0.0.1:8000/pago/respuesta";
        script.dataset.epaycoConfirmation   = "/pago/confirmacion";
        script.dataset.epaycoMethodconfirmation = "GET";

        container.appendChild(script);
    }

    // Abre el modal del carrito y carga contenido
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
        Precio: $${(!isNaN(item.price) && !isNaN(item.quantity) ? (Number(item.price) * Number(item.quantity)).toLocaleString('es-CO') : '0')}<br>
        Cantidad: 
        <button class="btn-carrito btn-carrito-menos" onclick="actualizarCantidad('${item.product_id}','${item.variante_id}',${item.quantity-1})">-</button>
        <span style="display:inline-block;width:24px;text-align:center;">${item.quantity}</span>
        <button class="btn-carrito btn-carrito-mas" onclick="actualizarCantidad('${item.product_id}','${item.variante_id}',${item.quantity+1})">+</button>
        <button class="btn-carrito btn-carrito-x" onclick="eliminarDelCarrito('${item.product_id}','${item.variante_id}')">&times;</button>
    </div>
</div>
<hr>`;
                    }
                }

                document.getElementById('cart-content').innerHTML = html;
                document.getElementById('cart-total').innerHTML = `<b>Total: $${total.toLocaleString('es-CO')}</b>`;

                // === EPAYCO: genera el botón cada vez que se abre/actualiza
                mostrarBotonPago(total);
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

    /* ------------------------------------------------------------------
     * 6. CONTADOR AL CARGAR LA PÁGINA
     * ------------------------------------------------------------------ */
    fetch('/carrito/contenido')
        .then(res => res.json())
        .then(data => {
            actualizarContadorCarrito(data.carrito);
        });

}); // FIN DOMContentLoaded
