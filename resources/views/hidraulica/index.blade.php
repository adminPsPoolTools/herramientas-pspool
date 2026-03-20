@extends('layouts.app')

@section('content')
<main class="seccion">

    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})"
        title="Configura el filtro y la bomba"
        description="Calcula el filtro y la bomba necesarias para tu instalación." :user="$user" />

    <div class="container w-10/12 max-w-screen-lg mx-auto mb-4 contenido">
        <div class="p-4 px-4 mb-0 caja md:p-8">
            <form action="{{ route('hidraulica.calculo') }}" id="formulario-calculo" method="get">

                <div class="grid gap-4 mb-2">
                    <div>
                        <label for="tipo_piscina" class="block text-sm font-medium text-gray-700">Tipo de
                            piscina</label>
                        <select name="tipo_piscina" id="tipo_piscina" onchange="toggleInput()"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="privada">Privada</option>
                            {{-- <option value="publica">Pública</option> --}}
                        </select>
                        <span class="text-sm text-red-500" id="error-tipo_piscina"></span>
                    </div>
                </div>

                <div class="grid gap-4 md:grid-cols-2">

                    <div>
                        <label for="superficie" class="block text-sm font-medium text-gray-700">Lámina de agua
                            m²</label>
                        <input type="number" name="superficie" id="superficie" step="any" min="0" step="0.1"
                            class="w-full h-10 px-4 mt-1 border bg-gray-50" value="32" placeholder="" />
                        @error('superficie')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="profundidad" class="block text-sm font-medium text-gray-700">Profundidad
                            media</label>
                        <input type="number" name="profundidad" id="profundidad" step="0.1" min="0"
                            class="w-full h-10 px-4 mt-1 border bg-gray-50" value="1.50" placeholder="" />
                        @error('profundidad')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="desbordante" class="block text-sm font-medium text-gray-700">¿Es
                            desbordante?</label>
                        <select name="desbordante" id="desbordante" onchange="toggleInput()"
                            class="w-full h-10 px-5 mt-1 border bg-gray-50">
                            <option value="no">No</option>
                            <option value="si">Sí</option>
                        </select>
                        @error('superficie')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="block" id="container_deposito">
                        <label for="volumen_deposito" class="text-sm font-medium text-gray-700">Volumen del
                            depósito</label>
                        <input type="number" name="volumen_deposito" id="volumen_deposito" step="0.1" min="0"
                            class="w-full h-10 px-2 mt-1 border bg-gray-50" value="0" placeholder="" />
                        @error('profundidad')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- --}}
                    {{-- Segunda fila --}}
                    <div>
                        <label for="tiempo" class="block text-sm font-medium text-gray-700">Horas
                            recirculación</label>
                        <input type="number" name="tiempo" id="tiempo" step="0.1" min="0"
                            class="w-full h-10 px-4 mt-1 border bg-gray-50" value="8" placeholder="" />
                        @error('tiempo')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="velocidad_filtrado" class="block text-sm font-medium text-gray-700">Velocidad
                            Filtración</label>
                        <select name="velocidad_filtrado" id="velocidad_filtrado"
                            class="w-full h-10 px-4 mt-1 border w-f bg-gray-50">
                            {{-- <option value="20">20 m³/h/m²</option>
                            <option value="25">25 m³/h/m²</option>
                            <option value="30" selected>30 m³/h/m²</option> --}}
                            <option value="40" selected>40 m³/h/m²</option>
                        </select>
                    </div>
                    <div class="text-right md:col-span-3">
                        <button class="btn-calcular disabled:opacity-25" id="borrarTablaBtn">Calcular</button>
                    </div>
                </div>
                <x-boton-volver :user="$user" />
        </div>
        <div id="resultados" class="grid grid-cols-1 mt-4 md:grid-cols-1">
            <div id="alerta"
                class="justify-between hidden mb-2 text-green-700 bg-green-100 border border-green-400 rounded mar"
                role="alert">
                <div id="resultadoCalculo" class="hidden mt-1 mb-1 ml-3">
                    <p class="text-lg">Resultado de su calculo: </p>
                    <p class="text-lg">El cálculo de la superficie filtrante es: <strong><span
                                id="resultadoFiltro"></span>
                            m²</p></strong>
                    <p class="text-lg">El cálculo del caudal adecuado es: <strong><span id="resultadoBomba">
                                m³/h</span></strong>
                        m³/h</p>
                    <p class="text-lg"><strong>¡Para optimizar la filtración por favor consulte con nosotros al 96 686
                            68
                            15!
                            <strong></p>
                </div>
            </div>
            <div id="tablaResultados" class="justify-between hidden">
                <div class="w-1/2 tabla">
                    <table id="tablaFiltros" class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <tbody id="tbodyFiltro">
                            <!-- Aquí se insertarán las filas de la tabla -->
                            <thead>
                                <tr>
                                    <th colspan="4" class="px-4 py-2 text-left text-white bg-blue-500">Filtros
                                        recomenados
                                    </th>
                                </tr>
                                <tr>
                                    <th class="px-4 py-2 text-white bg-blue-500 border">Descripción</th>
                                    <th class="px-4 py-2 text-white bg-blue-500 border">m²</th>
                                    <th class="px-4 py-2 text-white bg-blue-500 border">URL</th>
                                </tr>
                            </thead>
                        </tbody>
                    </table>
                </div>
                <div class="w-1/2 tabla">
                    <table id="tablaBombas" class="min-w-full bg-white border border-gray-200 rounded-lg">
                        <tbody id="tbodyBomba">
                            <!-- Aquí se insertarán las filas de la tabla -->
                            <thead>
                                <tr>
                                    <th colspan="4" class="px-4 py-2 text-left text-white bg-blue-500">Bombas
                                        recomendadas
                                    </th>
                                </tr>
                                <tr>
                                    <th class="px-4 py-2 text-white bg-blue-500 border">Descripción</th>
                                    <th class="px-4 py-2 text-white bg-blue-500 border">m³/h</th>
                                    <th class="px-4 py-2 text-white bg-blue-500 border">URL</th>
                                </tr>
                            </thead>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> {{-- --}}
    </div>
    </form>
    </div>
    </div>

