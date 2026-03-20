@extends('layouts.app')

@section('content')

<x-header-herramientas class="py-5 titulo" background="background-image: url({{ asset('storage/img/home/home.jpg')}})"
    title="Configura tu clorador salino"
    description="Calcula tu clorador salino en función de los parametros de tu piscina." :user="$user" />

<div class="container w-10/12 max-w-screen-lg mx-auto mb-4 contenido">
    <div class="p-4 px-4 mb-0 caja md:p-8">
        <form action="{{ route('clorador.calculo') }}" id="formulario-calculo" method="get">
            <div class="grid gap-4 md:grid-cols-2">
                <div class="block text-sm font-medium text-gray-700">
                    <label for="tipo_piscina">Tipo de piscina</label><br>
                    <select name="tipo_piscina" id="tipo_piscina" onchange="toggleInput()"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="privada">Privada</option>
                        <option value="publica">Pública</option>
                    </select>
                    <span class="text-sm text-red-500" id="error-tipo_piscina"></span>
                </div>

                <div class="block text-sm font-medium text-gray-700">
                    <label for="temp">Temperatura Piscina*</label><br>
                    <select name="temp" id="temp" onchange="toggleInput()"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="0">Menos de 28ºC</option>
                        <option value="1">Más de 28ºC</option>
                    </select>
                    <span class="text-sm text-red-500" id="error-tipo_piscina"></span>
                </div>

                <div id="banyistas-container" class="block text-sm font-medium text-gray-700">
                    <label for="banyistas" class="block text-sm font-medium text-gray-700">Número de
                        bañistas</label>
                    <input type="number"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        id="numero_banyistas" name="numero_banyistas" value="10"
                        placeholder="Introduce el numero de bañistas">
                    <span class="text-sm text-red-500" id="error-banyistas"></span>
                </div>

                <div>
                    <label for="volumen" class="block text-sm font-medium text-gray-700">Volumen piscina m³</label>
                    <input type="number"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        id="volumen_piscina" name="volumen_piscina" value="50"
                        placeholder="Introduce el volumen de la piscina">
                    <span class="text-sm text-red-500" id="error-volumen"></span>
                </div>

                <div>
                    <label for="horas" class="block text-sm font-medium text-gray-700">Horas filtración</label>
                    <input type="number"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        id="horas_filtracion" name="horas_filtracion" value="8"
                        placeholder="Introduce las horas de filtración">
                    <span class="text-sm text-red-500" id="error-horas"></span>
                </div>

                <div class="text-right md:col-span-2">
                    <button class="btn-calcular disabled:opacity-25" id="borrarTablaBtn">
                        Calcular
                    </button>
                </div>
            </div>
            <x-boton-volver :user="$user" />
        </form>
    </div>
    <div id="resultados">
        <div id="tablaResultados" class="hidden mx-auto mt-2">
            <div id="alerta"
                class="relative hidden px-4 py-3 mb-2 text-green-700 bg-green-100 border border-green-400 rounded"
                role="alert">

                <div id="resultadoCalculo" class="hidden mt-4 mb-2">
                    <p class="text-lg font-semibold">El resultado de su cálculo es: <span id="resultado"></span>
                        grCl/h
                    </p>
                </div>

                <strong class="font-bold">¡Atención!</strong>
                <span class="block sm:inline">Estos son los modelos que se adaptan a los parámetros que ha indicado
                    arriba.
                    <br><strong>Este resultado es una orientación, depende de la zona geográfica y la temperatura
                        el equipo puede ser no compatible con la instalación.
                        <br>Si tiene alguna duda por favor contacte con la oficina al 96 686 68 15 o mande un correo
                        a
                        info@ps-pool.com para asesorarle</strong>.
                    Puede pulsar en los enlaces para ir al producto.</span>
            </div>
            <table id="tablaCloradores" class="w-full min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr>
                        <th class="px-4 py-2 tablacab">Nombre Modelo</th>
                        <th class="px-4 py-2 tablacab">Descripción</th>
                        <th class="px-4 py-2 tablacab">grCl2/h</th>
                        <th class="px-4 py-2 tablacab">URL</th>
                    </tr>
                </thead>
                <tbody id="tbodyClorador">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function toggleInput() {

        var tipoPiscina = document.getElementById('tipo_piscina').value;
        var banyistasContainer = document.getElementById('banyistas-container');

        if (tipoPiscina === 'privada') {
            banyistasContainer.style.display = 'none';
        } else {
            banyistasContainer.style.display = 'block';
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
                    // Recoger los datos de la respuesta json
                    var cloradoresPorModelo = response.cloradoresPorModelo;
                    var resultado = response.resultado; // Suponiendo que el resultado del cálculo viene en la respuesta

                    // Obtener referencia a los elementos relevantes
                    var tbodyClorador = document.getElementById("tbodyClorador");
                    var borrarTablaBtn = document.getElementById("borrarTablaBtn");
                    var alerta = document.getElementById("alerta");
                    var resultadoCalculo = document.getElementById("resultadoCalculo");
                    var resultadoSpan = document.getElementById("resultado");

                            // Limpiar errores previos
                    document.getElementById('error-banyistas').textContent = '';
                    document.getElementById('error-volumen').textContent = '';
                    document.getElementById('error-horas').textContent = '';
                    document.getElementById('error-tipo_piscina').textContent = '';

                    // Función para borrar el contenido de la tabla
                    function borrarContenidoTabla() {
                        // Borra todas las filas del tbody
                        tbodyClorador.innerHTML = "";
                    }

                    // Agregar un evento de clic al botón para borrar la tabla
                    borrarTablaBtn.addEventListener("click", borrarContenidoTabla);

                    // Borrar el contenido actual de la tabla
                    borrarContenidoTabla();

                    // Crear HTML de la tabla por modelo
                    for (var modelo in cloradoresPorModelo) {
                        if (cloradoresPorModelo.hasOwnProperty(modelo)) {
                            var cloradores = cloradoresPorModelo[modelo];
                            var filaHTML = crearFilaHTMLClorador(cloradores);
                            // Insertar el HTML en el cuerpo de la tabla
                            tbodyClorador.innerHTML += filaHTML;
                        }
                    }

                    // Mostrar la tabla y los mensajes
                    $('#tablaResultados').removeClass('hidden').addClass('block');
                    $('#alerta').removeClass('hidden').addClass('block');
                    $('#resultadoCalculo').removeClass('hidden').addClass('block');
                    resultadoSpan.textContent = resultado;

                },
                error: function(xhr, status, error) {
                    // Manejar los errores de la llamada AJAX
                    document.getElementById('error-banyistas').textContent = '';
                    document.getElementById('error-volumen').textContent = '';
                    document.getElementById('error-horas').textContent = '';
                    document.getElementById('error-tipo_piscina').textContent = '';

                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        // Manejar errores de validación
                        var errors = xhr.responseJSON.errors;
                        if (errors.numero_banyistas) {
                            document.getElementById('error-banyistas').textContent = errors.numero_banyistas[0];
                        }
                        if (errors.volumen_piscina) {
                            document.getElementById('error-volumen').textContent = errors.volumen_piscina[0];
                        }
                        if (errors.horas_filtracion) {
                            document.getElementById('error-horas').textContent = errors.horas_filtracion[0];
                        }
                        if (errors.tipo_piscina) {
                            document.getElementById('error-tipo_piscina').textContent = errors.tipo_piscina[0];
                        }
                } else {
                    alert('Se ha producido un error: ' + error);
                }
                }
            });
        });
    });

    function crearFilaHTMLClorador(cloradores) {
        var html = '';
        html += '<tr>';
        html += '<td class="px-4 py-2 border">' + cloradores.nombre_modelo + '</td>';
        html += '<td class="px-4 py-2 border">' + cloradores.descripcion + '</td>';
        html += '<td class="px-4 py-2 border">' + cloradores.valor + ' gr/h</td>';
        if (cloradores.url) {
            html += '<td class="border"><a type="button" target="_blank" href="' + cloradores.url +
                '" class="tablacomprar disabled:opacity-25">Comprar</a></td>';
        } else {
            html += '<td class="px-4 py-2 text-gray-500 border">Sin URL</td>';
        }
        html += '</tr>';
        return html;
    }
</script>

@endsection
