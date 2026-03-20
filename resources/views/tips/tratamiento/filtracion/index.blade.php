@extends('layouts.app')

@section('content')
@php
$userEncoded = base64_encode($user);
@endphp
<main class="home">

    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Tips Tratamiento del agua"
        description="Consejos útiles sobre el tratamiento del agua" :user="$user" />

    <style>
        .image {
            margin-right: 20px;
            margin-top: 10px;
            width: 100%;
        }
    </style>

    <div class="container w-8/12 max-w-screen-lg mx-auto mb-4 bg-white contenido">

        <h4 class="pt-3">LA PIRAMIDE DE LA <strong>FILTRACIÓN</strong><br>¿CÓMO CONSEGUIR AGUA LIMPIA Y SALUDABLE?</h4>
        <div class="mt-5 mb-5 container-wrapper">
            <img src="storage/img/tips/tratamiento/filtracion/piramide-1.png" alt="plano-topclean" class="image">

        </div>
        <hr>

        <div class="mt-5 mb-5 container-wrapper">
            <img src="storage/img/tips/tratamiento/filtracion/piramide-2.png" alt="plano-topclean" class="image">

        </div>


        <hr>
        <a href="{{ route('tips.tratamiento.index', ['user' => $userEncoded]) }}" class="mt-2 btn-volver">Volver</a>

    </div>
</main>
@endsection
