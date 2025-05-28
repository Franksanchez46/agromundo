<!-- resources/views/productos/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Lista de Productos</h1>
    
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Categoría</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->descripcion }}</td>
                    <td>{{ $producto->precio }}</td>
                    <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
