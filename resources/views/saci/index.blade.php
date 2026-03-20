@extends('layouts.app')

@section('content')

<main class="seccion">


    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Bombas Saci"
        description="Calcula el ahorro energético con las bombas Saci" :user="$user" />

    <div class="container w-10/12 max-w-screen-lg mx-auto contenido">
        <div class="p-4 px-4 mb-0 caja md:p-8">
            <form action="{{ route('saci.calculo') }}" id="formulario-calculo" method="get">
                <div class="grid gap-4 mb-4 md:grid-cols-3">

                    <input type="hidden" id="calc_id" name="calc_id" value="AED">
                    <input type="hidden" id="calc_idioma" name="calc_idioma" value="es">

                    <div>
                        <label for="volumen" class="block text-sm font-medium text-gray-700">Volumen piscina
                            m³</label>
                        <input type="number" id="calc_volumen" name="calc_volumen" value="48"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="calc_filtration" class="block text-sm font-medium text-gray-700">Horas
                            depuración/Día</label>
                        <input type="number" id="calc_filtration" name="calc_filtration" min="1" max="24" value="8"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="calc_meses" class="block text-sm font-medium text-gray-700">Meses temporada</label>
                        <select id="calc_meses" name="calc_meses"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="1">1 mes</option>
                            <option value="2">2 meses</option>
                            <option value="3">3 meses</option>
                            <option value="4">4 meses</option>
                            <option value="5">5 meses</option>
                            <option value="6">6 meses</option>
                            <option value="7">7 meses</option>
                            <option value="8" selected>8 meses</option>
                            <option value="9">9 meses</option>
                            <option value="10">10 meses</option>
                            <option value="11">11 meses</option>
                            <option value="12">12 meses</option>
                        </select>
                    </div>


                    <div>
                        <div class="inline-container">
                            <label for="calc_perdidas" class="block text-sm font-medium text-gray-700">Pérdida de
                                carga</label>
                            <p class="help-button" id="help-button">?</p>
                        </div>
                        <select id="calc_perdidas" name="calc_perdidas"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="0.5">Muy baja</option>
                            <option value="0.75">Baja</option>
                            <option value="1" selected>Media</option>
                            <option value="1.25">Alta</option>
                            <option value="1.5">Muy Alta</option>
                        </select>


                        <div class="help-popup" id="help-popup">
                            <ul>
                                <li><strong>Muy baja:</strong><br>- La bomba está junto a la piscina, aspira en carga, y
                                    solo
                                    existe el filtro de arena en el recorrido de retorno a la piscina.</li>
                                <li><strong>Baja:</strong><br>- La bomba está junto a la piscina, aspira en carga y
                                    además se
                                    dispone de un clorador salino.</li>
                                <li><strong>Media:</strong><br>- La bomba está en carga a más de 15 metros de la piscina
                                    y hay
                                    clorador salino.<br>- La bomba está junto a la piscina pero tiene que aspirar más de
                                    1 metro vertical.</li>
                                <li><strong>Alta:</strong><br>- La bomba está en carga pero a más de 30 metros de la
                                    piscina.<br>- La bomba tiene que aspirar y además está algunos metros separada de la
                                    piscina.</li>
                                <li><strong>Muy Alta:</strong><br>- La bomba tiene que aspirar, está separada de la
                                    piscina y
                                    existen varios elementos además del fitro de arena en el recorrido de retorno.</li>
                            </ul>
                        </div>
                    </div>

                    <div>
                        <label for="calc_tuberia" class="block text-sm font-medium text-gray-700">Diámetro de
                            tubería</label>
                        <select id="calc_tuberia" name="calc_tuberia"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="32">DN32</option>
                            <option value="40">DN40</option>
                            <option value="50" selected>DN50</option>
                            <option value="63">DN63</option>
                            <option value="75">DN75</option>
                            <option value="90">DN90</option>
                            <option value="110">DN110</option>
                        </select>
                    </div>

                    <div>
                        <label for="calc_preciokw" class="block text-sm font-medium text-gray-700">Precio
                            electricidad</label>
                        <input type="number" id="calc_preciokw" name="calc_preciokw" min="0.01" value="0.25" step=".01"
                            max="10"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>



                    <div>
                        <label for="calc_potencia" class="block text-sm font-medium text-gray-700">Potencia
                            bomba Standard</label>
                        <select id="calc_potencia" name="calc_potencia"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="0.25">0,25 cv</option>
                            <option value="0.33">0,33 cv</option>
                            <option value="0.50">0,50 cv</option>
                            <option value="0.75">0,75 cv</option>
                            <option value="1.00">1,00 cv</option>
                            <option value="1.50" selected>1,50 cv</option>
                            <option value="2.00">2,00 cv</option>
                            <option value="3.00">3,00 cv</option>
                            <option value="4.00">4,00 cv</option>
                            <option value="5.00">5,00 cv</option>
                        </select>
                    </div>
                    <div class="flex-1">
                        <label for="calc_modelo" class="block text-sm font-medium text-gray-700">Modelo bomba
                            Saci</label>
                        <select id="calc_modelo" name="calc_modelo"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="VARIO_WINNER_33_M">VARIO WINNER 33 M</option>
                            <option value="VARIO_WINNER_50_M">VARIO WINNER 50 M</option>
                            <option value="VARIO_WINNER_75_M">VARIO WINNER 75 M</option>
                            <option value="VARIO_WINNER_100_M">VARIO WINNER 100 M</option>
                            <option value="VARIO_WINNER_150_M" selected>VARIO WINNER 150 M</option>
                            <option value="VARIO_WINNER_200_M">VARIO WINNER 200 M</option>
                            <option value="VARIO_WINNER_300_M">VARIO WINNER 300 M</option>
                            <option value="E_WINNER_150">[e]WINNER 150</option>
                            <option value="E_WINNER_300">[e]WINNER 300</option>
                            <option value="E_WINNER_PRO">[e]WINNER PRO</option>
                            <option value="VARIO_SUPRA_300">VARIO SUPRA 300</option>
                            <option value="VARIO_SUPRA_400">VARIO SUPRA 400</option>
                            <option value="VARIO_SUPRA_550">VARIO SUPRA 550</option>
                            <option value="E_SUPRA_550">[e]SUPRA 550</option>
                        </select>
                    </div>


                    <div class="text-right md:col-span-3">
                        <button class="btn-calcular disabled:opacity-25" id="borrarTablaBtn">
                            Calcular
                        </button>
                    </div>
                </div>
        </div>
        <x-boton-volver :user="$user" />
        </form>

        <div id="tbodyBombaSaci" class="min-w-full mt-4 table-auto"></div>

        <div class="ml-10">
            <div id="graficas" class="row" style="display: none">
                <!-------------------------------- GRAPHS ---------------------------------------------->
                <div class="px-5 mt-5 col-12 col-sm-6" id="divGraficas1">
                    <div class="chartjs-size-monitor"
                        style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                        <div class="chartjs-size-monitor-expand"
                            style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink"
                            style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                        </div>
                    </div>
                    <p class="text-center"><b>Coste Energético</b></p>
                    <canvas id="graficas-1" width="519" height="350"
                        style="display: block; width: 519px; height: 259px;" class="chartjs-render-monitor"></canvas>
                </div>
                <div class="px-5 mt-5 col-12 col-sm-6" id="divGraficas2">
                    <div class="chartjs-size-monitor"
                        style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                        <div class="chartjs-size-monitor-expand"
                            style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                        </div>
                        <div class="chartjs-size-monitor-shrink"
                            style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                            <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                        </div>
                    </div>
                    <p class="text-center"><b>Consumo Energético</b></p>
                    <canvas id="graficas-2" width="519" height="350"
                        style="display: block; width: 519px; height: 259px;" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>

        <div class="mt-5 row" id="mensaje-responsabilidad" style="display: none">
            <div class="col-12">
                <div id="calc_disclaimer" class="alert alert-warning text-muted small"><i
                        class="fas fa-exclamation-circle fa-3x me-4 float-start"></i>PS POOL EQUIPMENT S.L. no se hace
                    responsable en ningún caso de las posibles diferencias que puedan surgir en la instalación real, en
                    comparación a los cálculos estríctamente teóricos presentados en el siguiente Informe de Eficiencia
                    Energética.</div>
            </div>
        </div>
    </div>

    <div id="loading" style="display: none;">
        <div id="loading-spinner"></div>
        <div class="block text-xl font-medium text-center text-gray-700">
            <p>Calculando resultados...</p>
        </div>
    </div>

    </div>
