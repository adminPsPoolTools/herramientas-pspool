@extends('layouts.app')

@section('content')
    <main class="seccion">

        <x-header-herramientas class="py-5 titulo"
            background="background-image: url({{ asset('storage/img/home/home.jpg') }})" title="Carga de AFM"
            description="Calcula la carga de AFM necesaria para tu filtro" :user="$user" />

        <div class="container w-10/12 max-w-screen-lg mx-auto contenido">
            <div class="p-4 px-4 mb-0 caja md:p-8">
                <form action="{{ route('afm.calculo') }}" id="formulario-calculo" method="get">
                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="mb-4">
                            <label for="carga" class="block text-sm font-medium text-gray-700">Carga de silex
                                (kg)</label>
                            <input type="number" id="carga" name="carga" value="150" step=".1"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <div class="block text-sm font-medium text-gray-700">
                            <label for="tipo_filtro">Tipo de filtro</label><br>
                            <select name="tipo_filtro" id="tipo_filtro" onchange="toggleInput()"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="brazo">Brazos colectores</option>
                                <option value="crepina">Placa de crepinas</option>
                            </select>
                        </div>
                        <div class="block text-sm font-medium text-gray-700" id="diametro-container">
                            <label for="diametro">¿Filtro mayor de Ø800 mm.?</label><br>
                            <select name="diametro" id="diametro"
                                class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="no">No</option>
                                <option value="si">Si</option>
                            </select>
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
            <div id="tbodyResultadoAfm" class="min-w-full mt-4 table-auto">
                <div class="flex flex-col w-full gap-2">
                    <div role="alert"
                        class="relative flex w-full px-4 py-4 text-base text-gray-900 rounded-lg font-regular bg-gray-900/10"
                        style="opacity: 1;">
                        <div class="shrink-0"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd"
                                    d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                    clip-rule="evenodd"></path>
                            </svg></div>
                        <div class="ml-3 mr-12">
                            <p class="block font-sans text-base antialiased font-medium leading-relaxed text-inherit">
                                Rellena los datos</p>
                            <ul class="mt-2 ml-2 list-disc list-inside">
                                <li>Los valores mostrados son aproximados</li>
                                <li>Si tiene alguna duda contacte con la oficina</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function toggleInput() {
        var tipoFiltro = document.getElementById("tipo_filtro").value;
        var diametroContainer = document.getElementById("diametro-container");
        if (tipoFiltro === "crepina") {
            diametroContainer.style.display = "none";
        } else {
            diametroContainer.style.display = "block";
        }
    }



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
                    var carga = response.carga;
                    var diametro = response.diametro;
                    var afmGrado1 = response.afmGrado1;
                    var afmGrado2 = response.afmGrado2;
                    var afmGrado3 = response.afmGrado3;
                    var sacosGrado1 = response.sacosGrado1;
                    var sacosGrado2 = response.sacosGrado2;
                    var sacosGrado3 = response.sacosGrado3;
                    var totalKilosSegunSacos = response.totalKilosSegunSacos;
                    var totalKilosSegunCalculos = response.totalKilosSegunCalculos;

                    // Obtener referencias a elementos relevantes
                    var tbodyResultadoAfm = document.getElementById("tbodyResultadoAfm");

                    // Función para borrar el contenido de la tabla
                    function borrarContenidoTabla() {
                        // Borra todas las filas del tbody
                        tbodyResultadoAfm.innerHTML = "";
                    }

                    // Agregar un evento de clic al botón para borrar la tabla
                    borrarTablaBtn.addEventListener("click", borrarContenidoTabla);


                    function crearTablaHTML() {
                        var html = '<table class="min-w-full bg-white border">';
                        html += '<thead class="">';
                        html += '<tr>';
                        html +=
                            '<th class="w-2/4 px-4 py-3 text-sm font-semibold text-white bg-gray-800">Carga de silex</th>';
                        html +=
                            '<th class="px-4 py-3 text-sm font-semibold text-center border">' +
                            carga.toString().replace('.', ',') + ' kg</th>';
                        html += '</tr>';

                        // html += '<tr>';
                        //     html += '<th class="w-2/4 px-4 py-3 text-sm font-semibold text-white bg-gray-800">Diametro del filtro</th>';
                        //     html += '<th class="px-4 py-3 text-sm font-semibold text-center border"> Mayor de Ø800 mm. ' + diametro.toUpperCase() + '</th>';
                        // html += '</tr>';

                        html += '<tr>';
                        html +=
                            '<th class="w-2/4 px-4 py-3 text-sm font-semibold text-white bg-gray-800">Kg AFM 1</th>';
                        html +=
                            '<th class="px-4 py-3 text-sm font-semibold text-center border"><a class="btn-calcular disabled:opacity-25" target="_blank" href="https://ps-pool.com/tienda/medios-filtrantes/290-1653-medio-de-filtrado-afmR-ng-506028305061.html#/1718-kilos-21_kg/1719-granulometria-grado_1">' +
                            afmGrado1.toString().replace('.', ',') +
                            ' Kg AFM grado 1</a></th>';
                        html += '</tr>';

                        html += '<tr>';
                        html +=
                            '<th class="w-2/4 px-4 py-3 text-sm font-semibold text-white bg-gray-800">Kg AFM 2</th>';
                        html +=
                            '<th class="px-4 py-3 text-sm font-semibold text-center border"><a class="btn-calcular disabled:opacity-25" target="_blank" href="https://ps-pool.com/tienda/medios-filtrantes/290-1654-medio-de-filtrado-afmR-ng-506028305061.html#/1718-kilos-21_kg/1720-granulometria-grado_2">' +
                            afmGrado2.toString().replace('.', ',') +
                            ' Kg AFM grado 2</a></th>';
                        html += '</tr>';

                        if (!afmGrado3 == 0) {
                            html += '<tr>';
                            html +=
                                '<th class="w-2/4 px-4 py-3 text-sm font-semibold text-white bg-gray-800">Kg AFM 3</th>';
                            html +=
                                '<th class="px-4 py-3 text-sm font-semibold text-center border"><a class="btn-calcular disabled:opacity-25" target="_blank" href="https://ps-pool.com/tienda/medios-filtrantes/290-1655-medio-de-filtrado-afmR-ng-506028305061.html#/1718-kilos-21_kg/1721-granulometria-grado_3">' +
                                afmGrado3.toString().replace('.', ',') +
                                ' Kg AFM grado 3</a></th>';
                            html += '</tr>';
                        }

                        html += '<tr>';
                        html +=
                            '<th class="w-1/4 px-4 py-3 text-sm font-semibold text-white bg-gray-800">Sacos AFM 1</th>';
                        html +=
                            '<th class="px-4 py-3 text-sm font-semibold text-center border">' +
                            sacosGrado1 + ' Sacos Grado 1</th>';
                        html += '</tr>';

                        html += '<tr>';
                        html +=
                            '<th class="w-1/4 px-4 py-3 text-sm font-semibold text-white bg-gray-800">Sacos AFM 2</th>';
                        html +=
                            '<th class="px-4 py-3 text-sm font-semibold text-center border">' +
                            sacosGrado2 + ' Sacos Grado 2</th>';
                        html += '</tr>';

                        if (!afmGrado3 == 0) {
                            html += '<tr>';
                            html +=
                                '<th class="w-1/4 px-4 py-3 text-sm font-semibold text-white bg-gray-800">Sacos AFM 3</th>';
                            html +=
                                '<th class="px-4 py-3 text-sm font-semibold text-center border">' +
                                sacosGrado3 + ' Sacos Grado 3</th>';
                            html += '</tr>';
                        }

                        html += '<tr>';
                        html +=
                            '<th class="w-1/4 px-4 py-3 text-sm font-semibold text-white bg-gray-800">Total kg AFM calculados</th>';
                        html +=
                            '<th class="px-4 py-3 text-sm font-semibold text-center border">' +
                            totalKilosSegunCalculos.toString().replace('.', ',') +
                            ' Kgs.</th>';
                        html += '</tr>';

                        html += '<tr>';
                        html +=
                            '<th class="w-1/4 px-4 py-3 text-sm font-semibold text-white bg-gray-800">Total kg AFM segun sacos</th>';
                        html +=
                            '<th class="px-4 py-3 text-sm font-semibold text-center border">' +
                            totalKilosSegunSacos.toString().replace('.', ',') +
                            ' Kgs.</th>';
                        html += '</tr>';

                        html += '</thead>';
                        html += '</table>';
                        return html;
                    }


                    // Crear HTML de la tabla
                    var tablaHTML = crearTablaHTML();

                    // Insertar el HTML en el cuerpo del documento
                    document.getElementById("tbodyResultadoAfm").innerHTML = tablaHTML;

                },
                error: function(xhr, status, error) {
                    // Manejar los errores de la llamada AJAX
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
