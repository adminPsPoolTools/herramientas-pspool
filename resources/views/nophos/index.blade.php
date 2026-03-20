@extends('layouts.app')

@section('content')

<main class="seccion">
    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="NoPhos"
        description="Calcula la cantidad de nophos que hay que utilizar en tu piscina." :user="$user" />

    <div class="container w-10/12 max-w-screen-lg mx-auto mb-4 contenido">
        <div class="p-4 px-4 mb-0 caja md:p-8">
            <form action="{{ route('nophos.calculoSemana') }}" id="formulario-calculo-semana" method="get">
                <div class="flex flex-col md:flex-row">
                    <!-- Existing Inputs Section -->
                    <div class="w-full p-4 bg-white rounded shadow-lg md:w-2/2">
                        <div class="grid gap-4 text-sm">
                            <div class="text-gray-600">
                                <p class="text-lg font-medium">Dosificación preventiva semanal</p>
                                <label for="ph">100 ml de Nophos x cada 50 m³ agua directamente en el skimmer</label>
                            </div>
                            <div class="grid gap-4">
                                <div>
                                    <label for="volumen">Indica el volumen de tu piscina en m³</label>
                                    <input type="number" name="volumen" id="volumen" step="any"
                                        class="w-full h-10 px-4 mt-1 border rounded bg-gray-50" value="48"
                                        placeholder="" />
                                    @error('volumen')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Results Section -->
                        <div id="tbodyNophos" class="min-w-full mt-4"></div>


                        <!-- Button Section -->
                        <div class="mt-2 text-right md:col-span-3">
                            <button class="btn-calcular disabled:opacity-25" id="borrarTablaBtn">Calcular</button>
                        </div>
                    </div>

                    <!-- YouTube Video Section -->
                    <div class="w-full p-4 mt-4 md:mt-0">
                        <div class="relative pb-[56.25%] h-0 overflow-hidden">
                            <iframe class="absolute top-0 left-0 w-full h-full"
                                src="https://www.youtube.com/embed/Qcq5YZxHntQ?si=LgAJOGnVBm9ZeGBM"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>

                </div>
            </form>
        </div>

        {{-- Dosificion inicial --}}
        <div class="p-4 px-4 mb-0 caja md:p-8">
            <form action="{{ route('nophos.calculoInicio') }}" id="formulario-calculo-inicio" method="get">
                <div class="flex flex-col md:flex-row">
                    <!-- Existing Inputs Section -->
                    <div class="w-full p-4 bg-white rounded shadow-lg md:w-2/2">
                        <div class="grid gap-4 text-sm">
                            <div class="text-gray-600">
                                <p class="text-lg font-medium">Dosificación al inicio de temporada</p>
                                <label for="nivel-fosfatos">Medir el nivel de fosfatos con el kit o flexitester</label>
                                <br>
                                <label for="nivel-fosfatos">La medida ideal de fosfatos es 0 mg/l</label>
                            </div>
                            <div class="grid gap-4">
                                <div>
                                    <label for="fosfatos">Nivel de fosfatos: entre 0.00 - 4.00 mg/l</label>
                                    <input type="number" name="fosfatos" id="fosfatos" step="any" min="0.00" max="4.00"
                                        class="w-full h-10 px-4 mt-1 border rounded bg-gray-50" value="0.2"
                                        placeholder="" />
                                    @error('fosfatos')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label for="volumen">Volumen de la piscina en m³</label>
                                    <input type="number" name="volumen" id="volumen" step="any"
                                        class="w-full h-10 px-4 mt-1 border rounded bg-gray-50" value="48"
                                        placeholder="" />
                                    @error('volumen')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Results Section -->
                        <div id="tbodyNophosInicio" class="min-w-full mt-4"></div>

                        <!-- Button Section -->
                        <div class="mt-2 text-right md:col-span-3">
                            <button class="btn-calcular disabled:opacity-25" id="borrarTablaBtnInicio">Calcular</button>
                        </div>
                    </div>

                    <!-- YouTube Video Section -->
                    <div class="w-full p-4 mt-4 md:w-2/2 md:mt-0">
                        <p><strong>¿Cómo utilizar el NoPhos ?</strong></p>
                        <p>Sólo hace falta una pequeña cantidad de NoPhos para eliminar los fosfatos. 10 ml de NoPhos es
                            suficiente para atrapar un 1 gr de fosfatos.</p>
                        <p>Una piscina de 100 m3 de agua con un nivel de fosfatos de 0,5 ppm = mg/l = g/m3, tendrá 50 gr
                            de fosfatos en el agua.</p>
                        <p>Para eliminar los 50 gr de fosfatos hará falta 500 ml de NoPhos. Hemos desarrollado un test
                            kit muy sencillo y rápido para facilitar la medición en las piscinas. El Nophos se puede
                            utilizar también de manera preventiva en piscinas sin la necesidad de medir el nivel de
                            fosfatos.</p>
                        <p><strong>Precaución:</strong>
                        <p>En sistemas con filtros biológicos, el contenido de fosfatos no debe de ser cero.</p>

                        <p><strong>Recomendamos los siguientes valores:</strong></p>
                        <ul>
                            <li>- Para piscinas y fuentes : 0 ppm</li>
                            <li>- Para piscinas naturales y estanques : 0,05 - 0,1 ppm</li>
                        </ul>
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
        $('#formulario-calculo-semana').submit(function(event) {
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
                    var tbodyNophos = document.getElementById("tbodyNophos");
                    // Función para borrar el contenido de la tabla
                    function borrarContenidoTabla() {
                        // Borra todas las filas del tbody
                        tbodyNophos.innerHTML = "";
                    }

                    // Agregar un evento de clic al botón para borrar la tabla
                    borrarTablaBtn.addEventListener("click", borrarContenidoTabla);

                    //REcogemos el valor de la resputa json
                    var resultadoMlNophos = response.result.toFixed(0);

                    function crearTablaHTML(resultadoMlNophos) {

                            var html = '<table class="min-w-full bg-white">';
                            html += '<thead class="">';
                            html +=  '<div class="text-gray-600"><p class="text-lg font-medium">Resultado</p></div>';
                            html +=
                                '<div class="p-4 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">Su piscina necesita: ' +
                                    resultadoMlNophos + ' ml de Nophos';
                            html += '</div>'
                            html += '</thead>';
                            html += '</table>';
                            html += '<div class="mt-6 mb-6">'
                            html += '<p>Puedes adquirir los productos aquí: <a class="btn-calcular disabled:opacity-25" target="_blank" href="https://ps-pool.com/tienda/medicion/143-test-flexitester-para-el-analisis-de-agua.html">Flexitester</a> ó <a class="btn-calcular disabled:opacity-25" target="_blank" href="https://ps-pool.com/tienda/producto-quimico/291-2172-nophos-eliminador-de-fosfatos.html#/2200-litros-1_litro">NoPhos</a></p>';
                            html += '</div>';
                            html += '</table>';
                            return html;
                                }
                    // Crear HTML de la tabla
                    var tablaIndiceLangelier = crearTablaHTML(resultadoMlNophos);

                    // Insertar el HTML en el cuerpo del documento
                    document.getElementById("tbodyNophos").innerHTML =
                        tablaIndiceLangelier;

                },
                error: function(xhr, status, error) {
                    // Manejar los errores de la llamada AJAX
                    console.error(xhr.responseText);
                }
            });
        });
    });

    $(document).ready(function() {
        $('#formulario-calculo-inicio').submit(function(event) {
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
                    var tbodyNophosInicio = document.getElementById("tbodyNophosInicio");
                    // Función para borrar el contenido de la tabla
                    function borrarContenidoTabla() {
                        // Borra todas las filas del tbody
                        tbodyNophosInicio.innerHTML = "";
                    }

                    // Agregar un evento de clic al botón para borrar la tabla
                    borrarTablaBtnInicio.addEventListener("click", borrarContenidoTabla);

                    //REcogemos el valor de la resputa json
                    var resultadoMlNophos = response.result.toFixed(0);

                    function crearTablaHTML(resultadoMlNophos) {

                            var html = '<table class="min-w-full bg-white">';
                            html += '<thead class="">';
                            html +=  '<div class="text-gray-600"><p class="text-lg font-medium">Resultado</p></div>';
                            html +=
                                '<div class="p-4 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">Su piscina necesita: ' +
                                    resultadoMlNophos + ' ml de Nophos';
                            html += '</div>'
                            html += '</thead>';
                            html += '<div class="mt-6 mb-6">'
                            html += '<p>Puedes adquirir los productos aquí: <a class="btn-calcular disabled:opacity-25" target="_blank" href="https://ps-pool.com/tienda/medicion/143-test-flexitester-para-el-analisis-de-agua.html">Flexitester</a> ó <a class="btn-calcular disabled:opacity-25" target="_blank" href="https://ps-pool.com/tienda/producto-quimico/291-2172-nophos-eliminador-de-fosfatos.html#/2200-litros-1_litro">NoPhos</a></p>';
                            html += '</div>';
                            html += '</table>';
                            return html;
                                }
                    // Crear HTML de la tabla
                    var tablaIndiceLangelier = crearTablaHTML(resultadoMlNophos);

                    // Insertar el HTML en el cuerpo del documento
                    document.getElementById("tbodyNophosInicio").innerHTML =
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
