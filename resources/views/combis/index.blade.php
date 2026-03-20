@extends('layouts.app')

@section('content')
    <script src="https://cdn.tailwindcss.com"></script>

    <main class="seccion">
        <x-header-herramientas class="py-5 titulo"
            background="background-image: url({{ asset('storage/img/home/home.jpg') }})" title="Configura tu Combi-Whirl"
            description="Configura tu sistema de masaje Combi-Whirl" :user="$user" />

        <div class="container w-10/12 max-w-screen-lg mx-auto mb-4 contenido">
            <div class="p-4 px-4 mb-0 caja md:p-8">
                <div class="button-container">
                    <p>Con esta herramienta te mostramos todos los elementos necesarios para configurar tu sistema de
                        masaje
                        Combi-Whirl en función del número de boquillas que necesites.</p>
                    <div class="items-center filter-button" data-value="1Fondo">1 Fondo</div>
                    <div class="filter-button" data-value="1Pared">1 Pared</div>
                    <div class="filter-button" data-value="1Fondo1Pared">1 Fondo <br> 1 Pared</div>
                    <div class="filter-button" data-value="1Fondo2Pared">1 Fondo <br> 2 Pared</div>
                    <div class="filter-button" data-value="2Fondo1Pared">2 Fondo <br> 1 Pared</div>
                    <div class="filter-button" data-value="2Fondo2Pared">2 Fondo <br> 2 Pared</div>
                    <div class="filter-button" data-value="3Fondo1Pared">3 Fondo <br> 1 Pared</div>
                    <div class="filter-button" data-value="1Fondo3Pared">1 Fondo <br> 3 Pared</div>
                </div>
                <table class="w-full min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr>
                            <th class="py-2 text-center tablacab">REF/URL</th>
                            <th class="px-4 py-2 tablacab">DESCRIPCIÓN</th>
                            <th class="px-4 py-2 tablacab">CAUDAL</th>
                            <th class="px-4 py-2 tablacab">POTENCIA</th>
                            <th class="px-4 py-2 column-1Fondo tablacab">1 x Fondo</th>
                            <th class="px-4 py-2 column-1Pared tablacab">1 x Pared</th>
                            <th class="px-4 py-2 column-1Fondo1Pared tablacab">1 x Fondo <br> 1 x Pared</th>
                            <th class="px-4 py-2 column-1Fondo2Pared tablacab">1 x Fondo <br> 2 x Pared</th>
                            <th class="px-4 py-2 column-2Fondo1Pared tablacab">2 x Fondo <br> 1 x Pared</th>
                            <th class="px-4 py-2 column-2Fondo2Pared tablacab">2 x Fondo <br> 2 x Pared</th>
                            <th class="px-4 py-2 column-3Fondo1Pared tablacab">3 x Fondo <br> 1 x Pared</th>
                            <th class="px-4 py-2 column-1Fondo3Pared tablacab">1 x Fondo <br> 3 x Pared</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <tr>
                            <td id="boton_url" class="text-center">
                                <a href="https://ps-pool.com/tienda/masaje-combi-whirl/206-nicho-combiwhirl-de-pared-rosca-interior-2-pulgadas.html"
                                    target="_blank">6530</a>
                            </td>
                            <td>Nicho impulsión pared</td>
                            <td>30m³</td>
                            <td>-</td>
                            <td class="px-5 column-1Fondo">-</td>
                            <td class="px-5 column-1Pared">1</td>
                            <td class="px-5 column-1Fondo1Pared">1</td>
                            <td class="px-5 column-1Fondo2Pared">2</td>
                            <td class="px-5 column-2Fondo1Pared">1</td>
                            <td class="px-5 column-2Fondo2Pared">2</td>
                            <td class="px-5 column-3Fondo1Pared">1</td>
                            <td class="px-5 column-1Fondo3Pared">3</td>
                        </tr>
                        <tr>
                            <td id="boton_url" class="text-center">
                                <a href="https://ps-pool.com/tienda/masaje-combi-whirl/186-nicho-combiwhirl-de-fondo-conexion-bronce-pvc-o63-mm.html"
                                    target="_blank">4695</a>
                            </td>
                            <td>Nicho impulsión fondo</td>
                            <td>30m³</td>
                            <td>-</td>
                            <td class="px-5 column-1Fondo">1</td>
                            <td class="px-5 column-1Pared">-</td>
                            <td class="px-5 column-1Fondo1Pared">1</td>
                            <td class="px-5 column-1Fondo2Pared">1</td>
                            <td class="px-5 column-2Fondo1Pared">2</td>
                            <td class="px-5 column-2Fondo2Pared">2</td>
                            <td class="px-5 column-3Fondo1Pared">3</td>
                            <td class="px-5 column-1Fondo3Pared">1</td>
                        </tr>
                        <tr>
                            <td id="boton_url" class="text-center">
                                <a href="https://ps-pool.com/tienda/masaje-combi-whirl/192-embellecedor-en-inox-v4a.html"
                                    target="_blank">4719</a>
                            </td>
                            <td>Embellecedor</td>
                            <td>-</td>
                            <td>-</td>
                            <td class="px-5 column-1Fondo">1</td>
                            <td class="px-5 column-1Pared">1</td>
                            <td class="px-5 column-1Fondo1Pared">2</td>
                            <td class="px-5 column-1Fondo2Pared">3</td>
                            <td class="px-5 column-2Fondo1Pared">3</td>
                            <td class="px-5 column-2Fondo2Pared">4</td>
                            <td class="px-5 column-3Fondo1Pared">4</td>
                            <td class="px-5 column-1Fondo3Pared">4</td>
                        </tr>
                        <tr>
                            <td id="boton_url" class="text-center">
                                <a href="https://ps-pool.com/tienda/masaje-combi-whirl/185-nicho-toma-aspiracion-hormigon-rosca-interior-2-1-2-pulgadas.html"
                                    target="_blank">4688</a>
                            </td>
                            <td>Nicho aspiración</td>
                            <td>60m³</td>
                            <td>-</td>
                            <td class="px-5 column-1Fondo">2</td>
                            <td class="px-5 column-1Pared">2</td>
                            <td class="px-5 column-1Fondo1Pared">2</td>
                            <td class="px-5 column-1Fondo2Pared">2</td>
                            <td class="px-5 column-2Fondo1Pared">2</td>
                            <td class="px-5 column-2Fondo2Pared">2</td>
                            <td class="px-5 column-3Fondo1Pared">2</td>
                            <td class="px-5 column-1Fondo3Pared">2</td>
                        </tr>
                        <tr>
                            <td id="boton_url" class="text-center">
                                <a href="https://ps-pool.com/tienda/masaje-combi-whirl/191-embellecedor-rejilla-o200-mm-en-inox-para-dn65.html"
                                    target="_blank">4713</a>
                            </td>
                            <td>Embellecedor aspiración 200mmØ</td>
                            <td>-</td>
                            <td>-</td>
                            <td class="px-5 column-1Fondo">2</td>
                            <td class="px-5 column-1Pared">2</td>
                            <td class="px-5 column-1Fondo1Pared">-</td>
                            <td class="px-5 column-1Fondo2Pared">-</td>
                            <td class="px-5 column-2Fondo1Pared">-</td>
                            <td class="px-5 column-2Fondo2Pared">-</td>
                            <td class="px-5 column-3Fondo1Pared">-</td>
                            <td class="px-5 column-1Fondo3Pared">-</td>
                        </tr>
                        <tr>
                            <td id="boton_url" class="text-center">
                                <a href="https://ps-pool.com/tienda/masaje-combi-whirl/83-embellecedor-rejilla-o280-mm-en-inox-para-dn80.html"
                                    target="_blank">14336</a>
                            </td>
                            <td>Embellecedor aspiración 280mmØ</td>
                            <td>-</td>
                            <td>-</td>
                            <td class="px-5 column-1Fondo">-</td>
                            <td class="px-5 column-1Pared">-</td>
                            <td class="px-5 column-1Fondo1Pared">2</td>
                            <td class="px-5 column-1Fondo2Pared">-</td>
                            <td class="px-5 column-2Fondo1Pared">-</td>
                            <td class="px-5 column-2Fondo2Pared">-</td>
                            <td class="px-5 column-3Fondo1Pared">-</td>
                            <td class="px-5 column-1Fondo3Pared">-</td>
                        </tr>
                        <tr>
                            <td id="boton_url" class="text-center">
                                <a href="https://ps-pool.com/tienda/masaje-combi-whirl/83-embellecedor-rejilla-o280-mm-en-inox-para-dn80.html"
                                    target="_blank">14336</a>
                            </td>
                            <td>Embellecedor aspiración 350mmØ</td>
                            <td>-</td>
                            <td>-</td>
                            <td class="px-5 column-1Fondo">-</td>
                            <td class="px-5 column-1Pared">-</td>
                            <td class="px-5 column-1Fondo1Pared">-</td>
                            <td class="px-5 column-1Fondo2Pared">2</td>
                            <td class="px-5 column-2Fondo1Pared">2</td>
                            <td class="px-5 column-2Fondo2Pared">2</td>
                            <td class="px-5 column-3Fondo1Pared">2</td>
                            <td class="px-5 column-1Fondo3Pared">2</td>
                        </tr>
                        <tr>
                            <td id="boton_url" class="text-center">
                                <a href="https://pspool.addisnetwork.es/bombas-fitstar/237-150-fitstar.html#/647-corriente-trifasica/680-caudal_m_h-3000_m_h"
                                    target="_blank">14142</a>
                            </td>
                            <td>Bomba bronce</td>
                            <td>30 m³</td>
                            <td>1,5 kW - 2CV</td>
                            <td class="px-5 column-1Fondo">1</td>
                            <td class="px-5 column-1Pared">1</td>
                            <td class="px-5 column-1Fondo1Pared">-</td>
                            <td class="px-5 column-1Fondo2Pared">-</td>
                            <td class="px-5 column-2Fondo1Pared">-</td>
                            <td class="px-5 column-2Fondo2Pared">-</td>
                            <td class="px-5 column-3Fondo1Pared">-</td>
                            <td class="px-5 column-1Fondo3Pared">-</td>
                        </tr>
                        <tr>
                            <td id="boton_url" class="text-center">
                                <a href="https://pspool.addisnetwork.es/bombas-fitstar/237-152-fitstar.html#/647-corriente-trifasica/681-caudal_m_h-4800_m_h"
                                    target="_blank">9832</a>
                            </td>
                            <td>Bomba bronce</td>
                            <td>48m³</td>
                            <td>2,2kW - 3CV</td>
                            <td class="px-5 column-1Fondo">-</td>
                            <td class="px-5 column-1Pared">-</td>
                            <td class="px-5 column-1Fondo1Pared">-</td>
                            <td class="px-5 column-1Fondo2Pared">-</td>
                            <td class="px-5 column-2Fondo1Pared">-</td>
                            <td class="px-5 column-2Fondo2Pared">-</td>
                            <td class="px-5 column-3Fondo1Pared">-</td>
                            <td class="px-5 column-1Fondo3Pared">-</td>
                        </tr>
                        <tr>
                            <td id="boton_url" class="text-center">
                                <a href="https://pspool.addisnetwork.es/bombas-fitstar/237-153-fitstar.html#/647-corriente-trifasica/682-caudal_m_h-6200_m_h"
                                    target="_blank">8933</a>
                            </td>
                            <td>Bomba bronce</td>
                            <td>60m³</td>
                            <td>3,0kW - 4,0CV</td>
                            <td class="px-5 column-1Fondo">-</td>
                            <td class="px-5 column-1Pared">-</td>
                            <td class="px-5 column-1Fondo1Pared">1</td>
                            <td class="px-5 column-1Fondo2Pared">-</td>
                            <td class="px-5 column-2Fondo1Pared">-</td>
                            <td class="px-5 column-2Fondo2Pared">-</td>
                            <td class="px-5 column-3Fondo1Pared">-</td>
                            <td class="px-5 column-1Fondo3Pared">-</td>
                        </tr>
                        <tr>
                            <td id="boton_url" class="text-center">
                                <a href="https://pspool.addisnetwork.es/bombas-fitstar/237-154-fitstar.html#/647-corriente-trifasica/673-caudal_m_h-9000_m_h"
                                    target="_blank">8934</a>
                            </td>
                            <td>Bomba bronce</td>
                            <td>90m³</td>
                            <td>4,0kW - 5,5CV</td>
                            <td class="px-5 column-1Fondo">-</td>
                            <td class="px-5 column-1Pared">-</td>
                            <td class="px-5 column-1Fondo1Pared">-</td>
                            <td class="px-5 column-1Fondo2Pared">1</td>
                            <td class="px-5 column-2Fondo1Pared">1</td>
                            <td class="px-5 column-2Fondo2Pared">-</td>
                            <td class="px-5 column-3Fondo1Pared">-</td>
                            <td class="px-5 column-1Fondo3Pared">-</td>
                        </tr>
                        <tr>
                            <td id="boton_url" class="text-center">
                                <a href="https://pspool.addisnetwork.es/bombas-fitstar/237-155-fitstar.html#/647-corriente-trifasica/683-caudal_m_h-11000_m_h"
                                    target="_blank">8935</a>
                            </td>
                            <td>Bomba bronce</td>
                            <td>110m³</td>
                            <td>5.5kW - 7.5CV</td>
                            <td class="px-5 column-1Fondo">-</td>
                            <td class="px-5 column-1Pared">-</td>
                            <td class="px-5 column-1Fondo1Pared">-</td>
                            <td class="px-5 column-1Fondo2Pared">-</td>
                            <td class="px-5 column-2Fondo1Pared">-</td>
                            <td class="px-5 column-2Fondo2Pared">1</td>
                            <td class="px-5 column-3Fondo1Pared">1</td>
                            <td class="px-5 column-1Fondo3Pared">1</td>
                        </tr>
                        <tr>
                            <td id="boton_url" class="text-center">
                                <a href="https://pspool.addisnetwork.es/cuadros-y-pulsadores/193-nicho-preinstalacion-para-pulsador-neumaticopiezoelectrico.html"
                                    target="_blank">4727</a>
                            </td>
                            <td>Nicho pulsador</td>
                            <td>-</td>
                            <td>-</td>
                            <td class="px-5 column-1Fondo">1</td>
                            <td class="px-5 column-1Pared">1</td>
                            <td class="px-5 column-1Fondo1Pared">1</td>
                            <td class="px-5 column-1Fondo2Pared">1</td>
                            <td class="px-5 column-2Fondo1Pared">1</td>
                            <td class="px-5 column-2Fondo2Pared">1</td>
                            <td class="px-5 column-3Fondo1Pared">1</td>
                            <td class="px-5 column-1Fondo3Pared">1</td>
                        </tr>
                        <tr>
                            <td id="boton_url" class="text-center">
                                <a href="https://pspool.addisnetwork.es/cuadros-y-pulsadores/194-pulsador-neumatico-embellecedor-en-inox-v4a.html"
                                    target="_blank">4729</a>
                            </td>
                            <td>Embellecedor pulsador</td>
                            <td>-</td>
                            <td>-</td>
                            <td class="px-5 column-1Fondo">1</td>
                            <td class="px-5 column-1Pared">1</td>
                            <td class="px-5 column-1Fondo1Pared">1</td>
                            <td class="px-5 column-1Fondo2Pared">1</td>
                            <td class="px-5 column-2Fondo1Pared">1</td>
                            <td class="px-5 column-2Fondo2Pared">1</td>
                            <td class="px-5 column-3Fondo1Pared">1</td>
                            <td class="px-5 column-1Fondo3Pared">1</td>
                        </tr>
                        <tr>
                            <td id="boton_url" class="text-center">
                                <a href="https://pspool.addisnetwork.es/cuadros-y-pulsadores/293-552-cuadro-neumaticos-y-piezo-electricos.html#/926-potencia_kw_-220/930-modelo-neumatico"
                                    target="_blank">22726</a>
                            </td>
                            <td>Cuadro neum.380V</td>
                            <td>-</td>
                            <td>2,2kW - 4-6A</td>
                            <td class="px-5 column-1Fondo">1</td>
                            <td class="px-5 column-1Pared">1</td>
                            <td class="px-5 column-1Fondo1Pared">-</td>
                            <td class="px-5 column-1Fondo2Pared">-</td>
                            <td class="px-5 column-2Fondo1Pared">-</td>
                            <td class="px-5 column-2Fondo2Pared">-</td>
                            <td class="px-5 column-3Fondo1Pared">-</td>
                            <td class="px-5 column-1Fondo3Pared">-</td>
                        </tr>
                        <tr>
                            <td id="boton_url" class="text-center">
                                <a href="https://pspool.addisnetwork.es/cuadros-y-pulsadores/293-554-cuadro-neumaticos-y-piezo-electricos.html#/927-potencia_kw_-300/930-modelo-neumatico"
                                    target="_blank">22725</a>
                            </td>
                            <td>Cuadro neum. 380V</td>
                            <td>-</td>
                            <td>3,0kW - 6,2-10A</td>
                            <td class="px-5 column-1Fondo">-</td>
                            <td class="px-5 column-1Pared">-</td>
                            <td class="px-5 column-1Fondo1Pared">1</td>
                            <td class="px-5 column-1Fondo2Pared">-</td>
                            <td class="px-5 column-2Fondo1Pared">-</td>
                            <td class="px-5 column-2Fondo2Pared">-</td>
                            <td class="px-5 column-3Fondo1Pared">-</td>
                            <td class="px-5 column-1Fondo3Pared">-</td>
                        </tr>
                        <tr>
                            <td id="boton_url" class="text-center">
                                <a href="https://pspool.addisnetwork.es/cuadros-y-pulsadores/293-555-cuadro-neumaticos-y-piezo-electricos.html#/928-potencia_kw_-400/930-modelo-neumatico"
                                    target="_blank">22724</a>
                            </td>
                            <td>Cuadro neum. 380V</td>
                            <td>-</td>
                            <td>4,0kW - 4-6A</td>
                            <td class="px-5 column-1Fondo">-</td>
                            <td class="px-5 column-1Pared">-</td>
                            <td class="px-5 column-1Fondo1Pared">-</td>
                            <td class="px-5 column-1Fondo2Pared">1</td>
                            <td class="px-5 column-2Fondo1Pared">1</td>
                            <td class="px-5 column-2Fondo2Pared">-</td>
                            <td class="px-5 column-3Fondo1Pared">-</td>
                            <td class="px-5 column-1Fondo3Pared">-</td>
                        </tr>
                        <tr>
                            <td id="boton_url" class="text-center">
                                <a href="https://pspool.addisnetwork.es/cuadros-y-pulsadores/293-556-cuadro-neumaticos-y-piezo-electricos.html#/929-potencia_kw_-550/930-modelo-neumatico"
                                    target="_blank">22735</a>
                            </td>
                            <td>Cuadro neum. 380V</td>
                            <td>-</td>
                            <td>5,5kW - 5,5-8A</td>
                            <td class="px-5 column-1Fondo">-</td>
                            <td class="px-5 column-1Pared">-</td>
                            <td class="px-5 column-1Fondo1Pared">-</td>
                            <td class="px-5 column-1Fondo2Pared">-</td>
                            <td class="px-5 column-2Fondo1Pared">-</td>
                            <td class="px-5 column-2Fondo2Pared">1</td>
                            <td class="px-5 column-3Fondo1Pared">1</td>
                            <td class="px-5 column-1Fondo3Pared">1</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <x-boton-volver :user="$user" />
        </div>
    </main>

    <script>
        const buttons = document.querySelectorAll('.filter-button');
        const allColumns = document.querySelectorAll('th, td');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                // Desmarcar todos los botones
                buttons.forEach(btn => btn.classList.remove('selected'));

                // Marcar el botón actual
                this.classList.add('selected');

                const value = this.getAttribute('data-value');
                const columnClass = `.column-${value}`;

                // Ocultar todas las columnas
                allColumns.forEach(column => column.classList.add('hidden'));

                // Mostrar solo la columna seleccionada y las columnas descriptivas
                const columnsToShow = document.querySelectorAll(columnClass);
                columnsToShow.forEach(column => column.classList.remove('hidden'));

                // Mostrar también las primeras 4 columnas descriptivas (REF, DESCRIPCIÓN, CAUDAL, POTENCIA)
                for (let i = 0; i < 4; i++) {
                    document.querySelectorAll(`th:nth-child(${i + 1}), td:nth-child(${i + 1})`).forEach(
                        column => {
                            column.classList.remove('hidden');
                        });
                }

                // Mostrar solo filas que tengan valor en la columna seleccionada
                const tableRows = document.querySelectorAll("#table-body tr");
                tableRows.forEach(row => {
                    const cellValue = row.querySelector(columnClass).textContent.trim();
                    if (cellValue !== '-') {
                        row.classList.remove('hidden');
                    } else {
                        row.classList.add('hidden');
                    }
                });
            });
        });

        // Simular un clic en el primer botón para inicializar la tabla
        document.querySelector('.filter-button[data-value="1Fondo"]').click();
    </script>
@endsection
