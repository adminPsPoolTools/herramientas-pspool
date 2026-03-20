@extends('layouts.app')

@section('content')

<main class="seccion">

    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Configurador de PS COVER"
        description="Configura y calcula tu cubierta." :user="$user" />

    <link rel="stylesheet" type="text/css" href="{{ asset('config/lib/css/configurador.css') }}" />
    <script src="{{ asset('config/lib/js/jquery.min.js') }}"></script>
    <script src="{{ asset('config/lib/js/scriptPS.JS') }}"></script>
    <script type="text/javascript" src="{{ asset('config/lib/html2pdf-master/dist/html2pdf.bundle.min.js') }}"></script>

    <div class="container max-w-screen-lg mx-auto mb-4 w-12/12 contenido">
        <div class="px-4 caja">
            <div id="errormail" class="enespera" style="z-index: 1002;">
                <div class="error"><img src="img/checkko.png" align="absmiddle"><br>
                    <div id="errortxt"></div>
                </div>
            </div>
            <div id="correcto" class="enespera" style="z-index: 1002;">
                <div class="correcto"><img src="img/checkok.png" align="absmiddle"><br>La información ha sido enviada
                </div>
            </div>

            <form name="formdatos" id="formdatos" method="post">
                <input type="hidden" name="MODELO" id="tipoCubierta">
                <input type="hidden" name="SUBTIPO" id="deltaltea"> <!-- Submodelo -->
                <input type="hidden" name="PROFUNDIDAD_TAPA" id="profundidadTapa"> <!-- Submodelo -->
                <input type="hidden" name="PROFUNDIDAD_PIS" id="profundidadPis"> <!-- Submodelo -->
                <input type="hidden" name="CONVIGA" id="conViga"> <!-- viga [true/false] -->
                <input type="hidden" name="CONTAPA" id="conTapa"> <!-- tapa [true/false] -->
                <input type="hidden" name="ANCHOPISCINA" id="anchoPiscina"> <!-- Ancho de la piscina -->
                <input type="hidden" name="LARGOPISCINA" id="largoPiscina"> <!-- Altura de la piscina -->
                <input type="hidden" name="ANCHOESCALERA" id="anchoEscalera"> <!-- Ancho de la escalera -->
                <input type="hidden" name="LARGOESCALERA" id="largoEscalera"> <!-- Altura de la escalera -->
                <input type="hidden" name="TIPOESCALERA" id="posicionEscalera"> <!-- Posición de la escalera [F|D] -->
                <input type="hidden" name="posescalera" id="posescalera">
                <input type="hidden" name="SENTIDOESCALERA" id="sentidoEscalera"> <!-- Sentido de la escalera [s|n] -->
                <input type="hidden" name="ESCALERAROMANA" id="escaleraromana"> <!-- Escalera romana -->
                <input type="hidden" name="TIPOLAMINA" id="tipoLamina"> <!-- Material lámina -->
                <input type="hidden" name="COLORLAMINA" id="colorLamina"> <!-- Color lámina -->
                <input type="hidden" name="TIPOINSTALACION" id="tipoInsta"> <!-- Tipo de instalacion -->
                <input type="hidden" name="PROVINCIA" id="provinciaPrecio"> <!-- Provincia -->
                <input type="hidden" name="IMPORTEINSTALACION" id="instaprecio"> <!-- Precio de instalación -->
                <input type="hidden" name="DATOSCLIENTEFINAL" id="datoscliente"> <!-- Precio de instalación -->
                <input type="hidden" name="DESCRIPCION" id="descripcion"> <!-- Precio de instalación -->
                <input type="hidden" name="TIPO_TAPA" id="tipoTapa"> <!-- Tipo de tapa -->
                <input type="hidden" name="TIPO_PISCINA" id="tipoPiscina"> <!-- Tipo de tapa -->
                <input type="hidden" name="TIPO" id="TIPO"> <!-- tipo para enviar datos: [1|2] -->
                <input type="hidden" name="user" id="user" value="{{ $user }}">
            </form>

            <div class="salto" style="height: 30px;"></div>

            <div id="configurador">

                <!---------------------------------------->
                <!--              CUBIERTA              -->
                <!---------------------------------------->

                @include('configuradorpscover.cubierta')

                <!---------------------------------------->
                <!--              PISCINA               -->
                <!---------------------------------------->

                @include('configuradorpscover.piscina')


                <!---------------------------------------->
                <!--              ESCALERA              -->
                <!---------------------------------------->

                @include('configuradorpscover.escalera')

                <!---------------------------------------->
                <!--               LAMINA               -->
                <!---------------------------------------->

                @include('configuradorpscover.laminas')

                <!---------------------------------------->
                <!--            INSTALACIÓN             -->
                <!---------------------------------------->

                @include('configuradorpscover.instalacion')


                <!---------------------------------------->
                <!--            PRECIO PVP              -->
                <!---------------------------------------->

                @include('configuradorpscover.precioPVP')

                <!---------------------------------------->
                <!--            PRECIO PNC              -->
                <!---------------------------------------->

                @include('configuradorpscover.precioPNC')


                <!---------------------------------------->
                <!--           DATOS CLIENTE            -->
                <!---------------------------------------->


                @include('configuradorpscover.datoscliente')

                <!---------------------------------------->
                <!--             IMPRIMIR               -->
                <!---------------------------------------->

                @include('configuradorpscover.imprimir')

                <!---------------------------------------->
                <!--             FINAL                  -->
                <!---------------------------------------->

                @include('configuradorpscover.final')


            </div>
            {{-- @if(isset($user))
            <script>
                console.log('{{ $user }}');
            </script>
            @endif --}}
            <div class="salto" style="height: 30px"></div>
            <x-boton-volver :user="$user" />
            <div class="salto" style="height: 40px"></div>

        </div>
    </div>
</main>

@endsection

<style>
    .flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    /* Responsive styles */
    @media screen and (max-width: 1268px) {
        .boton-s {
            width: 100%;
            margin-top: 10px;
        }

        #delta {
            flex-direction: column;
            gap: 10px;
        }

        .switch {
            transform: scale(0.8);
            align-items: center;
        }

        .nombrecheck {
            font-size: 14px !important;
            text-align: left !important;
        }

        .titulo-modelo {
            text-align: left;
        }

        .flex {
            display: inline-block;
        }

        #presupuesto,
        #presupuestoPVP,
        .mostrar_neto {
            font-size: 20px !important;
            float: inherit !important;
            padding: 0px !important;
            text-align: center;
            margin-top: 5px;

        }

        #dibuimprimir,
        #dibuinstalacion,
        #dibuprecio,
        #calculadora {
            display: none;
        }


        .formtemp {
            float: inherit !important;
            width: 100% !important;
            padding: 40px !important;

        }

        #btnimprimirA {
            width: 100%;
        }
    }
</style>
