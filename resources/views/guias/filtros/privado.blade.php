@extends('layouts.app')

@section('content')

@php
$userEncoded = base64_encode($user);
@endphp
<main class="home">
    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Filtros Calplas Residencial"
        description="Aquí dispones de una tabla con todos los filtros de calplas para piscina privada" :user="$user" />

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
                            <td rowspan="5">FA</td>
                            <td>FA 10</td>
                            <td>520</td>
                            <td>0,20</td>
                            <td>350</td>
                            <td>4 m³/h</td>
                            <td>6 m³/h</td>
                            <td>10 m³/h</td>
                            <td>105 / 125</td>
                            <td>3 / 2 / -</td>
                            <td>2"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/219-1671-calplas-fa.html#/1735-diametros_filtros-o_520_mm/1736-modelo-fa_10_o_520_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>FA 15</td>
                            <td>640</td>
                            <td>0,30</td>
                            <td>350</td>
                            <td>6 m³/h</td>
                            <td>9 m³/h</td>
                            <td>15 m³/h</td>
                            <td>126 / 150</td>
                            <td>3 / 3 / -</td>
                            <td>2"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/219-1672-calplas-fa.html#/1737-diametros_filtros-o_640_mm/1738-modelo-fa_15_o_640_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>FA 20</td>
                            <td>720</td>
                            <td>0,40</td>
                            <td>400</td>
                            <td>8 m³/h</td>
                            <td>12 m³/h</td>
                            <td>20 m³/h</td>
                            <td>210 / 250</td>
                            <td>5 / 5 / -</td>
                            <td>2"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/219-1673-calplas-fa.html#/1739-diametros_filtros-o_720_mm/1740-modelo-fa_20_o_720_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>FA 30</td>
                            <td>840</td>
                            <td>0,52</td>
                            <td>400</td>
                            <td>10 m³/h</td>
                            <td>16 m³/h</td>
                            <td>26 m³/h</td>
                            <td>294 / 350</td>
                            <td>7 / 4 / 3</td>
                            <td>2"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/219-1674-calplas-fa.html#/1741-diametros_filtros-o_840_mm/1742-modelo-fa_30_o_840_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>FA 35</td>
                            <td>960</td>
                            <td>0,70</td>
                            <td>450</td>
                            <td>14 m³/h</td>
                            <td>21 m³/h</td>
                            <td>35 m³/h</td>
                            <td>420 / 500</td>
                            <td>10 / 5 / 5</td>
                            <td>2½"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/219-1675-calplas-fa.html#/1743-diametros_filtros-o_960_mm/1744-modelo-fa_35_o_960_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td rowspan="7">HFS</td>
                            <td>HFS 06</td>
                            <td>415</td>
                            <td>0,13</td>
                            <td>450</td>
                            <td>2,6 m³/h</td>
                            <td>3,9 m³/h</td>
                            <td>6,5 m³/h</td>
                            <td>42 / 50</td>
                            <td>1 / 1 / -</td>
                            <td>2"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/220-1676-calplas-hfs.html#/1745-diametros_filtros-o_415_mm/1746-modelo-hfs_06_o_415_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>HFS 08</td>
                            <td>460</td>
                            <td>0,16</td>
                            <td>450</td>
                            <td>3,2 m³/h</td>
                            <td>4,8 m³/h</td>
                            <td>8 m³/h</td>
                            <td>63 / 75</td>
                            <td>2 / 1 / -</td>
                            <td>2"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/220-1677-calplas-hfs.html#/1747-diametros_filtros-o_460_mm/1748-modelo-hfs_08_o_460_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>HFS 10</td>
                            <td>520</td>
                            <td>0,20</td>
                            <td>500</td>
                            <td>4 m³/h</td>
                            <td>6 m³/h</td>
                            <td>10 m³/h</td>
                            <td>126 / 150</td>
                            <td>3 / 3 / -</td>
                            <td>2"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/220-1678-calplas-hfs.html#/1735-diametros_filtros-o_520_mm/1749-modelo-hfs_10_o_520_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>HFS 15</td>
                            <td>640</td>
                            <td>0,30</td>
                            <td>600</td>
                            <td>6 m³/h</td>
                            <td>9 m³/h</td>
                            <td>15 m³/h</td>
                            <td>252 / 300</td>
                            <td>6 / 6 / -</td>
                            <td>2"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/220-1679-calplas-hfs.html#/1737-diametros_filtros-o_640_mm/1750-modelo-hfs_15_o_640_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>HFS 20</td>
                            <td>720</td>
                            <td>0,40</td>
                            <td>600</td>
                            <td>10 m³/h</td>
                            <td>12 m³/h</td>
                            <td>20 m³/h</td>
                            <td>336 / 400</td>
                            <td>8 / 8 / -</td>
                            <td>2"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/220-1680-calplas-hfs.html#/1739-diametros_filtros-o_720_mm/1751-modelo-hfs_20_o_720_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>HFS 30</td>
                            <td>840</td>
                            <td>0,52</td>
                            <td>650</td>
                            <td>16 m³/h</td>
                            <td>15 m³/h</td>
                            <td>26 m³/h</td>
                            <td>420 / 500</td>
                            <td>10 / 5 / 5</td>
                            <td>2"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/220-1681-calplas-hfs.html#/1741-diametros_filtros-o_840_mm/1752-modelo-hfs_30_o_840_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>HFS 35</td>
                            <td>960</td>
                            <td>0,70</td>
                            <td>700</td>
                            <td>14 m³/h</td>
                            <td>21 m³/h</td>
                            <td>35 m³/h</td>
                            <td>630 / 750</td>
                            <td>15 / 8 / 7</td>
                            <td>2½"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/220-1682-calplas-hfs.html#/1743-diametros_filtros-o_960_mm/1753-modelo-hfs_35_o_960_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td rowspan="5">AFM</td>
                            <td>AFM 520</td>
                            <td>520</td>
                            <td>0,20</td>
                            <td>900</td>
                            <td>4 m³/h</td>
                            <td>6 m³/h</td>
                            <td>10 m³/h</td>
                            <td>231 / 275</td>
                            <td>6 / 5 / -</td>
                            <td>2"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/221-1683-calplas-afm.html#/1735-diametros_filtros-o_520_mm/1754-modelo-afm_520_o_520_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>AFM 640</td>
                            <td>640</td>
                            <td>0,30</td>
                            <td>900</td>
                            <td>6 m³/h</td>
                            <td>9 m³/h</td>
                            <td>15 m³/h</td>
                            <td>357 / 425</td>
                            <td>9 / 8 / -</td>
                            <td>2"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/221-1684-calplas-afm.html#/1737-diametros_filtros-o_640_mm/1755-modelo-afm_640_o_640_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>AFM 720</td>
                            <td>720</td>
                            <td>0,40</td>
                            <td>900</td>
                            <td>8 m³/h</td>
                            <td>12 m³/h</td>
                            <td>20 m³/h</td>
                            <td>462 / 550</td>
                            <td>11 / 11 / -</td>
                            <td>2"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/221-1685-calplas-afm.html#/1739-diametros_filtros-o_720_mm/1756-modelo-afm_720_o_720_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>AFM 840</td>
                            <td>840</td>
                            <td>0,52</td>
                            <td>950</td>
                            <td>10 m³/h</td>
                            <td>16 m³/h</td>
                            <td>26 m³/h</td>
                            <td>651 / 775</td>
                            <td>15 / 8 / 8</td>
                            <td>2"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/221-1686-calplas-afm.html#/1741-diametros_filtros-o_840_mm/1757-modelo-afm_840_o_840_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>AFM 960</td>
                            <td>960</td>
                            <td>0,70</td>
                            <td>1000</td>
                            <td>14 m³/h</td>
                            <td>21 m³/h</td>
                            <td>35 m³/h</td>
                            <td>924 / 1100</td>
                            <td>22 / 11 / 11</td>
                            <td>2½"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/221-1687-calplas-afm.html#/1743-diametros_filtros-o_960_mm/1758-modelo-afm_960_o_960_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td rowspan="5">AFM/P</td>
                            <td>AFM/P 520</td>
                            <td>520</td>
                            <td>0,20</td>
                            <td>850</td>
                            <td>4 m³/h</td>
                            <td>6 m³/h</td>
                            <td>10 m³/h</td>
                            <td>189 / 225</td>
                            <td>5 / 4 / -</td>
                            <td>2"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/281-2100-calplas-afm-p.html#/1735-diametros_filtros-o_520_mm/2116-modelo-afm_p_o_520_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>AFM/P 640</td>
                            <td>640</td>
                            <td>0,30</td>
                            <td>850</td>
                            <td>6 m³/h</td>
                            <td>9 m³/h</td>
                            <td>15 m³/h</td>
                            <td>315 / 375</td>
                            <td>8 / 7 / -</td>
                            <td>2"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/281-2101-calplas-afm-p.html#/1737-diametros_filtros-o_640_mm/2117-modelo-afm_p_o_640_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>AFM/P 720</td>
                            <td>720</td>
                            <td>0,40</td>
                            <td>850</td>
                            <td>8 m³/h</td>
                            <td>12 m³/h</td>
                            <td>20 m³/h</td>
                            <td>378 / 450</td>
                            <td>9 / 9 / -</td>
                            <td>2"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/281-2102-calplas-afm-p.html#/1739-diametros_filtros-o_720_mm/2118-modelo-afm_p_o_720_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>AFM/P 840</td>
                            <td>840</td>
                            <td>0,52</td>
                            <td>850</td>
                            <td>10 m³/h</td>
                            <td>16 m³/h</td>
                            <td>26 m³/h</td>
                            <td>525 / 625</td>
                            <td>13 / 12 / -</td>
                            <td>2"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/281-2103-calplas-afm-p.html#/1741-diametros_filtros-o_840_mm/2119-modelo-afm_p_o_840_mm_25_kg_cm"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>AFM/P 960</td>
                            <td>960</td>
                            <td>0,70</td>
                            <td>900</td>
                            <td>14 m³/h</td>
                            <td>21 m³/h</td>
                            <td>35 m³/h</td>
                            <td>735 / 875</td>
                            <td>18 / 17 / -</td>
                            <td>2½"</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/filtros/281-2104-calplas-afm-p.html#/1743-diametros_filtros-o_960_mm/2120-modelo-afm_p_o_960_mm_25_kg_cm"
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
