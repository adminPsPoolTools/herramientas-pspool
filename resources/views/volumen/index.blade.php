@extends('layouts.app')

@section('content')

<main class="seccion">
    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})"
        title="Volumen de agua de tu piscina"
        description="Calcula el volumen de agua de tu piscina con esta simple calculadora." :user="$user" />


    <div class="container w-10/12 max-w-screen-lg mx-auto mb-4 contenido">
        <div class="p-4 px-4 mb-0 caja md:p-8">
            <form action="{{ route('volumen.calculo') }}" id="formulario-calculo" method="get">
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label for="ancho" class="block text-sm font-medium text-gray-700">Ancho de piscina</label>
                        <input type="number"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            id="ancho" name="ancho" value="5" placeholder="Introduce el ancho de tu piscina">
                        <span class="text-sm text-red-500" id="error-ancho"></span>
                    </div>

                    <div>
                        <label for="largo" class="block text-sm font-medium text-gray-700">Largo de piscina</label>
                        <input type="number"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            id="largo" name="largo" value="10" placeholder="Introduce largo de tu piscina">
                        <span class="text-sm text-red-500" id="error-largo"></span>
                    </div>

                    <div>
                        <label for="profundidadMin" class="block text-sm font-medium text-gray-700">Profundidad
                            mínima</label>
                        <input type="number"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            id="profundidadMin" name="profundidadMin" value="1.10" step="0.01"
                            placeholder="Introduce las horas de filtración">
                        <span class="text-sm text-red-500" id="error-horas"></span>
                    </div>

                    <div>
                        <label for="profundidadMax" class="block text-sm font-medium text-gray-700">Profundidad
                            máxima</label>
                        <input type="number"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            id="profundidadMax" name="profundidadMax" value="1.50" step="0.01"
                            placeholder="Introduce las horas de filtración">
                        <span class="text-sm text-red-500" id="error-horas"></span>
                    </div>

                    <div class="text-right md:col-span-2">
                        <button class="btn-calcular disabled:opacity-25" id="borrarTablaBtn">Calcular
                        </button>
                    </div>
                </div>
                <x-boton-volver :user="$user" />
            </form>
        </div>
        <div id="resultados" class="grid grid-cols-1 gap-4 mt-4 md:grid-cols-1">
            <div id="tablaResultados" class="">
                <table id="tablaCloradores" class="w-full min-w-full bg-white border border-gray-200 rounded-lg">
                    <div id="tbodyResultadoVolumen" class="min-w-full mt-1 mb-5"></div>
                    <!-- Aquí se insertarán las filas de la tabla -->
                    </tbody>
                </table>
            </div>
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

        //Recogemos los datos de la respuesta json
        var ancho               = response.ancho;
        var largo               = response.largo;
        var profundidadMin      = response.profundidadMin;
        var profundidadMax      = response.profundidadMax;
        var profundidadMedia    = response.profundidadMedia;
        var superficie          = response.superficie;
        var volumen             = response.volumen;

        // Obtener referencias a elementos relevantes
        var tbodyResultadoVolumen   = document.getElementById("tbodyResultadoVolumen");

        // Función para borrar el contenido de la tabla
        function borrarContenidoTabla() {
            // Borra todas las filas del tbody
            tbodyResultadoVolumen.innerHTML = "";
        }

        // Agregar un evento de clic al botón para borrar la tabla
        borrarTablaBtn.addEventListener("click", borrarContenidoTabla);


        function crearTablaHTML(resultadoLangelier) {

            var html = '<table class="min-w-full bg-white">';
                html += '<thead class="">';
                html += '<div class="text-gray-600"><p class="text-lg font-medium">Resultado:</p></div>';
                html += '<div class="p-4 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">'
                html += '<p>La superficies es: <strong>'           + superficie + ' m²</strong></p>';
                html += '<p>La profundidad media es: <strong>'     + profundidadMedia + ' mts.</strong></p>';
                html += '<p>El volumen de su piscina es: <strong>' + volumen+ ' m³</strong></p>';
                html += '</div>'
                html += '</thead>';
            html += '</table>';

            return html;

        }


// Crear HTML de la tabla
var tablaHTML = crearTablaHTML();

// Insertar el HTML en el cuerpo del documento
document.getElementById("tbodyResultadoVolumen").innerHTML = tablaHTML;

},
    error: function(xhr, status, error) {
    // Manejar los errores de la llamada AJAX
    console.error(xhr.responseText);
    }
});
});
});


</script>