</main>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function toggleInput() {
        var selectElement = document.getElementById("desbordante");
        var containerVolumenDeposito = document.getElementById("container_deposito");
        var volumenDeposito = document.getElementById("volumen_deposito");
        if (selectElement.value === "si") {
            containerVolumenDeposito.style.display = "block";
            volumenDeposito.value = 0;
        } else {
            containerVolumenDeposito.style.display = "none";
            volumenDeposito.value = 0;
        }
    }

        // Inicializar el estado del campo al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
        toggleInput();

    });

    $(document).ready(function() {
        $('#formulario-calculo').submit(function(event) {
            // Evitar el envío del formulario por defecto
            event.preventDefault();

            // Obtener la URL del formulario
            var url = $(this).attr('action');

            // Obtener los datos del formulario
            var formData = $(this).serialize();

            // Realizar la llamada AJAX
            $.ajax({
                type: 'GET',
                url: url,
                data: formData,
                success: function(response) {

                    //Recogemos los datos de la respuesta json
                    var primerResultadoPorModeloBomba = response.primerResultadoPorModeloBomba;
                    var primerResultadoPorModeloFiltro = response.primerResultadoPorModeloFiltro;
                    var superficie_necesaria = response.superficie_necesaria;
                    var qLavado = response.qLavado;

                    // Obtener referencias a elementos relevantes
                    var tbodyBomba = document.getElementById("tbodyBomba");
                    var tbodyFiltro = document.getElementById("tbodyFiltro");
                    var borrarTablaBtn = document.getElementById("borrarTablaBtn");
                    var resultadoBomba = document.getElementById("resultadoBomba");
                    var resultadoFiltro = document.getElementById("resultadoFiltro");

                    // Función para borrar el contenido de la tabla
                    function borrarContenidoTabla() {
                        tbodyBomba.innerHTML = "";
                        tbodyFiltro.innerHTML = "";
                    }

                    // Agregar un evento de clic al botón para borrar la tabla
                    borrarTablaBtn.addEventListener("click", borrarContenidoTabla);
                    // Borrar el contenido actual de la tabla
                    borrarContenidoTabla();

                    // Crear HTML de la tabla por modelo
                    for (var modelo in primerResultadoPorModeloFiltro) {
                        if (primerResultadoPorModeloFiltro.hasOwnProperty(modelo)) {
                            var filtros = primerResultadoPorModeloFiltro[modelo];
                            var filaHTML = crearTablaHTMLFiltro(filtros);
                            // Insertar el HTML en el cuerpo de la tabla
                            tbodyFiltro.innerHTML += filaHTML;
                        }
                    }
                    // Crear HTML de la tabla por modelo
                    for (var modelo in primerResultadoPorModeloBomba) {
                        if (primerResultadoPorModeloBomba.hasOwnProperty(modelo)) {
                            var bombas = primerResultadoPorModeloBomba[modelo];
                            var filaHTML = crearTablaHTMLBomba(bombas);
                            // Insertar el HTML en el cuerpo de la tabla
                            tbodyBomba.innerHTML += filaHTML;
                        }
                    }

                    resultadoBomba.textContent = qLavado;
                    resultadoFiltro.textContent = superficie_necesaria;

                    function crearTablaHTMLBomba(bombaRES) {
                        var html = '';
                        html += '<tr>';
                        html += '<td class="px-4 py-3 text-left border">' + bombaRES.descripcion + '</td>';
                        html += '<td class="px-4 py-3 text-left border">' + bombaRES.caudal + ' m³/h</td>';
                        if (bombaRES.url) {
                            html += '<td class="border"><div class="p-1 text-center md:col-span-2"><a target="_blank" href="' +
                                bombaRES.url + '" class="btn-calcular disabled:opacity-25">Comprar</a></div></td>';
                        } else {
                            html +=
                                '<td class="px-4 py-2 text-gray-500 border">Sin URL</td>';
                        }
                        html += '</tr>';
                        return html;
                    }

                    function crearTablaHTMLFiltro(filtroRES) {
                        var html = '';
                        html += '<tr>';
                        html += '<td class="px-4 py-3 text-left border">' + filtroRES.descripcion + '</td>';
                        html += '<td class="px-4 py-3 text-left border">' + filtroRES.superficie_filtrante + ' m²</td>';
                        if (filtroRES.url) {
                            html += '<td class="border"><div class="p-1 text-center md:col-span-2"><a target="_blank" href="' +
                                    filtroRES.url + '" class="btn-calcular disabled:opacity-25">Comprar</a></div></td>';
                        } else {
                            html +=
                                '<td class="px-4 py-2 text-gray-500 border">Sin URL</td>';
                        }

                        html += '</tr>';
                        return html;
                    }

                    // Crear HTML de la tabla
                    var tablaHTMLFiltro = crearTablaHTMLFiltro(
                        primerResultadoPorModeloFiltro);
                    var tablaHTMLBomba = crearTablaHTMLBomba(primerResultadoPorModeloBomba);

                    // Mostrar la tabla y los mensajes
                    $('#tablaResultados').removeClass('hidden').addClass('flex');
                    $('#alerta').removeClass('hidden').addClass('block');
                    $('#resultadoCalculo').removeClass('hidden').addClass('block');

                },
                error: function(xhr, status, error) {
                    // Manejar los errores de la llamada AJAX
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
