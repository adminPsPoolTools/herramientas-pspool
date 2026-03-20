@extends('layouts.app')

@section('content')

<main class="seccion">
    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Activador Da-Gen"
        description="Calcula la cantidad de activador Da-Gen necesitas para tu piscina" :user="$user" />

    <div class="container w-10/12 max-w-screen-lg mx-auto mb-4 contenido">
        <div class="p-4 px-4 mb-0 caja md:p-8">
            <form action="{{ route('activador.calculo') }}" id="formulario-calculo" method="get">
                <div class="flex flex-col md:flex-row">
                    <!-- Existing Inputs Section -->
                    <div class="w-full p-4 bg-white rounded shadow-lg md:w-2/2">
                        <div class="grid gap-4 text-sm">
                            <div class="text-gray-600">
                                <p class="text-lg font-medium">Dosificación:</p>
                                <label for="activador">1 kg. por cada m³ de agua (medido indicada para el sistema
                                    DAISY)</label>
                                <label for="activador">Para conseguir el mejor resultado, mezclar el cloruro de magnesio
                                    con
                                    sal común en una proporción de 1:3 (MgCl²:NaCl)</label>
                            </div>
                            <div class="grid gap-4">
                                <div>
                                    <label for="volumen">Indica el volumen de tu piscina en m³/h</label>
                                    <input type="number" name="volumen" id="volumen" step="any" min="0"
                                        class="w-full h-10 px-4 mt-1 border rounded bg-gray-50" value="10"
                                        placeholder="" />
                                    @error('volumen')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Results Section -->
                        <div id="tbodyActivador" class="min-w-full mt-4"></div>


                        <!-- Button Section -->
                        <div class="mt-2 text-right md:col-span-3">
                            <button class="btn-calcular disabled:opacity-25" id="borrarTablaBtn">Calcular</button>
                        </div>
                    </div>

                    <!-- YouTube Video Section -->
                    <div class="w-full p-4 mt-4 md:mt-0">
                        <div class="relative pb-[56.25%] h-0 overflow-hidden">
                            <iframe width="560" height="315"
                                src="https://www.youtube.com/embed/8jkCHm0lGLY?si=XFcFu6CuHw6qoAC8"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
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
                    var tbodyActivador = document.getElementById("tbodyActivador");
                    // Función para borrar el contenido de la tabla
                    function borrarContenidoTabla() {
                        // Borra todas las filas del tbody
                        tbodyActivador.innerHTML = "";
                    }

                    // Agregar un evento de clic al botón para borrar la tabla
                    borrarTablaBtn.addEventListener("click", borrarContenidoTabla);

                    //REcogemos el valor de la resputa json
                    var resultado = response.result;

                    function crearTablaHTML(resultado) {

                            var html = '<table class="min-w-full bg-white">';
                            html += '<thead class="">';
                            html +=  '<div class="text-gray-600"><p class="text-lg font-medium">Resultado por semana</p></div>';
                            html +=
                                '<div class="p-4 mb-2 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">Su piscina necesita ' +
                                    resultado + ' kg. de Activador DA-GEN  ';
                            html += '</div>';
                            html += '</thead>';
                            html += '</table>';

                            html += '<div class="mt-6 mb-6">';
                            html += '<table style="width:100%; border-collapse: collapse;">';
                            html += '<tr>';
                            html += '<td style="padding: 10px; vertical-align: middle;">Puedes adquirir los productos pulsando aquí:</td>';
                            html += '<td style="padding: 10px; vertical-align: middle; text-align: right;">';
                            html += '<a class="btn-calcular disabled:opacity-25" target="_blank" href="https://ps-pool.com/tienda/accesorios/33-activador-dagen-saco-25-kg.html">Activador DA-GEN</a>';
                            html += '</td>';
                            html += '</tr>';
                            html += '</table>';
                            html += '</div>';

                            html += '</table>';
                            return html;
                                }
                    // Crear HTML de la tabla
                    var tablaActivadorDagen = crearTablaHTML(resultado);

                    // Insertar el HTML en el cuerpo del documento
                    document.getElementById("tbodyActivador").innerHTML =
                        tablaActivadorDagen;

                },
                error: function(xhr, status, error) {
                    // Manejar los errores de la llamada AJAX
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