</main>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    // Remover el event listener separado del botón ya que lo manejaremos dentro del submit
    $('#formulario-calculo').submit(function(event) {
        event.preventDefault();

        // Limpiar los gráficos existentes antes de crear nuevos
        destroyCharts();

        $('#tbodyBombaSaci').hide();
        $('#graficas').hide();
        $('#mensaje-responsabilidad').hide();

        $('#loading').show();

        var url = $(this).attr('action');
        var formData = $(this).serialize();

        $.ajax({
            type: 'GET',
            url: url,
            data: formData,
            success: function(response) {
                $('#loading').hide();
                $('#tbodyBombaSaci').show();
                $('#graficas').show();
                $('#mensaje-responsabilidad').show();

                // Recogemos los datos de la respuesta json
                var ahorro_anual = response.ahorro_anual;
                var ahorro_en_potencia = response.ahorro_en_potencia;
                var ahorro_energetico = response.ahorro_energetico;
                var caudal_sincrono = response.caudal_sincrono;
                var coste_anual_asincrono = response.coste_anual_asincrono;
                var coste_anual_velocidad_variable = response.coste_anual_velocidad_variable;
                var coste_diario_asincrono = response.coste_diario_asincrono;
                var coste_diario_velocidad_variable = response.coste_diario_velocidad_variable;
                var horas_horas_maximas = response.horas_horas_maximas;
                var minutos_horas_maximas = response.minutos_horas_maximas;
                var potencia_absorbida_asincrona_diaria = response.potencia_absorbida_asincrona_diaria;
                var potencia_absorbida_diaria = response.potencia_absorbida_diaria;
                var rpm_min = response.rpm_min;
                var modelobombaSaci = response.modeloBombaSaci.split('_').join(' ');
                var modeloStandard = response.modeloStandard;
                var conclusiones = response.conclusiones;

                var grafica_coste_mensual_ca = response.grafica_coste_mensual_ca;
                var grafica_coste_mensual_cs = response.grafica_coste_mensual_cs;
                var grafica_consumo_energetico_ea = response.grafica_consumo_energetico_ea;
                var grafica_consumo_energetico_es = response.grafica_consumo_energetico_es;

                // Crear HTML de la tabla
                var tablaHTMLSaci = crearTablaHTML(
                    modeloStandard,
                    modelobombaSaci,
                    potencia_absorbida_diaria,
                    potencia_absorbida_asincrona_diaria,
                    coste_diario_velocidad_variable,
                    coste_diario_asincrono,
                    coste_anual_velocidad_variable,
                    coste_anual_asincrono,
                    horas_horas_maximas,
                    minutos_horas_maximas,
                    rpm_min,
                    caudal_sincrono,
                    ahorro_anual,
                    ahorro_en_potencia,
                    ahorro_energetico,
                    conclusiones
                );

                // Limpiar y actualizar el contenido
                $('#tbodyBombaSaci').html(tablaHTMLSaci);

                var textoBombaStandard = 'Bomba Standard de ' + modeloStandard.replace('.', ',') + ' cv';

                // Dibujar las nuevas gráficas
                crearGrafico('graficas-1', 'Comparación de Costes Mensuales', grafica_coste_mensual_ca, grafica_coste_mensual_cs, textoBombaStandard, modelobombaSaci);
                crearGrafico('graficas-2', 'Comparación de Consumo Energético', grafica_consumo_energetico_ea, grafica_consumo_energetico_es, textoBombaStandard, modelobombaSaci);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                $('#loading').hide();
            }
        });
    });

    // Event listener para el popup de ayuda
    $('#help-button').hover(
        function() {
            $('#help-popup').show();
        },
        function() {
            $('#help-popup').hide();
        }
    );
});

