@extends('layouts.app')

@section('content')
@php
$userEncoded = base64_encode($user);
@endphp
<main class="home">

    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Cloradores Salinos Privados"
        description="Aquí dispones de una tabla con todos cloradores salinos para piscina privada" :user="$user" />

    <style>
        table {
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
        }

        th {
            background-color: var(--azulosc);
            /* Cambia este color según tu preferencia */
            color: white;
            padding: 2px;
            text-align: center;
            width: 150px;
            border: 1px solid white;
        }

        td {
            padding: 1px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .vertical-text {
            writing-mode: vertical-rl;
            text-orientation: mixed;
            transform: rotate(180deg);
        }

        a {
            text-decoration: inherit;
        }
    </style>

    <div class="py-5 album bg-light">
        <div class="container">
            <div>
                <table class="min-w-full mb-2 bg-white">
                    <thead>
                        <tr>
                            <th>EQUIPO</th>
                            <th>FUNCIÓN</th>
                            <th>REF</th>
                            <th>MODELO</th>
                            <th>AMPERAJE</th>
                            <th>LAMP.</th>
                            <th>VASO IONIZACIÓN</th>
                            <th>PRIVADA hasta 28 ºC</th>
                            <th>PRIVADA <br> + 28ºC</th>
                            <th>PÚBLICA</th>
                            <th>Enlace</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="vertical-text" rowspan="3">PSALT ls</td>
                            <td rowspan="3">Electrólisis<br> baja <br> salinidad</td>
                            <td>18569</td>
                            <td>PSALT 1LS</td>
                            <td rowspan="3">-</td>
                            <td rowspan="3">-</td>
                            <td rowspan="3">-</td>
                            <td>60 m³</td>
                            <td>40 m³</td>
                            <td>15 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/285-2155-psalt-low-salinity.html#/2181-modelo-psalt_ls1"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>18570</td>
                            <td>PSALT 2LS</td>
                            <td>120 m³</td>
                            <td>80 m³</td>
                            <td>25 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/285-2156-psalt-low-salinity.html#/2182-modelo-psalt_ls2"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>18571</td>
                            <td>PSALT 3LS</td>
                            <td>150 m³</td>
                            <td>125 m³</td>
                            <td>40 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/285-2157-psalt-low-salinity.html#/2183-modelo-psalt_ls3"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td class="vertical-text" rowspan="5">HIDROLIFE</td>
                            <td rowspan="5">Electrólisis<br>salinidad</td>
                            <td>12632</td>
                            <td>SAL 8</td>
                            <td rowspan="5">-</td>
                            <td rowspan="5">-</td>
                            <td rowspan="5">-</td>
                            <td>35 m³</td>
                            <td>15 m³</td>
                            <td>-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/242-1632-hidrolife-842540233428.html#/1695-produccion-8_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11365</td>
                            <td>SAL 16</td>
                            <td>65 m³</td>
                            <td>40 m³</td>
                            <td>15 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/242-1633-hidrolife-842540233428.html#/1696-produccion-16_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11366</td>
                            <td>SAL 22</td>
                            <td>110 m³</td>
                            <td>80 m³</td>
                            <td>25 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/242-1634-hidrolife-842540233428.html#/1697-produccion-22_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11367</td>
                            <td>SAL 33</td>
                            <td>200 m³</td>
                            <td>125 m³</td>
                            <td>40 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/242-1635-hidrolife-842540233428.html#/1698-produccion-33_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>11368</td>
                            <td>SAL 50</td>
                            <td>300 m³</td>
                            <td>200 m³</td>
                            <td>65 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/242-1636-hidrolife-842540233428.html#/1699-produccion-50_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td class="vertical-text" rowspan="3">OXILIFE</td>
                            <td rowspan="3">Hidrólisis<br>+ electrólisis<br>baja<br>salinidad</td>
                            <td>11432</td>
                            <td>OX 0</td>
                            <td>8</td>
                            <td rowspan="3">-</td>
                            <td rowspan="3">-</td>
                            <td>20 m³</td>
                            <td>10 m³</td>
                            <td>5 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/243-1894-oxilife.html#/1695-produccion-8_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11434</td>
                            <td>OX 1</td>
                            <td>15</td>
                            <td>60 m³</td>
                            <td>40 m³</td>
                            <td>15 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/243-1895-oxilife.html#/1982-produccion-15_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>11435</td>
                            <td>OX 2</td>
                            <td>30</td>
                            <td>120 m³</td>
                            <td>80 m³</td>
                            <td>25 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/243-1896-oxilife.html#/1983-produccion-30_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td class="vertical-text" rowspan="2">UVSCENIC</td>
                            <td rowspan="2">Electrólisis<br>baja<br>salinidad<br>+ ultravioleta</td>
                            <td>11493</td>
                            <td>UV 16</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">2</td>
                            <td rowspan="2">-</td>
                            <td>65 m³</td>
                            <td>40 m³</td>
                            <td>-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/244-1897-uvscenic-842540233433.html#/1696-produccion-16_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>11494</td>
                            <td>UV 33</td>
                            <td>200 m³</td>
                            <td>125 m³</td>
                            <td>40 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/244-1898-uvscenic-842540233433.html#/1698-produccion-33_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td class="vertical-text" rowspan="2">AQUASCENIC</td>
                            <td rowspan="2">Electrólisis<br>baja<br>salinidad<br>+ hidrólisis<br>+ ionizacion Cu
                            </td>
                            <td>11506</td>
                            <td>HD 1</td>
                            <td>15</td>
                            <td rowspan="2">-</td>
                            <td>2e</td>
                            <td>65 m³</td>
                            <td>40 m³</td>
                            <td>15</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/245-1899-aquascenic.html#/1982-produccion-15_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>11507</td>
                            <td>HD 2</td>
                            <td>30</td>
                            <td>4e</td>
                            <td>110 m³</td>
                            <td>80 m³</td>
                            <td>25 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/245-1900-aquascenic.html#/1983-produccion-30_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <td class="vertical-text" rowspan="3">BIONET</td>
                        <td rowspan="3">Electrólisis<br>+ ionización Cu
                        </td>
                        <td>12190</td>
                        <td>BIO 16</td>
                        <td rowspan="3">-</td>
                        <td rowspan="3">-</td>
                        <td>2e</td>
                        <td>65 m³</td>
                        <td>40 m³</td>
                        <td>15 m³</td>
                        <td class="border"><a type="button" target="_blank"
                                href="https://www.ps-pool.com/tienda/clorador-salino-privada/246-1901-bionet.html#/1984-modelo-16_gr_h"
                                class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>12191</td>
                            <td>BIO 22</td>
                            <td>4e</td>
                            <td>100 m³</td>
                            <td>80 m³</td>
                            <td>25 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/246-1902-bionet.html#/1985-modelo-22_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>11742</td>
                            <td>BIO 33</td>
                            <td>6e</td>
                            <td>200 m³</td>
                            <td>125 m³</td>
                            <td>40 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/246-1903-bionet.html#/1986-modelo-33_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td class="vertical-text" rowspan="4">HIDRONISER</td>
                            <td rowspan="4">Floculante<br>algicida<br>bactericida </td>
                            <td>13350</td>
                            <td>AQ 65</td>
                            <td rowspan="4">-</td>
                            <td rowspan="4">-</td>
                            <td>2e</td>
                            <td rowspan="4">-</td>
                            <td>65 m³</td>
                            <td rowspan="4">-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/247-1904-hidroniser.html#/1987-modelo-aq_65"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11810</td>
                            <td>AQ 110</td>
                            <td>4e</td>
                            <td>110 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/247-1905-hidroniser.html#/1988-modelo-aq_110"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <td>13131</td>
                        <td>AQ 150</td>
                        <td>6e</td>
                        <td>150 m³</td>
                        <td class="border"><a type="button" target="_blank"
                                href="https://www.ps-pool.com/tienda/clorador-salino-privada/247-1906-hidroniser.html#/1989-modelo-aq_1504"
                                class=" tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>12952</td>
                            <td>AQ 200</td>
                            <td>4e + 4e</td>
                            <td>200 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/247-1907-hidroniser.html#/1990-modelo-aq_200"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td class="vertical-text" rowspan="4">STATION</td>
                            <td rowspan="4">Controlador<br>de Cl y PH </td>
                            <td>1151</td>
                            <td>ST1</td>
                            <td rowspan="4">-</td>
                            <td rowspan="4">-</td>
                            <td rowspan="4">-</td>
                            <td rowspan="4">-</td>
                            <td rowspan="4">-</td>
                            <td>120 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/equipos-de-control/248-1911-panel-controlador-station.html#/1994-modelo-st1"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>15451</td>
                            <td>PH+FCL</td>
                            <td>250 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/equipos-de-control/248-1908-panel-controlador-station.html#/1991-modelo-st1_ph_fcl"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>15449</td>
                            <td>PH+REDOX</td>
                            <td>350 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/equipos-de-control/248-1909-panel-controlador-station.html#/1992-modelo-st1_ph_rx"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>15452</td>
                            <td>PH+REDOX+FCL</td>
                            <td>500 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/equipos-de-control/248-1910-panel-controlador-station.html#/1993-modelo-st1_ph_fcl_rx"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td class="vertical-text" rowspan="3">DA-GEN</td>
                            <td rowspan="3">Hidrólisis<br>+ electrólisis <br>baja salinidad </td>
                            <td>13355</td>
                            <td>MOD 45</td>
                            <td>15</td>
                            <td rowspan="3">-</td>
                            <td rowspan="3">-</td>
                            <td>45</td>
                            <td rowspan="3">-</td>
                            <td>23 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/249-1912-dagen-modular.html#/1982-produccion-15_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>13052</td>
                            <td>MOD 90</td>
                            <td>30</td>
                            <td>90 m³</td>
                            <td>45 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/249-1913-dagen-modular.html#/1983-produccion-30_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>13356</td>
                            <td>MOD 150</td>
                            <td>50</td>
                            <td>150 m³</td>
                            <td>75 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/249-1914-dagen-modular.html#/1699-produccion-50_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <a href="{{ route('guias.cloradores.index', ['user' => $userEncoded]) }}" class="btn-volver">Volver</a>
        </div>
    </div>
</main>
@endsection
