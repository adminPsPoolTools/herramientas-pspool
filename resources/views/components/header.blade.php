@props(['user'])

@php
$userEncoded = base64_encode($user);
@endphp

<header class="py-5 titulo cabhome" style="{{ $background }}">
    <div class="row">
        <div class="col container-wrapper">
            <div class="container_titulo">
                <div class="texto">
                    <h1>{{ $title }}</h1>
                    <p>{{ $description }}</p>
                    <div class="flecha"><img src="{{ asset('storage/img/flecha.png')}}"></div>
                </div>
            </div>
            <div class="container_menu">
                <nav class="menu">
                    <ul class="mb-0 d-flex list-unstyled">
                        <li class="mx-2">
                            <a href="{{ route('home', ['token' => 'l31ucJISzo6nI4s7y7wpict2EsDtPONc8HeiIXFYHiu59S8ErUUSl9K7pxdjW1Fs', 'user' => $userEncoded ]) }}"
                                class="{{ Route::is('home') ? 'active' : '' }}">
                                Herramientas
                            </a>
                        </li>
                        <li class="mx-2">
                            <a href="{{ route('guias.index', ['token' => 'l31ucJISzo6nI4s7y7wpict2EsDtPONc8HeiIXFYHiu59S8ErUUSl9K7pxdjW1Fs', 'user' => $userEncoded ]) }}"
                                class="{{ Route::is('guias.index') ? 'active' : '' }}">
                                Guías rápidas
                            </a>
                        </li>
                        <li class="mx-2">
                            <a href="{{ route('tips.index', ['token' => 'l31ucJISzo6nI4s7y7wpict2EsDtPONc8HeiIXFYHiu59S8ErUUSl9K7pxdjW1Fs', 'user' => $userEncoded ]) }}"
                                class="{{ Route::is('tips.index') ? 'active' : '' }}">
                                Tips
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>

<style>
    /* General styles */
    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -1rem;
        margin-left: -1rem;
    }

    .col {
        padding-right: 1rem;
        padding-left: 1rem;
        margin-bottom: 1rem;
        /* Espaciado entre columnas */
    }

    .py-5 {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }

    .text-center {
        text-align: center;
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
    }

    .mt-4 {
        margin-top: 1.5rem;
    }

    /* Responsive styles */
    @media screen and (max-width: 1268px) {
        .container-wrapper {
            width: 100%;
            padding: 0 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container_titulo,
        .texto {
            width: 100% !important;
            text-align: center;
            font-size: 18px !important;

        }

        .texto h1 {
            width: 100% !important;
            text-align: left;
            font-size: 40px !important;

        }

        .menu ul {
            flex-direction: column;
            align-items: center;
            width: 100% !important;
        }

        .menu ul li {
            margin: 10px 0;
            width: 100% !important;
            border-bottom: solid 1px white;
        }

        .album {
            margin-top: 100px !important;
        }

        .container_menu {
            width: 100% !important;
        }

    }

    /* Responsive styles */
    @media screen and (max-width: 430px) {
        .container-wrapper {
            width: 100%;
            padding: 0 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container_titulo,
        .texto {
            width: 100% !important;
            text-align: center;
            font-size: 18px !important;

        }

        .texto h1 {
            width: 100% !important;
            text-align: left;
            font-size: 40px !important;

        }

        .menu ul {
            flex-direction: column;
            align-items: center;
            width: 100% !important;
        }

        .menu ul li {
            margin: 10px 0;
            width: 100% !important;
            border-bottom: solid 1px white;
        }

        .album {
            margin-top: 100px !important;
        }

        .container_menu {
            width: 100% !important;
        }

    }

    .menu ul li a {
        display: block;
        padding: 12px 20px;
        background-color: #00598d;
        /* Color azul destacado */
        color: white !important;
        //border-radius: 8px;
        font-size: 18px;
        text-align: center;
        text-decoration: none !important;
        transition: background-color 0.3s ease;
    }

    .menu ul li a:hover {
        background-color: #00598d;
    }

    .menu ul li {
        margin: 0 2px !important;
        text-decoration: none;
    }

    .menu ul li a.active {
        background-color: #000000;
        /* Un tono más oscuro para marcar como activo */
        font-weight: bold;
        box-shadow: 0 0 8px rgba(175, 175, 175, 0.2);
    }
</style>
