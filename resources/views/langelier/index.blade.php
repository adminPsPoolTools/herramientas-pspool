@extends('layouts.app')

@section('content')
    <main class="seccion">
        <x-header-herramientas class="py-5 titulo"
            background="background-image: url({{ asset('storage/img/home/home.jpg') }})" title="Indice de langelier"
            description="Calcula el indice de langelier." :user="$user" />

        <div class="container w-10/12 max-w-screen-lg mx-auto mb-4 contenido">
            <div class="p-4 px-4 mb-0 caja md:p-8">
                <form action="{{ route('langelier.calculo') }}" id="formulario-calculo" method="get">
                    <div class="flex flex-col md:flex-row">
                        <!-- Existing Inputs Section -->
                        <div class="w-full p-4 bg-white rounded shadow-lg md:w-2/2">
                            <div class="grid gap-4 text-sm">
                                <div class="text-gray-600">
                                    <p class="text-lg font-medium">Rellena los datos</p>
                                </div>
                                <div class="grid gap-4">
                                    <div>
                                        <label for="ph">PH del agua</label>
                                        <input type="number" name="ph" id="ph" step="any"
                                            class="w-full h-10 px-4 mt-1 border rounded bg-gray-50" value="7.41"
                                            placeholder="" />
                                        @error('ph')
                                            <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="temperatura">Temperatura(ºC)</label>
                                        <input type="number" name="temperatura" id="temperatura" step="any"
                                            class="w-full h-10 px-4 mt-1 border rounded bg-gray-50" value="28"
                                            placeholder="" />
                                        @error('temperatura')
                                            <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="dureza">Dureza (ppm)</label>
                                        <input type="number" name="dureza" id="dureza" step="any"
                                            class="w-full h-10 px-4 mt-1 border rounded bg-gray-50" value="450"
                                            placeholder="" />
                                        @error('dureza')
                                            <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="alcalinidad">Alcalinidad(ppm)</label>
                                        <input type="number" name="alcalinidad" id="alcalinidad" step="any"
                                            class="w-full h-10 px-4 mt-1 border rounded bg-gray-50" value="92"
                                            placeholder="" />
                                        @error('alcalinidad')
                                            <span class="text-red-600">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Results Section -->
                            <div id="tbodyIndiceLangelier" class="min-w-full mt-4"></div>

                            <!-- Button Section -->
                            <div class="mt-2 text-right md:col-span-3">
                                <button class="btn-calcular disabled:opacity-25" id="borrarTablaBtn">Calcular</button>
                            </div>
                        </div>

                        <!-- YouTube Video Section -->
                        <div class="w-full p-4 mt-4 md:w-2/2 md:mt-0">
                            <iframe width="100%" height="315"
                                src="https://www.youtube.com/embed/B2M9i-LtbfU?si=W9qrFKteAzeN5UVW"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>

                    <div class="flex mt-3">
                        <x-boton-volver :user="$user" />
                    </div>
                </form>
            </div>
        </div>

    </main>
@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
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

                    // Obtener referencias a elementos relevantes
                    var tbodyIndiceLangelier = document.getElementById(
                        "tbodyIndiceLangelier");
                    // Función para borrar el contenido de la tabla
                    function borrarContenidoTabla() {
                        // Borra todas las filas del tbody
                        tbodyIndiceLangelier.innerHTML = "";
                    }

                    // Agregar un evento de clic al botón para borrar la tabla
                    borrarTablaBtn.addEventListener("click", borrarContenidoTabla);

                    //REcogemos el valor de la resputa json
                    var resultadoLangelier = response.resultadoIndiceLangelier;
                    var validacionIndiceSuperior = response.validacionIndiceSuperior;
                    var validacionIndiceInferior = response.validacionIndiceInferior;

                    function crearTablaHTML(resultadoLangelier) {

                        var valorFormateado = parseFloat(resultadoLangelier).toFixed(3);
                        var valorNumerico = parseFloat(valorFormateado);

                        if (validacionIndiceSuperior == false && validacionIndiceInferior ==
                            false) {
                            var html = '<table class="min-w-full bg-white">';
                            html += '<thead class="">';
                            html +=
                                '<div class="text-gray-600"><p class="text-lg font-medium">Resultado del índice</p></div>';
                            html +=
                                '<div class="p-4 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert"><p class="font-bold">¡Enhorabuena!</p>El valor obtenido es correcto: ' +
                                valorNumerico;
                            html += '<p>Índice mínimo -0.5 y máximo 0.5</p>';
                            html += '</div>'
                            html += '</thead>';
                            html += '</table>';
                            return html;
                        } else {
                            var html = `
                            <table class="min-w-full bg-white">
                                <thead>
                                    <div class="text-gray-600">
                                        <p class="text-lg font-medium">Resultado del índice</p>
                                    </div>
                                    <div class="p-4 text-orange-700 bg-orange-100 border-l-4 border-orange-500" role="alert">
                                        <p class="font-bold">¡Atención!</p>
                                        <p>El valor del índice supera los mínimos y máximos: ${valorNumerico}</p>
                                        <p class="font-bold">Regule los parámetros del agua.</p>
                                        <p>Puedes revisar nuestros tips para verificar los parámetros correctos de este índice pulsando en el siguiente <b><a href="{{ route('tips.tratamiento.langelier.index') }}">enlace a tips</a></b></p>
                                        <p>Índice mínimo -0.5 y máximo 0.5</p>
                                    </div>
                                </thead>
                            </table>
                        `;
                            return html;
                        }
                    }
                    // Crear HTML de la tabla
                    var tablaIndiceLangelier = crearTablaHTML(resultadoLangelier);

                    // Insertar el HTML en el cuerpo del documento
                    document.getElementById("tbodyIndiceLangelier").innerHTML =
                        tablaIndiceLangelier;

                },
                error: function(xhr, status, error) {
                    // Manejar los errores de la llamada AJAX
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
