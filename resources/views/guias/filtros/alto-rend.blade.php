@extends('layouts.app')

@section('content')
@php
$userEncoded = base64_encode($user);
@endphp
<main class="home">


    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})"
        title="Filtros Calplas Públicos de alto rendimiento"
        description="Aquí dispones de una tabla con todos los filtros de calplas para piscina pública." :user="$user" />

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
                            <th>Carga AFM/arena</th>
                            <th>AFM G1/G2/G3</th>
                            <th>Conex. “/DN</th>
                            <th>Enlace</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- DCH --}}
                        <tr>
                            <td rowspan="9">DCH</td>
                            <td>415</td>
                            <td>415</td>
                            <td>0,13</td>
                            <td>1200</td>
                            <td>2,6 m³/h</td>
                            <td>3,9 m³/h</td>
                            <td>6 m³/h</td>
                            <td>189/225</td>
                            <td>5/4</td>
                            <td>2”</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/224-1712-calplas-dch.html#/1745-diametros_filtros-o_415_mm/1795-modelo-dch_415_o_415_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>460</td>
                            <td>460</td>
                            <td>0,16</td>
                            <td>1200</td>
                            <td>3,2 m³/h</td>
                            <td>4,8 m³/h</td>
                            <td>8 m³/h</td>
                            <td>231/275</td>
                            <td>6/5</td>
                            <td>2”</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/224-1713-calplas-dch.html#/1747-diametros_filtros-o_460_mm/1796-modelo-dch_460_o_460_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>520</td>
                            <td>520</td>
                            <td>0,20</td>
                            <td>1200</td>
                            <td>4 m³/h</td>
                            <td>6 m³/h</td>
                            <td>10 m³/h</td>
                            <td>294/350</td>
                            <td>7/7</td>
                            <td>2”</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/224-1714-calplas-dch.html#/1735-diametros_filtros-o_520_mm/1797-modelo-dch_520_o_520_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>640</td>
                            <td>640</td>
                            <td>0,30</td>
                            <td>1200</td>
                            <td>6 m³/h</td>
                            <td>9 m³/h</td>
                            <td>15 m³/h</td>
                            <td>483/575</td>
                            <td>12/11</td>
                            <td>2”</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/224-1715-calplas-dch.html#/1737-diametros_filtros-o_640_mm/1798-modelo-dch_640_o_640_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>720</td>
                            <td>720</td>
                            <td>0,40</td>
                            <td>1200</td>
                            <td>8 m³/h</td>
                            <td>12 m³/h</td>
                            <td>20 m³/h</td>
                            <td>609/725</td>
                            <td>15/14</td>
                            <td>2”</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/224-1716-calplas-dch.html#/1739-diametros_filtros-o_720_mm/1799-modelo-dch_720_o_720_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>840</td>
                            <td>840</td>
                            <td>0,52</td>
                            <td>1200</td>
                            <td>10 m³/h</td>
                            <td>16 m³/h</td>
                            <td>26 m³/h</td>
                            <td>840/1000</td>
                            <td>20/10</td>
                            <td>2½”</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/224-1717-calplas-dch.html#/1741-diametros_filtros-o_840_mm/1800-modelo-dch_840_o_840_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>960</td>
                            <td>960</td>
                            <td>0,70</td>
                            <td>1200</td>
                            <td>14 m³/h</td>
                            <td>21 m³/h</td>
                            <td>35 m³/h</td>
                            <td>1113/1325</td>
                            <td>27/13</td>
                            <td>2½”</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/224-1718-calplas-dch.html#/1743-diametros_filtros-o_960_mm/1801-modelo-dch_960_o_960_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>1010</td>
                            <td>1010</td>
                            <td>0,78</td>
                            <td>1200</td>
                            <td>16 m³/h</td>
                            <td>24 m³/h</td>
                            <td>40 m³/h</td>
                            <td>1260/1500</td>
                            <td>30/15</td>
                            <td>DN80</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/224-1719-calplas-dch.html#/1759-diametros_filtros-o_1010_mm/1802-modelo-dch_1010_o_1010_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>1260</td>
                            <td>1260</td>
                            <td>1,21</td>
                            <td>1200</td>
                            <td>24 m³/h</td>
                            <td>36 m³/h</td>
                            <td>60 m³/h</td>
                            <td>1890/2250</td>
                            <td>46/22</td>
                            <td>DN100</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/224-1720-calplas-dch.html#/1763-diametros_filtros-o_1260_mm/1803-modelo-dch_1260_o_1260_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        {{-- DCHP --}}
                        <tr>
                            <td rowspan="9">DCHP</td>
                            <td>415</td>
                            <td>415</td>
                            <td>0,13</td>
                            <td>1200</td>
                            <td>2,6 m³/h</td>
                            <td>3,9 m³/h</td>
                            <td>6 m³/h</td>
                            <td>168/200</td>
                            <td>4/ 4</td>
                            <td>2”</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/225-1721-calplas-dch-p.html#/1745-diametros_filtros-o_415_mm/1804-modelo-dch_p_415_o_415_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>460</td>
                            <td>460</td>
                            <td>0,16</td>
                            <td>1200</td>
                            <td>3,2 m³/h</td>
                            <td>4,8 m³/h</td>
                            <td>8 m³/h</td>
                            <td>231/275</td>
                            <td>6/5</td>
                            <td>2”</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/225-1722-calplas-dch-p.html#/1747-diametros_filtros-o_460_mm/1805-modelo-dch_p_460_o_460_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>520</td>
                            <td>520</td>
                            <td>0,20</td>
                            <td>1200</td>
                            <td>4 m³/h</td>
                            <td>6 m³/h</td>
                            <td>10 m³/h</td>
                            <td>273/325</td>
                            <td>7/6</td>
                            <td>2”</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/225-1723-calplas-dch-p.html#/1735-diametros_filtros-o_520_mm/1806-modelo-dch_p_520_o_520_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>640</td>
                            <td>640</td>
                            <td>0,30</td>
                            <td>1200</td>
                            <td>6 m³/h</td>
                            <td>9 m³/h</td>
                            <td>15 m³/h</td>
                            <td>441/525</td>
                            <td>11/10</td>
                            <td>2”</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/225-1724-calplas-dch-p.html#/1737-diametros_filtros-o_640_mm/1807-modelo-dch_p_640_o_640_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>720</td>
                            <td>720</td>
                            <td>0,40</td>
                            <td>1200</td>
                            <td>8 m³/h</td>
                            <td>12 m³/h</td>
                            <td>20 m³/h</td>
                            <td>567/675</td>
                            <td>14/13</td>
                            <td>2”</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/225-1725-calplas-dch-p.html#/1739-diametros_filtros-o_720_mm/1808-modelo-dch_p_720_o_720_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>840</td>
                            <td>840</td>
                            <td>0,52</td>
                            <td>1200</td>
                            <td>10 m³/h</td>
                            <td>16 m³/h</td>
                            <td>26 m³/h</td>
                            <td>756/900</td>
                            <td>18/18</td>
                            <td>2½”</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/225-1726-calplas-dch-p.html#/1741-diametros_filtros-o_840_mm/1809-modelo-dch_p_840_o_840_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>960</td>
                            <td>960</td>
                            <td>0,70</td>
                            <td>1200</td>
                            <td>14 m³/h</td>
                            <td>21 m³/h</td>
                            <td>35 m³/h</td>
                            <td>987/1175</td>
                            <td>24/23</td>
                            <td>2½”</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/225-1727-calplas-dch-p.html#/1743-diametros_filtros-o_960_mm/1810-modelo-dch_p_960_o_960_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>1010</td>
                            <td>1010</td>
                            <td>0,78</td>
                            <td>1200</td>
                            <td>16 m³/h</td>
                            <td>24 m³/h</td>
                            <td>40 m³/h</td>
                            <td>1092/1300</td>
                            <td>26/26</td>
                            <td>DN80</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/225-1728-calplas-dch-p.html#/1759-diametros_filtros-o_1010_mm/1811-modelo-dch_p_1010_o_1010_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>1260</td>
                            <td>1260</td>
                            <td>1,21</td>
                            <td>1200</td>
                            <td>24 m³/h</td>
                            <td>36 m³/h</td>
                            <td>60 m³/h</td>
                            <td>1722/2050</td>
                            <td>41/41</td>
                            <td>DN100</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/225-1729-calplas-dch-p.html#/1763-diametros_filtros-o_1260_mm/1812-modelo-dch_p_1260_o_1260_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        {{-- DS --}}
                        <tr>
                            <td rowspan="12">DS</td>
                            <td>1010</td>
                            <td>1010</td>
                            <td>0,78</td>
                            <td>1200</td>
                            <td>16 m³/h</td>
                            <td>23 m³/h</td>
                            <td>39 m³/h</td>
                            <td>1260/1500</td>
                            <td>30/15/15</td>
                            <td>DN80</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/282-2105-calplas-ds.html#/1759-diametros_filtros-o_1010_mm/2121-modelo-ds_o_1010_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>1160</td>
                            <td>1160</td>
                            <td>1,01</td>
                            <td>1200</td>
                            <td>20 m³/h</td>
                            <td>30 m³/h</td>
                            <td>51 m³/h</td>
                            <td>1680/2000</td>
                            <td>40/20/20</td>
                            <td>DN80</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/282-2106-calplas-ds.html#/1761-diametros_filtros-o_1160_mm/2122-modelo-ds_o_1160_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>1260</td>
                            <td>1260</td>
                            <td>1,21</td>
                            <td>1200</td>
                            <td>24 m³/h</td>
                            <td>36 m³/h</td>
                            <td>61 m³/h</td>
                            <td>1890/2250</td>
                            <td>45/25/20</td>
                            <td>DN100</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/282-2107-calplas-ds.html#/1763-diametros_filtros-o_1260_mm/2123-modelo-ds_o_1260_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>1440</td>
                            <td>1440</td>
                            <td>1,55</td>
                            <td>1200</td>
                            <td>31 m³/h</td>
                            <td>47 m³/h</td>
                            <td>78 m³/h</td>
                            <td>2520/3000</td>
                            <td>60/30/30</td>
                            <td>DN100</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/282-2108-calplas-ds.html#/1765-diametros_filtros-o_1440_mm/2124-modelo-ds_o_1440_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>1640</td>
                            <td>1640</td>
                            <td>2,04</td>
                            <td>1200</td>
                            <td>41 m³/h</td>
                            <td>61 m³/h</td>
                            <td>102 m³/h</td>
                            <td>3360/4000</td>
                            <td>80/40/40</td>
                            <td>DN125</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/282-2109-calplas-ds.html#/1767-diametros_filtros-o_1640_mm/2125-modelo-ds_o_1640_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>1840</td>
                            <td>1840</td>
                            <td>2,52</td>
                            <td>1200</td>
                            <td>50 m³/h</td>
                            <td>76 m³/h</td>
                            <td>126 m³/h</td>
                            <td>4200/5000</td>
                            <td>100/50/50</td>
                            <td>DN125</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/282-2110-calplas-ds.html#/1769-diametros_filtros-o_1840_mm/2126-modelo-ds_o_1840_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>2040</td>
                            <td>2040</td>
                            <td>3,17</td>
                            <td>1200</td>
                            <td>63 m³/h</td>
                            <td>95 m³/h</td>
                            <td>159 m³/h</td>
                            <td>5460/6500</td>
                            <td>140/60/60</td>
                            <td>DN150</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/282-2111-calplas-ds.html#/1771-diametros_filtros-o_2040_mm/2127-modelo-ds_o_2040_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>2210</td>
                            <td>2210</td>
                            <td>3,77</td>
                            <td>1200</td>
                            <td>75 m³/h</td>
                            <td>113 m³/h</td>
                            <td>189 m³/h</td>
                            <td>6720/8000</td>
                            <td>160/80/80</td>
                            <td>DN150</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/282-2112-calplas-ds.html#/1773-diametros_filtros-o_2210_mm/2128-modelo-ds_o_2210_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>2340</td>
                            <td>2340</td>
                            <td>4,06</td>
                            <td>1200</td>
                            <td>81 m³/h</td>
                            <td>122 m³/h</td>
                            <td>203 m³/h</td>
                            <td>7140/8500</td>
                            <td>180/80/80</td>
                            <td>DN200</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/282-2113-calplas-ds.html#/1775-diametros_filtros-o_2340_mm/2129-modelo-ds_o_2340_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>2550</td>
                            <td>2550</td>
                            <td>4,91</td>
                            <td>1200</td>
                            <td>98 m³/h</td>
                            <td>147 m³/h</td>
                            <td>246 m³/h</td>
                            <td>8400/10000</td>
                            <td>200/100/100</td>
                            <td>DN200</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/282-2114-calplas-ds.html#/1777-diametros_filtros-o_2550_mm/2130-modelo-ds_o_2550_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>2800</td>
                            <td>2800</td>
                            <td>5,97</td>
                            <td>1200</td>
                            <td>119 m³/h</td>
                            <td>179 m³/h</td>
                            <td>299 m³/h</td>
                            <td>10920/13000</td>
                            <td>260/140/120</td>
                            <td>DN250</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/282-2115-calplas-ds.html#/1779-diametros_filtros-o_2800_mm/2131-modelo-ds_o_2800_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>3000</td>
                            <td>3000</td>
                            <td>6,90</td>
                            <td>1200</td>
                            <td>138 m³/h</td>
                            <td>207 m³/h</td>
                            <td>345 m³/h</td>
                            <td>12600/15000</td>
                            <td>300/160/140</td>
                            <td>DN250</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/282-2116-calplas-ds.html#/1781-diametros_filtros-o_3000_mm/2132-modelo-ds_o_3000_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        {{-- DPS 420 --}}
                        <tr>
                            <td rowspan="12">DPS/420</td>
                            <td>1010</td>
                            <td>1010</td>
                            <td>0,78</td>
                            <td>1200</td>
                            <td>16 m³/h</td>
                            <td>23 m³/h</td>
                            <td>39 m³/h</td>
                            <td>1092 / 1300</td>
                            <td>26 / 26</td>
                            <td>DN80</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/223-1700-calplas-dps-420.html#/1759-diametros_filtros-o_1010_mm/1783-modelo-dps_420_o_1010_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>1160</td>
                            <td>1160</td>
                            <td>1,01</td>
                            <td>1200</td>
                            <td>20 m³/h</td>
                            <td>30 m³/h</td>
                            <td>51 m³/h</td>
                            <td>1470 / 1750</td>
                            <td>35 / 35</td>
                            <td>DN80</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/223-1701-calplas-dps-420.html#/1761-diametros_filtros-o_1160_mm/1784-modelo-dps_420_o_1160_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>1260</td>
                            <td>1260</td>
                            <td>1,21</td>
                            <td>1200</td>
                            <td>24 m³/h</td>
                            <td>36 m³/h</td>
                            <td>61 m³/h</td>
                            <td>1722 / 2050</td>
                            <td>42 / 40</td>
                            <td>DN100</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/223-1702-calplas-dps-420.html#/1763-diametros_filtros-o_1260_mm/1785-modelo-dps_420_o_1260_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>1440</td>
                            <td>1440</td>
                            <td>1,55</td>
                            <td>1200</td>
                            <td>31 m³/h</td>
                            <td>47 m³/h</td>
                            <td>78 m³/h</td>
                            <td>2310 / 2750</td>
                            <td>60 / 50</td>
                            <td>DN100</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/223-1703-calplas-dps-420.html#/1765-diametros_filtros-o_1440_mm/1786-modelo-dps_420_o_1440_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>1640</td>
                            <td>1640</td>
                            <td>2,04</td>
                            <td>1200</td>
                            <td>41 m³/h</td>
                            <td>61 m³/h</td>
                            <td>102 m³/h</td>
                            <td>2940 / 3500</td>
                            <td>80 / 60</td>
                            <td>DN125</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/223-1704-calplas-dps-420.html#/1767-diametros_filtros-o_1640_mm/1787-modelo-dps_420_o_1640_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>1840</td>
                            <td>1840</td>
                            <td>2,52</td>
                            <td>1200</td>
                            <td>50 m³/h</td>
                            <td>76 m³/h</td>
                            <td>126 m³/h</td>
                            <td>3780 / 4500</td>
                            <td>100 / 80</td>
                            <td>DN125</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/223-1705-calplas-dps-420.html#/1769-diametros_filtros-o_1840_mm/1788-modelo-dps_420_o_1840_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>2040</td>
                            <td>2040</td>
                            <td>3,17</td>
                            <td>1200</td>
                            <td>63 m³/h</td>
                            <td>95 m³/h</td>
                            <td>159 m³/h</td>
                            <td>4650 / 5500</td>
                            <td>120 / 100</td>
                            <td>DN150</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/223-1706-calplas-dps-420.html#/1771-diametros_filtros-o_2040_mm/1789-modelo-dps_420_o_2040_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>2210</td>
                            <td>2210</td>
                            <td>3,77</td>
                            <td>1200</td>
                            <td>75 m³/h</td>
                            <td>113 m³/h</td>
                            <td>189 m³/h</td>
                            <td>5460 / 6500</td>
                            <td>130 / 130</td>
                            <td>DN150</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/223-1707-calplas-dps-420.html#/1773-diametros_filtros-o_2210_mm/1790-modelo-dps_420_o_2210_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>2340</td>
                            <td>2340</td>
                            <td>4,06</td>
                            <td>1200</td>
                            <td>81 m³/h</td>
                            <td>122 m³/h</td>
                            <td>203 m³/h</td>
                            <td>5880 / 7000</td>
                            <td>140 / 140</td>
                            <td>DN200</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/223-1708-calplas-dps-420.html#/1775-diametros_filtros-o_2340_mm/1791-modelo-dps_420_o_2340_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>2550</td>
                            <td>2550</td>
                            <td>4,91</td>
                            <td>1200</td>
                            <td>98 m³/h</td>
                            <td>147 m³/h</td>
                            <td>246 m³/h</td>
                            <td>7140 / 8500</td>
                            <td>180 / 160</td>
                            <td>DN200</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/223-1709-calplas-dps-420.html#/1777-diametros_filtros-o_2550_mm/1792-modelo-dps_420_o_2550_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>2800</td>
                            <td>2800</td>
                            <td>5,97</td>
                            <td>1200</td>
                            <td>119 m³/h</td>
                            <td>179 m³/h</td>
                            <td>299 m³/h</td>
                            <td>8400 / 10000</td>
                            <td>200 / 200</td>
                            <td>DN250</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/223-1710-calplas-dps-420.html#/1779-diametros_filtros-o_2800_mm/1793-modelo-dps_420_o_2800_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>3000</td>
                            <td>3000</td>
                            <td>6,90</td>
                            <td>1200</td>
                            <td>138 m³/h</td>
                            <td>207 m³/h</td>
                            <td>345 m³/h</td>
                            <td>9660 / 11500</td>
                            <td>240 / 220</td>
                            <td>DN250</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/223-1711-calplas-dps-420.html#/1781-diametros_filtros-o_3000_mm/1794-modelo-dps_420_o_3000_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        {{-- --}}

                    </tbody>
                </table>
            </div>
            <a href="{{ route('guias.filtros.index', ['user' => $userEncoded]) }}" class="btn-volver">Volver</a>
        </div>
    </div>
</main>
@endsection
