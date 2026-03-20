@extends('layouts.app')

@section('content')

<x-header-herramientas class="py-5 titulo" background="background-image: url({{ asset('storage/img/home/home.jpg')}})"
    title="Calculadora de tiras led" description="Calcula tu tiras leds de tu piscinas" :user="$user" />

<div class="container w-10/12 max-w-screen-lg mx-auto mb-4 contenido">
    <div class="p-4 px-4 mb-0 caja md:p-8">
        <form action="{{ route('linearled.calculo') }}" id="formulario-calculo" method="get">
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label for="espacio" class="block text-sm font-medium text-gray-700">Espacio máximo
                        existente (mts)</label>
                    <input type="number"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        id="espacio" name="espacio" value="5" step=".01">
                    <span class="text-sm text-red-500" id="error-ancho"></span>
                </div>

                <div>
                    <label for="tipo_giro" class="block text-sm font-medium text-gray-700">Tipo de giro de
                        la
                        tira</label>
                    <div class="flex items-center">
                        <select id="tipo_giro" name="tipo_giro"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="frontal">Frontal</option>
                            <option value="lateral">Lateral</option>
                        </select>
                        <button type="button" class="btn-calcular disabled:opacity-25"
                            onclick="showPopup('storage/img/pslinearled/tipo_salida.png')">Ayuda</button>
                    </div>
                </div>

                <div class="">
                    <label for="orientacion_cable" class="block text-sm font-medium text-gray-700">Orientacion
                        salida cable</label>
                    <div class="flex items-center">
                        <select id="orientacion_cable" name="orientacion_cable"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="acodado">Acodado</option>
                            <option value="recto">Recto</option>
                        </select>
                        <!-- <button type="button" class="btn-calcular disabled:opacity-25"
                                onclick="showPopup('image2.jpg')">Ayuda</button>-->
                    </div>
                </div>

                <div>
                    <label for="alimentacion" class="block text-sm font-medium text-gray-700">Alimentación</label>
                    <div class="flex items-center">
                        <select id="alimentacion" name="alimentacion"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="dos_lados">Cable por los dos lados</option>
                            <option value="un_lado">Cable por un lado</option>
                        </select>
                        <button type="button" class="btn-calcular disabled:opacity-25"
                            onclick="showPopup('storage/img/pslinearled/alimentacion.png')">Ayuda</button>
                    </div>
                </div>

                <div>
                    <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                    <div class="flex items-center space-x-2">
                        <select id="color" name="color"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="rgb">Rgb</option>
                            <option value="mono">Monocolor</option>
                        </select>
                        <!--button type="button" class="btn-calcular disabled:opacity-25"
                                onclick="showPopup('image4.jpg')">Ayuda</-button>-->
                    </div>
                </div>

                <div class="text-right md:col-span-2">
                    <button class="btn-calcular disabled:opacity-25" id="borrarTablaBtn">Calcular
                    </button>
                </div>
            </div>
            <x-boton-volver :user="$user" />
        </form>
    </div>
</div>

<div class="justify-center hidden" id="tablaResultado">
    <div class="w-8/12 p-3">
        <div class="p-4 mb-20 bg-white rounded-lg shadow-lg">
            <div id="tbodyResultadoTirasLed"></div>
        </div>
    </div>
</div>

<!-- Pop-up modal -->
<div id="popup" class="fixed inset-0 items-center justify-center hidden bg-gray-900 bg-opacity-50">
    <div class="w-3/4 p-4 m-auto bg-white rounded-lg shadow-lg">
        <img id="popupImage" src="" alt="Popup Image" class="object-cover">
        <button type="button" class="mt-4 text-indigo-500 hover:underline" onclick="hidePopup()">Cerrar</button>
    </div>
</div>

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
        var resultadoSinTapones = response.resultadoSinTapones;
        var resultadoConTapones = response.resultadoConTapones;

        // Obtener referencias a elementos relevantes
        var tbodyResultadoTirasLed   = document.getElementById("tbodyResultadoTirasLed");

        // Función para borrar el contenido de la tabla
        function borrarContenidoTabla() {
            // Borra todas las filas del tbody
            tbodyResultadoTirasLed.innerHTML = "";


        }

        // Agregar un evento de clic al botón para borrar la tabla
        borrarTablaBtn.addEventListener("click", borrarContenidoTabla);
        document.getElementById('tablaResultado').classList.remove('hidden');
        document.getElementById('tablaResultado').classList.add('flex');


        function crearTablaHTML() {
        var html = '<table class="min-w-full bg-white">';
                html += '<thead class="">';
                html += '<h2 class="mb-4 text-lg font-semibold text-gray-700">Resultado:</h2>';
                    html += '<tr>';
                        html += '<th class="w-3/4 px-4 py-3 text-sm font-semibold text-white bg-gray-800">Tira led sin tapones (mts)</th>';
                    html += '</tr>';
                    html += '<tr>';
                        html += '<th class="px-4 py-3 text-sm font-semibold text-center border">' + resultadoSinTapones.toString().replace('.', ',')  +' mts</th>';
                    html += '</tr>';

                    html += '<tr>';
                        html += '<th class="w-3/4 px-4 py-3 text-sm font-semibold text-white bg-gray-800">Tira led con tapones (mts)</th>';
                    html += '</tr>';

                    html += '<tr>';
                        html += '<th class="px-4 py-3 text-sm font-semibold text-center border">' + resultadoConTapones.toString().replace('.', ',') + ' mts</th>';
                    html += '</tr>';

                html += '</thead>';
            html += '</table>';
        return html;
}

// Crear HTML de la tabla
var tablaHTML = crearTablaHTML();

// Insertar el HTML en el cuerpo del documento
document.getElementById("tbodyResultadoTirasLed").innerHTML = tablaHTML;

},
    error: function(xhr, status, error) {
    // Manejar los errores de la llamada AJAX
    console.error(xhr.responseText);
    }
});
});
});


    function showPopup(imageSrc) {
        document.getElementById('popupImage').src = imageSrc;
        document.getElementById('popup').classList.remove('hidden');
    }

    function hidePopup() {
        document.getElementById('popup').classList.add('hidden');
    }


</script>
