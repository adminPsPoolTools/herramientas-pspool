<?php

/* error_reporting(E_ALL);
ini_set('display_errors', 1); */

/* ================================== */
/* ======   CONFIGURADOR PS    ====== */
/* ================================== */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

include 'modelos/DatosPresupuesto.php';
include 'include/config.php';
include 'include/funciones.php';
include 'include/utilidades.php';
include 'include/imprimirPdf.php';

use Modelos\DatosPresupuesto;

$conn = mysqli_connect(SERVER, USERNAME, PASSWORD, BD) or die("Error al conectar -> " . SERVER . " - " . USERNAME . " - " . PASSWORD . " - " . BD);

$tipo = $_POST['TIPO'];

switch ($tipo) {
    case 1: //CALCULAR EL PRESUPUESTO

        $cliente = $_POST['CLIENTE'];
        $sql = "SELECT CODIGO FROM CLIENTES WHERE NOMBRE_USUARIO = '" . $cliente . "' OR CORREO = '" . $cliente . "'";

        $mres  = mysqli_query($conn, $sql);
        $mrow2 = mysqli_fetch_object($mres);

        if ($mrow2) {
            $cliente = $mrow2->CODIGO;
        } else {
            $cliente = "1";
        }

        $modelo             = strtoupper($_POST['MODELO']);
        $subtipo            = str_replace(' ', '-', strtoupper($_POST['SUBTIPO']));
        $profundidadTapa    = $_POST['PROFUNDIDAD_TAPA'];
        $profundidadPiscina = $_POST['PROFUNDIDAD_PIS'];
        $tipoEscalera       = $_POST['TIPOESCALERA'];
        $sentidoEscalera    = $_POST['SENTIDOESCALERA'];
        $largoEscalera      = $_POST['LARGOESCALERA'];
        $anchoEscalera      = $_POST['ANCHOESCALERA'];
        $largoPiscina       = $_POST['LARGOPISCINA'];
        $anchoPiscina       = $_POST['ANCHOPISCINA'];
        $tipoLamina         = $_POST['TIPOLAMINA'];
        $conViga            = $_POST['CONVIGA'];
        $conTapa            = $_POST['CONTAPA'];
        $escaleraRomana     = $_POST['ESCALERAROMANA'];
        $colorLamina        = str_replace('%20', ' ', $_POST['COLORLAMINA']);
        $descripcion        = str_replace('%20', ' ', $_POST['DESCRIPCION']);
        $tipoInstalacion    = $_POST['TIPOINSTALACION'];
        $provincia          = $_POST['PROVINCIA'];
        $importeInstalacion = $_POST['IMPORTEINSTALACION'];
        $datosClienteFinal  = $_POST['DATOSCLIENTEFINAL'];
        $tipoTapa           = ($subtipo == "TOP" | $subtipo == "DUO" | $subtipo == "CAVE") ? "revestir" : $_POST['TIPO_TAPA'];
        $tipoPiscina        = $_POST['TIPO_PISCINA'];

        $datosPresupuesto = new DatosPresupuesto(
            $modelo,                //S = sumergido C = coronacion
            $subtipo,               // Modelo de cubierta: Deck, Top, Duo, Cave, Terra, Terra-Solar, Altea, Delta-A-B-C-D
            $profundidadTapa,       // Profundidad hasta la tapa
            $profundidadPiscina,    // Profundidad hasta el fondo
            $tipoEscalera,          // D = No hay escalera F = si hay escalera
            $sentidoEscalera,       // S
            $largoEscalera,         //Largo escalera
            $anchoEscalera,         //Ancho escalera
            $anchoPiscina,          //Ancho piscina
            $largoPiscina,          //Largo piscina
            $tipoLamina,            //PVC - PC
            $cliente,               //Codigo del cliente
            $conViga,               //True o False
            $conTapa,               //True o False
            $escaleraRomana,        //Recta o Romana
            $colorLamina,           // Color
            $tipoInstalacion,       //Tipo de instalacion: Exterior o Propia
            $provincia,             //Provincia
            $importeInstalacion,    // En caso de que sea propia
            $datosClienteFinal,     // Datos del cliente
            $tipoTapa,              // ipe o revestir
            $tipoPiscina            // hormigon, liner o polieste
        );

        $calcularPresupuesto = calcularYGrabarPresupuesto($datosPresupuesto, $conn);

        print_r($calcularPresupuesto);

        $resPres = json_decode($calcularPresupuesto);
        break;

    case 2:

        $codigoPresu    = $_POST['PRESUPUESTO'];
        $descripcion    = $_POST['DESCRIPCION'];
        $alias          = $_POST['ALIAS'];
        $direccion      = $_POST['DIRECCION'];
        $poblacion      = $_POST['POBLACION'];
        $cif            = $_POST['CIF'];
        $provincia      = $_POST['PROVINCIA'];
        $telefonoFijo   = $_POST['TELEFONOFIJO'];
        $telefonoMovil  = $_POST['TELEFONOMOVIL'];
        $correo         = $_POST['CORREO'];
        $password       = $_POST['PASSWORD'];
        $pais           = $_POST['PAIS'];
        $cp             = $_POST['CP'];

        cambiarClientePresupuesto(
            $codigoPresu,
            0,
            $descripcion,
            $alias,
            $direccion,
            $poblacion,
            $cif,
            $provincia,
            $telefonoFijo,
            $telefonoMovil,
            $correo,
            $password,
            $pais,
            $cp,
            $conn
        );

        break;

    case 3: //Imprimir el presupuesto
        $presupuesto       = $_POST['PRESUPUESTO'];
        $datosClienteFinal = $_POST['DATOSPRINT'];
        $html = obtenerFacturaPresupuesto($conn, $presupuesto, $datosClienteFinal, false);

        $result = array(
            "OK" => 1,
            "TEST" => $presupuesto,
            "HTML" => "$html"
        );

        echo json_encode($result);

        break;

    case 4: //ENVIAR CORREO DEL PRESUPUESTO

        $presupuesto    = $_POST['PRESUPUESTO'];
        $cliente        = $_POST['CLIENTE'];

        $sql = "SELECT CODIGO FROM CLIENTES WHERE NOMBRE_USUARIO = '" . $cliente . "' OR CORREO = '" . $cliente . "'";

        $mres = mysqli_query($conn, $sql);

        if ($mres) {
            $mrow2 = mysqli_fetch_object($mres);

            $cliente = $mrow2->CODIGO;
        } else {

            $cliente = "1";
        }

        $html =  str_replace('\'', '\\\'', obtenerFacturaPresupuesto($conn, $presupuesto, $datosClienteFinal,  true));

        $result = array(
            "OK" => 1,
            "TEST" => $presupuesto,
            "HTML" => "$html"
        );

        echo json_encode($result);
        //enviarCorreoCliente($conn, $presupuesto, $cliente);
        break;

    default:
        # code...
        break;
}

