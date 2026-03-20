@extends('layouts.app')

@section('content')
@php
$userEncoded = base64_encode($user);
@endphp
<main class="home">


    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Cloradores Salinos Públicos"
        description="Aquí dispones de una tabla con todos cloradores salinos para piscina pública" :user="$user" />

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
                            <td class="vertical-text" rowspan="6">HIDROLIFE</td>
                            <td rowspan="6">Electrólisis<br>salinidad</td>
                            <td>11364</td>
                            <td>SAL 85</td>
                            <td rowspan="6">-</td>
                            <td rowspan="6">-</td>
                            <td rowspan="6">-</td>
                            <td rowspan="6">-</td>
                            <td rowspan="6">-</td>
                            <td>120 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/252-1928-hidrolife.html#/1999-produccion-85_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11360</td>
                            <td>SAL 85</td>
                            <td>250 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/252-1929-hidrolife.html#/2000-produccion-125_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11344</td>
                            <td>SAL 175</td>
                            <td>350 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/252-1930-hidrolife.html#/2001-produccion-175_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11339</td>
                            <td>SAL 250</td>
                            <td>500 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/252-1931-hidrolife.html#/2002-produccion-250_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11370</td>
                            <td>SAL 350</td>
                            <td>700 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/252-1932-hidrolife.html#/2003-produccion-350_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>11371</td>
                            <td>SAL 500</td>
                            <td>1000 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/252-1933-hidrolife.html#/2004-produccion-500_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td class="vertical-text" rowspan="7">OXILIFE</td>
                            <td rowspan="7">Hidrólisis<br>+ electrólisis<br>baja<br>salinidad</td>
                            <td>11436</td>
                            <td>OX 3</td>
                            <td>50</td>
                            <td rowspan="7">-</td>
                            <td rowspan="7">-</td>
                            <td rowspan="7">-</td>
                            <td rowspan="7">-</td>
                            <td>40 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/253-1934-oxilife.html#/1699-produccion-50_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11437</td>
                            <td>OX 4</td>
                            <td>80</td>
                            <td>65 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/253-1935-oxilife.html#/2005-produccion-80_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11465</td>
                            <td>OX 5</td>
                            <td>120</td>
                            <td>120 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/253-1936-oxilife.html#/2006-produccion-120_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11466</td>
                            <td>OX 6</td>
                            <td>175</td>
                            <td>250 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/253-1937-oxilife.html#/2001-produccion-175_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11467</td>
                            <td>OX 7</td>
                            <td>250</td>
                            <td>350 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/253-1938-oxilife.html#/2002-produccion-250_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11468</td>
                            <td>OX 8</td>
                            <td>350</td>
                            <td>500 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/253-1939-oxilife.html#/2003-produccion-350_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>11469</td>
                            <td>OX 9</td>
                            <td>500</td>
                            <td>1000 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/253-1940-oxilife.html#/2004-produccion-500_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>

                        <tr>
                            <td class="vertical-text" rowspan="5">UVSCENIC</td>
                            <td rowspan="5">Electrólisis<br>baja<br>salinidad<br>+ ultravioleta</td>
                            <td>11495</td>
                            <td>UV 50</td>
                            <td rowspan="5">-</td>
                            <td>2</td>
                            <td rowspan="5">-</td>
                            <td rowspan="5">-</td>
                            <td>300 m³</td>
                            <td>60 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/254-1941-uvscenic.html#/1699-produccion-50_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11496</td>
                            <td>UV 85</td>
                            <td>2</td>
                            <td rowspan="4">-</td>
                            <td>125 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/254-1942-uvscenic.html#/1999-produccion-85_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11497</td>
                            <td>UV 125</td>
                            <td>4</td>
                            <td>220 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/254-1943-uvscenic.html#/2000-produccion-125_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11498</td>
                            <td>UV 175</td>
                            <td>4</td>
                            <td>300 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/254-1944-uvscenic.html#/2001-produccion-175_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>11499</td>
                            <td>UV 250</td>
                            <td>6</td>
                            <td>400 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/254-1945-uvscenic.html#/2002-produccion-250_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td class="vertical-text" rowspan="7">AQUASCENIC</td>
                            <td rowspan="7">Electrólisis<br>baja<br>salinidad<br>+ hidrólisis<br>+ ionizacion Cu
                            </td>
                            <td>11508</td>
                            <td>HD 3</td>
                            <td>50</td>
                            <td rowspan="7">-</td>
                            <td>6e</td>
                            <td rowspan="7">-</td>
                            <td>200 m³</td>
                            <td>40 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/256-1949-aquascenic.html#/1699-produccion-50_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11509</td>
                            <td>HD 4</td>
                            <td>80</td>
                            <td>8e</td>
                            <td>300 m³</td>
                            <td>65 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/256-1950-aquascenic.html#/2005-produccion-80_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11510</td>
                            <td>HD 5</td>
                            <td>120</td>
                            <td>10e</td>
                            <td rowspan="5">-</td>
                            <td>120 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/256-1951-aquascenic.html#/2006-produccion-120_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11511</td>
                            <td>HD 6</td>
                            <td>175</td>
                            <td>12e</td>
                            <td>250 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/256-1952-aquascenic.html#/2001-produccion-175_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11512</td>
                            <td>HD 7</td>
                            <td>250</td>
                            <td>14e</td>
                            <td>350 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/256-1953-aquascenic.html#/2002-produccion-250_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11513</td>
                            <td>HD 8</td>
                            <td>350</td>
                            <td>16e</td>
                            <td>500 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/256-1954-aquascenic.html#/2003-produccion-350_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>11514</td>
                            <td>HD 9</td>
                            <td>500</td>
                            <td>18e</td>
                            <td>750 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/256-1955-aquascenic.html#/2004-produccion-500_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td class="vertical-text" rowspan="7">BIONET</td>
                            <td rowspan="7">Electrólisis<br>+ ionización Cu</td>
                            <td>13345</td>
                            <td>BIO 50</td>
                            <td rowspan="7">-</td>
                            <td rowspan="7">-</td>
                            <td>8e</td>
                            <td rowspan="7">-</td>
                            <td>180 m³</td>
                            <td>80 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/257-1956-bionet.html#/1699-produccion-50_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>13346</td>
                            <td>BIO 85</td>
                            <td>8e</td>
                            <td>300 m³</td>
                            <td>120 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/257-1957-bionet.html#/1999-produccion-85_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11743</td>
                            <td>BIO 125</td>
                            <td>10e</td>
                            <td rowspan="5">-</td>
                            <td>250 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/257-1958-bionet.html#/2000-produccion-125_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>11744</td>
                            <td>BIO 175</td>
                            <td rowspan="4">12e</td>
                            <td>250 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/257-1959-bionet.html#/2001-produccion-175_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>13347</td>
                            <td>BIO 250</td>
                            <td>500 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/257-1960-bionet.html#/2002-produccion-250_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>13348</td>
                            <td>BIO 350</td>
                            <td>700 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/257-1961-bionet.html#/2003-produccion-350_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>13349</td>
                            <td>BIO 500</td>
                            <td>1000 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/257-1962-bionet.html#/2004-produccion-500_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td class="vertical-text" rowspan="6">HIDRONISER</td>
                            <td rowspan="6">Floculante<br>algicida<br>bactericida </td>
                            <td>13132</td>
                            <td>AQ 300</td>
                            <td rowspan="6">-</td>
                            <td rowspan="6">-</td>
                            <td>4e + 6e</td>
                            <td rowspan="6">-</td>
                            <td>300 m³</td>
                            <td rowspan="6">-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/317-2339-hidroniser.html#/2300-modelo-aq_300"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>13351</td>
                            <td>AQ 400</td>
                            <td>4e + 4e + 4e</td>
                            <td>400 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/317-2340-hidroniser.html#/2301-modelo-aq_400"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>13352</td>
                            <td>AQ 500</td>
                            <td>14e</td>
                            <td>500 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/317-2341-hidroniser.html#/2302-modelo-aq_500"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>13353</td>
                            <td>AQ 600</td>
                            <td>16e</td>
                            <td>600 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/317-2342-hidroniser.html#/2303-modelo-aq_600"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>13354</td>
                            <td>AQ 700</td>
                            <td>18e</td>
                            <td>700 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/317-2343-hidroniser.html#/2304-modelo-aq_700"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>12950</td>
                            <td>AQ 800</td>
                            <td>20e</td>
                            <td>800 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/317-2344-hidroniser.html#/2305-modelo-aq_800"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td class="vertical-text" rowspan="8">DA-GEN</td>
                            <td rowspan="8">Hidrólisis<br>+ electrólisis <br>baja salinidad </td>
                            <td>13357</td>
                            <td>MOD 360</td>
                            <td>125</td>
                            <td rowspan="8">-</td>
                            <td rowspan="8">-</td>
                            <td>360</td>
                            <td rowspan="8">-</td>
                            <td>180 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/250-1920-dagen-modular.html#/2000-produccion-125_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>13358</td>
                            <td>MOD 500</td>
                            <td>175</td>
                            <td>500 m³</td>
                            <td>250 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/250-1921-dagen-modular.html#/2001-produccion-175_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>22508</td>
                            <td>MOD 750</td>
                            <td>-</td>
                            <td>750 m³</td>
                            <td>375 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/250-1922-dagen-modular.html#/2002-produccion-250_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>22509</td>
                            <td>MOD 1000</td>
                            <td>-</td>
                            <td>1000 m³</td>
                            <td>500 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/250-1923-dagen-modular.html#/2003-produccion-350_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>22510</td>
                            <td>MOD 1500</td>
                            <td>-</td>
                            <td>1500 m³</td>
                            <td>750 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-publica/250-1924-dagen-modular.html#/2004-produccion-500_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>12640</td>
                            <td>45 FC</td>
                            <td>15</td>
                            <td>45 m³</td>
                            <td>23 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/251-1925-dagen-completo-cloro-libre-fc.html#/1982-produccion-15_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>12641</td>
                            <td>90 FC</td>
                            <td>30</td>
                            <td>90 m³</td>
                            <td>45 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/251-1926-dagen-completo-cloro-libre-fc.html#/1983-produccion-30_gr_h"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>12642</td>
                            <td>150 FC</td>
                            <td>50</td>
                            <td>150 m³</td>
                            <td>75 m³</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/clorador-salino-privada/251-1927-dagen-completo-cloro-libre-fc.html#/1699-produccion-50_gr_h"
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
