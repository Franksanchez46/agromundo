// Referencias a los elementos del carrito
const carritoIcono = document.getElementById('carrito-icono');
const carritoDropdown = document.getElementById('carrito-dropdown');
const listaCarrito = document.getElementById('carrito-lista');
const contadorCarrito = document.getElementById('carrito-contador');
const totalCarrito = document.getElementById('carrito-total');

// Verificar si el usuario está autenticado
const isAuthenticated = document.body.getAttribute('data-authenticated') === 'true';

// Verificar si el usuario está autenticado

// Inicializar carrito vacío
let carrito = [];

// Actualizar el DOM al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    activarBotones();


// Cargar carrito al iniciar
if (isAuthenticated) {
    
    fetch('/cart')
        .then(response => response.json())
        .then(data => {
            
            if (Array.isArray(data.cart)) {
                carrito = data.cart;
                console.log("Carrito cargado desde el servidor:");
                actualizarCarrito(carrito);
            
/*                 // Mostrar automáticamente si hay productos
                if (carrito.length > 0) {
                    setTimeout(() => {
                        carritoDropdown.style.display = 'block';
                    }, 100);
                } */
            }
        })            
        .catch(error => console.error('Error al cargar carrito del servidor:', error));
} else {
    // Si no hay autenticación, simplemente deja el carrito vacío
    carrito = [];
    actualizarCarrito(carrito);
}






    // Evento para vaciar el carrito
    document.getElementById('carrito-vaciar').addEventListener('click', () => {
        carrito = [];

        if (isAuthenticated) {
            fetch('/cart/clear', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                actualizarCarrito(data.cart);
            })
            .catch(error => console.error('Error al vaciar el carrito:', error));
        } else {
            carrito = [];
            actualizarCarrito(carrito);
        }        
    });
});



// Evento para agregar productos al carrito
document.querySelectorAll('.agregar-carrito').forEach(boton => {
    boton.addEventListener('click', e => {
        e.preventDefault();
        const producto = boton.parentElement;
        const nombre = producto.querySelector('h3').textContent;
        const precio = parseInt(producto.querySelector('.precio').textContent.replace('$', '').replace('.', ''));
        const id = boton.getAttribute('data-id');

        const itemExistente = carrito.find(p => p.id === id);
        if (itemExistente) {
            itemExistente.cantidad++;
        } else {
            carrito.push({ id, nombre, precio, cantidad: 1 });
        }

        fetch('/cart/store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                product_id: id,
                quantity: 1,
                price: precio
            })
        })
        .then(response => response.json())
        .then(data => {
            actualizarCarrito(data.cart);
        })
        .catch(error => console.error('Error al agregar producto al carrito:', error));
    });
});

// Evento para mostrar/ocultar el carrito
carritoIcono.addEventListener('click', e => {
    e.preventDefault();
    carritoDropdown.style.display = carritoDropdown.style.display === 'none' ? 'block' : 'none';
});

// Función para actualizar el DOM del carrito
function actualizarCarrito(cart) {
    listaCarrito.innerHTML = '';
    let total = 0;

    if (Array.isArray(cart)) {
        carrito = cart;
    }

    carrito.forEach(item => {
        total += item.precio * item.cantidad;

        const li = document.createElement('li');
        li.className = 'list-group-item';
        li.innerHTML = `
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <strong>${item.nombre}</strong><br>
                <small>$${item.precio.toLocaleString()} x ${item.cantidad} = $${(item.precio * item.cantidad).toLocaleString()}</small>
            </div>
            <div class="btn-group btn-group-sm ms-2">
                <button class="btn btn-outline-secondary restar" data-id="${item.id}">−</button>
                <button class="btn btn-outline-secondary sumar" data-id="${item.id}">+</button>
                <button class="btn btn-outline-danger eliminar" data-id="${item.id}">&times;</button>
            </div>
        </div>
    `;
    
        listaCarrito.appendChild(li);
    });

    contadorCarrito.textContent = carrito.reduce((acc, item) => acc + item.cantidad, 0);
    totalCarrito.textContent = total.toLocaleString();

    if (carrito.length === 0) {
        carritoDropdown.style.display = 'none';
    }

}

// ✅ Función actualizada para activar botones con delegación de eventos
function activarBotones() {
    listaCarrito.addEventListener('click', (event) => {
        const target = event.target;
        const id = parseInt(target.getAttribute('data-id'));

        if (target.classList.contains('sumar')) {
            console.log("Click en botón sumar - ID:", id);
            const producto = carrito.find(p => p.id === id);
            if (producto) {
                producto.cantidad++;
                fetch(`/cart/update/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ quantity: producto.cantidad })
                })
                .then(response => response.json())
                .then(data => actualizarCarrito(data.cart))
                .catch(error => console.error('Error al actualizar cantidad:', error));
            }
        }

        if (target.classList.contains('restar')) {
            console.log("Click en botón restar - ID:", id);
            const producto = carrito.find(p => p.id === id);
            if (producto && producto.cantidad > 1) {
                producto.cantidad--;
                fetch(`/cart/update/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ quantity: producto.cantidad })
                })
                .then(response => response.json())
                .then(data => actualizarCarrito(data.cart))
                .catch(error => console.error('Error al actualizar cantidad:', error));
            }
        }

        if (target.classList.contains('eliminar')) {
            console.log("Click en botón eliminar - ID:", id);
            carrito = carrito.filter(p => p.id !== id);
            fetch(`/cart/destroy/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => actualizarCarrito(data.cart))
            .catch(error => console.error('Error al eliminar producto del carrito:', error));
        }
    });
}
