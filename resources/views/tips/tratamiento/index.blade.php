@extends('layouts.app')

@section('content')
@php
$userEncoded = base64_encode($user);
@endphp
<main class="home">


    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Tips Tratamiento"
        description="Consejos útiles sobre el tratamiento del agua" :user="$user" />

    <div class="py-5 album bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                <div class="mb-2 col">
                    <div class="shadow-blue card">
                        <div class="card-body">
                            <h4>Tips Filtración</h4>
                            <p class="card-text">Consejos útiles sobre el tratamiento del agua</p>
                        </div>
                        <div class="card-img"
                            style="background-image:url(storage/img/tips/tratamiento/filtracion/filtracion.jpg);">
                            <form id="" method="GET" action="" target="_blank">
                                @csrf
                                <input type="hidden" name="id" value="">
                                <a href="{{ route('tips.tratamiento.filtracion.index', ['user' => $user]) }}"
                                    type="button" class="btn btn-acceder shadow-blue ">ACCEDE</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mb-2 col">
                    <div class="shadow-blue card">
                        <div class="card-body">
                            <h4>Tips Indice langelier</h4>
                            <p class="card-text">Consejos útiles sobre los valores correctos del agua y el calculo del
                                indice de langelier</p>
                        </div>
                        <div class="card-img"
                            style="background-image:url(storage/img/tips/tratamiento/filtracion/langelier.png);">
                            <form id="" method="GET" action="" target="_blank">
                                @csrf
                                <input type="hidden" name="id" value="">
                                <a href="{{ route('tips.tratamiento.langelier.index', ['user' => $user]) }}"
                                    type="button" class="btn btn-acceder shadow-blue ">ACCEDE</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('tips.index', ['user' => $userEncoded]) }}" class="btn-volver">Volver</a>
        </div>
    </div>
</main>
@endsection
