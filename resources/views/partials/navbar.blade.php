@if (Auth::check())
    @if (Auth::user()->rol_id === 1)
        @include('partials.navbar_admin') {{-- administrador --}}
    @else
        @include('partials.navbar_user') {{-- usuario normal --}}
    @endif
@else
    @include('partials.navbar_public') {{-- visitante no autenticado --}}
@endif
