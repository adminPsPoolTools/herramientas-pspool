@extends('layouts.app')

@section('content')
    @php
        $userEncoded = base64_encode($user);
    @endphp
    <main class="home">

        <x-header-herramientas class="py-5 titulo"
            background="background-image: url({{ asset('storage/img/home/home.jpg') }})" title="Tips Tratamiento del agua"
            description="Consejos útiles sobre el tratamiento del agua" :user="$user" />

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

            <h4 class="pt-3">VALORES CORRECTOS DEL AGUA Y CÁLCULO DEL <strong>ÍNDICE DE LANGELIER</strong></h4>
            <div class="mt-5 mb-5 container-wrapper">
                <img src="storage/img/tips/tratamiento/filtracion/langelier.png" alt="plano-topclean" class="image">
                <div class="alineacion-centro">
                    <p>Los valores correctos para un agua de piscina según la normativa son los siguientes:</p>
                    <ul>
                        <li>pH: 7,2 - 8,0 ppm</li>
                        <li>Cloro libre: 0,5 - 2,0 Cl2 mg/l</li>
                        <li>redOx : entre 250 y 900 mV</li>
                        <li>Cloro combinado: máximo 0,6 Cl2 mg/l</li>
                        <li>Ácido isocianúrico: =< 75 mg/l</li>
                        <li>Índice Langelier: entre -0,3 y +0,3</li>
                    </ul>
                </div>
            </div>

            <hr>

            <h4 class="pt-3"><strong>El ÍNDICE LANGELIER (ISL)</strong> indica la capacidad corrosiva o incrustante de un
                agua</h4>
            <div class="mt-5 mb-5 container-wrapper">
                <div class="alineacion-centro">
                    <p>Para determinar el Índice Langelier es necesario medir los siguientes parámetros: el pH, la
                        alcalinidad, la dureza, la
                        salinidad y la temperatura. El valor perfecto sería 0, que correspondería a un agua total y
                        perfectamente equilibrada.</p>

                    <p><strong>pH</strong> : el valor adecuado está entre 7 y 8 (agua neutra). Por debajo de 7 será ácida,
                        siendo irritante para las personas y
                        corrosiva para los metales. Por encima de 8 será alcalina, también irritante para las personas e
                        incrustante para las
                        instalaciones (produciendo precipitación de cal y otras sales.</p>

                    <p><strong>Temperatura:</strong>influye en el índice Langelier y por tanto en el pH ideal. Cuanto mayor
                        sea la temperatura del agua,
                        menor será el pH ideal, por lo que en agua frías hay que subir el pH para mantener el equilibrio.
                    </p>

                    <p><strong>Dureza:</strong>Se mide la cantidad de carbonatos, clasificando las aguas en duras (con mucha
                        cal) o blandas (con poca cal).</p>
                    <p><strong>Alcalinidad:</strong> Se mide la concentración de bicarbonatos presentes en el agua. La
                        alcalinidad del agua de aporte debe de estar entre 80-120 ppm. para mantener un agua equilibrada.
                    </p>
                    <p><strong>Salinidad:</strong> A mayor aumento de la conductividad del agua, ésta se volverá más
                        corrosiva y habrá que subir el valor del pH para compensar, por lo que a mayor salinidad mayor será
                        el pH ideal.</p>
                </div>
            </div>
            <hr>

            <h4 class="pt-3">LA <strong>FÓRMULA</strong> PARA CALCULAR EL ÍNDICE LANGELIER ES LA SIGUIENTE:</h4>
            <div class="mt-5 mb-5 container-wrapper">
                <img src="storage/img/tips/tratamiento/filtracion/langelier-formula.png" alt="plano-topclean"
                    class="image">
                <div class="alineacion-centro">
                    <p>Los valores correctos para un agua de piscina según la normativa son los siguientes:</p>
                    <ul>
                        <li><strong>ISL</strong> = Índice de saturación o de LANGELIER</li>
                        <li><strong>pH </strong> = Valor del pH del agua</li>
                        <li><strong>CT </strong> = Coeficiente de temperatura del agua °C</li>
                        <li><strong>CD </strong> = Coeficiente de Dureza cálcica</li>
                        <li><strong>CA </strong> = Coeficiente de Alcalinidad Carbonatada</li>
                        <li><strong>12,2 </strong> = Constante correctora aplicable a piscinas y spas</li>
                    </ul>
                </div>
            </div>

            <hr>

            <h4 class="pt-3">El índice Langelier (LSI): el secreto de un agua perfectamente equilibrada</h4>
            <div class="mt-5 mb-5 container-wrapper">
                <div class="w-full alineacion-centro">
                    <iframe width="560" height="315"
                        src="https://www.youtube.com/embed/B2M9i-LtbfU?si=IWZmzrTM7rmu_21P" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>

            <hr>
            <a href="{{ route('tips.tratamiento.index', ['user' => $userEncoded]) }}" class="mt-2 btn-volver">Volver</a>

        </div>
    </main>
@endsection
