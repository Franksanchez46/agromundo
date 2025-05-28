@extends('layouts.app')

@section('content')

<main>
    <div class="perfil-container">
        <h1>Inicio de sesión y seguridad</h1>

        {{-- Mostrar mensajes de éxito --}}
{{--         @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
 --}}
        {{-- Mostrar errores de validación --}}
{{--         @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form action="{{ route('usuario.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="section">
                <label for="name"><strong>Nombre</strong></label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-control perfil-input">
            </div>
            
            <div class="section">
                <label for="email"><strong>Email</strong></label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="form-control perfil-input">
            </div>
            
            <div class="section">
                <label for="telefono"><strong>Número de celular</strong></label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $user->telefono) }}" class="form-control perfil-input">
            </div>
            
            <div class="section">
                <label for="password"><strong>Nueva contraseña</strong></label>
                <input type="password" id="password" name="password" class="form-control perfil-input" placeholder="Nueva contraseña">
            </div>
            
            <div class="section">
                <label for="password_confirmation"><strong>Confirmar nueva contraseña</strong></label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control perfil-input" placeholder="Repetir la nueva contraseña">
            </div>
            
            <div class="text-center mt-4">
                <button type="submit" class="btn-actualizar">Actualizar</button>
            </div>
        </form>
    </div>
</main>

@endsection
