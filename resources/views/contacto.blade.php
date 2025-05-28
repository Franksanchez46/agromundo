@extends('layouts.app')

@section('title', 'Contacto - Agromundo')

@section('content')
@php
    // Reemplaza este número por tu WhatsApp (código país + número, sin "+")
    $whatsappNumber = '57XXXXXXXXXX';
    // Mensaje inicial que verá el cliente en el chat
    $preMessage = '¡Hola!%20Quisiera%20más%20información%20sobre%20Agromundo.';
    $whatsappUrl = 'https://wa.me/qr/MMBO5JXZKSADD1' . $whatsappNumber . '&text=' . $preMessage;
@endphp

<div class="container py-5">
    <div class="text-center mb-4">
        <h1 class="text-success">Contáctanos</h1>
        <p class="fs-5">¿Tienes alguna duda o necesitas asesoría? Escríbenos por WhatsApp:</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-6 text-center">
            <a href="{{ $whatsappUrl }}" target="_blank" class="btn btn-success btn-lg">
                Enviar mensaje por WhatsApp
            </a>
        </div>
    </div>
</div>
@endsection
