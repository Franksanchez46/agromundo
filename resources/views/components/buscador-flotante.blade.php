{{-- resources/views/components/buscador-flotante.blade.php --}}
<div id="buscador-flotante" class="buscador-flotante">
    <form action="{{ route('busqueda.global') }}" method="GET" class="buscador-flotante-form">
        <input type="text" name="q" class="form-control buscador-flotante-input" placeholder="Buscar productos, categorías, etc..." required>
        <button type="submit" class="btn btn-primary buscador-flotante-btn">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </form>
</div>