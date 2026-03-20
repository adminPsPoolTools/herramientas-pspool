@extends('layouts.app')

@section('content')
@php
$userEncoded = base64_encode($user);
@endphp
<main class="home">


    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Tips limpiafondos TopClean"
        description="Consejos útiles sobre el limpiafondos Topclean" :user="$user" />

    <style>
        .image {
            margin-right: 20px;
            margin-top: 10px;
            width: 50%;
        }

        .image-caudal {
            margin-right: 20px;
            margin-top: 10px;
            width: 50%;

        }

        .image-small {
            margin-right: 20px;
            width: 50%;
        }

        .alineacion-centro {
            align-content: center;
        }
    </style>

    <div class="container w-8/12 max-w-screen-lg mx-auto mb-4 bg-white contenido">

        <h4 class="pt-3">¿CÓMO CALCULAR LOS IMPULSORES <strong>TOPCLEAN</strong> QUE NECESITA UNA PISCINA?</h4>
        <div class="mt-5 mb-5 container-wrapper">
            <img src="storage/img/tips/topclean/plano-topclean.png" alt="plano-topclean" class="image">
            <div class="alineacion-centro">
                <p>Una distribución adecuada de los impulsores de fondo y su cobertura precisan de un PLANO EXACTO.
                </p>
                <p> El departamento de proyectos de PS Pool te realiza, sin cargo, el plano de distribución de los
                    impulsores Topclean.</p>
                <p> Envíanos las medidas y características de la piscina y nosotros te realizaremos, gratuitamente,
                    un
                    proyecto
                    personalizado.</p>
            </div>
        </div>
        <hr>

        <h4>UBICACIÓN DE LOS IMPULSORES<strong> TOPCLEAN</strong></h4>
        <div class="container-wrapper">
            <div class="alineacion-centro">
                <p>No pueden existir zonas sin cubrir por el radio
                    de acción de los impulsores ya que esas zonas
                    quedarán sin limpiar y será necesario añadir un
                    impulsor más.</p>
            </div>
            <img src="storage/img/tips/topclean/ubicacion-impulsores.png" alt="ubicacion-impulsores" class="image">
        </div>
        <hr>

        <h4>COBERTURA DE LOS IMPULSORES<strong> G4 y G4V</strong></h4>
        <div class="text-center">
            <img src="storage/img/tips/topclean/cobertura-impulsores.png" alt="cobertura-impulsores" class="image">
        </div>
        <hr>

        <h4>CAUDAL DE LOS IMPULSORES<strong> TOPCLEAN</strong></h4>
        <div class="container-wrapper">
            <div>
                <p>Caudal modelo G4 con 4 orificios</p>
                <img src="storage/img/tips/topclean/caudales-impulsores.png" alt="caudal-impulsores"
                    class="image-caudal">
            </div>
        </div>
        <div class="container-wrapper">
            <div>
                <p>Caudal modelo G4V = 3.4 m³/h + efecto venturi</p>
                <img src="storage/img/tips/topclean/caudal-impulsor.png" alt="caudal-impulsor" class="mb-3 image-small">
            </div>
        </div>
        <hr>
        <a href="{{ route('tips.index', ['user' => $userEncoded]) }}" class="mt-2 btn-volver">Volver</a>
    </div>
</main>
@endsection
