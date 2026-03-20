@extends('layouts.app')

@section('content')

<main class="seccion">


    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Estamos en Mantenimiento</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                text-align: center;
                background-color: #f8f9fa;
                color: #333;
                margin: 0;
                padding: 50px;
            }

            .container {
                max-width: 600px;
                margin: auto;
                background: white;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            h1 {
                color: #ff6600;
            }

            p {
                font-size: 18px;
            }

            .loader {
                border: 5px solid #f3f3f3;
                border-top: 5px solid #ff6600;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                animation: spin 1s linear infinite;
                margin: 20px auto;
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }
        </style>
    </head>

    <body>

        <x-header-herramientas class="py-5 titulo"
            background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Configurador de PS COVER"
            description="Configura y calcula tu cubierta." :user="$user" />


        <link rel="stylesheet" type="text/css" href="{{ asset('config/lib/css/configurador.css') }}" />
        <script src="{{ asset('config/lib/js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('config/lib/html2pdf-master/dist/html2pdf.bundle.min.js') }}">
        </script>

        <div class="container">
            <h1>🚧 Sitio en Mantenimiento 🚧</h1>
            <div class="loader"></div>
            <p>Estamos realizando mejoras en nuestra web.</p>
            <p>Gracias por tu paciencia.</p>
        </div>
    </body>

    <div class="salto" style="height: 30px"></div>
    <x-boton-volver :user="$user" />
    <div class="salto" style="height: 40px"></div>

    </html>
    @endsection
