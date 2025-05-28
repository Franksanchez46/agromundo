/* document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('buscador-navbar');
    const btn = document.getElementById('buscador-btn');
    const resultados = document.getElementById('buscador-resultados');

    function buscar() {
        const q = input.value.trim();
        if (q.length < 2) {
            resultados.style.display = 'none';
            resultados.innerHTML = '';
            return;
        }
        fetch(`/buscar-ajax?q=${encodeURIComponent(q)}`)
            .then(res => res.json())
            .then(data => {
                if (data.length > 0) {
                    resultados.innerHTML = '<ul>' +
                        data.map(item => `<li><a href="/producto/${item.id}">${item.nombre}</a></li>`).join('') +
                        '</ul>';
                } else {
                    resultados.innerHTML = '<p style="padding:10px;">No se encontraron resultados.</p>';
                }
                resultados.style.display = 'block';
            });
    }

    input.addEventListener('input', buscar);
    btn.addEventListener('click', buscar);

    // Ocultar resultados al hacer click fuera
    document.addEventListener('click', function (e) {
        if (!resultados.contains(e.target) && e.target !== input && e.target !== btn) {
            resultados.style.display = 'none';
        }
    });
}); */