// Función para destruir los gráficos existentes
function destroyCharts() {
    var chart1 = Chart.getChart("graficas-1");
    var chart2 = Chart.getChart("graficas-2");

    if (chart1) {
        chart1.destroy();
    }
    if (chart2) {
        chart2.destroy();
    }
}

// Función para crear la tabla HTML (mantiene la misma estructura pero recibe parámetros)
function crearTablaHTML(
    modeloStandard,
    modelobombaSaci,
    potencia_absorbida_diaria,
    potencia_absorbida_asincrona_diaria,
    coste_diario_velocidad_variable,
    coste_diario_asincrono,
    coste_anual_velocidad_variable,
    coste_anual_asincrono,
    horas_horas_maximas,
    minutos_horas_maximas,
    rpm_min,
    caudal_sincrono,
    ahorro_anual,
    ahorro_en_potencia,
    ahorro_energetico,
    conclusiones
) {
    var html = '<div class="flex flex-wrap gap-1">';
                    // Primera tabla
                    html += '<div class="flex-1">';
                        html += '<table class="w-full bg-white">';
                            html += '<thead>';
                                html += '<tr>';
                                    html += '<th class="w-1/4 px-4 py-2 text-sm font-semibold text-white"></th>';
                                    html += '<th class="w-1/4 px-4 py-2 text-sm font-semibold text-center text-white bg-gray-800">Bomba ' + modelobombaSaci + '</th>';
                                    html += '<th class="w-1/4 px-4 py-2 text-sm font-semibold text-center text-white bg-gray-800">Bomba Standard de ' + modeloStandard.replace('.', ',') + ' cv</th>';
                                html += '</tr>';
                                html += '<tr>';
                                    html += '<th class="w-1/4 px-4 py-2 text-sm font-semibold text-white bg-gray-800">Potencia Absorbida Diaria</th>';
                                    html += '<th class="px-4 py-2 text-sm font-semibold text-center border">' + potencia_absorbida_diaria.toString().replace('.', ',') + ' kWh</th>';
                                    html += '<th class="px-4 py-2 text-sm font-semibold text-center border">' + potencia_absorbida_asincrona_diaria.toString().replace('.', ',') + ' kWh</th>';
                                html += '</tr>';
                                html += '<tr>';
                                    html += '<th class="w-1/4 px-4 py-2 text-sm font-semibold text-white bg-gray-800">Coste Diario</th>';
                                    html += '<th class="px-4 py-2 text-sm font-semibold text-center border">' + coste_diario_velocidad_variable.toString().replace('.', ',') + ' €</th>';
                                    html += '<th class="px-4 py-2 text-sm font-semibold text-center border">' + coste_diario_asincrono.toString().replace('.', ',') + ' €</th>';
                                html += '</tr>';
                                html += '<tr>';
                                    html += '<th class="w-1/4 px-4 py-2 text-sm font-semibold text-white bg-gray-800">Coste Anual</th>';
                                    html += '<th class="px-4 py-2 text-sm font-semibold text-center border">' + coste_anual_velocidad_variable.toString().replace('.', ',') + ' €</th>';
                                    html += '<th class="px-4 py-2 text-sm font-semibold text-center border">' + coste_anual_asincrono.toString().replace('.', ',') + ' €</th>';
                                html += '</tr>';
                                html += '<tr>';
                                    html += '<th class="w-1/4 px-4 py-2 text-sm font-semibold text-white bg-gray-800">Tiempo Funcionamiento</th>';
                                    html += '<th class="px-4 py-2 text-sm font-semibold text-center border">' + horas_horas_maximas + 'h ' + minutos_horas_maximas + 'min</th>';
                                    html += '<th class="px-4 py-2 text-sm font-semibold text-center border">' + horas_horas_maximas + 'h ' + minutos_horas_maximas + 'min</th>';
                                html += '</tr>';
                                html += '<tr>';
                                    html += '<th class="w-1/4 px-4 py-2 text-sm font-semibold text-white bg-gray-800">RPM Mínimas</th>';
                                    html += '<th class="px-4 py-2 text-sm font-semibold text-center border">' + rpm_min.toString().replace('.', ',') + ' rpm</th>';
                                    html += '<th class="px-4 py-2 text-sm font-semibold text-center border">-</th>';
                                html += '</tr>';
                                html += '<tr>';
                                    html += '<th class="w-1/4 px-4 py-2 text-sm font-semibold text-white bg-gray-800">Caudal Sincrono</th>';
                                    html += '<th class="px-4 py-2 text-sm font-semibold text-center border">' + caudal_sincrono.toString().replace('.', ',') + ' m³/h</th>';
                                    html += '<th class="px-4 py-2 text-sm font-semibold text-center border">-</th>';
                                html += '</tr>';
                            html += '</thead>';
                        html += '</table>';
                    html += '</div>';

                    // Segunda tabla
                    html += '<div">';
                        html += '<table class="w-full bg-white">';
                            html += '<thead>';
                                html += '<tr>';
                                    html += '<th colspan="2" class="px-4 py-2 text-lg font-semibold text-center text-white bg-green-600">Ahorros Estimados</th>';
                                html += '</tr>';
                                html += '<tr>';
                                    html += '<th class="w-1/2 px-4 py-2 text-sm font-semibold text-white bg-gray-800">Ahorro Anual</th>';
                                    html += '<th class="px-4 py-2 text-sm font-semibold text-center border">' + ahorro_anual.toString().replace('.', ',') + ' €</th>';
                                html += '</tr>';
                                html += '<tr>';
                                    html += '<th class="w-1/2 px-4 py-2 text-sm font-semibold text-white bg-gray-800">Ahorro en Potencia</th>';
                                    html += '<th class="px-4 py-2 text-sm font-semibold text-center border">' + ahorro_en_potencia.toString().replace('.', ',') + ' kW</th>';
                                html += '</tr>';
                                html += '<tr>';
                                    html += '<th class="w-1/2 px-4 py-2 text-sm font-semibold text-white bg-gray-800">Ahorro Energético</th>';
                                    html += '<th class="px-4 py-2 text-sm font-semibold text-center border">' + ahorro_energetico.toString().replace('.', ',') + ' %</th>';
                                html += '</tr>';
                            html += '</thead>';
                        html += '</table>';
                    html += '</div>';
                html += '</div>';

                 // Tercera tabla con las conclusiones
                 html += '<table class="min-w-full mt-6 bg-white">';
                    html += '<thead>';
                        html += '<tr>';
                            html += '<th colspan="2" class="px-4 py-2 text-lg font-semibold text-center text-white bg-green-600">Conclusiones</th>';
                        html += '</tr>';
                        html += '<tr>';
                            html += '<th class="px-4 py-2 text-sm font-thin text-left border">' + conclusiones + '</th>';
                        html += '</tr>';
                    html += '</thead>';
                html += '</table>';

            return html;
}

