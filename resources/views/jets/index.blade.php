@extends('layouts.app')

@section('content')

<main class="seccion">

    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Configura tus Jets Spas"
        description="Configura tu sistema de masaje Jets Spas." :user="$user" />

    <div class="container w-10/12 max-w-screen-lg mx-auto mb-4 contenido">
        <div class="p-4 px-4 mb-0 caja md:p-8">
            <div class="button-container">
                <p>Con esta herramienta te mostramos todos los elementos necesarios para configurar tu sistema de masaje
                    Jet-Spa en función del número de boquillas que necesites.</p>
                <div class="items-center filter-button" data-value="2F2O">2 Fijos <br> 2 Orientables</div>
                <div class="filter-button" data-value="4F4O">4 Fijos <br> 4 Orientables</div>
                <div class="filter-button" data-value="6F6O">6 Fijos <br> 6 Orientables</div>
                <div class="filter-button" data-value="8F8O">8 Fijos <br> 8 Orientables</div>

            </div>
            <table class="w-full min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr>
                        <th class="py-2 text-center tablacab">REF/URL</th>
                        <th class="px-4 py-2 tablacab">DESCRIPCIÓN</th>
                        <th class="px-4 py-2 tablacab">CAUDAL</th>
                        <th class="px-4 py-2 tablacab">POTENCIA</th>

                        <th class="px-4 py-2 column-2F2O tablacab">2 x Fijos <br> 2 x Orientables</th>
                        <th class="px-4 py-2 column-4F4O tablacab">4 x Fijos <br> 4 x Orientables</th>
                        <th class="px-4 py-2 column-6F6O tablacab">6 x Fijos <br> 6 x Orientables</th>
                        <th class="px-4 py-2 column-8F8O tablacab">8 x Fijos <br> 8 x Orientables</th>

                    </tr>
                </thead>
                <tbody id="table-body">
                    <tr>
                        <td id="boton_url" class="text-center">
                            <a href="https://ps-pool.com/tienda/masaje-jet-spa/187-nicho-jet-spa.html"
                                target="_blank">4702</a>
                        </td>
                        <td>Nicho presintalación Jet Spa</td>
                        <td>-</td>
                        <td>-</td>
                        <td class="px-5 column-2F2O">4</td>
                        <td class="px-5 column-4F4O">8</td>
                        <td class="px-5 column-6F6O">12</td>
                        <td class="px-5 column-8F8O">16</td>
                    </tr>
                    <tr>
                        <td id="boton_url" class="text-center">
                            <a href="https://ps-pool.com/tienda/masaje-jet-spa/188-embellecedor-orientable-en-inox-v4a.html"
                                target="_blank">4704</a>
                        </td>
                        <td>Embellecedor orientable</td>
                        <td>-</td>
                        <td>-</td>
                        <td class="px-5 column-2F2O">2</td>
                        <td class="px-5 column-4F4O">4</td>
                        <td class="px-5 column-6F6O">6</td>
                        <td class="px-5 column-8F8O">8</td>

                    </tr>
                    <tr>
                        <td id="boton_url" class="text-center">
                            <a href="hhttps://ps-pool.com/tienda/masaje-jet-spa/189-embellecedor-fijo-8-agujeros-en-inox-v4a.html"
                                target="_blank">4706</a>
                        </td>
                        <td>Embellecedor fijo</td>
                        <td>-</td>
                        <td>-</td>
                        <td class="px-5 column-2F2O">2</td>
                        <td class="px-5 column-4F4O">4</td>
                        <td class="px-5 column-6F6O">6</td>
                        <td class="px-5 column-8F8O">8</td>

                    </tr>
                    <tr>
                        <td id="boton_url" class="text-center">
                            <a href="https://ps-pool.com/tienda/tomas-aspiracion/294-2200-tomas-de-aspiracion.html#/2085-conexiones-dn80/2220-modelo-roscar/2221-diametro_embellecedores-350"
                                target="_blank">11996</a>
                        </td>
                        <td>Nicho aspiración DN50 2"</td>
                        <td>-</td>
                        <td>-</td>
                        <td class="px-5 column-2F2O">2</td>
                        <td class="px-5 column-4F4O">-</td>
                        <td class="px-5 column-6F6O">-</td>
                        <td class="px-5 column-8F8O">-</td>

                    </tr>
                    <tr>
                        <td id="boton_url" class="text-center">
                            <a href="https://ps-pool.com/tienda/masaje-combi-whirl/185-nicho-toma-aspiracion-hormigon-rosca-interior-2-1-2.html"
                                target="_blank">4688</a>
                        </td>
                        <td>Nicho aspiración DN65 2 ½"</td>
                        <td>-</td>
                        <td>-</td>
                        <td class="px-5 column-2F2O">-</td>
                        <td class="px-5 column-4F4O">2</td>
                        <td class="px-5 column-6F6O">2</td>
                        <td class="px-5 column-8F8O">2</td>

                    </tr>
                    <tr>
                        <td id="boton_url" class="text-center">
                            <a href=https://ps-pool.com/tienda/masaje-combi-whirl/191-embellecedor-rejilla-o200-mm-en-inox-para-dn65.html"
                                target="_blank">4713</a>
                        </td>
                        <td>Embellecedor aspiración 200mmØ</td>
                        <td>-</td>
                        <td>-</td>
                        <td class="px-5 column-2F2O">2</td>
                        <td class="px-5 column-4F4O">-</td>
                        <td class="px-5 column-6F6O">-</td>
                        <td class="px-5 column-8F8O">-</td>
                    </tr>
                    <tr>
                        <td id="boton_url" class="text-center">
                            <a href="https://ps-pool.com/tienda/masaje-combi-whirl/83-embellecedor-rejilla-o280-mm-en-inox-para-dn80.html"
                                target="_blank">14336</a>
                        </td>
                        <td>Embellecedor aspiración 280mmØ</td>
                        <td>-</td>
                        <td>-</td>
                        <td class="px-5 column-2F2O">-</td>
                        <td class="px-5 column-4F4O">2</td>
                        <td class="px-5 column-6F6O">2</td>
                        <td class="px-5 column-8F8O">-</td>

                    </tr>
                    <tr>
                        <td id="boton_url" class="text-center">
                            <a href="https://ps-pool.com/tienda/masaje-combi-whirl/1-embellecedor-rejilla-o350-mm-en-inox-para-dn65.html"
                                target="_blank">10112</a>
                        </td>
                        <td>Embellecedor aspiración 350mmØ</td>
                        <td>-</td>
                        <td>-</td>
                        <td class="px-5 column-2F2O">-</td>
                        <td class="px-5 column-4F4O">-</td>
                        <td class="px-5 column-6F6O">-</td>
                        <td class="px-5 column-8F8O">2</td>

                    </tr>
                    <tr>
                        <td id="boton_url" class="text-center">
                            <a href="https://ps-pool.com/tienda/bombas-fitstar/460-bomba-bronce-075-kw-10-cv-400v-14-mh.html"
                                target="_blank">8930</a>
                        </td>
                        <td>Bomba bronce 400v</td>
                        <td>14m³</td>
                        <td>0,75kW - 1,0CV</td>
                        <td class="px-5 column-2F2O">1</td>
                        <td class="px-5 column-4F4O">-</td>
                        <td class="px-5 column-6F6O">-</td>
                        <td class="px-5 column-8F8O">-</td>

                    </tr>
                    <tr>
                        <td id="boton_url" class="text-center">
                            <a href="https://ps-pool.com/tienda/bombas-fitstar/464-bomba-bronce-15-kw-20-cv-400v-30-mh.html"
                                target="_blank">14142</a>
                        </td>
                        <td>Bomba bronce 380v</td>
                        <td>30m³</td>
                        <td>1,5kW - 2,0CV</td>
                        <td class="px-5 column-2F2O">-</td>
                        <td class="px-5 column-4F4O">-</td>
                        <td class="px-5 column-6F6O">-</td>
                        <td class="px-5 column-8F8O">-</td>
                    </tr>
                    <tr>
                        <td id="boton_url" class="text-center">
                            <a href="https://ps-pool.com/tienda/bombas-fitstar/465-bomba-bronce-22-kw-30-cv-400v-48-mh.html"
                                target="_blank">8932</a>
                        </td>
                        <td>Bomba bronce 380v</td>
                        <td>48m³</td>
                        <td>2,2kW - 3,0CV</td>
                        <td class="px-5 column-2F2O">-</td>
                        <td class="px-5 column-4F4O">1</td>
                        <td class="px-5 column-6F6O">-</td>
                        <td class="px-5 column-8F8O">-</td>

                    </tr>
                    <tr>
                        <td id="boton_url" class="text-center">
                            <a href="https://ps-pool.com/tienda/bombas-fitstar/462-bomba-bronce-30-kw-40-cv-400v-62-mh.html"
                                target="_blank">8933</a>
                        </td>
                        <td>Bomba bronce 380v</td>
                        <td>62m³</td>
                        <td>3,0kW - 4,0CV</td>
                        <td class="px-5 column-2F2O">-</td>
                        <td class="px-5 column-4F4O">-</td>
                        <td class="px-5 column-6F6O">1</td>
                        <td class="px-5 column-8F8O">-</td>

                    </tr>
                    <tr>
                        <td id="boton_url" class="text-center">
                            <a href="https://ps-pool.com/tienda/bombas-fitstar/463-bomba-bronce-40-kw-55-cv-400v-90-mh.html"
                                target="_blank">8934</a>
                        </td>
                        <td>Bomba bronce 380v</td>
                        <td>90m³</td>
                        <td>4,0kW - 5,5CV</td>
                        <td class="px-5 column-2F2O">-</td>
                        <td class="px-5 column-4F4O">-</td>
                        <td class="px-5 column-6F6O">-</td>
                        <td class="px-5 column-8F8O">1</td>

                    </tr>
                    <tr>
                        <td id="boton_url" class="text-center">
                            <a href="https://ps-pool.com/tienda/cuadros-y-pulsadores/193-nicho-para-pulsador-neumatico-y-piezoelectrico.html"
                                target="_blank">4727</a>
                        </td>
                        <td>Nicho pulsador</td>
                        <td>-</td>
                        <td>-</td>
                        <td class="px-5 column-2F2O">1</td>
                        <td class="px-5 column-4F4O">1</td>
                        <td class="px-5 column-6F6O">1</td>
                        <td class="px-5 column-8F8O">1</td>
                    </tr>
                    <tr>
                        <td id="boton_url" class="text-center">
                            <a href="https://ps-pool.com/tienda/cuadros-y-pulsadores/194-pulsador-neumatico-embellecedor-en-inox.html"
                                target="_blank">4729</a>
                        </td>
                        <td>Embellecedor pulsador</td>
                        <td>-</td>
                        <td>-</td>
                        <td class="px-5 column-2F2O">1</td>
                        <td class="px-5 column-4F4O">1</td>
                        <td class="px-5 column-6F6O">1</td>
                        <td class="px-5 column-8F8O">1</td>
                    </tr>
                    <tr>
                        <td id="boton_url" class="text-center">
                            <a href="https://ps-pool.com/tienda/cuadros-y-pulsadores/293-2193-cuadro-neumaticos-y-piezo-electricos.html#/1686-corriente-trifasica/2211-modelo-150_kw_6_a_400_v/2218-tipo-neumatico"
                                target="_blank">22727</a>
                        </td>
                        <td>Cuadro neumático 380V</td>
                        <td>-</td>
                        <td>1,5kW - 3-5A</td>
                        <td class="px-5 column-2F2O">1</td>
                        <td class="px-5 column-4F4O">-</td>
                        <td class="px-5 column-6F6O">-</td>
                        <td class="px-5 column-8F8O">-</td>

                    </tr>
                    <tr>
                        <td id="boton_url" class="text-center">
                            <a href="https://ps-pool.com/tienda/cuadros-y-pulsadores/293-2195-cuadro-neumaticos-y-piezo-electricos.html#/1686-corriente-trifasica/2213-modelo-220_kw_8_a_400_v/2218-tipo-neumatico"
                                target="_blank">22726</a>
                        </td>
                        <td>Cuadro neumático 380V</td>
                        <td>-</td>
                        <td>2,2kW - 4-6A</td>
                        <td class="px-5 column-2F2O">-</td>
                        <td class="px-5 column-4F4O">1</td>
                        <td class="px-5 column-6F6O">-</td>
                        <td class="px-5 column-8F8O">-</td>

                    </tr>
                    <tr>
                        <td id="boton_url" class="text-center">
                            <a href="https://ps-pool.com/tienda/cuadros-y-pulsadores/293-2197-cuadro-neumaticos-y-piezo-electricos.html#/1686-corriente-trifasica/2218-tipo-neumatico/2219-modelo-300_kw_8_a_400_v"
                                target="_blank">22725</a>
                        </td>
                        <td>Cuadro neumático 380V</td>
                        <td>-</td>
                        <td>3,0kW - 6,2-10A</td>
                        <td class="px-5 column-2F2O">-</td>
                        <td class="px-5 column-4F4O">-</td>
                        <td class="px-5 column-6F6O">1</td>
                        <td class="px-5 column-8F8O">-</td>
                    </tr>
                    <tr>
                        <td id="boton_url" class="text-center">
                            <a href="https://ps-pool.com/tienda/cuadros-y-pulsadores/293-2198-cuadro-neumaticos-y-piezo-electricos.html#/1686-corriente-trifasica/2216-modelo-400_kw_10_a_400_v/2218-tipo-neumatico"
                                target="_blank">22734</a>
                        </td>
                        <td>Cuadro neumático 380V</td>
                        <td>-</td>
                        <td>4,0kW - 4-6A</td>
                        <td class="px-5 column-2F2O">-</td>
                        <td class="px-5 column-4F4O">-</td>
                        <td class="px-5 column-6F6O">-</td>
                        <td class="px-5 column-8F8O">1</td>
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
                document.querySelectorAll(`th:nth-child(${i + 1}), td:nth-child(${i + 1})`).forEach(column => {
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
    document.querySelector('.filter-button[data-value="2F2O"]').click();
</script>
@endsection
