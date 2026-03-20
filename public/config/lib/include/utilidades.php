<?php

//Articulos fijos
function insertarArticulosFijos($conn, $datos, $nuevoCodigo, &$linea, &$transacciones)
{
    if ($datos->subtipo == 'TERRA' | $datos->subtipo == 'TERRA_SLIM' | $datos->subtipo == 'TERRA_LITE' | $datos->subtipo == 'TERRA_SOLAR') {
        $sql = "SELECT CODIGO, PRECIO
        FROM ARTICULOS
        WHERE TIPO_ARTICULO_FIJO = '$datos->subtipo'
        AND FIJO = 'S'
        ORDER BY CODIGO DESC";
    } else {
        $sql = "SELECT CODIGO, PRECIO
            FROM ARTICULOS
            WHERE TIPO_ARTICULO_FIJO LIKE '%$datos->subtipo%'
            AND FIJO = 'S'
            ORDER BY CODIGO DESC";
    }

    $mres = mysqli_query($conn, $sql);

    while ($mrow2 = mysqli_fetch_object($mres)) {
        $precioArticuloFijo = obtenerPVPArticulo($mrow2->CODIGO, $datos->cliente, $mrow2->PRECIO, 1, $conn);
        $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO)
                VALUES($nuevoCodigo, $linea, '" . $mrow2->CODIGO . "', 1, " . $precioArticuloFijo['PVP'] . ", " . $precioArticuloFijo['PVP_FINAL'] . ",
                     " . $precioArticuloFijo['DTO'] . ", " . $precioArticuloFijo['PVP_FINAL'] . ", 'Articulo fijo " . $mrow2->CODIGO . "')";

        if (mysqli_query($conn, $sql)) {
            $linea++;
            array_push($transacciones, $sql);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
//Enrollador
function insertarEnrollador($conn, $nuevoCodigo, &$linea, &$transacciones, $codigo, $precio, $comentario)
{
    $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO)
            VALUES($nuevoCodigo, $linea, '$codigo', 1, {$precio['PVP']}, {$precio['PVP_FINAL']}, {$precio['DTO']}, {$precio['PVP_FINAL']}, '$comentario')";

    if (mysqli_query($conn, $sql)) {
        $linea++;
        array_push($transacciones, $sql);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
//Insertar contrapesa
function insertarContrapesa($conn, $datos, $nuevoCodigo, &$linea, &$transacciones, $subtipo, $anchoTotal)
{
    $sql = "SELECT CODIGO, PRECIO
            FROM ARTICULOS
            WHERE SUBTIPO_MOTOR LIKE '%$subtipo%'
            AND TIPO_ARTICULO_FIJO LIKE '%CONTRAPESA%'
            AND FIJO = 'S'
            AND ANCHURA >= '$anchoTotal'
            ORDER BY ANCHURA ASC
            LIMIT 1";

    $mres = mysqli_query($conn, $sql);

    while ($mrow2 = mysqli_fetch_object($mres)) {
        $precioArticuloFijo = obtenerPVPArticulo($mrow2->CODIGO, $datos->cliente, $mrow2->PRECIO, 1, $conn);
        $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO)
                VALUES($nuevoCodigo, $linea, '" . $mrow2->CODIGO . "', 1, " . $precioArticuloFijo['PVP'] . ", " . $precioArticuloFijo['PVP_FINAL'] . ",
                     " . $precioArticuloFijo['DTO'] . ", " . $precioArticuloFijo['PVP_FINAL'] . ", 'Articulo fijo " . $mrow2->CODIGO . "')";

        if (mysqli_query($conn, $sql)) {
            $linea++;
            array_push($transacciones, $sql);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
//Insertar tornillos para las contrapesas CAVE
function insertarTornillosContrapesa($conn, $datos, $nuevoCodigo, &$linea, &$transacciones, $subtipo, $tipoArticulo, $anchoTotal, $cantidad, $comentario)
{
    $sql = "SELECT CODIGO, PRECIO
            FROM ARTICULOS
            WHERE SUBTIPO_MOTOR LIKE '%$subtipo%'
            AND TIPO_ARTICULO_FIJO LIKE '%$tipoArticulo%'
            AND FIJO = 'S'
            ORDER BY ANCHURA ASC
            LIMIT 1";

    $mres = mysqli_query($conn, $sql);

    while ($mrow2 = mysqli_fetch_object($mres)) {
        $precioArticuloFijo = obtenerPVPArticulo($mrow2->CODIGO, $datos->cliente, $mrow2->PRECIO, 1, $conn);
        $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO)
                VALUES($nuevoCodigo, $linea, '" . $mrow2->CODIGO . "', $cantidad, " . $precioArticuloFijo['PVP'] . ", " . $precioArticuloFijo['PVP_FINAL'] . ",
                     " . $precioArticuloFijo['DTO'] . ", " . $precioArticuloFijo['PVP_FINAL'] . ", '$comentario " . $mrow2->CODIGO . "')";
        if (mysqli_query($conn, $sql)) {
            $linea++;
            array_push($transacciones, $sql);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
// Instertar viga
function insertarVigas($conn, $subtipo, $cPresupuesto, &$linea, $anchoPiscina, $cliente, $largoTotal, &$transacciones)
{
    $tipoTapa = null;

    if ($subtipo == "TOP" | $subtipo == "DUO" | $subtipo == "CAVE") {
        $tipoTapa = "revestir";
    } else if ($anchoPiscina >= 500 && $anchoPiscina <= 600) {
        $tipoTapa = "revestir";
    } else {
        $tipoTapa = "ipe";
    }

    $sql = "SELECT CODIGO, PRECIO
            FROM ARTICULOS
            WHERE ANCHURA >= $anchoPiscina
            AND LONGITUD >= $largoTotal
            AND TIPO_ARTICULO_FIJO LIKE '%$tipoTapa%'
            AND ((SUBTIPO_MOTOR IS NULL) OR (SUBTIPO_MOTOR LIKE '') OR (UPPER(SUBTIPO_MOTOR) LIKE '%$subtipo%'))
            ORDER BY ANCHURA ASC LIMIT 1 ";

    $mres  = mysqli_query($conn, $sql);
    $mrow2 = mysqli_fetch_object($mres);

    $precioViga = obtenerPVPArticulo($mrow2->CODIGO, $cliente, $mrow2->PRECIO, 1, $conn);

    $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO)
            VALUES ($cPresupuesto, $linea, '" . $mrow2->CODIGO . "', 1, " . $precioViga['PVP'] . ", " . $precioViga['PVP_FINAL'] . ",
                    " . $precioViga['DTO'] . ", " . $precioViga['PVP_FINAL'] . ", 'Viga')";


    if (mysqli_query($conn, $sql)) {
        $linea++;
        array_push($transacciones, $sql);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Insertar extra de lacado para las vigas
function insertarExtraLacadoViga($conn, $datos, $nuevoCodigo, &$linea, &$transacciones, $subtipo, $tipoArticulo)
{
    $sql = "SELECT CODIGO, PRECIO
            FROM ARTICULOS
            WHERE SUBTIPO_MOTOR LIKE '%$subtipo%'
            AND TIPO_ARTICULO_FIJO LIKE '%$tipoArticulo%'
            AND FIJO = 'S'";

    $mres = mysqli_query($conn, $sql);

    while ($mrow2 = mysqli_fetch_object($mres)) {
        $precioArticuloFijo = obtenerPVPArticulo($mrow2->CODIGO, $datos->cliente, $mrow2->PRECIO, 1, $conn);
        $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO)
                VALUES($nuevoCodigo, $linea, '" . $mrow2->CODIGO . "', 1, " . $precioArticuloFijo['PVP'] . ", " . $precioArticuloFijo['PVP_FINAL'] . ",
                     " . $precioArticuloFijo['DTO'] . ", " . $precioArticuloFijo['PVP_FINAL'] . ", 'Articulo fijo " . $mrow2->CODIGO . "')";
        if (mysqli_query($conn, $sql)) {
            $linea++;
            array_push($transacciones, $sql);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
// Insertar soporte intermedio
function insertarSoporteIntermedio($conn, $datos, $nuevoCodigo, &$linea, &$transacciones, $anchoTotal, $largoTotal)
{
    $cantidad = 0;
    if ($datos->anchoPiscina >= 450 && $datos->anchoPiscina < 550) {
        $cantidad = 1;
    } elseif ($datos->anchoPiscina >= 550 && $datos->anchoPiscina <= 600) {
        $cantidad = 2;
    }

    $sql = "SELECT CODIGO, PRECIO
            FROM ARTICULOS
            WHERE ANCHURA >= $datos->anchoPiscina
            AND LONGITUD >= $largoTotal
            AND TIPO_ARTICULO_FIJO LIKE '%SOPORTE INTERMEDIO%'
            AND ((SUBTIPO_MOTOR IS NULL) OR (SUBTIPO_MOTOR LIKE '') OR (UPPER(SUBTIPO_MOTOR) LIKE '%$datos->subtipo%'))
            ORDER BY ANCHURA ASC LIMIT 1";

    $mres = mysqli_query($conn, $sql);

    while ($mrow2 = mysqli_fetch_object($mres)) {
        $precioArticuloFijo = obtenerPVPArticulo($mrow2->CODIGO, $datos->cliente, $mrow2->PRECIO, 1, $conn);
        $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO)
                VALUES($nuevoCodigo, $linea, '" . $mrow2->CODIGO . "', $cantidad, " . $precioArticuloFijo['PVP'] . ", " . $precioArticuloFijo['PVP_FINAL'] . ",
                     " . $precioArticuloFijo['DTO'] . ", " . $precioArticuloFijo['PVP_FINAL'] . ", 'Articulo fijo " . $mrow2->CODIGO . "')";
        if (mysqli_query($conn, $sql)) {
            $linea++;
            array_push($transacciones, $sql);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
// Insertar Viga refuerzo Deck
function insertarVigaRefuerzoDeck($conn, $nuevoCodigo, &$linea, &$transacciones, $codigo, $cantidad, $precio, $comentario)
{
    $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO)
            VALUES($nuevoCodigo, $linea, '$codigo', $cantidad, {$precio['PVP']}, {$precio['PVP_FINAL']}, {$precio['DTO']}, {$precio['PVP_FINAL']}, '$comentario')";

    if (mysqli_query($conn, $sql)) {
        $linea++;
        array_push($transacciones, $sql);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
// Insertar anclajes Viga refuerzo Deck
function insertarAnclajesVigaRefuerzoDeck($conn, $datos, $nuevoCodigo, &$linea, &$transacciones, $anchoTotal, $largoTotal, $tipoArticulo, $cantidad, $comentario)
{
    $sql = "SELECT CODIGO, PRECIO
            FROM ARTICULOS
            WHERE ANCHURA >= $anchoTotal
            AND LONGITUD >= $largoTotal
            AND TIPO_ARTICULO_FIJO LIKE '%$tipoArticulo%'
            AND ((SUBTIPO_MOTOR IS NULL) OR (SUBTIPO_MOTOR LIKE '') OR (UPPER(SUBTIPO_MOTOR) LIKE '%$datos->subtipo%'))
            ORDER BY ANCHURA ASC LIMIT 1";

    $mres = mysqli_query($conn, $sql);

    while ($mrow2 = mysqli_fetch_object($mres)) {
        $precioArticuloFijo = obtenerPVPArticulo($mrow2->CODIGO, $datos->cliente, $mrow2->PRECIO, 1, $conn);
        insertarVigaRefuerzoDeck($conn, $nuevoCodigo, $linea, $transacciones, $mrow2->CODIGO, $cantidad, $precioArticuloFijo, $comentario . " " . $mrow2->CODIGO);
    }
}
// Insertamos el extra de ANGULO TAPAS de la viga DECK
function insertarExtraAnguloTapas($conn, $datos, $nuevoCodigo, &$linea, &$transacciones, $tipoArticulo, $cantidad, $comentario)
{
    $sql = "SELECT CODIGO, PRECIO
            FROM ARTICULOS
            WHERE SUBTIPO_MOTOR LIKE '%$datos->subtipo%'
            AND TIPO_ARTICULO_FIJO LIKE '%$tipoArticulo%'
            AND FIJO = 'S'";

    $mres = mysqli_query($conn, $sql);

    while ($mrow2 = mysqli_fetch_object($mres)) {
        $precioArticuloFijo = obtenerPVPArticulo($mrow2->CODIGO, $datos->cliente, $mrow2->PRECIO, 1, $conn);
        $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO)
                VALUES($nuevoCodigo, $linea, '" . $mrow2->CODIGO . "', $cantidad, " . $precioArticuloFijo['PVP'] . ", " . $precioArticuloFijo['PVP_FINAL'] . ",
                     " . $precioArticuloFijo['DTO'] . ", " . $precioArticuloFijo['PVP_FINAL'] . ", '$comentario " . $mrow2->CODIGO . "')";
        if (mysqli_query($conn, $sql)) {
            $linea++;
            array_push($transacciones, $sql);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
// Insertar rejilla deck
function insertarRejillaDeck($conn, $datos, $nuevoCodigo, &$linea, &$transacciones, &$precio, &$precioSinDescuento, $anchoTotal, $largoTotal)
{
    if ($datos->conTapa) {
        if (!$datos->conViga) {
            return devolverError("Tiene que seleccionar la viga para poner rejilla");
        }

        // AHORA MIRAMOS LA REJILLA QUE HAY QUE PONERLE SI ES EL CASO
        $resRejilla = insertarRejilla($conn, $datos, $nuevoCodigo, $linea, $anchoTotal, $datos->cliente, $datos->tipoTapa, $largoTotal);

        if (!empty($resRejilla)) {
            if (mysqli_query($conn, $resRejilla['SQL'])) {
                $linea++;
                array_push($transacciones, $resRejilla['SQL']);
            } else {
                echo "Error: " . mysqli_error($conn);
            }

            $precio += (float) $resRejilla['PRECIO'];
            $precioSinDescuento += (float) $resRejilla['PRECIO_SIN_DESCUENTO'];
        }
    }
}
function insertarRejilla($conn, $datos, $cPresupuesto, $linea, $ancho, $cliente)
{

    $result = array();

    //PRIMERO COGEMOS LA REJILLA Y SUS MEDIDAS PARA SABER CUANTAS UNIDADES HAY QUE PONER
    $sql = "SELECT CODIGO, ANCHURA, PRECIO
              FROM ARTICULOS
             WHERE TIPO_ARTICULO_FIJO LIKE '%TAPA%$datos->tipoTapa%'
             AND ((SUBTIPO_MOTOR LIKE '') OR (UPPER(SUBTIPO_MOTOR) LIKE '%$datos->subtipo%'))
             ORDER BY PRECIO ASC LIMIT 1";

    $res   = mysqli_query($conn, $sql) or die("SQL ERROR (721) $sql " . mysqli_error($conn));
    $mrow2 = mysqli_fetch_object($res);

    $anchoArticulo = (float) $mrow2->ANCHURA;

    $cantidad = ceil($ancho / $anchoArticulo);

    $precioRejilla = obtenerPVPArticulo($mrow2->CODIGO, $cliente, $mrow2->PRECIO, $cantidad, $conn);

    $importeRejilla             = (float) $precioRejilla['PVP_FINAL'] * $cantidad;
    $importeRejillaSinDescuento = (float) $precioRejilla['PVP']       * $cantidad;

    if ($datos->subtipo == "DUO") {
        $cantidad = $cantidad * 2;
        $importeRejilla = (float) $precioRejilla['PVP_FINAL'] * $cantidad;
        $importeRejillaSinDescuento = (float) $precioRejilla['PVP'] * $cantidad;
    }

    $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO)
            VALUES ($cPresupuesto, $linea, '" . $mrow2->CODIGO . "', $cantidad, " . $precioRejilla['PVP'] . ",
                  " . $precioRejilla['PVP_FINAL'] . ", " . $precioRejilla['DTO'] . ", " . $importeRejilla . ", 'Tapa')";

    if (!empty($sql)) {
        $result = array(
            'SQL' => $sql,
            'PRECIO' => $importeRejilla,
            'PRECIO_SIN_DESCUENTO' => $importeRejillaSinDescuento
        );
    }

    return $result;
}
// Insertar laminas
function insertarLaminas($conn, $datos, $nuevoCodigo, &$linea, &$transacciones, &$precio, &$precioSinDescuento)
{
    $sql = "SELECT CODIGO, PRECIO, LONGITUD FROM ARTICULOS
            WHERE UPPER(COLOR) = UPPER('{$datos->colorLamina}')
            AND UPPER(MATERIAL) = UPPER('{$datos->tipoLamina}')
            AND ((TIPO_ARTICULO_FIJO LIKE '') OR (TIPO_ARTICULO_FIJO IS NULL))
            AND ANCHURA >= '{$datos->anchoPiscina}'
            ORDER BY ANCHURA ASC
            LIMIT 1";

    $mres = mysqli_query($conn, $sql);
    $mrow2 = mysqli_fetch_object($mres);

    if (empty($mrow2->LONGITUD)) {
        return devolverError("No hay láminas con esas características $sql");
    }

    //Sumamos 100 cm al largo y redondeamo el entero superior.
    if ($datos->subtipo != 'TERRA') {
        $nLaminas = ceil(($datos->largoPiscina + 100) / 7.5);
    } else {
        $nLaminas = ceil(($datos->largoPiscina) / 7.5);
    }

    $nLaminas = ($nLaminas * 7.5) / 100;

    $precioLaminas = obtenerPVPArticulo($mrow2->CODIGO, $datos->cliente, $mrow2->PRECIO, $nLaminas, $conn);
    $importeLaminas = ((float) $precioLaminas['PVP_FINAL'] * $nLaminas);
    $precio += $importeLaminas;
    $precioSinDescuento += ((float) $precioLaminas['PVP'] * $nLaminas);

    $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO)
            VALUES($nuevoCodigo, $linea, '{$mrow2->CODIGO}', $nLaminas, {$precioLaminas['PVP']}, {$precioLaminas['PVP_FINAL']},
                 {$precioLaminas['DTO']}, $importeLaminas, 'Laminas {$mrow2->CODIGO}')";

    if (mysqli_query($conn, $sql)) {
        $linea++;
        array_push($transacciones, $sql);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
// Insertar escalera
function insertarEscalera($conn, $datos, $nuevoCodigo, &$linea, &$transacciones, &$precio, &$precioSinDescuento)
{
    if ($datos->tipoEscalera != "D") {
        if (!empty($datos->anchoEscalera) && $datos->anchoEscalera != "0" && !empty($datos->largoEscalera) && $datos->largoEscalera != "0") {
            if ($datos->esRomana) {
                $sql = "SELECT CODIGO, PRECIO, LONGITUD FROM ARTICULOS
                        WHERE UPPER(COLOR) = UPPER('{$datos->colorLamina}')
                        AND UPPER(MATERIAL) = UPPER('{$datos->tipoLamina}')
                        AND TIPO_ARTICULO_FIJO LIKE '%ROMANA%'
                        AND ANCHURA >= '{$datos->anchoEscalera}'
                        ORDER BY ANCHURA ASC
                        LIMIT 1";

                $mres = mysqli_query($conn, $sql);
                $mrow2 = mysqli_fetch_object($mres);

                $precioEscaleraRomana = obtenerPVPArticulo($mrow2->CODIGO, $datos->cliente, $mrow2->PRECIO, 1, $conn);

                $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO)
                        VALUES($nuevoCodigo, $linea, '{$mrow2->CODIGO}', 1, {$precioEscaleraRomana['PVP']}, {$precioEscaleraRomana['PVP_FINAL']},
                             {$precioEscaleraRomana['DTO']}, {$precioEscaleraRomana['PVP_FINAL']}, 'Laminas Escalera {$mrow2->CODIGO}')";

                $precio += (float) $precioEscaleraRomana['PVP_FINAL'];
                $precioSinDescuento += (float) $precioEscaleraRomana['PVP'];
            } else {
                $sql = "SELECT CODIGO, PRECIO, LONGITUD FROM ARTICULOS
                        WHERE UPPER(COLOR) = UPPER('{$datos->colorLamina}')
                        AND UPPER(MATERIAL) = UPPER('{$datos->tipoLamina}')
                        AND ((TIPO_ARTICULO_FIJO LIKE '') OR (TIPO_ARTICULO_FIJO IS NULL))
                        AND ANCHURA >= '{$datos->anchoEscalera}'
                        ORDER BY ANCHURA ASC
                        LIMIT 1";

                $mres = mysqli_query($conn, $sql);
                $mrow2 = mysqli_fetch_object($mres);

                $nLaminasEscalera = intval($datos->largoEscalera / 7.5);
                if (round($datos->largoEscalera / 7.5, 0) != round($datos->largoEscalera / 7.5, 3)) {
                    $nLaminasEscalera += 1;
                }
                $nLaminasEscalera = ($nLaminasEscalera * 7.5) / 100;

                $precioLaminasEscalera = obtenerPVPArticulo($mrow2->CODIGO, $datos->cliente, $mrow2->PRECIO, $nLaminasEscalera, $conn);
                $importeLaminasEscalera = (float) $precioLaminasEscalera['PVP_FINAL'] * $nLaminasEscalera;

                $precio += $importeLaminasEscalera;
                $precioSinDescuento += (float) $precioLaminasEscalera['PVP'] * $nLaminasEscalera;

                $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO)
                        VALUES($nuevoCodigo, $linea, '{$mrow2->CODIGO}', $nLaminasEscalera, {$precioLaminasEscalera['PVP']},
                             {$precioLaminasEscalera['PVP_FINAL']}, {$precioLaminasEscalera['DTO']}, $importeLaminasEscalera,
                             'Laminas Escalera {$mrow2->CODIGO}')";
            }

            if (mysqli_query($conn, $sql)) {
                $linea++;
                array_push($transacciones, $sql);
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
}
// Insertar patines para la cave
function insertarPatines($conn, $modelo, $subtipo, $nuevoCodigo, &$linea, $anchoTotal, $cliente, &$transacciones)
{

    $sql = "SELECT CODIGO, PRECIO
              FROM ARTICULOS
             WHERE TIPO_ARTICULO_FIJO LIKE '%PATIN%'
               AND ((TIPO_MOTOR = '$modelo') OR (TIPO_MOTOR IS NULL) OR (TIPO_MOTOR LIKE ''))
               AND ((SUBTIPO_MOTOR IS NULL) OR (SUBTIPO_MOTOR LIKE '') OR (UPPER(SUBTIPO_MOTOR) LIKE '%$subtipo%'))";

    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_object($res);

    $sql = "";
    $importe = 0;

    if (!empty($row)) {

        $cantidad = ceil($anchoTotal / 100) + 1; //Anchot total redondeado hacia arriba + 1
        $codigo = $row->CODIGO;
        $pvp = obtenerPVPArticulo($codigo, $cliente, $row->PRECIO, $cantidad, $conn);

        $importe             = (float) $pvp['PVP_FINAL'] * $cantidad;
        $importeSinDescuento = (float) $pvp['PVP']       * $cantidad;

        $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO)
                VALUES($nuevoCodigo, $linea, '$codigo', $cantidad, " . $pvp['PVP'] . ", " . $pvp['PVP_FINAL'] . ", " . $pvp['DTO'] . "," . $importe . ", 'Patines')";

        if (mysqli_query($conn, $sql)) {
            $linea++;
            array_push($transacciones, $sql);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
// Insertar tubo salida para la vave
function insertarTuboSalida($conn, $modelo, $subtipo, $nuevoCodigo, &$linea, $anchoTotal, $cliente, &$transacciones)
{

    $sql = "SELECT CODIGO, PRECIO
              FROM ARTICULOS
             WHERE TIPO_ARTICULO_FIJO LIKE '%TUBO%'
               AND ((TIPO_MOTOR = '$modelo') OR (TIPO_MOTOR IS NULL) OR (TIPO_MOTOR LIKE ''))
               AND ((SUBTIPO_MOTOR IS NULL) OR (SUBTIPO_MOTOR LIKE '') OR (UPPER(SUBTIPO_MOTOR) LIKE '%$subtipo%'))";
    /* WHERE CODIGO = '17601'"; */

    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_object($res);

    $sql = "";
    $importe = 0;

    if (!empty($row)) {

        $cantidad = (ceil($anchoTotal / 100) * 2) - 1; //Ancho total redondeado hacia arriba por 2 y le restamos 1
        $codigo = $row->CODIGO;
        $pvp = obtenerPVPArticulo($codigo, $cliente, $row->PRECIO, $cantidad, $conn);

        $importe             = (float) $pvp['PVP_FINAL'] * $cantidad;
        $importeSinDescuento = (float) $pvp['PVP']       * $cantidad;

        $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO)
                VALUES($nuevoCodigo, $linea, '$codigo', $cantidad, " . $pvp['PVP'] . ", " . $pvp['PVP_FINAL'] . ", " . $pvp['DTO'] . "," . $importe . ", 'Patines')";

        if (mysqli_query($conn, $sql)) {
            $linea++;
            array_push($transacciones, $sql);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
// Insertar anclajes de seguridad
function insertarAnclajesSeguridad($conn, $datos, $nuevoCodigo, &$linea, &$transacciones, &$precio, &$precioSinDescuento)
{
    $materialAnclaje = 'PVC';

    if (in_array($datos->colorLamina, ["SOLAR CLEAR", "SOLAR BRONZE", "SOLAR SILVER", "SOLAR BLUE", "DARK GRAY"])) {
        $materialAnclaje = 'POLICARBONATO';
    }

    $sql = "SELECT CODIGO, PRECIO
            FROM ARTICULOS
            WHERE UPPER(TIPO_ARTICULO_FIJO) LIKE '%ANCLAJE%'
            AND FIJO = 'S'
            AND UPPER(MATERIAL) LIKE '%$materialAnclaje%'";

    $mres = mysqli_query($conn, $sql);
    $mrow2 = mysqli_fetch_object($mres);

    if (!empty($mrow2->CODIGO)) {
        $anchoP = $datos->anchoPiscina / 100;
        $cantidad = ceil($anchoP);
        if ($datos->subtipo == 'TERRA') {
            $cantidad = $cantidad * 2;
        }

        if ($cantidad < 2) {
            if ($datos->subtipo == 'TERRA') {
                $cantidad = $cantidad * 2;
            } else {

                $cantidad = 2;
            }
        }

        $precioAnclajes = obtenerPVPArticulo($mrow2->CODIGO, $datos->cliente, $mrow2->PRECIO, $cantidad, $conn);
        $importeAnclajes = $cantidad * $precioAnclajes['PVP_FINAL'];
        $precio += (float) $importeAnclajes;
        $precioSinDescuento += (float) $cantidad * $precioAnclajes['PVP'];

        $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO)
                VALUES($nuevoCodigo, $linea, '{$mrow2->CODIGO}', $cantidad, {$precioAnclajes['PVP']}, {$precioAnclajes['PVP_FINAL']},
                     {$precioAnclajes['DTO']}, $importeAnclajes, 'Anclajes de seguridad {$mrow2->CODIGO}')";

        if (mysqli_query($conn, $sql)) {
            $linea++;
            array_push($transacciones, $sql);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
// Añadir cintas de las láminas
function insertarCintasLaminas($conn, $datos, $nuevoCodigo, &$linea, &$transacciones, &$precio, &$precioSinDescuento)
{
    $materialCinta = 'PVC';

    if (in_array($datos->colorLamina, ["SOLAR CLEAR", "SOLAR BRONZE", "SOLAR SILVER", "SOLAR BLUE", "DARK GRAY"])) {
        $materialCinta = 'POLICARBONATO';
    }

    $sql = "SELECT CODIGO, PRECIO
            FROM ARTICULOS
            WHERE UPPER(TIPO_ARTICULO_FIJO) LIKE '%CINTAS%'
            AND FIJO = 'S'
            AND UPPER(SUBTIPO_MOTOR) LIKE '%$datos->subtipo%'
            AND UPPER(MATERIAL) LIKE '%$materialCinta%'";

    $mres = mysqli_query($conn, $sql);
    $mrow2 = mysqli_fetch_object($mres);

    $anchoP = $datos->anchoPiscina / 100;
    $cantidad = ceil($anchoP);
    if ($cantidad < 2) {
        $cantidad = 2;
    }

    if (!empty($mrow2->CODIGO)) {
        $precioCintas = obtenerPVPArticulo($mrow2->CODIGO, $datos->cliente, $mrow2->PRECIO, 1, $conn);
        $importeCintas = $cantidad * $precioCintas['PVP_FINAL'];
        $precio += (float) $importeCintas;
        $precioSinDescuento += (float) $precioCintas['PVP'] * $cantidad;

        $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO)
                VALUES($nuevoCodigo, $linea, '{$mrow2->CODIGO}', $cantidad, {$precioCintas['PVP']}, {$precioCintas['PVP_FINAL']},
                     {$precioCintas['DTO']}, $importeCintas, 'Embalaje {$mrow2->CODIGO}')";

        if (mysqli_query($conn, $sql)) {
            $linea++;
            array_push($transacciones, $sql);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
// Añadir embalaje
function insertarEmbalaje($conn, $datos, $nuevoCodigo, &$linea, &$transacciones, &$precio, &$precioSinDescuento, $anchoTotal)
{
    $sql = "SELECT CODIGO, PRECIO
            FROM ARTICULOS
            WHERE UPPER(TIPO_ARTICULO_FIJO) LIKE '%EMBALAJE%'
            AND LONGITUD >= $anchoTotal
            ORDER BY LONGITUD ASC LIMIT 1";

    $mres = mysqli_query($conn, $sql);
    $mrow2 = mysqli_fetch_object($mres);

    if (!empty($mrow2->CODIGO)) {
        $precioEmbalaje = obtenerPVPArticulo($mrow2->CODIGO, $datos->cliente, $mrow2->PRECIO, 1, $conn);
        $precio += (float) $precioEmbalaje['PVP_FINAL'];
        $precioSinDescuento += (float) $precioEmbalaje['PVP'];

        $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO)
                VALUES($nuevoCodigo, $linea, '{$mrow2->CODIGO}', 1, {$precioEmbalaje['PVP']}, {$precioEmbalaje['PVP_FINAL']},
                     {$precioEmbalaje['DTO']}, {$precioEmbalaje['PVP_FINAL']}, 'Embalaje {$mrow2->CODIGO}')";

        if (mysqli_query($conn, $sql)) {
            $linea++;
            array_push($transacciones, $sql);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
// Añadir Portes
function insertarPortes($conn, $datos, $nuevoCodigo, &$linea, &$transacciones, &$precio, &$precioSinDescuento)
{
    $sql = "SELECT CODIGO, PRECIO
            FROM ARTICULOS
            WHERE UPPER(TIPO_ARTICULO_FIJO) LIKE '%PORTES%'
            LIMIT 1";

    $mres = mysqli_query($conn, $sql);
    $mrow2 = mysqli_fetch_object($mres);

    if (!empty($mrow2->CODIGO)) {
        $precioEmbalaje = obtenerPVPArticulo($mrow2->CODIGO, $datos->cliente, $mrow2->PRECIO, 1, $conn);
        $precio += (float) $precioEmbalaje['PVP_FINAL'];
        $precioSinDescuento += (float) $precioEmbalaje['PVP'];

        $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO)
                VALUES($nuevoCodigo, $linea, '{$mrow2->CODIGO}', 1, {$precioEmbalaje['PVP']}, {$precioEmbalaje['PVP_FINAL']},
                     {$precioEmbalaje['DTO']}, {$precioEmbalaje['PVP_FINAL']}, 'Embalaje {$mrow2->CODIGO}')";

        if (mysqli_query($conn, $sql)) {
            $linea++;
            array_push($transacciones, $sql);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
// Añadir instalacion
function insertarInstalacion($conn, $datos, $nuevoCodigo, &$linea, &$transacciones, &$precio, &$precioSinDescuento)
{
    if ($datos->tipoInstalacion == "E") {
        $sql = "SELECT PRECIO, CODIGO FROM ARTICULOS WHERE CODIGO = '{$datos->getInstalacion()}'";

        $mres = mysqli_query($conn, $sql);
        $mrow2 = mysqli_fetch_object($mres);
        $precioInstalacion = obtenerPVPArticulo($mrow2->CODIGO, $datos->cliente, $mrow2->PRECIO, 1, $conn);
        $precio += (float) $precioInstalacion['PVP_FINAL'];
        $precioSinDescuento += (float) $precioInstalacion['PVP'];

        $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO, SUBCUENTA)
                VALUES($nuevoCodigo, $linea, '{$mrow2->CODIGO}', 1, {$precioInstalacion['PVP']}, {$precioInstalacion['PVP_FINAL']},
                     {$precioInstalacion['DTO']}, {$precioInstalacion['PVP_FINAL']}, 'Instalación Externa {$mrow2->CODIGO}', '2146')";

        if (mysqli_query($conn, $sql)) {
            $linea++;
            array_push($transacciones, $sql);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else if ($datos->tipoInstalacion == "N") {
        $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO, SUBCUENTA)
                VALUES($nuevoCodigo, $linea, '7460', 1, 0, 0, 0,0, 'No requiere instalación', '2146')";

        $precio += (float) $datos->importeInstalacion;
        $precioSinDescuento += (float) $datos->importeInstalacion;

        if (mysqli_query($conn, $sql)) {
            $linea++;
            array_push($transacciones, $sql);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        $sql = "INSERT INTO LINPRESU (PRESUPUESTO_WEB, LINEA, ARTICULO, CANTIDAD, PVP, PVP_FINAL, DTO, IMPORTE, COMENTARIO, SUBCUENTA)
                VALUES($nuevoCodigo, $linea, '21712', 1, {$datos->importeInstalacion}, {$datos->importeInstalacion}, 0,
                     {$datos->importeInstalacion}, 'Instalación Externa', '2146')";

        $precio += (float) $datos->importeInstalacion;
        $precioSinDescuento += (float) $datos->importeInstalacion;

        if (mysqli_query($conn, $sql)) {
            $linea++;
            array_push($transacciones, $sql);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
// Generar codigos web para las ofertas
function generarCodigoAleatorio($conn)
{

    $año = date("Y");

    do {
        $numeroAleatorio = mt_rand(100000, 999999);
        $nuevoCodigo = $año . $numeroAleatorio;

        // Verificar si el código ya existe en la base de datos
        $sql = "SELECT COUNT(*) AS count FROM PRESUPUESTOS WHERE CODIGO_WEB = '$nuevoCodigo'";
        $mres = mysqli_query($conn, $sql);
        $mrow = mysqli_fetch_object($mres);
    } while ($mrow->count > 0); // Repetir hasta encontrar un código único

    return $nuevoCodigo;
}
// Devuelve errores
function devolverError($msg)
{
    $result = array(
        "OK" => 0,
        "ERROR" => $msg
    );

    return json_encode($result);
}
// Obetener PVPArticulos
function obtenerPVPArticulo($articulo, $cliente, $precio, $cantidad, $conn)
{
    $result = array();
    $result['PVP'] = $precio;
    $result['PVP_FINAL'] = $precio;
    $result['DTO'] = 0;

    if (empty($articulo) || empty($cliente) || empty($precio)) {

        if (empty($precio)) {
            $result['PVP'] = 0;
            $result['PVP_FINAL'] = 0;
        }

        return $result;
    }

    $pvpTarifa = ver_pvp_tarifas($articulo, $cliente, '50', $cantidad, $precio, $conn);

    $tmpPrecio = round((float) $pvpTarifa["PVP"], 2);

    if ($tmpPrecio == -1 || $tmpPrecio == "-1") {
        $tmpPrecio = round((float) $pvpTarifa["PVPPROYECTO"], 2);
    }

    $result['PVP_FINAL'] = $tmpPrecio;

    if (!empty($pvpTarifa["DTO"])) {
        $result['DTO'] = $pvpTarifa["DTO"];
    }

    return $result;
}
// Calcular cubierta deck
function calcularTerra($conn, $anchoTotal, $largoTotal, $modelo, $tipoPiscina, $suptipo)
{
    $result = [
        "OK" => false,
        "ERROR" => ""
    ];

    $metros2 = ceil($largoTotal * $anchoTotal) / 1000;
    if ($suptipo == "TERRA_SOLAR") {
        if ($anchoTotal <= 500 | $metros2 < 320) {
            $datosTerra170Json = file_get_contents('datosTerraSolar140.json');
            $datosTerra = json_decode($datosTerra170Json, true);
        } else {
            $result["ERROR"] = "No se encontró un valor válido para las dimensiones dadas.";
            return $result;
        }
    } else {
        //Dependiendo del ancho o largo cogeremos el enrollador de 140 o 170
        if ($anchoTotal > 500 | $largoTotal > 1200) {
            $datosTerra170Json = file_get_contents('datosTerra170.json');
            $datosTerra = json_decode($datosTerra170Json, true);
        } else {
            $datosTerra140Json = file_get_contents('datosTerra140.json');
            $datosTerra = json_decode($datosTerra140Json, true);
        }
    }


    // Obtener los valores superiores de ancho y largo
    $anchoSuperior = getNextOrExact(array_keys($datosTerra), $anchoTotal);
    $largoSuperior = getNextOrExact(array_keys($datosTerra[$anchoSuperior]), $largoTotal);

    // Validar si los valores existen en la tabla
    if (isset($datosTerra[$anchoSuperior][$largoSuperior])) {
        $result["VALOR"] = $datosTerra[$anchoSuperior][$largoSuperior];
        $result["OK"] = true;
        $resultadoMotor = $result["VALOR"];
    } else {
        $result["ERROR"] = "No se encontró un valor válido para las dimensiones dadas.";
        return $result;
    }
    $sql =   "SELECT LONGITUD, CODIGO, PRECIO
                FROM ARTICULOS
                WHERE ANCHURA  >= $anchoSuperior
                AND TIPO_MOTOR = '$modelo'
                AND SUBTIPO_MOTOR = '$suptipo'
                AND FUERZA_SOPORTADA = '$resultadoMotor'
                ORDER BY ANCHURA ASC, PRECIO ASC
                LIMIT 1";

    $mres = mysqli_query($conn, $sql);
    $mrow = mysqli_fetch_object($mres);

    if (!empty($mrow)) {
        $result["LONGITUD"] = $mrow->LONGITUD;
        $result["CODIGO"]   = $mrow->CODIGO;
        $result["PRECIO"]   = $mrow->PRECIO;
        $result["OK"]       = true;
    } else {
        $sql = "SELECT COUNT(CODIGO) AS N_ROWS
                FROM ARTICULOS
                WHERE ANCHURA >= $anchoSuperior
                AND ((SUBTIPO_MOTOR LIKE '$tipoPiscina'))
                AND TIPO_MOTOR = '$modelo'
                ORDER BY ANCHURA ASC, PRECIO ASC
                LIMIT 1";

        $mres = mysqli_query($conn, $sql);
        $mrow = mysqli_fetch_object($mres);

        if ($mrow->N_ROWS > 0) {
            $result["ERROR"] = "Longitud demasiado grande";
        } else {
            $result["ERROR"] = "Ancho demasiado grande";
        }
    }

    return $result;
}
// Calcular cubierta deck
function calcularDeck($conn, $anchoTotal, $largoTotal, $modelo, $tipoPiscina)
{

    //Dependiendo del ancho o largo cogeremos el enrollador de 140 o 170
    if ($anchoTotal > 500 | $largoTotal > 1500) {
        $datosDeck170Json = file_get_contents('datosDeck170.json');
        $datosDeck = json_decode($datosDeck170Json, true);
    } else {
        $datosDeck140Json = file_get_contents('datosDeck140.json');
        $datosDeck = json_decode($datosDeck140Json, true);
    }

    $result = [
        "OK" => false,
        "ERROR" => ""
    ];

    // Obtener los valores superiores de ancho y largo
    $anchoSuperior = getNextOrExact(array_keys($datosDeck), $anchoTotal);
    $largoSuperior = getNextOrExact(array_keys($datosDeck[$anchoSuperior]), $largoTotal);

    // Validar si los valores existen en la tabla
    if (isset($datosDeck[$anchoSuperior][$largoSuperior])) {
        $result["VALOR"] = $datosDeck[$anchoSuperior][$largoSuperior];
        $result["OK"] = true;
        $resultadoMotor = $result["VALOR"];
    } else {
        $result["ERROR"] = "No se encontró un valor válido para las dimensiones dadas.";
        return $result;
    }
    $sql =   "SELECT LONGITUD, CODIGO, PRECIO
                FROM ARTICULOS
                WHERE ANCHURA  >= $anchoSuperior
                AND TIPO_MOTOR = '$modelo'
                AND SUBTIPO_MOTOR = '$tipoPiscina'
                AND FUERZA_SOPORTADA = '$resultadoMotor'
                ORDER BY ANCHURA ASC, PRECIO ASC
                LIMIT 1";

    $mres = mysqli_query($conn, $sql);
    $mrow = mysqli_fetch_object($mres);

    if (!empty($mrow)) {
        $result["LONGITUD"] = $mrow->LONGITUD;
        $result["CODIGO"]   = $mrow->CODIGO;
        $result["PRECIO"]   = $mrow->PRECIO;
        $result["OK"]       = true;
    } else {
        $sql = "SELECT COUNT(CODIGO) AS N_ROWS
                FROM ARTICULOS
                WHERE ANCHURA >= $anchoSuperior
                AND ((SUBTIPO_MOTOR LIKE '$tipoPiscina'))
                AND TIPO_MOTOR = '$modelo'
                ORDER BY ANCHURA ASC, PRECIO ASC
                LIMIT 1";

        $mres = mysqli_query($conn, $sql);
        $mrow = mysqli_fetch_object($mres);

        if ($mrow->N_ROWS > 0) {
            $result["ERROR"] = "Longitud demasiado grande";
        } else {
            $result["ERROR"] = "Ancho demasiado grande";
        }
    }

    return $result;
}
// Calcular cubierta Top, Duo, Cave
function calcularMotorTopDuoCave($conn, $anchoTotal, $largoTotal, $profundidadTapa, $profundidadPiscina, $modelo, $subtipo, $tipoPiscina)
{

    $result = array(
        "OK" => false,
        "ERROR" => ""
    );

    $profundidadEje = null;
    $largoSuperior = null;
    $largoTotalConLaminas = $largoTotal + 100;

    if ($subtipo == 'DUO' | $subtipo == 'CAVE') {
        $profundidadEje = $profundidadPiscina - 40;
    } else {
        $profundidadEje = $profundidadTapa + 40;
    }

    //Dependiendo del ancho o largo cogeremos el enrollador de 140 o 170
    if ($profundidadEje <= 200) {
        if ($anchoTotal > 500 | $largoTotalConLaminas > 1500) {
            $datosTopDuoCave170Json = file_get_contents('datosTopDuoCave170.json');
            $datosTopDuoCave = json_decode($datosTopDuoCave170Json, true);
        } else {
            $datosTopDuoCave140Json = file_get_contents('datosTopDuoCave140.json');
            $datosTopDuoCave = json_decode($datosTopDuoCave140Json, true);
        }
    } else {
        $result["ERROR"] = "Eje demasiado profundo";
    }

    // Obtener los valores superiores de ancho y largo
    $profundidadSuperior = getNextOrExactTopduoCave(array_keys($datosTopDuoCave), $profundidadEje);
    $anchoSuperior = getNextOrExactTopduoCave(array_keys($datosTopDuoCave[$profundidadSuperior]), $anchoTotal);

    if ($subtipo == 'CAVE') {
        $largoTotalCave = $largoTotalConLaminas + 200;
        $largoSuperior = getNextOrExactTopduoCave(array_keys($datosTopDuoCave[$profundidadSuperior][$anchoSuperior]), $largoTotalCave);
    } else {
        $largoSuperior = getNextOrExactTopduoCave(array_keys($datosTopDuoCave[$profundidadSuperior][$anchoSuperior]), $largoTotalConLaminas);
    }

    if ($largoSuperior == null) {
        $datosTopDuoCave170Json = file_get_contents('datosTopDuoCave170.json');
        $datosTopDuoCave = json_decode($datosTopDuoCave170Json, true);
        $largoSuperior = getNextOrExactTopduoCave(array_keys($datosTopDuoCave[$profundidadSuperior][$anchoSuperior]), $largoTotalConLaminas);
    }

    // Validar si los valores existen en la tabla
    if (isset($datosTopDuoCave[$profundidadSuperior][$anchoSuperior][$largoSuperior])) {
        $result["VALOR"] = $datosTopDuoCave[$profundidadSuperior][$anchoSuperior][$largoSuperior];
        $result["OK"] = true;
        $resultadoMotor = $result["VALOR"];
    } else {
        $result["ERROR"] = "No se encontró un valor válido para las dimensiones dadas.";
        return $result;
    }
    $sql =   "SELECT LONGITUD, CODIGO, PRECIO
                FROM ARTICULOS
                WHERE ANCHURA  >= $anchoSuperior
                AND TIPO_MOTOR = '$modelo'
                AND SUBTIPO_MOTOR = '$tipoPiscina'
                AND FUERZA_SOPORTADA = '$resultadoMotor'
                ORDER BY ANCHURA ASC, PRECIO ASC
                LIMIT 1";

    $mres = mysqli_query($conn, $sql);
    $mrow = mysqli_fetch_object($mres);

    if (!empty($mrow)) {
        $result["LONGITUD"] = $mrow->LONGITUD;
        $result["CODIGO"]   = $mrow->CODIGO;
        $result["PRECIO"]   = $mrow->PRECIO;
        $result["OK"]       = true;
    } else {
        $sql = "SELECT COUNT(CODIGO) AS N_ROWS
                FROM ARTICULOS
                WHERE ANCHURA >= $anchoSuperior
                AND ((SUBTIPO_MOTOR LIKE '$tipoPiscina'))
                AND TIPO_MOTOR = '$modelo'
                ORDER BY ANCHURA ASC, PRECIO ASC
                LIMIT 1";

        $mres = mysqli_query($conn, $sql);
        $mrow = mysqli_fetch_object($mres);

        //SI EXISTE REGISTRO QUIERE DECIR QUE EL PROBLEMA ESTABA EN LA LONGITUD
        if ($mrow->N_ROWS > 0) {
            $result["ERROR"] = "Longitud demasiado grande";
        } else {
            $result["ERROR"] = "Ancho demasiado grande";
        }
    }

    return $result;
}
// Función para obtener el siguiente valor superior o igual
function getNextOrExact($array, $value)
{
    foreach ($array as $item) {
        if ($item >= $value) {
            return $item;
        }
    }
    //return end($keys); // Devuelve el último elemento si no hay ninguno mayor o igual
    return null; // Null si no encuentra valores
}
// Función para obtener el siguiente valor superior o igual
function getNextOrExactTopDuoCave($keys, $value)
{
    sort($keys);
    foreach ($keys as $key) {
        if ($key >= $value) {
            return $key;
        }
    }
    //return end($keys); // Devuelve el último elemento si no hay ninguno mayor o igual
    return null; // Null si no encuentra valores
}
//codear a HTML
function codeToHTML($string)
{
    $string = mb_convert_encoding($string, "HTML-ENTITIES", "ISO-8859-1");
    return $string;
}
// Este metodo no se esta usando de momento
function enviarCorreoCliente($conn, $presupuesto, $cliente)
{
?>
    <form id="form_pdf" method="post" action="enviar_correo.php" target="_blank">
        <input type="hidden" name="PDF" id="pdf" />
        <input type="hidden" name="PRESUPUESTO" value="<? echo $presupuesto; ?>" />
        <input type="hidden" name="CLIENTE" value="<? echo $cliente; ?>" />
    </form>
    <div class="spinner-border" id="cargador" role="status"><span class="sr-only">Loading...</span></div>
    <script type="text/javascript" src="./include/html2pdf-master/dist/html2pdf.bundle.min.js"></script>
    <script>
        var options = {
            margin: 2,
            filename: 'Presupuesto_<? echo $presupuesto; ?>.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2,
                imageTimeout: 0
            },
            jsPDF: {
                format: 'a3',
                compressed: true
            }
        }

        html2pdf().set(options).from('<? echo str_replace('\'', '\\\'', obtenerFacturaPresupuesto($conn, $presupuesto, $cliente, true)); ?>').toPdf()
            .output(undefined, undefined, 'pdf').then(function(d) {

                document.getElementById("pdf").value = encodeURIComponent(d);
                document.getElementById("form_pdf").submit();

            });
    </script>
<?php
}
// Este metodo no se esta usando de momento
function ver_pvp_tarifas($articulo, $cliente, $proyecto, $cantidad, $precio, $conn)
{
    /* grabarChivato("Parametros: Articulo->$articulo, Cliente->$cliente, PRECIO->$precio, Cantidad->$cantidad"); */

    $result = array(
        "PVP" => $precio,
        "DTO" => 0,
        "PVPPROYECTO" => $precio,
        "CODIGO_TERMINACION" => "0",
        "PVP_DE_ORIGEN_TARIFA" => 0
    );

    //return $result; // Evitamos que recalcule el precio con descuentos y lo muestre en la web.

    $PVP                    = -1;
    $DTO                    = 0;
    $PVPPROYECTO            = 0;
    $cantidad_a_partir_de   = 0;
    $PVP_DE_ORIGEN_TARIFA   = 'N';

    $sql = "SELECT tarifa, utilizar_pack, utilizar_siempre_pvp_caja
              from CLIENTES
             where codigo = " . $cliente;

    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_object($res);

    $tarifa                     = $row->tarifa;
    $utilizar_pack              = $row->utilizar_pack;
    $utilizar_siempre_pvp_caja  = $row->utilizar_siempre_pvp_caja;

    if ($tarifa > 0) {
        $sql = "SELECT APLICAR_SOLO_PACKS, APLICAR_SOLO_CAJAS, DURANTE_PERIODO, FECHA_INICIO, FECHA_FIN
                  from TARIFAS
                 where codigo = $tarifa";

        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_object($res);

        $tarifa_pack     = $row->APLICAR_SOLO_PACKS;
        $tarifa_caja     = $row->APLICAR_SOLO_CAJAS;
        $durante_periodo = $row->DURANTE_PERIODO;
        $fecha_inicio    = $row->FECHA_INICIO;
        $fecha_fin       = $row->FECHA_FIN;

        if ($durante_periodo == 'N') {
            if ($tarifa_pack == 'S' || $tarifa_caja == 'S') {
                $sql = "SELECT UDS_PACK, UNIDADESCAJA FROM ARTICULOS WHERE CODIGO = '$articulo'";

                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_object($res);

                $uds_pack       = $row->UDS_PACK;
                $unidadesCaja   = $row->UNIDADESCAJA;

                if ($tarifa_pack == 'S') {
                    $cantidad_a_partir_de = $uds_pack;
                }
                if ($tarifa_caja == 'S') {
                    $cantidad_a_partir_de = $unidadesCaja;
                }
            }

            if ($cantidad_a_partir_de == 0 || ($cantidad_a_partir_de > 0 && $cantidad >= $cantidad_a_partir_de)) {
                $sets = "SET @C_PVP=0, @C_DTO=0, @C_PVPPROYECTO=0, @C_codigo_terminacion=0, @C_pvp_de_origen_tarifa='0'";
                mysqli_query($conn, $sets);

                $sql = "call PVP_ARTICULO_TARIFA('$articulo', $tarifa, $proyecto, $cantidad, '$utilizar_pack', '$utilizar_siempre_pvp_caja', $precio, NOW(), $cliente,
                                    @C_PVP, @C_DTO, @C_PVPPROYECTO, @C_CODIGO_TERMINACION, @C_PVP_DE_ORIGEN_TARIFA);";

                mysqli_query($conn, $sql);

                $sql = "SELECT @C_PVP AS PVP, @C_DTO AS DTO, @C_PVPPROYECTO AS PVPPROYECTO, @C_CODIGO_TERMINACION AS CODIGO_TERMINACION,
                               @C_PVP_DE_ORIGEN_TARIFA AS PVP_DE_ORIGEN_TARIFA";

                $mresP = mysqli_query($conn, $sql);
                $mrowP = mysqli_fetch_object($mresP);

                $result['PVP']                  = $mrowP->PVP;
                $result['DTO']                  = $mrowP->DTO;
                $result['PVPPROYECTO']          = $mrowP->PVPPROYECTO;
                $result['CODIGO_TERMINACION']   = $mrowP->CODIGO_TERMINACION;
                $result['PVP_DE_ORIGEN_TARIFA'] = $mrowP->PVP_DE_ORIGEN_TARIFA;
            }
        }
    }

    /* si no existe una tarifa principal, vamos a buscar en tarifas clientes */
    if ($tarifa == 0) {
        /*buscamos el cliente en tarifas clientes*/
        $sql = "SELECT count(cliente) as n_reg
                  from TARIFASCLIENTES
                 where TARIFASCLIENTES.cliente = " . $cliente;

        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_object($res);

        $n_reg = $row->n_reg;

        if ($n_reg > 0) {
            $pvp               = $precio;
            $ultimo_pvp_valido = $precio;
            $PVPPROYECTO       = $precio;

            $sql = "SELECT TARIFASCLIENTES.tarifa, TARIFAS.APLICAR_SOLO_PACKS, TARIFAS.APLICAR_SOLO_CAJAS, DURANTE_PERIODO, FECHA_INICIO, FECHA_FIN
                      from TARIFASCLIENTES
                      left join TARIFAS on TARIFAS.CODIGO = TARIFASCLIENTES.TARIFA
                     WHERE TARIFASCLIENTES.cliente = " . $cliente . "
                     ORDER BY TARIFASCLIENTES.tarifa";

            $res = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_object($res)) {
                $tarifa             = $row->tarifa;
                $tarifa_pack        = $row->APLICAR_SOLO_PACKS;
                $tarifa_caja        = $row->APLICAR_SOLO_CAJAS;
                $durante_periodo    = $row->DURANTE_PERIODO;
                $fecha_inicio       = $row->FECHA_INICIO;
                $fecha_fin          = $row->FECHA_FIN;

                //LLAMAMOS AL PROCEDURE
                $sets = "SET @C_PVP=0, @C_DTO=0, @C_PVPPROYECTO=0, @C_codigo_terminacion=0, @C_pvp_de_origen_tarifa='0'";
                mysqli_query($conn, $sets);

                $sql = "call PVP_ARTICULO_TARIFA('$articulo', $tarifa, 50, $cantidad, '$utilizar_pack', '$utilizar_siempre_pvp_caja', $pvp, NOW(), $cliente,
                             @C_PVP, @C_DTO, @C_PVPPROYECTO, @C_CODIGO_TERMINACION, @C_PVP_DE_ORIGEN_TARIFA);";

                mysqli_query($conn, $sql);

                $sql = "SELECT @C_PVP AS PVP, @C_DTO AS DTO, @C_PVPPROYECTO AS PVPPROYECTO, @C_CODIGO_TERMINACION AS CODIGO_TERMINACION,
                               @C_PVP_DE_ORIGEN_TARIFA AS PVP_DE_ORIGEN_TARIFA";

                $res2 = mysqli_query($conn, $sql);
                $row2 = mysqli_fetch_object($res2);

                //print_r($row);
                //echo '<br>';

                $tmp_pvp = $row2->PVP;

                if ($tmp_pvp <> -1) {

                    if ($durante_periodo == 'N') {
                        $cantidad_a_partir_de = 0;

                        if ($tarifa_pack == 'S' || $tarifa_caja == 'S') {
                            $sql = "SELECT UDS_PACK, UNIDADESCAJA FROM ARTICULOS WHERE CODIGO = '$articulo'";

                            $res2 = mysqli_query($conn, $sql);
                            $row2 = mysqli_fetch_object($res2);

                            $uds_pack       = $row2->UDS_PACK;
                            $unidadesCaja   = $row2->UNIDADESCAJA;

                            if ($tarifa_pack == 'S') {
                                $cantidad_a_partir_de = $uds_pack;
                            }
                            if ($tarifa_caja == 'S') {
                                $cantidad_a_partir_de = $unidadesCaja;
                            }
                        }

                        if ($cantidad_a_partir_de == 0 || ($cantidad_a_partir_de > 0 && $cantidad >= $cantidad_a_partir_de)) {
                            $sets = "SET @C_PVP=0, @C_DTO=0, @C_PVPPROYECTO=0, @C_codigo_terminacion=0, @C_pvp_de_origen_tarifa='0'";
                            mysqli_query($conn, $sets);

                            $sql = "call pvp_articulo_tarifa('$articulo', $tarifa, $proyecto, $cantidad, '$utilizar_pack', '$utilizar_siempre_pvp_caja', $precio, NOW(), $cliente,
                                                @C_PVP, @C_DTO, @C_PVPPROYECTO, @C_CODIGO_TERMINACION, @C_PVP_DE_ORIGEN_TARIFA);";

                            mysqli_query($conn, $sql);

                            $sql = "SELECT @C_PVP AS PVP, @C_DTO AS DTO, @C_PVPPROYECTO AS PVPPROYECTO, @C_CODIGO_TERMINACION AS CODIGO_TERMINACION,
                                        @C_PVP_DE_ORIGEN_TARIFA AS PVP_DE_ORIGEN_TARIFA";

                            $mresP = mysqli_query($conn, $sql);
                            $mrowP = mysqli_fetch_object($mresP);

                            $result['PVP']                  = $mrowP->PVP;
                            $result['DTO']                  = $mrowP->DTO;
                            $result['PVPPROYECTO']          = $mrowP->PVPPROYECTO;
                            $result['CODIGO_TERMINACION']   = $mrowP->CODIGO_TERMINACION;
                            $result['PVP_DE_ORIGEN_TARIFA'] = $mrowP->PVP_DE_ORIGEN_TARIFA;

                            if ($result['PVP_DE_ORIGEN_TARIFA'] <> 'S') {
                                $pvp_de_origen_tarifa = $mrowP->PVP_DE_ORIGEN_TARIFA;
                            }
                        }

                        if ($pvp <> -1) {
                            $ultimo_pvp_valido = $pvp;
                        }

                        if ($pvp == -1) {
                            $pvp = $ultimo_pvp_valido;
                        }
                    } //IF DURANTE_PERIODO
                }
            } //WHILE ROW
        } //IF TARIFAS CLIENTES
    } //IF TARIFA == 0

    /* grabarChivato(json_encode($result)); */
    return $result;
}

//Utilidad para insertar lineas de presupuesto
function insertarLineasPresupuesto($conn, $transacciones)
{
    // Logging inicial
    error_log("Número de transacciones: " . count($transacciones));

    // Desactivar autocommit
    mysqli_autocommit($conn, FALSE);

    try {
        // Verificar que $transacciones sea un array no vacío
        if (!is_array($transacciones) || empty($transacciones)) {
            throw new Exception("No hay líneas de presupuesto para insertar");
        }

        // Ejecutar todas las consultas
        foreach ($transacciones as $index => $consulta) {
            // Validar consulta
            if (!is_string($consulta) || trim($consulta) === '') {
                error_log("Consulta inválida en índice $index");
                continue;
            }

            // Logging de consultas
            error_log("Consulta $index: " . substr($consulta, 0, 200) . "...");

            // Ejecutar consulta
            if (!mysqli_query($conn, $consulta)) {
                throw new Exception("Error en consulta $index: " . mysqli_error($conn));
            }
        }

        // Confirmar transacción
        mysqli_commit($conn);

        // Volver a activar autocommit
        mysqli_autocommit($conn, TRUE);

        // Logging de éxito
        error_log("Todas las líneas de presupuesto insertadas correctamente");

        return true;
    } catch (Exception $e) {
        // Revertir transacción
        mysqli_rollback($conn);

        // Volver a activar autocommit
        mysqli_autocommit($conn, TRUE);

        // Registro de error detallado
        error_log("Error en inserción de líneas de presupuesto: " . $e->getMessage());
        error_log("Traza: " . $e->getTraceAsString());

        return false;
    }
}