function calcularYGrabarPresupuesto($datos, $conn)
{
    $transacciones = array();
    $linea = 1;

    $largoTotal = ((float) $datos->largoPiscina);
    $anchoTotal = ((float) $datos->anchoPiscina);

    // MANOLO: solo cuento el largo de la escalera si es del tipo fuera y en el sentido de lacubierta
    if (($datos->tipoEscalera == 'F') && ($datos->sentidoEscalera == 'S')) {
        $largoTotal = ((float) $datos->largoPiscina) + ((float) $datos->largoEscalera);
    }

    if (empty($anchoTotal) || empty($largoTotal)) {
        return devolverError("MEDIDAS DE ALTO / ANCHO DE LA PISICINA INCORRECTAS");
    }

    //ANTES DE CALCULAR NADA VOY A APLICAR UNAS CUANTAS RESTRICCIONES
    //EL MÁXIMO LARGO PERMITIDO ES DE 15 METROS
    if ($datos->largoPiscina > 2000) {
        return devolverError("El largo m&aacute;ximo permitido es de 20 metros");
    }

    //EL MAXIMO ANCHO PERMITIDO ES DE 6 METROS
    if ($datos->anchoPiscina > 600) {
        return devolverError("El ancho m&aacute;ximo permitido es de 6 metros");
    }

    //LA ESCALERA NO PUEDE SER MAS ANCHA QUE LA PISCINA
    if ($datos->anchoEscalera > $datos->anchoPiscina) {
        return devolverError("La escalera no puede ser mas ancha que la piscina");
    }

    $datosMotor = array();
    //VAMOS A APROVECHAR EN ESTE SWITCH PARA PONER QUE LOS SUBTIPOS NUEVOS TIENEN QUE TENER VIGA SI O SI
    switch ($datos->subtipo) {

        case "TOP":
        case "DUO":
        case "CAVE":
            $datos->conViga = true;
            $datos->conTapa = true;
            $datosMotor = calcularMotorTopDuoCave($conn, $anchoTotal, $largoTotal, $datos->profundidadTapa, $datos->profundidadPiscina, $datos->modelo, $datos->subtipo, $datos->tipoPiscina);
            errorLog(print_r($datos, true));
            break;

        case "DECK": //SI ES DE CORONACION O SUMERGIDA CON EL SUBTIPO "DEC" SE DEJA COMO SE HACIA ANTES
            $datosMotor = calcularDeck($conn, $anchoTotal, $largoTotal, $datos->modelo, $datos->tipoPiscina);
            break;
    }

    //SI HA HABIDO ALGUN PROBLEMA OBTENIENDO EL MOTOR, DEVUELVO EL ERROR
    if (!$datosMotor["OK"]) {
        return devolverError($datosMotor["ERROR"]);
    }

    if (!empty($datosMotor)) //SI ESTÁ VACIO ES QUE NO HAY UN MOTOR CON ESAS CARACTERISTICAS DISPONIBLE
    {
        $largo = $datosMotor["LONGITUD"];

        if (((float) $largo) >= ((float) $largoTotal)) // SI LA LONGITUD TOTAL ES MENOR O IGUAL A LA MAXIMA, ES VALIDO
        {
            //Obtenemos codigo web
            $nuevoCodigo = generarCodigoAleatorio($conn);

            //Insertamos articulos fijos
            insertarArticulosFijos($conn, $datos, $nuevoCodigo, $linea, $transacciones);

            //Añadimos el enrollador
            $precioMotor = obtenerPVPArticulo($datosMotor["CODIGO"], $datos->cliente, $datosMotor["PRECIO"], 1, $conn);
            $precioSinDescuento = (float) $precioMotor['PVP'];
            $precio = (float) $precioMotor['PVP_FINAL'];

            insertarEnrollador($conn, $nuevoCodigo, $linea, $transacciones, $datosMotor["CODIGO"], $precioMotor, "Motor y enrrollador tipo " . $datos->subtipo);

            //Insertar Contrapesa
            insertarContrapesa($conn, $datos, $nuevoCodigo, $linea, $transacciones, $datos->subtipo, $anchoTotal);

            // Insertar tornillos contrapesa CAVE
            if ($datos->subtipo == 'CAVE') {
                $cantidad = ceil($anchoTotal / 100);
                insertarTornillosContrapesa($conn, $datos, $nuevoCodigo, $linea, $transacciones, $datos->subtipo, 'TORNILLO CINTA', $anchoTotal, $cantidad, 'Articulo fijo');
            }

            //Insertamos viga para DECK
            if ($datos->conViga) {
                $resViga = insertarViga($conn, $datos->subtipo, $nuevoCodigo, $linea, $datos->anchoPiscina, $datos->cliente, $largoTotal);

                if (!empty($resViga)) {
                    $linea++;
                    array_push($transacciones, $resViga['SQL']);

                    $precio             += (float) $resViga['PRECIO'];
                    $precioSinDescuento += (float) $resViga['PRECIO_SIN_DESCUENTO'];
                }

                //Insertamos el extra de LACADO de la viga DECK
                insertarExtraLacadoViga($conn, $datos, $nuevoCodigo, $linea, $transacciones, $datos->subtipo, 'LACADO');

                // Insertar soporte intermedio si el ancho de la piscina es mayor o igual a 450
                if ($datos->anchoPiscina >= 450) {
                    insertarSoporteIntermedio($conn, $datos, $nuevoCodigo, $linea, $transacciones, $datos->anchoPiscina, $largoTotal);
                }

                //Insertamos viga de refuerzo para pacific deck con tapa de revestir
                if ($datos->tipoTapa == "revestir") {
                    insertarAnclajesVigaRefuerzoDeck($conn, $datos, $nuevoCodigo, $linea, $transacciones, $datos->anchoPiscina, $largoTotal, 'VIGA REFUERZO', 1, 'Articulo fijo');
                    insertarAnclajesVigaRefuerzoDeck($conn, $datos, $nuevoCodigo, $linea, $transacciones, $datos->anchoPiscina, $largoTotal, 'ANCLAJE VIGA REFUERZO', 2, 'Articulo fijo');
                }

                //Insertamos el extra de ANGULO TAPAS de la viga DECK
                if ($datos->tipoTapa == "ipe") {
                    insertarExtraAnguloTapas($conn, $datos, $nuevoCodigo, $linea, $transacciones, 'ANGULO LATERAL', 1, 'Articulo fijo');
                }
            }

            // Insertar rejilla para la DECK
            insertarRejillaDeck($conn, $datos, $nuevoCodigo, $linea, $transacciones, $precio, $precioSinDescuento, $anchoTotal, $largoTotal);

            // Añadimos las laminas
            insertarLaminas($conn, $datos, $nuevoCodigo, $linea, $transacciones, $precio, $precioSinDescuento);

            // Añadimos escalera si la tiene
            insertarEscalera($conn, $datos, $nuevoCodigo, $linea, $transacciones, $precio, $precioSinDescuento);

            //Insertar patines para CAVE
            $resPatines = insertarPatines($conn, $datos->modelo, $datos->subtipo, $nuevoCodigo, $linea, $anchoTotal, $datos->cliente);
            if (!empty($resPatines)) {
                $linea++;
                array_push($transacciones, $resPatines['SQL']);

                $precio             += (float) $resPatines['PRECIO'];
                $precioSinDescuento += (float) $resPatines['PRECIO_SIN_DESCUENTO'];
            }

            //Insertar tubo salida para CAVE
            $resTuboSalida = insertarTuboSalida($conn, $datos->modelo, $datos->subtipo, $nuevoCodigo, $linea, $anchoTotal, $datos->cliente);
            if (!empty($resTuboSalida)) {
                $linea++;
                array_push($transacciones, $resTuboSalida['SQL']);

                $precio             += (float) $resTuboSalida['PRECIO'];
                $precioSinDescuento += (float) $resTuboSalida['PRECIO_SIN_DESCUENTO'];
            }

            // Insertar anclajes de seguridad
            insertarAnclajesSeguridad($conn, $datos, $nuevoCodigo, $linea, $transacciones, $precio, $precioSinDescuento);

            // Añadir cintas de las láminas
            insertarCintasLaminas($conn, $datos, $nuevoCodigo, $linea, $transacciones, $precio, $precioSinDescuento);

            // Añadir embalaje
            insertarEmbalaje($conn, $datos, $nuevoCodigo, $linea, $transacciones, $precio, $precioSinDescuento, $anchoTotal);

            //Portes
            insertarPortes($conn, $datos, $nuevoCodigo, $linea, $transacciones, $precio, $precioSinDescuento);

            // Añadir instalación
            insertarInstalacion($conn, $datos, $nuevoCodigo, $linea, $transacciones, $precio, $precioSinDescuento);

            //GRABAR PRESUPUESTO
            $descripcionCliente = "CUBIERTA " . $datos->subtipo . " " . round(((float)$datos->anchoPiscina / 100), 2) . " m x " . round(((float)$datos->largoPiscina / 100), 2) . " m";

            if ($datos->tipoEscalera != "D") {
                if (!empty($datos->largoEscalera) && $datos->largoEscalera != "0" && !empty($datos->anchoEscalera) && $datos->anchoEscalera != "0") {
                    if ($datos->esRomana) {
                        $descripcionCliente .= " + ESC.ROMANA ";
                    } else {
                        $descripcionCliente .= " + ESC.RECTA ";
                    }
                    $descripcionCliente .= round(((float)$datos->largoEscalera / 100), 2) . " x " . round(((float)$datos->anchoEscalera / 100), 2) . " mts";
                }
            }

            if ($datos->subtipo == "TOP" && !empty($datos->profundidadTapa)) {
                $descripcionCliente .= " - PROF. TAPA " . $datos->profundidadTapa . " cm";
            }

            if (($datos->subtipo == "DUO" || $datos->subtipo == "CAVE") && !empty($datos->profundidadPiscina)) {
                $descripcionCliente .= " - PROF. PISCINA " . $datos->profundidadPiscina . " cm";
            }

            $descripcionCliente .= " - Laminas de " . $datos->tipoLamina . " " . $datos->colorLamina;
            $descripcion = "Piscina de " . $datos->anchoPiscina . " x " . $datos->largoPiscina . " con escalera de " . $datos->largoEscalera . " x " . $datos->anchoEscalera;

            // S o C
            if ($datos->modelo == 'S') {
                $descripcion .= " sumergida,";
            } else {
                $descripcion .= " coronación,";
            }

            // D o F
            if ($datos->tipoEscalera == 'D') {
                $descripcion .= " dentro,";
            } else {
                $descripcion .= " fuera,";
            }

            //S o N
            if ($datos->sentidoEscalera == "S") {
                $descripcion .= " sentido ascendente,";
            } else {
                $descripcion .= " sentido descendente,";
            }

            if ($datos->conViga) {
                $descripcion .= " con viga,";
            } else {
                $descripcion .= " sin viga,";
            }

            if ($datos->conTapa) {
                $descripcion .= " con tapa";
            } else {
                $descripcion .= " sin tapa";
            }

            $descripcion .= " y lámina " . $datos->colorLamina . " de " . $datos->tipoLamina . ". ";

            if ($datos->tipoInstalacion == "E") {
                $descripcion .= "Instalación externa";
            } else {
                $descripcion .= "Instalación propia";
            }

            $sql = "INSERT INTO PRESUPUESTOS (TITULO, DESCRIPCION, CLIENTE, FECHA, TOTAL, CODIGO_WEB, IMPUESTO, COMENTARIO_INTERNO, DESCRIPCION_CLIENTE)
                    VALUES ('" . utf8_decode($descripcionCliente) . "','$descripcion', $datos->cliente, NOW(), $precio, $nuevoCodigo, 21,
                            '" . $datos->datosClienteFinal . "PRESUPUESTO WEB $nuevoCodigo', '" . utf8_decode($descripcionCliente) . "')";

            $mres = mysqli_query($conn, $sql);

            $result = $nuevoCodigo . ' - ' . round($precio, 2) . ' € - ' . $descripcion;

            //AHORA INSERTAMOS LAS LINEAS DEL PRESUPUESTO
            for ($i = 0; $i < count($transacciones); $i++) {
                mysqli_query($conn, $transacciones[$i]);
            }

            $result = array(
                "OK" => 1,
                "ERROR" => "",
                "TEST" => $datos->cliente,
                "CODIGO_PRESUPUESTO" => $nuevoCodigo,
                /* "PRECIO" => round($precio, 2), */
                /* "PRECIO"    => round(($precio * 1.21), 2), */
                "PRECIO"    => round(($precioSinDescuento * 1.21), 2),
                "DESCRIPCION" => codeToHTML(utf8_decode($descripcion)),
            );
        } else {
            $result = array(
                "OK" => 0,
                "ERROR" => "Largo demasiado grande",
            );
        }
    } else {
        $result = array(
            "OK" => 0,
            "ERROR" => "Hubo un error al obtener los datos"
        );

        return json_encode($result);
    }

    mysqli_commit($conn);
    mysqli_close($conn);

    return json_encode($result);
}

