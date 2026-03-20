@extends('layouts.app')

@section('content')

<main class="seccion">
    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})"
        title="Configura fotos led Eva Optic" description="Calcula los focos led de Eva Optic para tu piscina."
        :user="$user" />

    <div class="container w-10/12 max-w-screen-lg mx-auto mb-4 contenido">
        <div class="p-8 bg-white rounded-lg shadow-md w-100">
            <form class="space-y-6" action="{{ route('evaoptic.calculo') }}" id="formulario-calculo" method="get">
                <form>
                    <div class="flex w-full">
                        <!-- Columna izquierda (50%) -->
                        <div class="w-1/3 pr-4">
                            <!-- Bloque 1: Ancho piscina y Tipo de LUZ -->
                            <div class="flex flex-col space-y-4">
                                <div class="flex-1">
                                    <label for="ancho_consejos" class="block text-sm font-medium text-gray-700">Ancho
                                        piscina</label>
                                    <select id="ancho_consejos" name="ancho_consejos"
                                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="0">-- Elige un opción --</option>
                                        <option value="1">menos de 2m luz de un lado</option>
                                        <option value="2">menos de 5m luz de un lado</option>
                                        <option value="3">5m - 10m dos luces laterales</option>
                                        <option value="4">5m - 12,5m luz de un lado</option>
                                        <option value="5">10m - 25m dos luces laterales</option>
                                        <option value="6">Escaleras</option>
                                        <option value="7">Hidromasaje (monobloque)</option>
                                        <option value="8">Rápidos</option>
                                    </select>
                                </div>

                                <div class="flex-1">
                                    <label for="tipo_luz" class="block text-sm font-medium text-gray-700">Tipo de
                                        LUZ</label>
                                    <select id="tipo_luz" name="tipo_luz"
                                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="0">-- Elige un ancho arriba y mostraremos los focos
                                            aconsejables
                                            --
                                        </option>
                                        <option value="1">5W Q2 WW Blanco Cálido</option>
                                        <option value="2">5W Q2 CW Blanco Claro</option>
                                        <option value="3">10W B2 WW Blanco Cálido</option>
                                        <option value="4">10W B2 WW Blanco Claro</option>
                                        <option value="5">25W SubAqua MONO WW Blanco cálido</option>
                                        <option value="6">25W SubAqua MONO CW Blanco Claro</option>
                                        <option value="7">25W SubAqua MONO Mediterránea</option>
                                        <option value="8">25W SubAqua RGBW WW Blanco cálido</option>
                                        <option value="9">25W SubAqua RGBW CW Blanco Claro</option>
                                        <option value="10">40W SubAqua MONO WW Blanco cálido</option>
                                        <option value="11">40W SubAqua MONO CW Blanco Claro</option>
                                        <option value="12">40W SubAqua MONO Mediterránea</option>
                                        <option value="13">50W SubAqua RGBW WW Blanco cálido</option>
                                        <option value="14">50W SubAqua RGBW CW Blanco Claro</option>
                                    </select>
                                </div>

                                <!-- Bloque 2: Largo piscina, Ancho piscina, % Reflexión -->
                                <div class="flex-1">
                                    <label for="largo" class="block text-sm font-medium text-gray-700">Largo
                                        piscina</label>
                                    <input type="number" id="largo" name="largo" min="0" step=".01" value="8"
                                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>

                                <div class="flex-1">
                                    <label for="ancho" class="block text-sm font-medium text-gray-700">Ancho
                                        piscina</label>
                                    <input type="number" id="ancho" name="ancho" min="0" step=".01" value="4"
                                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>

                                <label for="reflexion" class="block text-sm font-medium text-gray-700">% Reflexión
                                    Piscina</label>
                                <div class="flex items-center mt-0 space-x-2">
                                    <select id="reflexion" name="reflexion"
                                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="1">0 %</option>
                                        <option value="2">10 %</option>
                                        <option value="3">20 %</option>
                                        <option value="4">30 %</option>
                                        <option value="5">40 %</option>
                                        <option value="6">50 %</option>
                                        <option value="7">60 %</option>
                                        <option value="8">70 %</option>
                                    </select>
                                    <button type="button" class="btn-calcular disabled:opacity-25"
                                        onclick="showPopup('storage/img/evaoptic/reflexion.png')">Ayuda</button>
                                </div>

                            </div>
                        </div>

                        <!-- Columna derecha (50%) -->
                        <div class="w-2/3 pl-4">
                            <div class="flex-1">
                                <div class="relative block w-full p-2 mt-1 mb-1 text-base leading-5 text-white bg-blue-500 rounded-lg opacity-100 font-regular"
                                    style="display: none;" id="mensaje_consejo_focos">
                                </div>

                            </div>

                            <!-- Distribución -->
                            <div class="p-6 mt-6 bg-white rounded-md shadow-md" style="display: none;"
                                id="distribucion">
                                <div class="font-bold">
                                    <span id="numero_focos"></span>
                                    <span id="largo_pared"></span><br>
                                    <span id="explicacion_focos_pared"></span><br>
                                    <span id="explicacion_focos_entre"></span>
                                </div>
                                <div class="relative flex items-center justify-center h-40 mt-4 bg-blue-200 rounded-md">
                                    <!-- Rectángulo con 5 inputs -->
                                    <div class="flex justify-between w-full px-4">
                                        <div class="flex flex-col items-center">
                                            <small class="text-md">
                                                ← Pared →
                                            </small>
                                            <input type="text" id="distancia_pared_1"
                                                class="w-10/12 text-center border border-gray-300 rounded-md" value=""
                                                readonly>
                                        </div>
                                        <div class="relative flex flex-col items-center">
                                            <small class="text-md" id="modelo_foco"></small>
                                            <input type="text" id="wattios_foco"
                                                class="w-10/12 text-center border border-gray-300 rounded-md" value=""
                                                readonly>
                                            {{--
                                            <!-- Haz de luz -->
                                            <svg class="absolute w-12 h-12 text-yellow-500 -bottom-10"
                                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 2L2 22h20L12 2z" fill="currentColor" />
                                            </svg> --}}
                                        </div>
                                        <div class="flex flex-col items-center">
                                            <small class="text-md">
                                                ← entre focos →
                                            </small>
                                            <input type="text" id="distancia_focos"
                                                class="w-10/12 text-center border border-gray-300 rounded-md" value=""
                                                readonly>
                                        </div>
                                        <div class="relative flex flex-col items-center">
                                            <small class="text-md" id="modelo_foco_1"></small>
                                            <input type="text"
                                                class="w-10/12 text-center border border-gray-300 rounded-md"
                                                id="wattios_foco_1" value="" readonly>
                                            <!-- Haz de luz -->
                                            {{-- <svg class="absolute w-12 h-12 text-yellow-500 -bottom-10"
                                                viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 2L2 22h20L12 2z" fill="currentColor" />
                                            </svg> --}}
                                        </div>
                                        <div class="flex flex-col items-center">
                                            <small class="text-md">
                                                ← Pared →
                                            </small>
                                            <input type="text" id="distancia_pared_2"
                                                class="w-10/12 text-center border border-gray-300 rounded-md" value=""
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Distribución -->
                    </div>

                    <!-- Botón de submit -->
                    <div class="text-right md:col-span-2">
                        <button class="btn-calcular disabled:opacity-25" id="borrarTablaBtn">
                            Calcular
                        </button>
                    </div>
                </form>

                <!-- Tablas de resultados -->
                <div class="min-w-full mt-4 table-auto">
                    <x-boton-volver :user="$user" />
                </div>

        </div>

        <!-- Pop-up modal -->
        <div id="popup" class="fixed inset-0 items-center justify-center hidden bg-gray-900 bg-opacity-50">
            <div class="w-3/4 p-4 m-auto bg-white rounded-lg shadow-lg">
                <span class="block text-sm font-medium text-gray-700">
                    La reflexión de la luz LED sobre superficies de gresite puede variar
                    significativamente dependiendo del color del material. Para áreas que requieren más luz, opta
                    por
                    colores claros. Para un efecto más íntimo o dramático, los tonos oscuros pueden ser más
                    apropiados. Revisa el tono de gresite con esta tabla y aplícalo en nuestra calculadora para
                    ofrecerte los focos y la cantidad adecuada.
                </span>
                <img id="popupImage" src="" alt="Popup Image" class="object-cover m-auto">
                <button type="button" class="btn-volver" onclick="hidePopup()">Cerrar</button>
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
            var ancho                           = response.ancho;
            var largo                           = response.largo;
            var ancho_consejos                  = response.ancho_consejos;
            var tipo_luz                        = response.tipo_luz;
            var reflexion                       = response.reflexion;
            var superficie                      = response.superficie;
            var resultadoValoresFocosN1         = response.resultadoValoresFocosN1;
            var resultadoValoresFocosN2         = response.resultadoValoresFocosN2;
            var resultadoPorcentajesReflexion   = response.resultadoPorcentajesReflexion;
            var minimoFocos                     = response.minimoFocos;
            var distanciaEntreFocos             = response.distanciaEntreFocos;
            var distanciaParedPrimerFoco        = response.distanciaParedPrimerFoco;
            var modelosFocos                    = response.modelosFocos;
            var wattiosFocos                    = response.wattiosFocos;

            $('#distancia_pared_1').val(distanciaParedPrimerFoco + " mts");
            $('#distancia_focos').val(distanciaEntreFocos + " mts");
            $('#distancia_pared_2').val(distanciaParedPrimerFoco + " mts");
            $('#numero_focos').text('Distribución de ' + minimoFocos + ' focos modelo ' + modelosFocos + ' de ' + wattiosFocos + ' en ');
            $('#largo_pared').text(largo + ' mts');
            $('#explicacion_focos_pared').text('El primer foco y el último irán a ' + distanciaParedPrimerFoco + ' mts de la pared.');
            $('#explicacion_focos_entre').text('La distancia entre los focos debe ser de ' + distanciaEntreFocos + ' mts entre ellos');
            $('#modelo_foco').text(modelosFocos);
            $('#modelo_foco_1').text(modelosFocos);
            $('#wattios_foco').val(wattiosFocos);
            $('#wattios_foco_1').val(wattiosFocos);
            $('#mensaje_consejo_focos').text('Se recomienda un mínimo de ' + minimoFocos + ' focos en total').css('display', 'block');
            $('#distribucion').css('display', 'block');
        },
            error: function(xhr, status, error) {
            // Manejar los errores de la llamada AJAX
            console.error(xhr.responseText);
            }
        });
    });
});


