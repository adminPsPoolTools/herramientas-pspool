@extends('layouts.app')

@section('content')

<style>
    .disabled-field {
        background-color: #fd967a !important;
        cursor: not-allowed;
    }
</style>

<main class="seccion">
    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Flow Vis"
        description="Elige el modelo adecuado para tu instalación facilmente" :user="$user" />

    <div class="container w-10/12 max-w-screen-lg mx-auto mb-4 contenido">
        <div class="p-4 px-4 mb-0 caja md:p-8">
            <form action="{{ route('flowvis.calculo') }}" id="formulario-calculo" method="get">
                <div class="flex flex-col md:flex-row">
                    <!-- Existing Inputs Section -->
                    <div class="w-full p-4 bg-white rounded shadow-lg md:w-2/2">
                        <div class="grid gap-4 text-sm">
                            <div class="text-gray-600">
                                <p class="text-lg font-medium">Elige el modelo adecuado</p>
                                <label for="flowvis">Proporciona la medición de caudal más fiable en m³/h</label>
                                <label for="flowvis">Diseño único patentado: Caudalímetro + válvula antiretorno</label>
                                <label for="flowvis">Instalación rápida y sencilla que no requiere calibración</label>
                            </div>
                            <div class="grid gap-1">
                                <label for="caudal">Indica el caudal en m³/h</label>
                                <input type="number" name="caudal" id="caudal" step="any" min="0"
                                    class="w-full h-10 px-4 mt-1 border rounded bg-gray-50" />
                                @error('caudal')
                                <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="grid gap-4">
                                <div class="mt-4">
                                    <label for="diametro">Indica el diámetro de la instalación</label>
                                    <select name="diametro" id="diametro"
                                        class="w-full h-10 px-4 mt-1 border rounded bg-gray-50">
                                        <option value="">-- Selecciona un diámetro --</option>
                                        <option value="50">50 mm</option>
                                        <option value="63">63 mm</option>
                                        <option value="75">75 mm</option>
                                        <option value="90">90 mm</option>
                                        <option value="110">110 mm</option>
                                    </select>
                                    @error('diametro')
                                    <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Results Section -->
                        <div id="tbodyFlowVis" class="min-w-full mt-4"></div>


                        <!-- Button Section -->
                        <div class="mt-2 text-right md:col-span-3">
                            <button class="btn-calcular disabled:opacity-25" id="borrarTablaBtn">Calcular</button>
                        </div>
                    </div>

                    <!-- YouTube Video Section -->
                    <div class="w-full p-4 mt-4 md:mt-0">
                        <div class="relative pb-[56.25%] h-0 overflow-hidden">
                            <iframe width="560" height="315"
                                src="https://www.youtube.com/embed/6ar6DkJ0Kk4?si=xwrYpVoSUoqZigdn"
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
                    var tbodyFlowVis = document.getElementById("tbodyFlowVis");
                    // Función para borrar el contenido de la tabla
                    function borrarContenidoTabla() {
                        // Borra todas las filas del tbody
                        tbodyFlowVis.innerHTML = "";
                    }

                    // Agregar un evento de clic al botón para borrar la tabla
                    borrarTablaBtn.addEventListener("click", borrarContenidoTabla);

                    //REcogemos el valor de la resputa json
                    var resultado = response.resultado;

                    function crearTablaHTML(resultado) {

                        let html = '';

                        if (resultado.length === 0) {
                            html += '<div class="p-4 mb-2 text-red-700 bg-red-100 border-l-4 border-red-500" role="alert">';
                            html += 'No se encontró un producto compatible para los valores ingresados.';
                            html += '</div>';
                            return html;
                        }

                        html += '<div class="mb-2 text-gray-600"><p class="text-lg font-medium">Caudalímetro adecuado:</p></div>';

                        resultado.forEach(producto => {
                            html += '<div class="p-4 mb-2 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">';
                            html += producto.descripcion + ' — Ref: ' + producto.item +
                                    ' (DN ' + producto.dn + ', Ø ' + producto.diametro + ' mm, ' +
                                    'Caudal: ' + producto.caudal_min + ' - ' + producto.caudal_max + ' m³/h)';
                            html += ' Comprar producto pulsar aquí: <strong><a target="_blank" href="' + producto.url + '"> FlowVis </a></strong>' ;
                            html += '</div>';
                        });

                        return html;
                    }

                    // Crear HTML de la tabla
                    var tablaFlowVis = crearTablaHTML(resultado);

                    // Insertar el HTML en el cuerpo del documento
                    document.getElementById("tbodyFlowVis").innerHTML =
                        tablaFlowVis;

                },
                error: function(xhr, status, error) {
                    // Manejar los errores de la llamada AJAX
                    console.error(xhr.responseText);
                }
            });
        });
    });



    document.addEventListener("DOMContentLoaded", function () {
        const caudalInput = document.getElementById("caudal");
        const diametroSelect = document.getElementById("diametro");

        function toggleFields() {
            if (caudalInput.value) {
                diametroSelect.disabled = true;
                diametroSelect.classList.add("disabled-field");
                caudalInput.disabled = false;
                caudalInput.classList.remove("disabled-field");
            } else if (diametroSelect.value) {
                caudalInput.disabled = true;
                caudalInput.classList.add("disabled-field");
                diametroSelect.disabled = false;
                diametroSelect.classList.remove("disabled-field");
            } else {
                // Ambos activos si ninguno tiene valor
                caudalInput.disabled = false;
                diametroSelect.disabled = false;
                caudalInput.classList.remove("disabled-field");
                diametroSelect.classList.remove("disabled-field");
            }
        }

        caudalInput.addEventListener("input", toggleFields);
        diametroSelect.addEventListener("change", toggleFields);

        toggleFields(); // Al cargar
    });

</script>
