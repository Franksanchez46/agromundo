@extends('layouts.app')

@section('content')
<!-- Sección Historia -->
<section class="hero">
  <div class="hero-container">
    <div class="hero-text">
      <h1>Historia</h1>
      <p>
        Fundada en 1996, nuestra empresa ha estado al servicio del sector agropecuario por más de dos décadas,
        brindando productos de alta calidad para el desarrollo sostenible de la ganadería y la agricultura.
        Nos especializamos en la venta de abonos, concentrados para animales, herramientas y todo lo necesario para
        impulsar la productividad del campo. Con una sede central que nos permite atender de forma cercana y eficiente
        a nuestros clientes, trabajamos cada día con compromiso, experiencia y pasión por el crecimiento del agro.
        Nuestra misión es ser aliados confiables para agricultores y ganaderos, ofreciendo soluciones que marquen la
        diferencia en sus labores diarias.
      </p>
    </div>
       <div class="image-stack">
      <img src="{{ asset('nosotros/chunky.jpg') }}" alt="Imagen de empresa agropecuaria" class="img-1"> 
      <img src="{{ asset('nosotros/chunky1.jpg') }}" alt="Imagen de empresa agropecuaria" class="img-2">
      <img src="{{ asset('nosotros/oh.jpg') }}" alt="Imagen de empresa agropecuaria" class="img-3">
    </div>
  </div>
</section>


<!-- Sección Misión y Visión -->
<section class="mission">
  <div class="mission-title">
    <h2>Misión y Visión</h2>
  </div>
  <div class="contenedor-tarjetas">
    <div class="tarjeta">
      <h3>Misión</h3>
      <p>
        Ofrecer productos y servicios de alta calidad para la ganadería y la agricultura, actuando como aliados
        estratégicos de agricultores y ganaderos. Trabajamos con pasión, experiencia y responsabilidad para impulsar un
        agro más eficiente, sostenible y próspero.
      </p>
    </div>

    <div class="tarjeta">
      <h3>Visión</h3>
      <p>
        Ser líderes reconocidos en el sector agropecuario por nuestra calidad, compromiso y cercanía, contribuyendo al
        desarrollo sostenible del campo colombiano y al bienestar de quienes lo trabajan, mediante soluciones
        innovadoras que fortalezcan la productividad y el crecimiento rural.
      </p>
    </div>
  </div>
</section>

<!-- Sección Valores Corporativos -->
<section class="valores">
  <h2 class="valores-titulo">Nuestros Valores</h2>
  <div class="valores-lista">
    <div class="valor-item">
      <h3>Compromiso</h3>
      <p>Nos dedicamos con responsabilidad al crecimiento del campo colombiano.</p>
    </div>
    <div class="valor-item">
      <h3>Innovación</h3>
      <p>Adoptamos tecnologías y soluciones modernas para mejorar la productividad agrícola y ganadera.</p>
    </div>
    <div class="valor-item">
      <h3>Sostenibilidad</h3>
      <p>Promovemos prácticas que respetan el medio ambiente y garantizan un futuro sostenible.</p>
    </div>
    <div class="valor-item">
      <h3>Cercanía</h3>
      <p>Valoramos las relaciones humanas, ofreciendo atención personalizada y honesta.</p>
    </div>
  </div>
</section>


<!-- Sección Futuro del Agro -->
<section class="future">
  <div class="future-content">
    <h2>El Futuro del Agro</h2>
    <p>
      Apostamos por la innovación y sostenibilidad para transformar el campo colombiano. Nuestra visión incluye el uso
      de nuevas tecnologías, capacitación constante y soluciones ecológicas que fortalezcan el trabajo rural y garanticen
      un desarrollo productivo, eficiente y responsable con el medio ambiente.
    </p>
  </div>
</section>
@endsection