document.getElementById('ancho_consejos').addEventListener('change', function() {
        const tipoLuzSelect = document.getElementById('tipo_luz');
        const selectedValue = this.value;

        // Clear current options
        while (tipoLuzSelect.options.length > 0) {
            tipoLuzSelect.remove(0);
        }

        // Define the options for each selection in the first select
        const optionsMap = {
            0: [
                {value: '0', text: '-- Elige un ancho arriba y mostraremos los focos aconsejables --'},
            ],
            1: [
                {value: '1', text: '5W Q2 WW Blanco Cálido'},
                {value: '2', text: '5W Q2 CW Blanco Claro'},
            ],
            2: [
                {value: '5', text: '25W SubAqua MONO WW Blanco cálido'},
                {value: '6', text: '25W SubAqua MONO CW Blanco Claro'},
                {value: '7', text: '25W SubAqua MONO Mediterránea'},
                {value: '8', text: '25W SubAqua RGBW WW Blanco cálido'},
                {value: '9', text: '25W SubAqua RGBW CW Blanco Claro'}
            ],
            3: [
                {value: '5', text: '25W SubAqua MONO WW Blanco cálido'},
                {value: '6', text: '25W SubAqua MONO CW Blanco Claro'},
                {value: '7', text: '25W SubAqua MONO Mediterránea'},
                {value: '8', text: '25W SubAqua RGBW WW Blanco cálido'},
                {value: '9', text: '25W SubAqua RGBW CW Blanco Claro'}
            ],
            4: [
                {value: '10', text: '40W SubAqua MONO WW Blanco cálido'},
                {value: '11', text: '40W SubAqua MONO CW Blanco Claro'},
                {value: '12', text: '40W SubAqua MONO Mediterránea'},
                {value: '13', text: '50W SubAqua RGBW WW Blanco cálido'},
                {value: '14', text: '50W SubAqua RGBW CW Blanco Claro'}
            ],
            5: [
                {value: '10', text: '40W SubAqua MONO WW Blanco cálido'},
                {value: '11', text: '40W SubAqua MONO CW Blanco Claro'},
                {value: '12', text: '40W SubAqua MONO Mediterránea'},
                {value: '13', text: '50W SubAqua RGBW WW Blanco cálido'},
                {value: '14', text: '50W SubAqua RGBW CW Blanco Claro'}
            ],
            6: [
                {value: '1', text: '5W Q2 WW Blanco Cálido'},
                {value: '2', text: '5W Q2 CW Blanco Claro'}

            ],
            7: [
                {value: '1', text: '5W Q2 WW Blanco Cálido'},
                {value: '2', text: '5W Q2 CW Blanco Claro'},
                {value: '3', text: '10W B2 WW Blanco Cálido'},
                {value: '4', text: '10W B2 WW Blanco Claro'},
                {value: '5', text: '25W SubAqua MONO WW Blanco cálido'},
                {value: '6', text: '25W SubAqua MONO CW Blanco Claro'},
                {value: '7', text: '25W SubAqua MONO Mediterránea'},
                {value: '8', text: '25W SubAqua RGBW WW Blanco cálido'},
                {value: '9', text: '25W SubAqua RGBW CW Blanco Claro'}
            ],
            8: [
                {value: '5', text: '25W SubAqua MONO WW Blanco cálido'},
                {value: '6', text: '25W SubAqua MONO CW Blanco Claro'},
                {value: '7', text: '25W SubAqua MONO Mediterránea'},
                {value: '8', text: '25W SubAqua RGBW WW Blanco cálido'},
                {value: '9', text: '25W SubAqua RGBW CW Blanco Claro'}
            ],
            // Add other cases as needed
        };

        // Get the options for the selected value
        const options = optionsMap[selectedValue] || [];

        // Populate the second select with the filtered options
        options.forEach(option => {
            const newOption = document.createElement('option');
            newOption.value = option.value;
            newOption.text = option.text;
            tipoLuzSelect.add(newOption);
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
