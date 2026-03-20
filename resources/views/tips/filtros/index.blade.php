@extends('layouts.app')

@section('content')
@php
$userEncoded = base64_encode($user);
@endphp
<main class="home">

    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Tips Filtros"
        description="Consejos útiles para elegir el filtro laminado más adecuado" :user="$user" />


    <style>
        .image {
            margin-right: 20px;
            margin-top: 10px;
            width: 30%;
        }

        .image-big {
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

        <h4 class="pt-3">¿CÓMO SABER CUÁL ES EL <strong>FILTRO LAMINADO</strong> MÁS ADECUADO PARA CADA PISCINA?</h4>
        <div class="mt-5 mb-5 container-wrapper">
            <img src="storage/img/tips/filtros/filtro-1.png" alt="filtro-1" class="image">
            <div class="alineacion-centro">
                <h4>LOS DATOS NECESARIOS PARA CALCULAR EL FILTRO SON LOS SIGUIENTES:</h4>
                <ol>
                    <li>
                        <p>Volumen de agua en m³</p>
                    </li>
                    <li>
                        <p>Tiempo de recirculación en horas Piscinas privadas: se recomienda máximo 6 h Piscinas
                            públicas: según normativa</p>
                    </li>
                    <li>
                        <p>Caudal en m³/h</p>
                    </li>
                    <li>
                        <p>Velocidad de filtración en m³/h/m² (entre 20 y 30)</p>
                    </li>
                    <li>
                        <p>Superficie filtrante en m²</p>
                    </li>
                </ol>
            </div>
        </div>

        <div class="mb-2 alineacion-centro">
            <h4>EJEMPLO:</h4>
            <ul>
                <li>
                    <p>Volumen = 100 m³</p>
                </li>
                <li>
                    <p>Tiempo de recirculación = 5 h</p>
                </li>
                <li>
                    <p>Caudal = 100m³ / 5 h = 20 m³/h</p>
                </li>
                <li>
                    <p>Velocidad de filtración = 25 m³/h/m²</p>
                </li>
                <li>
                    <p>Superficie filtrante = 20 m³/h /25 m³/h/m² = 0.8 m² = <strong>1 filtro de Ø1010 mm ó 2 filtros de
                            Ø720 mm</strong></p>
                </li>
            </ul>
        </div>
        <hr>

        <h4 class="mt-2">¿CUÁLES SON LAS VELOCIDADES ADECUADAS PARA <strong>FILTRACIÓN Y LAVADO</strong>?</h4>
        <p>Para estar seguro de que la filtración se ha realizado correctamente y el filtro queda totalmente limpio
            con
            el lavado es fundamental respetar las velocidades a las que se deben realizar estos procesos:</p>
        <div class="text-center">
            <img src="storage/img/tips/filtros/filtro-2.png" alt="filtro-2" class="mb-2 image-big">
        </div>

        <hr>
        <a href="{{ route('tips.index', ['user' => $userEncoded]) }}" class="mt-2 btn-volver">Volver</a>
    </div>
</main>
@endsection