function crearGrafico(idCanvas, titulo, datos1, datos2, etiqueta1, etiqueta2) {
    const ctx = document.getElementById(idCanvas).getContext('2d');

    // Crear array de días (1 al 30)
    const dias = Array.from({ length: 31 }, (_, i) => `Día ${i + 1}`);

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: dias,
            datasets: [
                {
                    label: etiqueta1,
                    data: datos1,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: etiqueta2,
                    data: datos2,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: titulo
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                // Si es el gráfico de coste, añadir €
                                if (idCanvas === 'graficas-1') {
                                    label += context.parsed.y.toFixed(2) + ' €';
                                } else {
                                    // Si es el gráfico de consumo, añadir kWh
                                    label += context.parsed.y.toFixed(2) + ' kWh';
                                }
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Días'
                    },
                    ticks: {
                        // Mostrar menos etiquetas para evitar solapamiento
                        maxTicksLimit: 15,
                        callback: function(value, index) {
                            // Mostrar solo algunos días para mejor legibilidad
                            return dias[index];
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: idCanvas === 'graficas-1' ? 'Coste (€)' : 'Consumo (kWh)'
                    },
                    ticks: {
                        callback: function(value) {
                            if (idCanvas === 'graficas-1') {
                                return value + ' €';
                            } else {
                                return value + ' kWh';
                            }
                        }
                    }
                }
            }
        }
    });
}

</script>
