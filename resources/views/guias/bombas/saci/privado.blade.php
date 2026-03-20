@extends('layouts.app')

@section('content')

@php
$userEncoded = base64_encode($user);
@endphp
<main class="home">

    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})" title="Bombas SACI Residencial"
        description="Aquí dispones de una tabla con todos las bombas de SACI para piscina privada" :user="$user" />

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
                            <th rowspan="2">TIPO</th>
                            <th rowspan="2">NOMBRE</th>
                            <th rowspan="2">MODELO</th>
                            <th rowspan="2">HP</th>
                            <th rowspan="2">KW</th>
                            <th colspan="2">Amp.</th>
                            <th colspan="9">Altura manométrica m.c.a./caudal m³/h</th>
                            <th>conex.</th>
                            <th rowspan="2">Enlace</th>
                        </tr>
                        <tr>
                            <th>230V</th>
                            <th>400V</th>
                            <th>4</th>
                            <th>6</th>
                            <th>8</th>
                            <th>10</th>
                            <th>12</th>
                            <th>14</th>
                            <th>16</th>
                            <th>18</th>
                            <th>20</th>
                            <th>DNA DNI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="vertical-text" rowspan="33">AUTOASPIRANTE</td>
                            <td rowspan="12">OPTIMA</td>
                            <td>25 M</td>
                            <td rowspan="2">0,25</td>
                            <td rowspan="2">0,16</td>
                            <td>2,6</td>
                            <td>-</td>
                            <td rowspan="2">10</td>
                            <td rowspan="2">8</td>
                            <td rowspan="2">6</td>
                            <td rowspan="2">4</td>
                            <td rowspan="2">0,5</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td rowspan="12">1½" Ø 50 PVC</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/453-1751-optima-840025002197.html#/1693-corriente-monofasica/1832-potencia_cv_-025_cv/1833-modelo-25m_016_kw_025_cv_230v_4_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>25 T</td>
                            <td>1,3</td>
                            <td>0,8</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/453-1752-optima-840025002197.html#/1686-corriente-trifasica/1832-potencia_cv_-025_cv/1834-modelo-25m_016_kw_025_cv_400v_4_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>33 M</td>
                            <td rowspan="2">0,33</td>
                            <td rowspan="2">0,25</td>
                            <td>2,9</td>
                            <td>-</td>
                            <td rowspan="2">12</td>
                            <td rowspan="2">10</td>
                            <td rowspan="2">8</td>
                            <td rowspan="2">5,5</td>
                            <td rowspan="2">2</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/453-1753-optima-840025002197.html#/1693-corriente-monofasica/1835-potencia_cv_-033_cv/1836-modelo-33m_025_kw_033_cv_230v_55_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>33 T</td>
                            <td>1,9</td>
                            <td>1,1</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/453-2605-optima-840025002197.html#/1686-corriente-trifasica/1835-potencia_cv_-033_cv/2501-modelo-33t_025_kw_033_cv_230v_55_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>50 M</td>
                            <td rowspan="2">0,50</td>
                            <td rowspan="2">0,37</td>
                            <td>3,3</td>
                            <td>-</td>
                            <td rowspan="2">14</td>
                            <td rowspan="2">12</td>
                            <td rowspan="2">10</td>
                            <td rowspan="2">7</td>
                            <td rowspan="2">5</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/453-1755-optima-840025002197.html#/1693-corriente-monofasica/1837-potencia_cv_-050_cv/1838-modelo-50m_033_kw_050_cv_230v_7_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>50 T</td>
                            <td>2,5</td>
                            <td>1,4</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/453-2607-optima-840025002197.html#/1686-corriente-trifasica/1837-potencia_cv_-050_cv/2503-modelo-50t_033_kw_050_cv_400v_7_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>75 M</td>
                            <td rowspan="2">0,75</td>
                            <td rowspan="2">0,55</td>
                            <td>3,8</td>
                            <td>-</td>
                            <td rowspan="2">16</td>
                            <td rowspan="2">15</td>
                            <td rowspan="2">12,5</td>
                            <td rowspan="2">10</td>
                            <td rowspan="2">8</td>
                            <td rowspan="2">4,2</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/453-1757-optima-840025002197.html#/1693-corriente-monofasica/1840-potencia_cv_-075_cv/1841-modelo-75m_055_kw_075_cv_230v_10_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>75 T</td>
                            <td>3</td>
                            <td>1,7</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/453-2609-optima-840025002197.html#/1686-corriente-trifasica/1840-potencia_cv_-075_cv/2504-modelo-75t_055_kw_075_cv_400v_10_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>100 M</td>
                            <td rowspan="2">1</td>
                            <td rowspan="2">0,75</td>
                            <td>4,2</td>
                            <td>-</td>
                            <td rowspan="2">17</td>
                            <td rowspan="2">16</td>
                            <td rowspan="2">15,3</td>
                            <td rowspan="2">13</td>
                            <td rowspan="2">10,5</td>
                            <td rowspan="2">7,6</td>
                            <td rowspan="2">5,5</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/453-1759-optima-840025002197.html#/1693-corriente-monofasica/1843-potencia_cv_-10_cv/1844-modelo-100m_075_kw_10_cv_230v_13_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>100 T</td>
                            <td>3,4</td>
                            <td>2</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/453-2611-optima-840025002197.html#/1686-corriente-trifasica/1843-potencia_cv_-10_cv/2505-modelo-100t_075_kw_10_cv_400v_13_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>150 M</td>
                            <td rowspan="2">1,5</td>
                            <td rowspan="2">1,1</td>
                            <td>7,3</td>
                            <td>-</td>
                            <td rowspan="2">18</td>
                            <td rowspan="2">17,3</td>
                            <td rowspan="2">15,9</td>
                            <td rowspan="2">14,5</td>
                            <td rowspan="2">12,8</td>
                            <td rowspan="2">11</td>
                            <td rowspan="2">9</td>
                            <td rowspan="2">5</td>
                            <td rowspan="2">-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/453-1761-optima-840025002197.html#/1693-corriente-monofasica/1846-potencia_cv_-15_cv/1847-modelo-150m_11_kw_15_cv_230v_145_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>150 T</td>
                            <td>5</td>
                            <td>2,9</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/453-2613-optima-840025002197.html#/1686-corriente-trifasica/1846-potencia_cv_-15_cv/2506-modelo-150t_11_kw_15_cv_400v_145_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td rowspan="14">WINNER</td>
                            <td>33 M</td>
                            <td rowspan="2">0,33</td>
                            <td rowspan="2">0,25</td>
                            <td>3,7</td>
                            <td>-</td>
                            <td rowspan="2">16</td>
                            <td rowspan="2">14,2</td>
                            <td rowspan="2">12</td>
                            <td rowspan="2">9</td>
                            <td rowspan="2">5</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td rowspan="21">2" Ø 63 PVC</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/230-winner-840025206247.html#/1686-corriente-trifasica/1837-potencia_cv_-050_cv/2490-modelo-50t_038_kw_050_cv_400v_111_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>33 T</td>
                            <td>2,6</td>
                            <td>1,5</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/230-2640-winner-840025206247.html#/1686-corriente-trifasica/1835-potencia_cv_-033_cv/2508-modelo-33t_025_kw_033_cv_230v_9_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>50 M</td>
                            <td rowspan="2">0,50</td>
                            <td rowspan="2">0,37</td>
                            <td>4,2</td>
                            <td>-</td>
                            <td rowspan="2">17,7</td>
                            <td rowspan="2">16</td>
                            <td rowspan="2">14</td>
                            <td rowspan="2">11,5</td>
                            <td rowspan="2">7,7</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/230-1763-winner-840025002101.html#/1693-corriente-monofasica/1837-potencia_cv_-050_cv/1849-modelo-038_kw_050_cv_230v_111_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>50 T</td>
                            <td>3,0</td>
                            <td>1,7</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/230-1764-winner-840025002101.html#/1686-corriente-trifasica/1837-potencia_cv_-050_cv/1850-modelo-038_kw_050_cv_400v_111_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>75 M</td>
                            <td rowspan="2">0,75</td>
                            <td rowspan="2">0,55</td>
                            <td>5,0</td>
                            <td>-</td>
                            <td rowspan="2">20</td>
                            <td rowspan="2">18,2</td>
                            <td rowspan="2">16,5</td>
                            <td rowspan="2">14</td>
                            <td rowspan="2">11</td>
                            <td rowspan="2">6</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/230-1765-winner-840025002101.html#/1693-corriente-monofasica/1840-potencia_cv_-075_cv/1851-modelo-055_kw_075_cv_230v_135_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>75 T</td>
                            <td>3,5</td>
                            <td>2,0</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/230-1766-winner-840025002101.html#/1686-corriente-trifasica/1840-potencia_cv_-075_cv/1852-modelo-055_kw_075_cv_400v_135_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>100 M</td>
                            <td rowspan="2">1</td>
                            <td rowspan="2">0,75</td>
                            <td>5,5</td>
                            <td>-</td>
                            <td rowspan="2">24</td>
                            <td rowspan="2">22</td>
                            <td rowspan="2">20</td>
                            <td rowspan="2">18</td>
                            <td rowspan="2">15</td>
                            <td rowspan="2">11</td>
                            <td rowspan="2">5</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/230-1767-winner-840025002101.html#/1693-corriente-monofasica/1843-potencia_cv_-10_cv/1853-modelo-075_kw_10_cv_230v_18_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>

                        </tr>
                        <tr>
                            <td>100 T</td>
                            <td>3,8</td>
                            <td>2,2</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/230-1768-winner-840025002101.html#/1686-corriente-trifasica/1843-potencia_cv_-10_cv/1854-modelo-075_kw_10_cv_400v_18_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>150 M</td>
                            <td rowspan="2">1,5</td>
                            <td rowspan="2">1,1</td>
                            <td>7,3</td>
                            <td>-</td>
                            <td rowspan="2">27,5</td>
                            <td rowspan="2">25,5</td>
                            <td rowspan="2">23,5</td>
                            <td rowspan="2">21,5</td>
                            <td rowspan="2">19</td>
                            <td rowspan="2">16</td>
                            <td rowspan="2">12</td>
                            <td rowspan="2">6</td>
                            <td rowspan="2">-</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/230-1769-winner-840025002101.html#/1693-corriente-monofasica/1846-potencia_cv_-15_cv/1855-modelo-11_kw_15_cv_230v_21_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>150 T</td>
                            <td>5,0</td>
                            <td>2,9</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/230-1770-winner-840025002101.html#/1686-corriente-trifasica/1846-potencia_cv_-15_cv/1856-modelo-11_kw_15_cv_400v_21_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>200 M</td>
                            <td rowspan="2">2</td>
                            <td rowspan="2">1,5</td>
                            <td>9,2</td>
                            <td>-</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">28,2</td>
                            <td rowspan="2">26,5</td>
                            <td rowspan="2">24,3</td>
                            <td rowspan="2">22</td>
                            <td rowspan="2">19</td>
                            <td rowspan="2">15,2</td>
                            <td rowspan="2">10,5</td>
                            <td rowspan="2">3</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/230-1771-winner-840025002101.html#/1693-corriente-monofasica/1857-potencia_cv_-20_cv/1858-modelo-15_kw_20_cv_230v_24_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>200 T</td>
                            <td>6,0</td>
                            <td>3,5</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/230-1772-winner-840025002101.html#/1686-corriente-trifasica/1857-potencia_cv_-20_cv/1859-modelo-15_kw_20_cv_400v_24_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>300 M</td>
                            <td rowspan="2">3</td>
                            <td rowspan="2">2,2</td>
                            <td>12,2</td>
                            <td>-</td>
                            <td rowspan="2">-</td>
                            <td rowspan="2">32,5</td>
                            <td rowspan="2">31</td>
                            <td rowspan="2">29</td>
                            <td rowspan="2">26</td>
                            <td rowspan="2">23</td>
                            <td rowspan="2">19,5</td>
                            <td rowspan="2">15,2</td>
                            <td rowspan="2">9,8</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/230-1773-winner-840025002101.html#/1687-potencia_cv_-30_cv/1693-corriente-monofasica/1860-modelo-22_kw_30_cv_230v_29_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>300 T</td>
                            <td>8,6</td>
                            <td>5,0</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/230-1774-winner-840025002101.html#/1686-corriente-trifasica/1687-potencia_cv_-30_cv/1861-modelo-22_kw_30_cv_400v_29_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>

                        <tr>
                            <td rowspan="6">VARIO WINNER</td>
                            <td>50</td>
                            <td>0,5</td>
                            <td>0,37</td>
                            <td>-</td>
                            <td rowspan="6">-</td>
                            <td colspan="9" rowspan="6">Velocidad variable</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/436-2117-vario-winner-monofasica-840025197749.html#/1837-potencia_cv_-050_cv/2133-modelo-50m_037_kw_050_cv_230v"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>75</td>
                            <td>0,75</td>
                            <td>0,55</td>
                            <td>5</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/436-2118-vario-winner-monofasica-840025197749.html#/1840-potencia_cv_-075_cv/2134-modelo-75m_055_kw_075_cv_230v"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>100</td>
                            <td>1</td>
                            <td>0,75</td>
                            <td>5,5</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/436-2119-vario-winner-monofasica-840025197749.html#/1843-potencia_cv_-10_cv/2135-modelo-100m_075_kw_1_cv_230v"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>150</td>
                            <td>1,5</td>
                            <td>1,10</td>
                            <td>7,3</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/436-2120-vario-winner-monofasica-840025197749.html#/1846-potencia_cv_-15_cv/2136-modelo-150m_11_kw_15_cv_230v"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>200</td>
                            <td>2</td>
                            <td>1,5</td>
                            <td>9,2</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/436-2121-vario-winner-monofasica-840025197749.html#/1857-potencia_cv_-20_cv/2137-modelo-200m_150_kw_2_cv_230v"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td>300</td>
                            <td>3</td>
                            <td>2,2</td>
                            <td>12,2</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/bombas-saci/230-1774-winner-840025002101.html#/1686-corriente-trifasica/1687-potencia_cv_-30_cv/1861-modelo-22_kw_30_cv_400v_29_m_h_10_mca"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr class="border_linea_tabla">
                            <td rowspan="14">[e] WINNER PRO</td>
                            <td>300 M</td>
                            <td>3</td>
                            <td>2,2</td>
                            <td>12,2</td>
                            <td rowspan="6">-</td>
                            <td colspan="9" rowspan="6">Velocidad variable con motor de imanes permanentes</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/56-bomba-saci-ewinner-pro-300m-hasta-3-cv-230v-840025015636.html"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="{{ route('guias.bombas.saci.index', ['user' => $userEncoded]) }}" class="btn-volver">Volver</a>
        </div>
    </div>
</main>
@endsection
