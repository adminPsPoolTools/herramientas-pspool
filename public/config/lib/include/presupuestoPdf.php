<?php

/*
 * HTML del presupuesto para generar el PDF en el navegador (html2pdf, A4 vertical, margen 10 mm).
 * Ancho útil de la página: ~718 px; alto útil: ~1046 px.
 */

function pdfTexto($texto)
{
    $texto = (string) $texto;
    if (!mb_check_encoding($texto, 'UTF-8')) {
        $texto = mb_convert_encoding($texto, 'UTF-8', 'ISO-8859-1');
    }
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

function pdfEuros($importe)
{
    return number_format((float) $importe, 2, ',', '.') . ' &euro;';
}

function pdfFecha($fecha)
{
    $time = strtotime((string) $fecha);
    if (!$time) {
        return pdfTexto($fecha);
    }
    $meses = array('ene', 'feb', 'mar', 'abr', 'may', 'jun', 'jul', 'ago', 'sep', 'oct', 'nov', 'dic');
    return date('j', $time) . ' ' . $meses[date('n', $time) - 1] . '. ' . date('Y', $time);
}

function pdfLineas($conn, $codigoPresupuesto, $instalacion)
{
    $condicion = $instalacion ? 'SUBCUENTA IS NOT NULL' : 'SUBCUENTA IS NULL';
    $codigo = mysqli_real_escape_string($conn, $codigoPresupuesto);

    $sql = "SELECT L.LINEA, L.COMENTARIO, L.ARTICULO, L.CANTIDAD, L.PVP, L.PVP_FINAL,
                   A.DESCRIPCION AS DESCARTICULO
              FROM LINPRESU L
              LEFT JOIN ARTICULOS A    ON L.ARTICULO = A.CODIGO
              LEFT JOIN PRESUPUESTOS P ON P.CODIGO_WEB = L.PRESUPUESTO_WEB
             WHERE $condicion
               AND ((P.CODIGO = '$codigo') OR (P.CODIGO_WEB = '$codigo'))
             ORDER BY L.LINEA";

    $lineas = array();
    $res = mysqli_query($conn, $sql);
    while ($res && $row = mysqli_fetch_object($res)) {
        $lineas[] = $row;
    }
    return $lineas;
}

// Devuelve las filas HTML y la suma de PVP (sin descuentos)
function pdfFilasLineas($lineas, $multiplicarCantidad)
{
    $html = '';
    $pvp = 0;

    foreach ($lineas as $row) {
        $cantidad = $multiplicarCantidad ? (float) $row->CANTIDAD : 1;
        $pvp += $cantidad * (float) $row->PVP;

        $html .= '
            <tr><td colspan="3" style="height:9px;"></td></tr>
            <tr style="font-size:10px;">
                <td style="width:16px; background:#d9d9d9; text-align:center; vertical-align:middle; font-weight:bold; padding:4px 0;">' . pdfTexto($row->LINEA) . '</td>
                <td style="width:36px; padding-left:4px; font-weight:bold; vertical-align:middle;">' . pdfTexto($row->ARTICULO) . '</td>
                <td style="font-weight:bold; vertical-align:middle;">' . pdfTexto($row->DESCARTICULO) . '</td>
            </tr>';
    }

    return array($html, $pvp);
}

function pdfFilaSubtotal($pvp)
{
    return '
            <tr><td colspan="3" style="height:9px;"></td></tr>
            <tr>
                <td colspan="3">
                    <table style="width:100%; border-collapse:separate; border-spacing:6px 0;">
                        <tr>
                            <td style="text-align:right; font-weight:bold; font-style:italic;">Subtotal sin IVA:</td>
                            <td style="width:90px; background:#d9d9d9; font-weight:bold; font-style:italic; text-align:right; padding:2px 4px;">' . pdfEuros($pvp) . '</td>
                        </tr>
                    </table>
                </td>
            </tr>';
}

function pdfCabeceraCondiciones($pagina)
{
    return '
    <table style="width:100%; border-collapse:collapse; margin-bottom:8px;">
        <tr>
            <td style="width:160px;"><img src="/config/img/logo-pscover.png" style="width:130px; height:auto;"></td>
            <td style="text-align:center; font-size:10px; font-weight:bold; text-decoration:underline;">CONDICIONES GENERALES</td>
            <td style="width:110px; text-align:right;"><div style="display:inline-block; border:1px solid #000; padding:2px 20px; font-weight:bold; font-style:italic; white-space:nowrap;">P&aacute;gina: ' . $pagina . ' / 3</div></td>
        </tr>
    </table>';
}

function pdfFirma($codigoPresupuesto)
{
    return '
        <div style="text-align:center; margin-top:14px;">
            <b>Aceptaci&oacute;n de presupuesto n&ordm; ' . pdfTexto($codigoPresupuesto) . ' y Condiciones Generales:</b>
            <div style="width:200px; height:80px; border:1px solid #000; margin:8px auto 0;"></div>
        </div>';
}

function obtenerPresupuestoPdf($conn, $presupuesto, $datosClienteFinal)
{
    $codigo = mysqli_real_escape_string($conn, $presupuesto);

    $sql = "SELECT P.CODIGO, P.TITULO, P.FECHA, P.CODIGO_WEB, P.DESCRIPCION_CLIENTE,
                   F.DESCRIPCION AS FORMADEPAGO
              FROM PRESUPUESTOS P
              LEFT JOIN CLIENTES C   ON P.CLIENTE     = C.CODIGO
              LEFT JOIN FORMASPAGO F ON C.FORMADEPAGO = F.CODIGO
             WHERE P.CODIGO_WEB = '$codigo'
                OR P.CODIGO     = '$codigo'";

    $res = mysqli_query($conn, $sql) or die("ERROR AL IMPRIMIR " . mysqli_error($conn));
    $row = mysqli_fetch_object($res);

    $codigoPresupuesto = !empty($row->CODIGO) ? $row->CODIGO : $row->CODIGO_WEB;
    $titulo = trim((string) $row->DESCRIPCION_CLIENTE) !== '' ? $row->DESCRIPCION_CLIENTE : $row->TITULO;
    $formaPago = trim((string) $row->FORMADEPAGO) !== '' ? $row->FORMADEPAGO : '50% transferencia y 50% antes de la entrega';

    // Líneas de producto
    list($filasProducto, $pvpProducto) = pdfFilasLineas(pdfLineas($conn, $codigoPresupuesto, false), true);

    // Instalación
    list($filasInstalacion, $pvpInstalacion) = pdfFilasLineas(pdfLineas($conn, $codigoPresupuesto, true), false);

    // Se muestra solo el PVP (sin descuentos) más IVA
    $baseImponible = round($pvpProducto + $pvpInstalacion, 2);
    $total = round($baseImponible * 1.21, 2);

    $gris = '#c8c8c8';
    $celdaDato = 'border:1px solid #000; padding:2px 4px;';

    $html = '
<div style="font-family: Arial, Helvetica, sans-serif; font-size:7px; color:#000; line-height:1.3;">

    <!-- ===================== PÁGINA 1 ===================== -->
    <div style="min-height:1040px; display:flex; flex-direction:column;">

        <div style="border:1px solid #000;">
            <div style="background:' . $gris . '; border-bottom:1px solid #000; text-align:center; font-size:10px; font-weight:bold; letter-spacing:1px; padding:2px;">PRESUPUESTO</div>

            <table style="width:100%; border-collapse:collapse;">
                <tr>
                    <td style="width:52%; vertical-align:top; padding:6px 8px;">
                        <img src="/config/img/logo-pscover.png" style="width:130px; height:auto;"><br>
                        <div style="margin-top:6px; font-size:8px; font-weight:bold;">C.I.F. B-42691709</div>
                        <div style="margin-top:4px;">
                            PS-POOL AUTOMATIC COVER SL<br>
                            AV. BENIDORM, N&ordm; 12<br>
                            POL&Iacute;GONO INDUSTRIAL LA ALBERCA<br>
                            03530 LA NUC&Iacute;A (ALICANTE)<br>
                            e-mail: info@ps-cover.com
                        </div>
                        <div style="display:inline-block; border:1px solid #000; padding:2px 20px; margin-top:6px; font-weight:bold; font-style:italic;">P&aacute;gina: 1 / 3</div>
                    </td>
                    <td style="width:48%; vertical-align:top; padding:6px 8px; border-left:1px solid #000;">
                        <table style="width:100%; border-collapse:collapse; margin-bottom:2px;">
                            <tr>
                                <td style="' . $celdaDato . ' width:50%; text-align:right; font-weight:bold;">FECHA</td>
                                <td style="' . $celdaDato . ' text-align:center;">' . pdfFecha($row->FECHA) . '</td>
                            </tr>
                            <tr>
                                <td style="' . $celdaDato . ' text-align:right; font-weight:bold;">C&Oacute;DIGO PRESUPUESTO</td>
                                <td style="' . $celdaDato . ' text-align:center;">' . pdfTexto($codigoPresupuesto) . '</td>
                            </tr>
                        </table>
                        <!-- Datos que el cliente rellena en el formulario (tabla HTML ya escapada en scriptPS.JS) -->
                        <style>.pdf-cliente table { font-size:inherit; width:auto !important; } .pdf-cliente td { padding:1px 10px 1px 0; vertical-align:top; color:#000; } .pdf-cond li { margin-bottom:2px; }</style>
                        <div style="margin-top:6px; font-weight:bold; font-style:italic;">DATOS DEL CLIENTE</div>
                        <div class="pdf-cliente" style="margin-top:2px;">' . $datosClienteFinal . '</div>
                    </td>
                </tr>
            </table>
        </div>

        <div style="background:' . $gris . '; text-align:center; font-weight:bold; font-style:italic; font-size:10px; padding:3px; margin-top:4px;">' . pdfTexto($titulo) . '</div>

        <table style="width:100%; border-collapse:collapse; margin-top:4px;">
            <tr style="background:' . $gris . '; font-weight:bold;">
                <td style="width:18px; border:1px solid #000; padding:1px 2px;">L.</td>
                <td style="width:40px; border:1px solid #000; padding:1px 4px;">C&Oacute;D.</td>
                <td style="border:1px solid #000; text-align:center;">DESCRIPCI&Oacute;N</td>
            </tr>
            <tr><td colspan="3" style="background:#e6e6e6; height:10px;"></td></tr>
            ' . $filasProducto . '
            ' . pdfFilaSubtotal($pvpProducto) . '
            <tr><td colspan="3" style="height:6px;"></td></tr>
            <tr><td colspan="3" style="background:' . $gris . '; font-weight:bold; font-style:italic; padding:2px 4px;">INSTALACI&Oacute;N CUBIERTA</td></tr>
            ' . $filasInstalacion . '
            ' . pdfFilaSubtotal($pvpInstalacion) . '
        </table>

        <!-- Hueco flexible: empuja el pie al final de la primera página -->
        <div style="flex:1 1 auto;"></div>

        <div style="border:1px solid #000; padding:5px 8px; width:55%; margin-bottom:6px;">
            ENTIDADES BANCARIAS<br><br>
            SANTANDER &nbsp; IBAN: ES65 0049 6979 6223 1000 9031
        </div>

        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <td style="width:64%; vertical-align:top; border:1px solid #000; padding:0;">
                    <div style="background:' . $gris . '; border-bottom:1px solid #000; text-align:center; font-weight:bold; padding:2px;">FORMA DE PAGO</div>
                    <div style="padding:3px 4px; min-height:80px;">' . pdfTexto($formaPago) . '</div>
                </td>
                <td style="width:1%;"></td>
                <td style="width:35%; vertical-align:top; border:1px solid #000; padding:0;">
                    <div style="background:#ffff00; border-bottom:1px solid #000; text-align:center; font-weight:bold; font-style:italic; font-size:8px; padding:2px;">Oferta v&aacute;lida 60 d&iacute;as</div>
                    <table style="width:100%; border-collapse:collapse; margin:4px 0; font-size:10px;">
                        <tr>
                            <td style="text-align:right; font-weight:bold; padding:2px 6px;">% DTO.</td>
                            <td style="text-align:right; border-bottom:1px solid #000; padding:2px 6px;">0,00 %</td>
                        </tr>
                        <tr>
                            <td style="text-align:right; font-weight:bold; padding:2px 6px;">BASE IMPONIBLE</td>
                            <td style="text-align:right; border-bottom:1px solid #000; padding:2px 6px;">' . pdfEuros($baseImponible) . '</td>
                        </tr>
                        <tr>
                            <td style="text-align:right; font-weight:bold; padding:2px 6px;">% IVA</td>
                            <td style="text-align:right; border-bottom:1px solid #000; padding:2px 6px;">21%</td>
                        </tr>
                        <tr>
                            <td style="text-align:right; font-weight:bold; font-style:italic; font-size:10px; padding:6px 6px 2px;">TOTAL</td>
                            <td style="padding:6px 6px 2px;"><div style="background:#ffff00; border:1px solid #000; text-align:right; font-weight:bold; font-size:10px; padding:2px 4px;">' . pdfEuros($total) . '</div></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div style="margin-top:8px; font-size:5.5px; color:#1f3c88; line-height:1.3;">
            Informaci&oacute;n sobre protecci&oacute;n de datos.<br>
            De conformidad con lo dispuesto en el RGPD y la LOPDGDD, informamos que los datos personales ser&aacute;n tratados por PS POOL AUTOMATIC COVER, S.L., con la finalidad de posibilitar las comunicaciones a trav&eacute;s del correo electr&oacute;nico. Puede solicitar m&aacute;s informaci&oacute;n y ejercer sus derechos escribiendo a info@ps-cover.com.
            En virtud de la LSSICE, este mensaje y sus archivos adjuntos pueden contener informaci&oacute;n confidencial, por lo que queda informado de que su uso no autorizado est&aacute; prohibido por la ley. Si ha recibido este mensaje por equivocaci&oacute;n, por favor notif&iacute;quelo inmediatamente a trav&eacute;s de esta misma v&iacute;a y borre el mensaje original junto con sus ficheros adjuntos sin leerlo o grabarlo total o parcialmente.
        </div>
    </div>

    <div class="html2pdf__page-break"></div>

    <!-- ===================== PÁGINA 2 ===================== -->
    <div class="pdf-cond" style="font-size:10px; line-height:1.35; min-height:1040px; display:flex; flex-direction:column; justify-content:space-between;">
        ' . pdfCabeceraCondiciones(2) . '
        <div><b>GARANT&Iacute;AS</b>
        <ul style="margin:3px 0 0; padding-left:18px;">
            <li>Motor y cuadro el&eacute;ctrico: 2 a&ntilde;os</li>
            <li>Lama de PVC opacas: 2 a&ntilde;os</li>
            <li>Lamas de Policarbonato: 3 a&ntilde;os</li>
        </ul></div>
        <div>La garant&iacute;a <b>incluye:</b>
        <ul style="margin:3px 0 0; padding-left:18px;">
            <li>Esta garant&iacute;a cubre, en general, cualquier defecto de fabricaci&oacute;n.</li>
            <li>Cubre todo el equipo el&eacute;ctrico (motores, buen funcionamiento de los finales de carrera y cuadro), con la condici&oacute;n expresa de que el cableado entre el cuadro y el motor haya sido instalado de acuerdo con las instrucciones que se proporcionan, y especialmente en lo que se refiere a la secci&oacute;n del cable y su longitud.</li>
            <li>La garant&iacute;a se har&aacute; efectiva &uacute;nicamente cuando las piezas hayan sido devueltas a f&aacute;brica para su examen y cuando, una vez revisadas en f&aacute;brica, se determine que se trata de un defecto o fallo de fabricaci&oacute;n.</li>
            <li>La garant&iacute;a est&aacute; limitada a la sustituci&oacute;n de las piezas que sean defectuosas y no incluye los gastos de desmontaje y montaje, ni tampoco da&ntilde;os y perjuicios.</li>
        </ul></div>
        <div>La garant&iacute;a <b>no incluye:</b>
        <ul style="margin:3px 0 0; padding-left:18px;">
            <li>Deterioros debidos al transporte (ver apartado de transporte).</li>
            <li>Montajes o instalaciones defectuosas o no conformes con nuestro manual de instalaci&oacute;n.</li>
            <li>Modificaciones del material sin el consentimiento del fabricante.</li>
            <li>Error de conexi&oacute;n o de tensi&oacute;n.</li>
            <li>Desgastes debidos a una mala instalaci&oacute;n del eje.</li>
            <li>Desgastes del motor y cuadro provocados por no respetar las reglas de conexi&oacute;n.</li>
            <li>Da&ntilde;os debidos a tormentas el&eacute;ctricas.</li>
            <li>PS Cover declina cualquier responsabilidad por los da&ntilde;os f&iacute;sicos o materiales que se pudieran producir en el caso de que la cubierta haya sido instalada sin alguno de los elementos que se indican en el manual de instalaci&oacute;n.</li>
        </ul></div>
        <div><b>RECOMENDACIONES</b>
        <ul style="margin:3px 0 0; padding-left:18px;">
            <li>Cuando la cubierta est&aacute; cerrada es recomendable poner peri&oacute;dicamente en funcionamiento la filtraci&oacute;n.</li>
            <li>No dejar nunca las lamas al aire libre sin protecci&oacute;n o sin que est&eacute;n en contacto con el agua.</li>
            <li>No caminar nunca sobre la cubierta.</li>
            <li>En el caso de piscinas desbordantes, tomar las precauciones necesarias para estar seguro de que la piscina no desbordar&aacute; si se produce una tormenta.</li>
            <li>Eliminar de la superficie de la cubierta las hojas y otros residuos ya que, de lo contrario, pueden aparecer con rapidez manchas irreversibles en las lamas. Se trata de un proceso biol&oacute;gico que no est&aacute; cubierto por nuestra garant&iacute;a.</li>
            <li>Es recomendable instalar una toma de tierra, y es absolutamente imprescindible en aquellas piscinas en las que existe un aparato de electr&oacute;lisis salina.</li>
        </ul></div>
        <div><b>ACLARACIONES</b>
        <ul style="margin:3px 0 0; padding-left:18px;">
            <li>La cubierta se calcula con forma rectangular. Los recortes se presupuestar&aacute;n aparte.</li>
            <li>Es necesario dejar instalado, previamente a la colocaci&oacute;n de la cubierta, un tubo corrugado o tubo flexible empotrado a la altura del eje del enrollador para pasar por su interior el cable del motor.</li>
            <li>La cubierta tendr&aacute; de anchura 3 cm menos con respecto al ancho de la piscina como margen para permitir su correcto deslizamiento.</li>
            <li>Se incluye mando a distancia.</li>
            <li>El cuadro el&eacute;ctrico presenta un interruptor de 3 posiciones para utilizar en caso de p&eacute;rdida del mando.</li>
            <li>La instalaci&oacute;n de la cubierta no est&aacute; incluida en el precio, pero disponemos de servicio t&eacute;cnico que podr&iacute;a realizarla. Consultar presupuesto y disponibilidad en funci&oacute;n de zona geogr&aacute;fica.</li>
            <li>Comunicar cualquier modificaci&oacute;n, ya que puede suponer cambios en el presupuesto.</li>
        </ul></div>
        ' . pdfFirma($codigoPresupuesto) . '
    </div>

    <div class="html2pdf__page-break"></div>

    <!-- ===================== PÁGINA 3 ===================== -->
    <div class="pdf-cond" style="font-size:10px; line-height:1.35; min-height:1040px; display:flex; flex-direction:column; justify-content:space-between;">
        ' . pdfCabeceraCondiciones(3) . '
        <div><b>PLAZOS</b>
        <ul style="margin:3px 0 0; padding-left:18px;">
            <li>Fabricaci&oacute;n: 1 semana desde la recepci&oacute;n de la hoja de fabricaci&oacute;n. La producci&oacute;n de la cubierta no se iniciar&aacute; hasta que no se reciba la hoja de fabricaci&oacute;n completamente rellena. No se planificar&aacute; ni iniciar&aacute; la producci&oacute;n de ninguna cubierta cuya hoja de fabricaci&oacute;n* est&eacute; incompleta.
                (<i>*Todos los datos que se solicitan en la hoja de fabricaci&oacute;n son necesarios para asegurar la correcta fabricaci&oacute;n de la cubierta, ya que esta se realizar&aacute; siguiendo las medidas exactas recogidas en ese documento; por ello es muy importante no dejar ning&uacute;n campo sin completar. En el caso de piscinas con escaleras integradas es preciso completar tambi&eacute;n el Anexo: medidas escalera.</i>)</li>
            <li>Entrega: 2 semanas desde el inicio de la producci&oacute;n, para Pen&iacute;nsula y Baleares.</li>
        </ul></div>
        <div><b>TRANSPORTE Y ENTREGA</b>
        <ul style="margin:3px 0 0; padding-left:18px;">
            <li>La cubierta ser&aacute; entregada en la direcci&oacute;n que se indica en la hoja de fabricaci&oacute;n por un cami&oacute;n tr&aacute;iler, que no cuenta con medios de descarga, y dentro de una caja de embalaje de protecci&oacute;n paletizada.</li>
            <li>El cliente debe asegurarse de que es posible el acceso de un cami&oacute;n de gran volumen hasta la direcci&oacute;n que se ha indicado, sin que existan impedimentos tales como cables, &aacute;rboles, v&iacute;as demasiado estrechas, etc.</li>
            <li>En el caso de que el acceso de un cami&oacute;n tr&aacute;iler no sea posible, o que no se disponga de los medios de descarga necesarios, es preciso comunicarlo con antelaci&oacute;n para realizar la entrega en un cami&oacute;n especial, con un coste adicional.</li>
            <li>En el transporte NO se incluyen gr&uacute;a, torito, descarga de la mercanc&iacute;a, camiones especiales, 2&ordf; entregas por causas no atribuibles a PS Pool, permisos especiales, etc.</li>
            <li>El cliente deber&aacute; tener previstos los medios necesarios para la descarga de la caja y su traslado hasta el lugar en que se va a instalar la cubierta.</li>
            <li>En el momento de recepcionar la mercanc&iacute;a hay que asegurarse de que la caja no ha sufrido golpes y est&aacute; intacta. Incluso aunque no se observe da&ntilde;o aparente, se deber&aacute; abrir el embalaje y, en caso de da&ntilde;os, notificarlo en un plazo no superior a 24 horas. En este caso hay que hacerlo constar en el albar&aacute;n de la empresa de transporte, realizar unas fotograf&iacute;as y notificarlo inmediatamente. Si en el justificante de entrega no se ha comunicado ning&uacute;n desperfecto, el responsable del da&ntilde;o ser&aacute; el receptor de la mercanc&iacute;a. Estas medidas son ajenas a PS Cover y responden a la Ley de Contrato de Transporte Terrestre de mercanc&iacute;as.</li>
            <li>PS Cover no correr&aacute; con los gastos de cualquier cambio, retraso o modificaci&oacute;n que se produzca en el transporte y entrega de la cubierta y cuyas causas no le sean directamente atribuibles.</li>
        </ul></div>
        <div><b>ACLARACIONES ESPEC&Iacute;FICAS PARA CADA MODELO DE CUBIERTA</b>
        <ul style="margin:3px 0 0; padding-left:18px;">
            <li>TERRA: En el caso de que la coronaci&oacute;n tenga voladizo ser&aacute; necesario realizar un recorte en la coronaci&oacute;n de 30 cm para permitir el funcionamiento correcto de la cubierta. M&aacute;s detalles: consultar FICHA T&Eacute;CNICA CUBIERTA TERRA.</li>
            <li>PACIFIC DECK: Medidas del caj&oacute;n 75 x 80 cm para cubiertas de hasta 15 m de longitud. M&aacute;s detalles: consultar FICHA T&Eacute;CNICA PACIFIC DECK.</li>
            <li>PACIFIC TOP: Las medidas del caj&oacute;n deben ser de 80 cm de alto y 77 cm de ancho para cubiertas de hasta 15 m de longitud. M&aacute;s detalles: consultar FICHA T&Eacute;CNICA PACIFIC TOP.</li>
            <li>PACIFIC CAVE: Las esquinas del extremo de la piscina en el que ir&aacute; ubicado el enrollador deben ser a 90&deg; para garantizar la correcta instalaci&oacute;n del enrollador y de las tapas. M&aacute;s detalles: consultar FICHA T&Eacute;CNICA PACIFIC CAVE.</li>
            <li>PACIFIC DUO: Las medidas del caj&oacute;n ser&aacute;n de 74 x 74 cm + 7 cm de separaci&oacute;n de la pared. M&aacute;s detalles: consultar FICHA T&Eacute;CNICA PACIFIC DUO.</li>
        </ul></div>
        ' . pdfFirma($codigoPresupuesto) . '
    </div>
</div>';

    return $html;
}
