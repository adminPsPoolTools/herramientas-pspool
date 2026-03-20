@extends('layouts.app')

@section('content')

@php
$userEncoded = base64_encode($user);
@endphp

<main class="home">


    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Guías Filtros Calplas"
        description="Aquí dispones de una tabla con todos los filtros de calplas" :user="$user" />

    <div class="py-5 album bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">

                <div class="mb-2 col">
                    <div class="shadow-blue card">
                        <div class="card-body">
                            <h4>Filtros para piscina residencial</h4>
                            <p class="card-text">Conoce la tablas de filtros calplas que disponemos</p>
                        </div>
                        <div class="card-img" style="background-image:url(storage/img/calplas-afm.jpg);">
                            <form id="" method="GET" action="" target="_blank">
                                @csrf
                                <input type="hidden" name="id" value="">
                                <a href="{{ route('guias.filtros.privado', ['user' => $userEncoded]) }}" type="button"
                                    class="btn btn-acceder shadow-blue ">ACCEDE</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mb-2 col">
                    <div class="shadow-blue card">
                        <div class="card-body">
                            <h4>Filtros para piscina pública</h4>
                            <p class="card-text">Conoce la tablas de filtros calplas que disponemos</p>
                        </div>
                        <div class="card-img" style="background-image:url(storage/img/calplas-afm.jpg);">
                            <form id="" method="GET" action="" target="_blank">
                                @csrf
                                <input type="hidden" name="id" value="">
                                <a href="{{ route('guias.filtros.publico', ['user' => $userEncoded]) }}" type="button"
                                    class="btn btn-acceder shadow-blue ">ACCEDE</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mb-2 col">
                    <div class="shadow-blue card">
                        <div class="card-body">
                            <h4>Filtros de alto rendimiento para piscina pública</h4>
                            <p class="card-text">Conoce la tablas de filtros calplas que disponemos</p>
                        </div>
                        <div class="card-img" style="background-image:url(storage/img/calplas-afm.jpg);">
                            <form id="" method="GET" action="" target="_blank">
                                @csrf
                                <input type="hidden" name="id" value="">
                                <a href="{{ route('guias.filtros.alto-rend', ['user' => $userEncoded]) }}" type="button"
                                    class="btn btn-acceder shadow-blue ">ACCEDE</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('guias.index' , ['user' => $userEncoded]) }}" class="btn-volver">Volver</a>
        </div>
    </div>
</main>
@endsection
