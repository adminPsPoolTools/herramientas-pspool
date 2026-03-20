@extends('layouts.app')

@section('content')
@php
$userEncoded = base64_encode($user);
@endphp
<main class="home">

    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Filtros Calplas Públicos"
        description="Aquí dispones de una tabla con todos los filtros de calplas para piscina pública" :user="$user" />

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
        }

        td {
            padding: 1px;
            text-align: center;
            border: 1px solid #ddd;
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
                        <tr class="header-row">
                            <th>Filtro</th>
                            <th class="w-10">Modelo</th>
                            <th>Ø mm</th>
                            <th>Sup. Filtrante m²</th>
                            <th>Altura lecho mm</th>
                            <th>Rend. a 20 m³/h/m²</th>
                            <th>Rend. a 30 m³/h/m²</th>
                            <th>Caudal Lav. 50 m³/h/m²</th>
                            <th>Carga AFM / arena</th>
                            <th>AFM G1/G2/G3</th>
                            <th>Conex. “/DN</th>
                            <th>Enlace</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="12">FB</td>
                            <td>FB 40</td>
                            <td>1010</td>
                            <td>0,78</td>
                            <td>500</td>
                            <td>16 m³/h</td>
                            <td>23 m³/h</td>
                            <td>39 m³/h</td>
                            <td>630/750</td>
                            <td>16 / 7 / 7</td>
                            <td>DN80</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/222-1688-calplas-fb.html#/1759-diametros_filtros-o_1010_mm/1760-modelo-fb_40_o_1010_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>FB 50</td>
                            <td>1160</td>
                            <td>1,01</td>
                            <td>600</td>
                            <td>20 m³/h</td>
                            <td>30 m³/h</td>
                            <td>51 m³/h</td>
                            <td>882/1050</td>
                            <td>22 / 10 / 10</td>
                            <td>DN80</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/222-1689-calplas-fb.html#/1761-diametros_filtros-o_1160_mm/1762-modelo-fb_50_o_1160_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>FB 60</td>
                            <td>1260</td>
                            <td>1,21</td>
                            <td>650</td>
                            <td>24 m³/h</td>
                            <td>36 m³/h</td>
                            <td>61 m³/h</td>
                            <td>1176/1400</td>
                            <td>28 / 14 / 14</td>
                            <td>DN80</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/222-1690-calplas-fb.html#/1763-diametros_filtros-o_1260_mm/1764-modelo-fb_60_o_1260_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>FB 80</td>
                            <td>1440</td>
                            <td>1,55</td>
                            <td>720</td>
                            <td>31 m³/h</td>
                            <td>47 m³/h</td>
                            <td>78 m³/h</td>
                            <td>1680/2000</td>
                            <td>40 / 20 / 20</td>
                            <td>DN100</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/222-1691-calplas-fb.html#/1765-diametros_filtros-o_1440_mm/1766-modelo-fb_80_o_1440_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>FB 100</td>
                            <td>1640</td>
                            <td>2,04</td>
                            <td>800</td>
                            <td>41 m³/h</td>
                            <td>61 m³/h</td>
                            <td>102 m³/h</td>
                            <td>2520/3000</td>
                            <td>60 / 30 / 30</td>
                            <td>DN125</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/222-1692-calplas-fb.html#/1767-diametros_filtros-o_1640_mm/1768-modelo-fb_100_o_1640_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>FB 125</td>
                            <td>1840</td>
                            <td>2,52</td>
                            <td>850</td>
                            <td>50 m³/h</td>
                            <td>76 m³/h</td>
                            <td>126 m³/h</td>
                            <td>3150/3750</td>
                            <td>80 / 30 / 40</td>
                            <td>DN125</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/222-1693-calplas-fb.html#/1769-diametros_filtros-o_1840_mm/1770-modelo-fb_125_o_1840_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>FB 150</td>
                            <td>2040</td>
                            <td>3,70</td>
                            <td>900</td>
                            <td>63 m³/h</td>
                            <td>95 m³/h</td>
                            <td>159 m³/h</td>
                            <td>4410/5250</td>
                            <td>120 / 40 / 50</td>
                            <td>DN150</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/222-1694-calplas-fb.html#/1771-diametros_filtros-o_2040_mm/1772-modelo-fb_150_o_2040_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>FB 175</td>
                            <td>2210</td>
                            <td>3,77</td>
                            <td>1000</td>
                            <td>75 m³/h</td>
                            <td>113 m³/h</td>
                            <td>189 m³/h</td>
                            <td>5670/6750</td>
                            <td>150 / 60 / 60</td>
                            <td>DN200</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/222-1695-calplas-fb.html#/1773-diametros_filtros-o_2210_mm/1774-modelo-fb_175_o_2210_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>FB 200</td>
                            <td>2340</td>
                            <td>4,06</td>
                            <td>1000</td>
                            <td>81 m³/h</td>
                            <td>122 m³/h</td>
                            <td>203 m³/h</td>
                            <td>6090/7250</td>
                            <td>160 / 60 / 70</td>
                            <td>DN200</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/222-1696-calplas-fb.html#/1775-diametros_filtros-o_2340_mm/1776-modelo-fb_200_o_2340_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>FB 250</td>
                            <td>2550</td>
                            <td>4,91</td>
                            <td>1000</td>
                            <td>98 m³/h</td>
                            <td>147 m³/h</td>
                            <td>246 m³/h</td>
                            <td>7560/9000</td>
                            <td>180 / 90 / 90</td>
                            <td>DN200</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/222-1697-calplas-fb.html#/1777-diametros_filtros-o_2550_mm/1778-modelo-fb_250_o_2550_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>FB 300</td>
                            <td>2800</td>
                            <td>5,97</td>
                            <td>1000</td>
                            <td>119 m³/h</td>
                            <td>179 m³/h</td>
                            <td>299 m³/h</td>
                            <td>10080/12000</td>
                            <td>240 / 120 / 120</td>
                            <td>DN250</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/222-1698-calplas-fb.html#/1779-diametros_filtros-o_2800_mm/1780-modelo-fb_300_o_2800_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>FB 350</td>
                            <td>3000</td>
                            <td>6,90</td>
                            <td>900</td>
                            <td>138 m³/h</td>
                            <td>207 m³/h</td>
                            <td>345 m³/h</td>
                            <td>10080/12000</td>
                            <td>220 / 120 / 140</td>
                            <td>DN250</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/222-1699-calplas-fb.html#/1781-diametros_filtros-o_3000_mm/1782-modelo-fb_350_o_3000_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <a href="{{ route('guias.filtros.index', ['user' => $userEncoded]) }}" class="btn-volver">Volver</a>
        </div>
    </div>
</main>
@endsection
