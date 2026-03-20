@extends('layouts.app')

@section('content')
@php
$userEncoded = base64_encode($user);
@endphp
<main class="home">

    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Guía rápida bombas SACI"
        description="Aquí dispones las guías rapidas de las bombas saci" :user="$user" />

    <div class="py-5 album bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">

                <div class="mb-2 col">
                    <div class="shadow-blue card">
                        <div class="card-body">
                            <h4>Bombas saci para residencial</h4>
                            <p class="card-text">Conoce la tablas de las bombas saci para piscina privada</p>
                        </div>
                        <div class="card-img" style="background-image:url(storage/img/bombas-saci.jpg);">
                            <form id="" method="GET" action="" target="_blank">
                                @csrf
                                <input type="hidden" name="id" value="">
                                <a href="{{ route('guias.bombas.saci.privado', ['user' => $user]) }}" type="button"
                                    class="btn btn-acceder shadow-blue ">ACCEDE</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mb-2 col">
                    <div class="shadow-blue card">
                        <div class="card-body">
                            <h4>Bombas saci para piscina pública</h4>
                            <p class="card-text">Conoce la tablas de las bombas saci para piscina pública</p>
                        </div>
                        <div class="card-img" style="background-image:url(storage/img/bombas-saci.jpg);">
                            <form id="" method="GET" action="" target="_blank">
                                @csrf
                                <input type="hidden" name="id" value="">
                                <a href="{{ route('guias.bombas.saci.publico', ['user' => $user]) }}" type="button"
                                    class="btn btn-acceder shadow-blue ">ACCEDE</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('guias.index', ['user' => $userEncoded]) }}" class="btn-volver">Volver</a>
        </div>
    </div>
</main>
@endsection
