@extends('layouts.app')   {{-- Usa tu layout principal --}}

@section('content')
<div class="container py-5 text-center">
    <h2 class="mb-3">¡Gracias por tu compra! 🥳</h2>

    <p>Tu pago se está procesando.  
       En cuanto ePayco confirme la transacción, te enviaremos la información a tu correo.</p>

    <a href="{{ url('/inicio') }}" class="btn btn-primary mt-4">Volver al inicio</a>
</div>


<h1>Gracias por tu compra</h1>
<p><strong>Estado:</strong> {{ request('x_response') }}</p>
<p><strong>Referencia:</strong> {{ request('x_ref_payco') }}</p>
<p><strong>Total:</strong> {{ request('x_amount') }}</p>

@endsection
