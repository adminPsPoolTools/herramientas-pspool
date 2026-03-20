@extends('layouts.app')

@section('content')

<main class="seccion">

    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Dimensión de tubería"
        description="Calcula la dimensión de las tuberías" :user="$user" />

    <div class="container w-10/12 max-w-screen-lg mx-auto mb-4 contenido">
        <div class="p-4 px-4 mb-0 caja md:p-8">
            <form action="{{ route('tuberias.calculo') }}" id="formulario-calculo" method="get">
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label for="caudal" class="block text-sm font-medium text-gray-700">Caudal de
                            agua en m³/h</label>
                        <input type="number"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            id="caudal" name="caudal" value="50" min="0" step="0.1"
                            placeholder="Introduce el caudal de tu piscina">
                        <span class="text-sm text-red-500" id="error-caudal"></span>
                    </div>

                    <div class="text-right md:col-span-2">
                        <button class="btn-calcular disabled:opacity-25" id="borrarTablaBtn">Calcular
                        </button>
                    </div>
                </div>
                <x-boton-volver :user="$user" />
            </form>
        </div>
        <div id="tarjetaRespuesta" class="min-w-full mt-4"></div>
        <!-- Aquí se mostrará el valor del response -->
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
    var tarjetaRespuesta = document.getElementById("tarjetaRespuesta");
    // Función para borrar el contenido de la tabla
    function borrarContenidoTabla() {
        // Borra todas las filas del tbody
        tarjetaRespuesta.innerHTML = "";
    }

    // Agregar un evento de clic al botón para borrar la tabla
    borrarTablaBtn.addEventListener("click", borrarContenidoTabla);

    //REcogemos el valor de la resputa json
    var canaleta   = response.resultadoCanaleta;
    var aspiracion = response.resultadoAspiracion;
    var impulsion  = response.resultadoImpulsion;


    function crearTablaHTML(canaleta,aspiracion,impulsion) {

        var mensajeAspiracion   = aspiracion[0] == 0    ? 'Valores excedidos - Consulte con del departamento técnico' : 'Velocidad:<strong> ' + aspiracion[0] + '</strong> y tubería de <strong>'  + aspiracion[1] + ' mm</strong>';
        var mensajeImpulsion    = impulsion[0]  == 0    ? 'Valores excedidos - Consulte con del departamento técnico' : 'Velocidad:<strong> ' + impulsion[0]  + '</strong> y tubería de<strong> '  + impulsion[1] + ' mm</strong>' ;
        var mensajeCanaleta     = canaleta[0]   == 0    ? 'Valores excedidos - Consulte con del departamento técnico' : 'Velocidad:<strong> ' + canaleta[0]   + '</strong> y tubería de<strong> '  + canaleta[1] + ' mm</strong>' ;

        var html = '<table class="min-w-full bg-white">';
            html += '<thead>';
            html += '<div class="mb-2 text-gray-600"><p class="text-lg font-medium">Resultado del cálculo</p></div>';
                html += '<div class="p-2 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">Resultado aspiración: ' + mensajeAspiracion + '</div>' ;
                html += '<div class="p-2 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">Resultado impulsión: ' + mensajeImpulsion + '</div>';
                html += '<div class="p-2 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">Resultado canaleta: ' + mensajeCanaleta + '</div>';
            html += '</div>'
            html += '</thead>';
            html += '</table>';
        return html;

    }
    // Crear HTML de la tabla
    var tablaIndiceLangelier = crearTablaHTML(canaleta,aspiracion,impulsion);

    // Insertar el HTML en el cuerpo del documento
    document.getElementById("tarjetaRespuesta").innerHTML = tablaIndiceLangelier;

},
    error: function(xhr, status, error) {
    // Manejar los errores de la llamada AJAX
    console.error(xhr.responseText);
    }
});
});
});

</script>
