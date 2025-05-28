document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.ver-mas-btn-cat').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.producto;
            const box = btn.closest('.box');

            const nombre = box.querySelector('h3').dataset.fullnombre;
            const descripcion = box.querySelector('.descripcion-corta-cat').dataset.fulltext;
            const precio = box.querySelector('.precio').textContent;
            const imagen = box.querySelector('img').src;

            document.getElementById('modal-nombre-cat').textContent = nombre;
            document.getElementById('modal-descripcion-cat').textContent = descripcion;
            document.getElementById('modal-precio-cat').textContent = precio;
            document.getElementById('modal-imagen-cat').src = imagen;
            document.getElementById('modal-agregar-cat').setAttribute('data-id', id);

            document.getElementById('modal-producto-cat').style.display = 'flex';
        });
    });

    // Cierra el modal al hacer clic en la "X"
    document.querySelector('.cerrar-cat').addEventListener('click', () => {
        document.getElementById('modal-producto-cat').style.display = 'none';
    });

    // Opcional: cerrar haciendo clic fuera del contenido
    document.getElementById('modal-producto-cat').addEventListener('click', (e) => {
        if (e.target === e.currentTarget) {
            e.currentTarget.style.display = 'none';
        }
    });
});