function cambiarClientePresupuesto(
    $codigoPresupuesto,
    $codigo,
    $descripcion,
    $alias,
    $direccion,
    $poblacion,
    $cif,
    $provincia,
    $telefonofijo,
    $telefonomovil,
    $correo,
    $password,
    $pais,
    $cp,
    $conn
) {

    if (empty($correo)) {

        $result = array(
            "OK" => 0,
            "ERROR" => "El correo no puede estar vacío",
        );

        return json_encode($result);
    }

    if (empty($codigo)) {

        //SI ES NUEVO MIRO QUE NO TENGA EL CORREO YA PUESTO
        $sql = "SELECT CODIGO_WEB FROM CLIENTES WHERE CORREO LIKE '$correo' OR LOGIN LIKE '$correo'";

        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_object($res);

        if (!empty($row) && $row->CODIGO_WEB != "") {

            $result = array(
                "OK" => 0,
                "ERROR" => "El correo $correo ya está en uso",
            );

            return json_encode($result);
        }

        $sql = "INSERT INTO CLIENTES (DESCRIPCION, ALIAS, DIRECCION, POBLACION, CIF, PROVINCIA, TELEFONOFIJO, TELEFONOMOVIL, CORREO, PASWORD, PAIS, CP, DIRECCIONENVIOMERCANCIA,
                                      POBLACIONENVIOMERCANCIA, PROVINCIAENVIOMERCANCIA, CPENVIOMERCANCIA, LOGIN)
                VALUES ('$descripcion', '$alias', '$direccion', '$poblacion', '$cif', '$provincia', '$telefonofijo', '$telefonomovil', '$correo', '$password', '$pais',
                        '$cp', '$direccion', '$poblacion', '$provincia', '$cp', '$correo')";

        $res = mysqli_query($conn, $sql);

        $sql = "SELECT CODIGO_WEB FROM CLIENTES WHERE CORREO LIKE '$correo'";

        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_object($res);
        $codigo = $row->CODIGO_WEB;
    }

    //AHORA ASIGNAMOS EL CLIENTE AL PRESUPUESTO
    if ($codigoPresupuesto != 0) {
        $sql = "UPDATE PRESUPUESTOS SET CLIENTE = $codigo WHERE CODIGO_WEB = $codigoPresupuesto";

        mysqli_query($conn, $sql);
    }

    $result = array(
        "OK" => 1,
        "ERROR" => "",
        "CODIGO_CLIENTE" => $codigo,
        "DESCRIPCION" => 'Usuario registrado',
    );


    mysqli_commit($conn);
    mysqli_close($conn);

    return json_encode($result);
}
