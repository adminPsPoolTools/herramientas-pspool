@extends('layouts.app')

@section('content')

<main class="home">

    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Guías rápidas"
        description="Ps Pool quiere ofrecerte guías rápidas de productos para que encuentres tu producto facilmente"
        :user="$user" />

    <div class="py-5 album bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                <div class="mb-2 col">
                    <div class="shadow-blue card">
                        <div class="card-body">
                            <h4>Guía filtros Calplas</h4>
                            <p class="card-text">Conoce la tablas de filtros calplas que disponemos</p>
                        </div>
                        <div class="card-img" style="background-image:url(storage/img/calplas-afm.jpg);">
                            <form id="" method="GET" action="" target="_blank">
                                @csrf
                                <input type="hidden" name="id" value="">
                                <a href="{{ route('guias.filtros.index', ['user' => $user]) }}" type="button"
                                    class="btn btn-acceder shadow-blue ">ACCEDE</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mb-2 col">
                    <div class="shadow-blue card">
                        <div class="card-body">
                            <h4>Guía Bombas SACI</h4>
                            <p class="card-text">Echa un vistazo a las bombas SACI en esta guía rápida</p>
                        </div>
                        <div class="card-img" style="background-image:url(storage/img/bombas-saci.jpg);">
                            <form id="" method="GET" action="" target="_blank">
                                @csrf
                                <input type="hidden" name="id" value="">
                                <a href="{{ route('guias.bombas.saci.index', ['user' => $user]) }}" type="button"
                                    class="btn btn-acceder shadow-blue ">ACCEDE</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mb-2 col">
                    <div class="shadow-blue card">
                        <div class="card-body">
                            <h4>Guía Cloradores salinos</h4>
                            <p class="card-text">Echa un vistazo a los cloradores en esta guía rápida</p>
                        </div>
                        <div class="card-img" style="background-image:url(storage/img/sugar-valley.png);">
                            <form id="" method="GET" action="" target="_blank">
                                @csrf
                                <input type="hidden" name="id" value="">
                                <a href="{{ route('guias.cloradores.index', ['user' => $user]) }}" type="button"
                                    class="btn btn-acceder shadow-blue ">ACCEDE</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="mb-2 col">
                    <div class="shadow-blue card">
                        <div class="card-body">
                            <h4>Guía TopClean</h4>
                            <p class="card-text">Echa un vistazo a los impulsores Topclean en esta guía rápida</p>
                        </div>
                        <div class="card-img" style="background-image:url(storage/img/topclean.jpg);">
                            <form id="" method="GET" action="" target="_blank">
                                @csrf
                                <input type="hidden" name="id" value="">
                                <a href="{{ route('guias.topclean.index', ['user' => $user]) }}" type="button"
                                    class="btn btn-acceder shadow-blue ">ACCEDE</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <x-boton-volver :user="$user" />
        </div>
    </div>
</main>
@endsection
