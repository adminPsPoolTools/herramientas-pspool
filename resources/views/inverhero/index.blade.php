@extends('layouts.app')

@section('content')
<main class="seccion">

    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Bombas inverHero"
        description="Calcula el ahorro energético con las bombas inverhero" :user="$user" />

    <div class="container w-10/12 max-w-screen-lg mx-auto contenido">
        <div class="p-4 px-4 mb-0 caja md:p-8">
            <form action="{{ route('inverhero.calculo') }}" id="formulario-calculo" method="get">
                <div class="grid gap-4 mb-4 md:grid-cols-3">

                    <div>
                        <label for="volumen" class="block text-sm font-medium text-gray-700">Volumen piscina
                            m³</label>
                        <input type="number" id="volumen" name="volumen" value="48"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="horas" class="block text-sm font-medium text-gray-700">Horas depuración</label>
                        <select id="horas" name="horas"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="1">1 horas</option>
                            <option value="2">2 horas</option>
                            <option value="3">3 horas</option>
                            <option value="4">4 horas</option>
                            <option value="5">5 horas</option>
                            <option value="6">6 horas</option>
                            <option value="7">7 horas</option>
                            <option value="8" selected>8 horas</option>
                        </select>
                    </div>

                    <div>
                        <label for="precio" class="block text-sm font-medium text-gray-700">Precio
                            electricidad</label>
                        <input type="number" id="precio" name="precio" min="0" value="0.35" step=".01"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>


                    <div>
                        <label for="meses" class="block text-sm font-medium text-gray-700">Meses temporada</label>
                        <select id="meses" name="meses"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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
                        <label for="modelo" class="block text-sm font-medium text-gray-700">Modelo InverHero</label>
                        <select id="modelo" name="modelo"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="IH20">IH20(0.75kw)</option>
                            <option value="IH24">IH24(1.05kw)</option>
                            <option value="IH30">IH30(1.40kw)</option>
                            <option value="IH40">IH40(1.75kw)</option>
                        </select>
                    </div>
                    <div class="flex-1">
                        <label for="comparativa" class="block text-sm font-medium text-gray-700">Bomba normal
                            kW</label>
                        <select id="comparativa" name="comparativa"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="75">0,75 kw</option>
                            <option value="110">1,10 kw</option>
                            <option value="150">1,50 kw</option>
                        </select>
                    </div>

                    <div class="flex-1">
                        <label for="velocidad" class="block text-sm font-medium text-gray-700">% Velocidad</label>
                        <select id="velocidad" name="velocidad"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="30">30 %</option>
                            <option value="40">40 %</option>
                            <option value="50">50 %</option>
                            <option value="60">60 %</option>
                            <option value="70">70 %</option>
                            <option value="80">80 %</option>
                            <option value="90">90 %</option>
                            <option value="100">100 %</option>
                            <option value="110">110 %</option>
                            <option value="120">120 %</option>
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
        {{-- Tabla resultados --}}
        <div id="tbodyBombaIH" class="min-w-full mt-4 table-auto"></div>
        <div id="tbodyBombaTotal" class="min-w-full mt-4 table-auto"></div>
        {{-- Tabla resultados --}}

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
    var volumenTotalIH              = response.volumenTotalIH;
    var horasFuncionamientoBombaIH  = response.horasFuncionamientoBombaIH;
    var consumoBombaKwIH            = response.consumoBombaKwIH;
    var consumoMensualIH            = response.consumoMensualIH;
    var costeElectricidadMensualIH  = response.costeElectricidadMensualIH;
    var costeElectricidadAnualIH    = response.costeElectricidadAnualIH;
    var ruidoIH                     = response.ruidoIH;
    var modeloBombaIH               = response.modeloBombaIH;

    var volumenTotalST              = response.volumenTotalST;
    var horasFuncionamientoBombaST  = response.horasFuncionamientoBombaST;
    var consumoBombaKwST            = response.consumoBombaKwST;
    var consumoMensualST            = response.consumoMensualST;
    var costeElectricidadMensualST  = response.costeElectricidadMensualST;
    var costeElectricidadAnualST    = response.costeElectricidadAnualST;
    var ruidoST                     = response.ruidoST;

    var ahorroMes               = response.ahorroMes;
    var ahorroTemporada         = response.ahorroTemporada;
    var ahorroCincoTemporadas   = response.ahorroCincoTemporadas;
    var ahorroDiezTemporadas    = response.ahorroDiezTemporadas;

    // Obtener referencias a elementos relevantes
    var tbodyBombaIH   = document.getElementById("tbodyBombaIH");
    var tbodyBombaTotal   = document.getElementById("tbodyBombaTotal");
    var borrarTablaBtn  = document.getElementById("borrarTablaBtn");

    // Función para borrar el contenido de la tabla
    function borrarContenidoTabla() {
        // Borra todas las filas del tbody
        tbodyBombaIH.innerHTML = "";
        tbodyBombaTotal.innerHTML = "";
    }

    // Agregar un evento de clic al botón para borrar la tabla
    borrarTablaBtn.addEventListener("click", borrarContenidoTabla);


    function crearTablaHTML() {
        var html = '<table class="min-w-full bg-white">';
                html += '<thead class="">';
                    html += '<tr>';
                        html += '<th class="w-1/4 px-4 py-3 text-sm font-semibold text-white"></th>';
                        html += '<th class="w-1/4 px-4 py-3 text-sm font-semibold text-center text-white bg-gray-800">Modelo bomba InverHero '+ modeloBombaIH + ' </th>';
                        html += '<th class="w-1/4 px-4 py-3 text-sm font-semibold text-center text-white bg-gray-800">Bombas Standar</th>';
                    html += '</tr>';
                    html += '<tr>';
                        html += '<th class="w-1/4 px-4 py-3 text-sm font-semibold text-white bg-gray-800">Ruido dB(A) 1 m</th>';
                        html += '<th class="px-4 py-3 text-sm font-semibold text-center border">' + ruidoIH.toString().replace('.', ',')  +' dB</th>';
                        html += '<th class="px-4 py-3 text-sm font-semibold text-center border">' + ruidoST.toString().replace('.', ',')  +' dB</th>';
                    html += '</tr>';

                    html += '<tr>';
                        html += '<th class="w-1/4 px-4 py-3 text-sm font-semibold text-white bg-gray-800">Horas al día</th>';
                        html += '<th class="px-4 py-3 text-sm font-semibold text-center border">' + horasFuncionamientoBombaIH.toString().replace('.', ',') + ' horas</th>';
                        html += '<th class="px-4 py-3 text-sm font-semibold text-center border">' + horasFuncionamientoBombaST.toString().replace('.', ',') +' horas</th>';
                    html += '</tr>';

                    html += '<tr>';
                        html += '<th class="w-1/4 px-4 py-3 text-sm font-semibold text-white bg-gray-800">Consumo kWh al mes</th>';
                        html += '<th class="px-4 py-3 text-sm font-semibold text-center border">' + consumoMensualIH.toString().replace('.', ',') +' kWh/mes</th>';
                        html += '<th class="px-4 py-3 text-sm font-semibold text-center border">' + consumoMensualST.toString().replace('.', ',') +' kWh/mes</th>';
                    html += '</tr>';

                    html += '<tr>';
                        html += '<th class="w-1/4 px-4 py-3 text-sm font-semibold text-white bg-gray-800">Coste electricidad al mes</th>';
                        html += '<th class="px-4 py-3 text-sm font-semibold text-center border">' + costeElectricidadMensualIH.toString().replace('.', ',') +' €</th>';
                        html += '<th class="px-4 py-3 text-sm font-semibold text-center border">' + costeElectricidadMensualST.toString().replace('.', ',') +' €</th>';
                    html += '</tr>';

                    html += '<tr>';
                        html += '<th class="w-1/4 px-4 py-3 text-sm font-semibold text-white bg-gray-800">Coste electricidad al año</th>';
                        html += '<th class="px-4 py-3 text-sm font-semibold text-center border">' + costeElectricidadAnualIH.toString().replace('.', ',') +' €</th>';
                        html += '<th class="px-4 py-3 text-sm font-semibold text-center border">' + costeElectricidadAnualST.toString().replace('.', ',') +' €</th>';
                    html += '</tr>';
                html += '</thead>';
            html += '</table>';
    return html;
}
function crearTablaHTMLTotal() {
        var html = '<table class="min-w-full bg-white border">';
                html += '<thead class="">';
                    html += '<tr>';
                    html += '<th class="w-1/4 px-4 py-3 text-sm font-semibold text-white border-none"></th>';
                    html += '<th class="px-4 py-3 text-sm font-semibold text-center border">Mes</th>';
                    html += '<th class="px-4 py-3 text-sm font-semibold text-center border">Temporada</th>';
                    html += '<th class="px-4 py-3 text-sm font-semibold text-center border">Cinco Temporadas</th>';
                    html += '<th class="px-4 py-3 text-sm font-semibold text-center border">Diez Temporadas</th>';
                html += '</tr>';
                html += '<tr>';
                    html += '<th class="w-1/4 px-4 py-3 text-sm font-semibold text-white bg-gray-800">Ahorros</th>';
                    html += '<th class="px-4 py-3 text-sm font-semibold text-center border">' + ahorroMes.toString().replace('.', ',') + ' €</th>';
                    html += '<th class="px-4 py-3 text-sm font-semibold text-center border">' + ahorroTemporada.toString().replace('.', ',') + ' €</th>';
                    html += '<th class="px-4 py-3 text-sm font-semibold text-center border">' + ahorroCincoTemporadas.toString().replace('.', ',') + ' €</th>';
                    html += '<th class="px-4 py-3 text-sm font-semibold text-center border">' + ahorroDiezTemporadas.toString().replace('.', ',') + ' €</th>';
                html += '</tr>';
                html += '</thead>';
            html += '</table>';

            html += '<div class="my-6 bg-white rounded shadow-md">';
            html += '<table class="min-w-full table-auto">';
            html += '<thead class="bg-gray-200">';
                html += '<tr>';
                    html += '<th class="text-sm font-medium text-gray-700">Modelo</th>';
                    html += '<th class="text-sm font-medium text-gray-700">Volumen (m³)</th>';
                    html += '<th class="text-sm font-medium text-gray-700">P1 (kW)</th>';
                    html += '<th class="text-sm font-medium text-gray-700">Voltaje (V/Hz)</th>';
                    html += '<th class="text-sm font-medium text-gray-700">Q max (m³/h)</th>';
                    html += '<th class="text-sm font-medium text-gray-700">Hmax (m)</th>';
                    html += '<th class="text-sm font-medium text-gray-700">Caudal (m³/h)<br>Max 8 m.c.a.</th>';
                    html += '<th class="text-sm font-medium text-gray-700">Caudal (m³/h)<br>Max 10 m.c.a.</th>';
                    html += '<th class="text-sm font-medium text-gray-700">Producto</th>';
                html+= '</tr>';
            html+= '</thead>';

            html+= '<tbody>';

                  if(modeloBombaIH == "IH20"){
                    var url = 'https://ps-pool.com/tienda/bombas-inverhero/315-1660-inverhero-monofasica.html#/1724-modelo-ih20_075_kw_10_cv_230v'
                      html += '<tr class="bg-gray-100">';
                      html += '<td class="px-4 py-2 border">IH20</td>';
                          html += '<td class="px-4 py-2 border">30~50</td>';
                          html += '<td class="px-4 py-2 border">0,75</td>';
                          html += '<td class="px-4 py-2 border">220~240/50/60</td>';
                          html += '<td class="px-4 py-2 border">24,0</td>';
                          html += '<td class="px-4 py-2 border">18,0</td>';
                          html += '<td class="px-4 py-2 border">18,1</td>';
                          html += '<td class="px-4 py-2 border">14,1</td>';
                          html += botonComprar(url);
                      html += '</tr>';

                  } else if (modeloBombaIH == "IH24"){
                    var url = 'https://ps-pool.com/tienda/bombas-inverhero/315-1661-inverhero-monofasica.html#/1725-modelo-ih24_105_kw_15_cv_230v'
                    html += '<tr class="bg-gray-100">';
                      html += '<td class="px-4 py-2 border">IH24</td>';
                          html += '<td class="px-4 py-2 border">40~70</td>';
                          html += '<td class="px-4 py-2 border">1,05</td>';
                          html += '<td class="px-4 py-2 border">220~240/50/60</td>';
                          html += '<td class="px-4 py-2 border">27,0</td>';
                          html += '<td class="px-4 py-2 border">20,0</td>';
                          html += '<td class="px-4 py-2 border">23,0</td>';
                          html += '<td class="px-4 py-2 border">19,3</td>';
                          html += botonComprar(url);
                      html += '</tr>';
                  }else if (modeloBombaIH == "IH30"){
                    var url = 'https://ps-pool.com/tienda/bombas-inverhero/315-1662-inverhero-monofasica.html#/1726-modelo-ih30_140_kw_18_cv_230v'
                      html += '<tr class="bg-gray-100">';
                      html += '<td class="px-4 py-2 border">IH30</td>';
                          html += '<td class="px-4 py-2 border">50~80</td>';
                          html += '<td class="px-4 py-2 border">1,40</td>';
                          html += '<td class="px-4 py-2 border">220~240/50/60</td>';
                          html += '<td class="px-4 py-2 border">29,5</td>';
                          html += '<td class="px-4 py-2 border">21,0</td>';
                          html += '<td class="px-4 py-2 border">27,3</td>';
                          html += '<td class="px-4 py-2 border">24,5</td>';
                          html += botonComprar(url);
                      html += '</tr>';
                  } else {
                    var url = 'https://ps-pool.com/tienda/bombas-inverhero/315-1663-inverhero-monofasica.html#/1727-modelo-ih40_175_kw_22_cv_230v'
                      html += '<tr>';
                      html += '<td class="px-4 py-2 border">IH40</td>';
                          html += '<td class="px-4 py-2 border">70~100</td>';
                          html += '<td class="px-4 py-2 border">1,75</td>';
                          html += '<td class="px-4 py-2 border">220~240/50/60</td>';
                          html += '<td class="px-4 py-2 border">42,0</td>';
                          html += '<td class="px-4 py-2 border">21,0</td>';
                          html += '<td class="px-4 py-2 border">35,6</td>';
                          html += '<td class="px-4 py-2 border">32,0</td>';
                          html += botonComprar(url);
                      html += '</tr>';
                }
                html += '</tbody>';
            html += '</table>';
        html += '</div>';

    return html;
}


// Crear HTML de la tabla
var tablaHTMLIH = crearTablaHTML();
var tablaHTMLTotal = crearTablaHTMLTotal();

// Insertar el HTML en el cuerpo del documento
document.getElementById("tbodyBombaIH").innerHTML = tablaHTMLIH;
document.getElementById("tbodyBombaTotal").innerHTML = tablaHTMLTotal;

},
    error: function(xhr, status, error) {
    // Manejar los errores de la llamada AJAX
    console.error(xhr.responseText);
    }
});
});
});

function botonComprar(url){

var botonComprar = '<div class="text-right md:col-span-2">';

    if (url) {
        botonComprar += '<td class="border"><div class="p-1 text-center md:col-span-2"><a target="_blank" href="' + url + '" class="btn-calcular disabled:opacity-25">Comprar</a></div></td>';
    } else {
        botonComprar += '<td class="px-4 py-2 text-gray-500 border">Sin URL</td>';
    }

    botonComprar += '</div>';
    return botonComprar;

}

</script>
