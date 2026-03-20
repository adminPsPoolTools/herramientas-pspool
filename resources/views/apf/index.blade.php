@extends('layouts.app')

@section('content')

<main class="seccion">
    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Apf"
        description="Calcula la cantidad de APF que hay que utilizar en tu piscina." :user="$user" />

    <div class="container w-10/12 max-w-screen-lg mx-auto mb-4 contenido">
        <div class="p-4 px-4 mb-0 caja md:p-8">
            <form action="{{ route('apf.calculo') }}" id="formulario-calculo" method="get">
                <div class="flex flex-col md:flex-row">
                    <!-- Existing Inputs Section -->
                    <div class="w-full p-4 bg-white rounded shadow-lg md:w-2/2">
                        <div class="grid gap-4 text-sm">
                            <div class="text-gray-600">
                                <p class="text-lg font-medium">Dosificación:</p>
                                <label for="apf"><strong>Dosis automática:</strong> de 0,5 a 1 ml/m³/h de
                                    recirculación</label>
                                <label for="apf">Se recomienda dosificar a través del ZPM entre la bomba y el
                                    filtro</label>
                            </div>
                            <div class="grid gap-4">
                                <div>
                                    <label for="caudal">Indica el caudal de tu piscina en m³/h</label>
                                    <input type="number" name="caudal" id="caudal" step="any" min="0"
                                        class="w-full h-10 px-4 mt-1 border rounded bg-gray-50" value="10"
                                        placeholder="" />
                                    @error('caudal')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Results Section -->
                        <div id="tbodyApf" class="min-w-full mt-4"></div>


                        <!-- Button Section -->
                        <div class="mt-2 text-right md:col-span-3">
                            <button class="btn-calcular disabled:opacity-25" id="borrarTablaBtn">Calcular</button>
                        </div>
                    </div>

                    <!-- YouTube Video Section -->
                    <div class="w-full p-4 mt-4 md:mt-0">
                        <div class="relative pb-[56.25%] h-0 overflow-hidden">
                            <iframe width="560" height="315"
                                src="https://www.youtube.com/embed/f3Bwxef9FQ4?si=s_qFqW3pJ9z4o1Ll"
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
                    var tbodyApf = document.getElementById("tbodyApf");
                    // Función para borrar el contenido de la tabla
                    function borrarContenidoTabla() {
                        // Borra todas las filas del tbody
                        tbodyApf.innerHTML = "";
                    }

                    // Agregar un evento de clic al botón para borrar la tabla
                    borrarTablaBtn.addEventListener("click", borrarContenidoTabla);

                    //REcogemos el valor de la resputa json
                    var resultado1 = response.result1.toFixed(0);
                    var resultado2 = response.result2.toFixed(0);


                    function crearTablaHTML(resultado1,resultado2) {

                            var html = '<table class="min-w-full bg-white">';
                            html += '<thead class="">';
                            html +=  '<div class="text-gray-600"><p class="text-lg font-medium">Resultado por semana</p></div>';
                            html +=
                                '<div class="p-4 mb-2 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">Su piscina necesita entre ' +
                                    resultado1 + ' ml y ' + resultado2 + ' ml/h de Apf';
                            html += '</div>';
                            html += '</thead>';
                            html += '</table>';
                            html += '<div class="mt-6 mb-6">'
                            html += '<p>Puedes adquirir los productos pulse aquí: <a class="btn-calcular disabled:opacity-25" target="_blank" href="https://ps-pool.com/tienda/producto-quimico/216-apf-coagulante-y-floculante-506028305028.html"> Apf </a></p>';
                            html += '</div>';
                            html += '</table>';
                            return html;
                                }
                    // Crear HTML de la tabla
                    var tablaIndiceLangelier = crearTablaHTML(resultado1,resultado2 );

                    // Insertar el HTML en el cuerpo del documento
                    document.getElementById("tbodyApf").innerHTML =
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
