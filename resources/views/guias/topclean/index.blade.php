@extends('layouts.app')

@section('content')
@php
$userEncoded = base64_encode($user);
@endphp
<main class="home">

    <x-header-herramientas class="py-5 titulo"
        background="background-image: url({{ asset('storage/img/home/home.jpg')}})"
        title="Impulsores y Recambios TopClean"
        description="Impulsores y recambios TopClean G4V, G4, G2V, G2, G1 y adaptaciones a otras marcas"
        :user="$user" />

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
                            <th rowspan="2">GAMA</th>
                            <th rowspan="2">TIPO</th>
                            <th rowspan="2">USO</th>
                            <th rowspan="2">COLOR</th>
                            <th rowspan="2">DESCRIPCIÓN</th>
                            <th>MODELO</th>
                            <th>REFERENCIA</th>
                            <th>Enlace</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="16">G4V</td>
                            <td rowspan="8">COMPLETO</td>
                            <td rowspan="8">HORMIGON</td>
                            <td>Blanco</td>
                            <td rowspan="8">Impulsor TOPCLEAN G4V, venturi</td>
                            <td rowspan="16">Fondo</td>
                            <td>10926</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/304-2249-impulsores-topclean-g4v-840076307258.html#/1700-color-blanco/2250-tipo-completo"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Gris claro</td>
                            <td>23494</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/304-2250-impulsores-topclean-g4v-840076307258.html#/2062-color-gris_claro/2250-tipo-completo"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Gris oscuro</td>
                            <td>11643</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/304-2251-impulsores-topclean-g4v-840076307258.html#/2065-color-gris_oscuro/2250-tipo-completo"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Beige</td>
                            <td>11349</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/304-2252-impulsores-topclean-g4v-840076307258.html#/2063-color-beige/2250-tipo-completo"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Marrón</td>
                            <td>11639</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/304-2253-impulsores-topclean-g4v-840076307258.html#/2250-tipo-completo/2251-color-marron"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Negro</td>
                            <td>11640</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/304-2254-impulsores-topclean-g4v-840076307258.html#/2064-color-negro/2250-tipo-completo"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Azul Oscuro</td>
                            <td>11641</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/304-2255-impulsores-topclean-g4v-840076307258.html#/2250-tipo-completo/2252-color-azul_oscuro"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Azul Claro</td>
                            <td>11642</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/304-2256-impulsores-topclean-g4v-840076307258.html#/2066-color-azul_claro/2250-tipo-completo"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td rowspan="8">RECAMBIO</td>
                            <td rowspan="8">HORMIGON/LINER</td>
                            <td>Blanco</td>
                            <td rowspan="8">Impulsor TOPCLEAN G4V</td>
                            <td>10991</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/304-2257-impulsores-topclean-g4v-840076307258.html#/1700-color-blanco/2253-tipo-recambio"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Gris claro</td>
                            <td>17438</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/304-2258-impulsores-topclean-g4v-840076307258.html#/2062-color-gris_claro/2253-tipo-recambio"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Gris oscuro</td>
                            <td>12326</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/304-2259-impulsores-topclean-g4v-840076307258.html#/2065-color-gris_oscuro/2253-tipo-recambio"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Beige</td>
                            <td>17439</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/304-2260-impulsores-topclean-g4v-840076307258.html#/2063-color-beige/2253-tipo-recambio"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Marrón</td>
                            <td>17440</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/304-2261-impulsores-topclean-g4v-840076307258.html#/2251-color-marron/2253-tipo-recambio"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Negro</td>
                            <td>11863</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/304-2262-impulsores-topclean-g4v-840076307258.html#/2064-color-negro/2253-tipo-recambio"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Azul Oscuro</td>
                            <td>17441</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/304-2263-impulsores-topclean-g4v-840076307258.html#/2252-color-azul_oscuro/2253-tipo-recambio"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Azul Claro</td>
                            <td>13162</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/304-2264-impulsores-topclean-g4v-840076307258.html#/2066-color-azul_claro/2253-tipo-recambio"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>

                        <tr>
                            <td rowspan="16">G4</td>
                            <td rowspan="8">COMPLETO</td>
                            <td rowspan="8">HORMIGON</td>
                            <td>Blanco</td>
                            <td rowspan="8">Impulsor <br> TOPCLEAN G4</td>
                            <td rowspan="16">Fondo/Escalera</td>
                            <td>4321</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/305-2265-impulsores-topclean-g4-840076303755.html#/1700-color-blanco/2250-tipo-completo"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Gris claro</td>
                            <td>23493</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/305-2266-impulsores-topclean-g4-840076303755.html#/2062-color-gris_claro/2250-tipo-completo"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Gris oscuro</td>
                            <td>6664</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/305-2267-impulsores-topclean-g4-840076303755.html#/2065-color-gris_oscuro/2250-tipo-completo"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Beige</td>
                            <td>6666</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/305-2268-impulsores-topclean-g4-840076303755.html#/2063-color-beige/2250-tipo-completo"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Marrón</td>
                            <td>6667</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/305-2269-impulsores-topclean-g4-840076303755.html#/2250-tipo-completo/2251-color-marron"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Negro</td>
                            <td>6665</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/305-2270-impulsores-topclean-g4-840076303755.html#/2064-color-negro/2250-tipo-completo"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Azul Oscuro</td>
                            <td>10281</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/305-2271-impulsores-topclean-g4-840076303755.html#/2250-tipo-completo/2252-color-azul_oscuro"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Azul Claro</td>
                            <td>10661</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/305-2272-impulsores-topclean-g4-840076303755.html#/2066-color-azul_claro/2250-tipo-completo"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td rowspan="8">RECAMBIO</td>
                            <td rowspan="8">HORMIGON/LINER</td>
                            <td>Blanco</td>
                            <td rowspan="8">Impulsor TOPCLEAN G4V</td>
                            <td>6762</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/305-2273-impulsores-topclean-g4-840076303755.html#/1700-color-blanco/2253-tipo-recambio"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Gris claro</td>
                            <td>23495</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/305-2274-impulsores-topclean-g4-840076303755.html#/2062-color-gris_claro/2253-tipo-recambio"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Gris oscuro</td>
                            <td>22954</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/305-2275-impulsores-topclean-g4-840076303755.html#/2065-color-gris_oscuro/2253-tipo-recambio"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Beige</td>
                            <td>7153</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/305-2276-impulsores-topclean-g4-840076303755.html#/2063-color-beige/2253-tipo-recambio"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Marrón</td>
                            <td>7224</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/305-2277-impulsores-topclean-g4-840076303755.html#/2251-color-marron/2253-tipo-recambio"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Negro</td>
                            <td>22953</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/305-2278-impulsores-topclean-g4-840076303755.html#/2064-color-negro/2253-tipo-recambio"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Azul Oscuro</td>
                            <td>12463</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/305-2279-impulsores-topclean-g4-840076303755.html#/2252-color-azul_oscuro/2253-tipo-recambio"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Azul Claro</td>
                            <td>12464</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/305-2280-impulsores-topclean-g4-840076303755.html#/2066-color-azul_claro/2253-tipo-recambio"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>G2V</td>
                            <td>RECAMBIO</td=>
                            <td>HORMIGON/LINER</td=>
                            <td>Blanco</td>
                            <td>Impulsor G2V venturi</td>
                            <td>Fondo</td>
                            <td>11276</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/344-2472-recambio-impulsores-818965011654.html#/2393-modelo-g2v/2394-tipo-fondo"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>G2</td>
                            <td>RECAMBIO</td=>
                            <td>HORMIGON/LINER</td=>
                            <td>Blanco</td>
                            <td>Impulsor G2 boquilla intercambiable</td>
                            <td>Fondo/Escalera</td>
                            <td>26849</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/344-2473-recambio-impulsores-818965011654.html#/2254-modelo-g2/2394-tipo-fondo"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td rowspan="2">G1</td>
                            <td rowspan="2">RECAMBIO</td=>
                            <td rowspan="2">HORMIGON/LINER/POLIESTER</td=>
                            <td rowspan="2">Blanco</td>
                            <td rowspan="2">Impulsor G1</td>
                            <td>Fondo</td>
                            <td>4269</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/344-2474-recambio-impulsores-818965011654.html#/2255-modelo-g1/2394-tipo-fondo"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Escalera</td>
                            <td>4272</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/344-2475-recambio-impulsores-818965011654.html#/2255-modelo-g1/2395-tipo-escalera"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td rowspan="5">RECAMBIO <br> OTRAS MARCAS</td>
                            <td rowspan="3">PARAMOUNT <br> POOL-VALET</td=>
                            <td rowspan="3">HORMIGON</td=>
                            <td rowspan="3">Blanco</td>
                            <td rowspan="2">Impulsor Pool-Valet rosca</td>
                            <td>Fondo</td>
                            <td>4271</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/344-2476-recambio-impulsores-818965011654.html#/2394-tipo-fondo/2396-modelo-pool_valet"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Escalera</td>
                            <td>4274</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/344-2477-recambio-impulsores-818965011654.html#/2395-tipo-escalera/2396-modelo-pool_valet"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Impulsor Pool-Valet PVR</td>
                            <td>Fondo</td>
                            <td>11617</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/344-2478-recambio-impulsores-818965011654.html#/2394-tipo-fondo/2397-modelo-pool_valet_pvr"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td rowspan="2">CARETAKER</td>
                            <td rowspan="2">HORMIGON</td>
                            <td rowspan="2">Blanco</td>
                            <td>Impulsor para Caretaker</td>
                            <td rowspan="2">Fondo</td>
                            <td>11616</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/344-2479-recambio-impulsores-818965011654.html#/2394-tipo-fondo/2398-modelo-caretaker"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                        <tr>
                            <td>Impulsor para Caretaker Venturi</td>
                            <td>11615</td>
                            <td class="border"><a type="button" target="_blank"
                                    href="https://www.ps-pool.com/tienda/limpiafondos-integrado/344-2480-recambio-impulsores-818965011654.html#/2394-tipo-fondo/2399-modelo-caretaker_venturi"
                                    class="tablacomprar disabled:opacity-25">Comprar</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="{{ route('guias.index', ['user' => $userEncoded]) }}" class="btn-volver">Volver</a>
        </div>
    </div>
</main>
@endsection
