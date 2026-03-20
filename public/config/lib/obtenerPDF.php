<?

/* error_reporting(E_ALL);
ini_set('display_errors', 1); */

mb_internal_encoding("UTF-8");

require_once "./TCPDF/config/tcpdf_config.php";
require_once "./TCPDF/tcpdf.php";

$conn = mysqli_connect('localhost', 'limpiafo_config', '5$gMgw(n@qEf', 'limpiafo_YlBn4V');
//$conn = mysqli_connect('172.26.0.8', 'root', '', 'pscover');

//$presupuesto = $_POST['presupuesto'];
$presupuesto = $_GET['presupuesto'];

class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        // Logo
        $this->Image('../img/logo-aquanatur.jpg', 10, 8, 50);
        // Set font
        $this->SetFont('helvetica', 'B', 10);
        // Title

        $this->setXY(135, 10);
        //$this->Cell(0, 15, utf8_encode('Hoja de fabricacion Terra'), 0, false, 'R', 0, '', 0, false, 'L', 'R');
        $this->Cell(50, 10, 'CONDICIONES GENERALES', false, false, 'C', 0, '', 50, false, 'T', 'M');

        $this->setXY(270, 10);
        $this->Cell(20, 10, $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), false, false, 'C', 0, '', 50, false, 'T', 'M');
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-30);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        //$this->Cell(0, 10, $this->getAliasNumPage(). '/' .$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

        $html = '<span style="font-size:10px; line-height:10px">Informaci&oacute;n b&aacute;sica sobre Protecci&oacute;n de Datos: Se garantiza el estricto cumplimento de la normativa vigente sobre protecci&oacute;n de datos de car&aacute;cter personal, inform&aacute;ndole que la finalidad de dicho tratamiento es la gesti&oacute;n contable, fiscal y administrativa de los datos facilitados. La base jur&iacute;dica del tratamiento est&aacute; basada en el consentimiento. NO CEDEMOS DATOS A TERCEROS salvo en aqu&eacute;llos supuestos en que la cesi&oacute;n resulte imprescindible para el correcto cumplimiento de la relaci&oacute;n establecida. Los derechos de acceso, rectificaci&oacute;n, supresi&oacute;n, limitaci&oacute;n de tratamiento, u oposici&oacute;n al tratamiento, as&iacute; como el derecho a la portabilidad de los datos podr&aacute;n ser ejercitados ante el Responsable del tratamiento por cualquier medio sujeto en derecho acompa&ntilde;ando de copia de documento oficial que le identifique: PS POOL AUTOMATIC COVER, S.L., con domicilio en POL. IND. LA ALBERCA C/ BENIFATO 21 - C.P. 03530 LA NUCIA (ALICANTE) o en la direcci&oacute;n electr&oacute;nica: info@ps-cover.com adjuntando fotocopia de su DNI, seg&uacute;n los t&eacute;rminos que la normativa aplicable establece. Puede consultar la informaci&oacute;n adicional y detallada en protecci&oacute;n de datos en nuestros Sitios Web http://www.ps-cover.com.</span>';

        $this->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
    }
}

//OBTENEMOS LOS DATOS QUE NECESITAMOS ANTES DE GENERAR EL PDF
$sql = "SELECT P.CODIGO, P.TITULO, P.DESCRIPCION, P.FECHA, P.TOTAL, P.CODIGO_WEB, P.COMENTARIO_INTERNO AS DATOS_CLIENTE_FINAL,
               P.DESCRIPCION_CLIENTE,

               C.CODIGO AS CLIENTE, C.ALIAS, C.DIRECCION, C.POBLACION, C.CIF, C.PROVINCIA, C.TELEFONOFIJO,
               C.FAX, C.CP, C.CORREO,

               F.DESCRIPCION AS FORMADEPAGO

          FROM PRESUPUESTOS P
          LEFT JOIN CLIENTES C   ON P.CLIENTE     = C.CODIGO
          LEFT JOIN FORMASPAGO F ON C.FORMADEPAGO = F.CODIGO
         WHERE P.CODIGO_WEB = '$presupuesto'
            OR P.CODIGO     = '$presupuesto'";

$res = mysqli_query($conn, $sql) or die("ERROR AL IMPRIMIR $sql " . mysqli_error($conn));
$row = mysqli_fetch_object($res);

$codigoPresupuesto = (empty($codigoPresupuesto)) ? $row->CODIGO_WEB : $row->CODIGO;

$tituloPresupuesto      = $row->TITULO;
$descPresupuesto        = $row->DESCRIPCION;
$descripcionCliente     = $row->DESCRIPCION_CLIENTE;
$fechaPresupuesto       = $row->FECHA;
$totalPresupuesto       = (float) $row->TOTAL;
$clientePresupuesto     = utf8_encode($row->CLIENTE);
$aliasPresupuesto       = utf8_encode($row->ALIAS);
$direccion1Presupuesto  = utf8_encode($row->DIRECCION);
$poblacionPresupuesto   = utf8_encode($row->POBLACION);
$CIFPresupuesto         = $row->CIF;
$provinciaPresupuesto   = $row->PROVINCIA;
$formaPagoPresupuesto   = $row->FORMADEPAGO;
$telefonoFijoPresupuesto = $row->TELEFONOFIJO;
$fax1Presupuesto        = $row->FAX;
$cp1Presupuesto         = $row->CP;
$correoPresupuesto      = $row->CORREO;
$datosClienteFinal      = $row->DATOS_CLIENTE_FINAL;

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A3', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('PS-COVER');
$pdf->SetTitle('Presupuesto - ' . $codigoPresupuesto);
$pdf->SetSubject('Presupuesto cubierta');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(5, 5, 5);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(5);

// set auto page breaks
$pdf->SetAutoPageBreak(true, 30);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 11, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.


$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
/* PRESUPUESTO */

$pdf->AddPage();

$html = '<style>
    .alert {
        position: relative;
        padding: 0.75rem 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: 0.25rem;
    }
    .alert-warning {
        color: #856404;
        background-color: #fff3cd;
        border-color: #ffeeba;
    }

    .alert-warning hr {
        border-top-color: #ffe8a1;
    }
    .align-self-start {
        -ms-flex-item-align: start !important;
        align-self: flex-start !important;
    }
    .border{
        border: 1px solid #343a40;
    }
    .border-top-0 {
        border-top: 0 !important;
    }

    .border-right-0 {
        border-right: 0 !important;
    }

    .border-bottom-0 {
        border-bottom: 0 !important;
    }

    .border-left-0 {
        border-left: 0 !important;
    }
    .col-6 {
        -ms-flex: 0 0 50%;
        flex: 0 0 50%;
        max-width: 50%;
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
    }
    .col-12 {
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
    }
    .d-flex {
        display: -ms-flexbox !important;
        display: flex !important;
    }
    .img-fluid {
        max-width: 100%;
        height: auto;
        width: auto;
    }
    .mt-0,
    .my-0 {
    margin-top: 0 !important;
    }
    .mt-2,
    .my-2 {
    margin-top: 0.5rem !important;
    }
    .mb-0,
    .my-0 {
    margin-bottom: 0 !important;
    }
    .flex-column {
        -ms-flex-direction: column !important;
        flex-direction: column !important;
    }
    .w-100 {
        width: 100% !important;
    }
    .w-50 {
        width: 50% !important;
    }
    .h-100 {
        height: 100% !important;
    }
    .text-center {
        text-align: center !important;
        vertical-align: middle !important;
    }
    .text-right {
        text-align: right !important;
    }
    .p-2 {
        padding: 0.5rem !important;
    }
    .p-3 {
        padding: 1rem !important;
    }
    .row {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    }
    .table {
        border-collapse: collapse !important;
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
    }


    .table-sm th,
    .table-sm td {
    padding: 0.3rem;
    }
</style>
<div class="h-100 d-flex flex-column align-self-start pages">
<table cols="2" border style="-ms-flex-line-pack: center; align-content: center;" class="border row no-gutters justify-content-end align-content-center">
    <thead class="thead-light"><tr><th colspan="3" style="background-color: #3dadf1;"><h3 class="mb-0 text-center w-100"><span><b>PRESUPUESTO ' . $codigoPresupuesto . '</b></span></h3></th></tr>
    </thead>
    <tbody>
        <tr><td></td><td></td></tr>

        <tr class="border">
            <td colspan="2"><img class="p-3 img-fluid" style="width:150px;" src="./img/logo-aquanatur.jpg"></td>
            <td>
                <table>
                    <thead>
                        <tr>
                            <th><div><span class="text-right"><b>FECHA</b></span></div></th>
                            <th><div><span class="text-center border">' . $fechaPresupuesto . '</span></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><span class="text-right border"><b>C&Oacute;DIGO PRESUPUESTO</b></span></td>
                            <td><span class="text-center border">' . $codigoPresupuesto . '</span></td>
                        </tr>
                    </tbody>
                </table>
                <br><br>
            </td>
        </tr>

        <tr>
            <td></td>
            <td></td>
            <td><hr></td>
        </tr>

        <tr>
            <td>
                <span>C.I.F. B-42691709</span><br>
                <span>PS-POOL AUTOMATIC COVER SL</span><br>
                <span>POL. IND. LA ALBERCA, C/BENIFATO 21</span><br>
                <span>03530 - LA NUCIA</span><br>
                <span>E-mail: info@ps-cover.com</span>
            </td>
            <td></td>
            <td>
                <div>
                    <span><b>' . $clientePresupuesto . ' - ' . $aliasPresupuesto . '</b></span> <br>
                    <span>' . $direccion1Presupuesto . '</span> <br>
                    <span>' . $cp1Presupuesto . ' - ' . $poblacionPresupuesto . '</span> <br>
                    <span>' . $provinciaPresupuesto . '</span> <br>
                    <span>TLF: ' . $telefonoFijoPresupuesto . '</span> <br>
                    <span>FAX: ' . $fax1Presupuesto . '</span> <br>
                    <span>E-MAIL: ' . $correoPresupuesto . '</span> <br>
                    <span>CIF: ' . $CIFPresupuesto . '</span>
                </div>
            </td>
        </tr>

        <tr><td colspan="3"></td></tr>

        <tr>
            <td colspan="3" style="background-color: #3dadf1;">
                <span class="text-center w-100"><b>' . $tituloPresupuesto . '</b></span>
            </td>
        </tr>
    </tbody>
</table>

    <br>

    <div class="mt-2">

        <table class="table table-borderless table-sm">
            <thead class="thead-light">
                <tr>
                    <th style="background-color: #e8ecef" width="30" class="border">L.</th>
                    <th style="background-color: #e8ecef" width="90" class="border">C&Oacute;D.</th>
                    <th style="background-color: #e8ecef" width="880" class="text-center border">DESCRIPCI&Oacute;N</th>
                </tr>
            </thead>
            <tbody><tr><td></td><td></td><td></td></tr>';

$importeBloque1 = 0;
$importeFinalBloque1 = 0;

//OBTENEMOS LAS LINEAS
$sql = "SELECT L.LINEA, L.COMENTARIO, L.ARTICULO, L.CANTIDAD, L.PVP, L.PVP_FINAL,
                   REPLACE(A.DESCRIPCION, '€', '&euro;') AS DESCARTICULO
              FROM LINPRESU L
              LEFT JOIN ARTICULOS A    ON L.ARTICULO = A.CODIGO
              LEFT JOIN PRESUPUESTOS P ON P.CODIGO_WEB = L.PRESUPUESTO_WEB
             WHERE SUBCUENTA IS NULL
               AND ((P.CODIGO = '$codigoPresupuesto') OR (P.CODIGO_WEB = '$codigoPresupuesto'))";

$res = mysqli_query($conn, utf8_encode($sql));
while ($row = mysqli_fetch_object($res)) {
    //print_r($row);

    $lineaPresu         = $row->LINEA;
    $comentarioPresu    = $row->COMENTARIO;
    $articuloPresu      = $row->ARTICULO;
    $descArticulo       = sanearString($row->DESCARTICULO);
    $cantidadLinea      = $row->CANTIDAD;
    $PVPLinea           = $row->PVP;
    $PVPFinal           = $row->PVP_FINAL;

    $importeBloque1      = $importeBloque1      + ((float) $cantidadLinea * (float) $PVPLinea);
    $importeFinalBloque1 = $importeFinalBloque1 + ((float) $cantidadLinea * (float) $PVPFinal);

    $html .= '
        <tr>
            <td width="30" height="30" class="p-3 text-center align-middle" style="background-color: #c0c0c0;">' . $lineaPresu . '</td>
            <td width="90"><b>' . $articuloPresu . '</b></td>
            <td width="880"><b>' . $descArticulo  . '</b></td>
        </tr>';
}


$dtoBloque1 = round(100 - (($importeFinalBloque1) * 100) / $importeBloque1, 2);

$html .= '<tr>
                <td></td>
                <td></td>
                <td>
                    <div class="text-right">
                        <span style="background-color: #c0c0c0" class="pl-2 pr-1"><b>Subtotal sin IVA: </b></span>
                        <span style="background-color: #c0c0c0" class="pl-5 pr-1 ml-3"><b>' . round($importeBloque1, 2) . ' &euro;</b></span>
                        <span style="background-color: #c0c0c0" class="pl-3 pr-1 ml-1"><b>' . $dtoBloque1 . '%</b></span>
                        <span style="background-color: #c0c0c0" class="pl-5 pr-1 ml-1"><b>' . round($importeFinalBloque1, 2) . ' &euro;</b></span>
                    </div>
                </td>
              </tr>
              <tr><td></td><td></td><td></td></tr>';

//OBTENEMOS LA INSTALACION
$sql = "SELECT L.LINEA, L.COMENTARIO, L.ARTICULO, L.PVP, L.PVP_FINAL,
                    A.DESCRIPCION AS DESCARTICULO
                FROM LINPRESU L
                LEFT JOIN ARTICULOS A    ON L.ARTICULO = A.CODIGO
                LEFT JOIN PRESUPUESTOS P ON P.CODIGO_WEB = L.PRESUPUESTO_WEB
                WHERE SUBCUENTA IS NOT NULL
                AND ((P.CODIGO = '$codigoPresupuesto') OR (P.CODIGO_WEB = '$codigoPresupuesto'))";

$res = mysqli_query($conn, $sql) or die("SQL ERROR $sql" . mysqli_error($conn));
$row = mysqli_fetch_object($res);

$lineaPresu         = $row->LINEA;
$comentarioPresu    = $row->COMENTARIO;
$articuloPresu      = $row->ARTICULO;
$descArticulo       = sanearString($row->DESCARTICULO);
$importe            = $row->PVP;
$importeFinal       = $row->PVP_FINAL;

$html .= '<tr style="height:5px;">
                <td style="background-color: #c0c0c0"></td>
                <td style="background-color: #c0c0c0"></td>
                <td style="background-color: #c0c0c0; height:"><b><i>INSTALACI&Oacute;N CUBIERTA</i></b></td>
              </tr>
              <tr style="height:5px;"><td></td><td></td><td></td></tr>
              <tr class="mt-1">
                <th class="p-3 text-center" style="background-color: #c0c0c0">' . $lineaPresu . '</th>
                <td><b>' . $articuloPresu . '</b></td> <td> <b>' . $descArticulo . '</b></td>
              </tr>';

$dtoPresupuesto = round(100 - (($importeFinal) * 100) / $importe, 2);
if ($dtoPresupuesto == "-0") {
    $dtoPresupuesto = 0;
}

$totalPresupuesto21 = round($totalPresupuesto * 1.21, 2);

$html .= ' </tbody>
            </table>
            <div class="text-right w-100">
                <span style="background-color: #c0c0c0" class="pl-2 pr-1"><b>Subtotal sin IVA:</b></span>
                <span style="background-color: #c0c0c0" class="pl-5 pr-1 ml-3"><b>' . round($importe, 2) . ' &euro;</b></span>
                <span style="background-color: #c0c0c0" class="pl-3 pr-1 ml-1"><b>' . $dtoPresupuesto . '%</b></span>
                <span style="background-color: #c0c0c0" class="pl-5 pr-1 ml-1"><b>' . round($importeFinal, 2) . ' &euro;</b></span>
            </div>
        </div><!-- fin de container-fluid -->
        <div class="alert alert-warning" style="padding: 10px" role="alert" > <strong>Nota: </strong>Presupuesto pendiente de medidas definitivas </div>
        <br>
        <table>
            <thead>
                <tr>
                    <th class="text-center border" style="background-color: #c0c0c0"><b>FORMA DE PAGO</b></th>
                    <th class="text-center border" style="background-color: #c0c0c0"><b>Oferta v&aacute;lida 30 d&iacute;as</b> </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border"> <span>50% transferencia y 50% segun condiciones de CYC</span> </td>
                    <td class="border">
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-right"><u>% DTO</u></th>
                                    <th class="text-right"><u>0.00%</u></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><u>BASE IMPONIBLE</u></td>
                                    <td class="text-right"><u>' . round($totalPresupuesto, 2) . '&euro;</u></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td class="text-right"><u>% IVA</u></td>
                                    <td class="text-right"><u>21%</u></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><b><i>TOTAL</i></b></td>
                                    <td class="text-right"><div class="border" style="background-color: #ffff00; width:50px"> <b>' . round($totalPresupuesto21, 2) . '&euro;</b> </div></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    </div><!-- fin del col-12 -->';

//die($html);
//$html = utf8_encode($html);
//echo $html;
//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->writeHTML($html, true, false, false, false, '');

/* $html = utf8_encode('<meta name="viewport" content="width=device-width, initial-scale=1, no-cache"> </head> <body> <div id="contenedor"> <!-- membrete y cliente --> <div class="h-100 d-flex flex-column align-self-start pages"><div class="border row no-gutters border-dark justify-content-end align-content-center"> <div class="border col-12 border-top-0 border-left-0 border-right-0 border-dark" style="background-color: #3dadf1"> <h3 class="mb-0 text-center w-100"><span><b>PRESUPUESTO ' . $codigoPresupuesto . '</b></span></h3> </div> <div class="col-6"> <img class="p-3 img-fluid w-50" src="./img/logo-aquanatur.jpg"> <div class="m-3"> <span>C.I.F. B-42691709</span><br> <span>PS-POOL AUTOMATIC COVER SL</span><br> <span>POL. IND. LA ALBERCA, C/BENIFATO 21</span><br> <span>03530 - LA NUCIA</span><br> <span>e-mail: info@ps-cover.com</span> <div class="mt-2 row no-gutters"> <span class="p-2 text-center border border-dark col-5"><b>P&aacute;gina 1/3</b></span> </div> </div> </div> <div class="border col-6 border-top-0 border-right-0 border-bottom-0 border-dark"> <div class="m-2 border row no-gutters border-dark"> <span class="pr-2 text-right col-6"><b>FECHA</b></span> <span class="text-center border col-6 border-dark border-top-0 border-bottom-0 border-right-0">' . $fechaPresupuesto . '</span> </div> <div class="m-2 border row no-gutters border-dark"> <span class="pr-2 text-right col-6"><b>C&Oacute;DIGO PRESUPUESTO</b></span> <span class="text-center border col-6 border-dark border-top-0 border-bottom-0 border-right-0">' . $codigoPresupuesto . '</span> </div> <div class="m-2 row no-gutters"> <span class="col-12"><b>' . $clientePresupuesto . ' - ' . $aliasPresupuesto . '</b></span> <span class="col-12">' . $direccion1Presupuesto . '</span> <span class="col-12">' . $cp1Presupuesto . ' - ' . $poblacionPresupuesto . '</span> <span class="col-12">' . $provinciaPresupuesto . '</span> <span class="col-12">TLF: ' . $telefonoFijoPresupuesto . '</span> <span class="col-12">FAX: ' . $fax1Presupuesto . '</span> <span class="col-12">E-MAIL: ' . $correoPresupuesto . '</span> <span class="col-12">CIF: ' . $CIFPresupuesto . '</span> </div> </div> <div class="border col-12 border-bottom-0 border-left-0 border-right-0 border-dark" style="background-color: #3dadf1"> <h5 class="mb-0 text-center w-100"><span><b>' . $descripcionCliente . '</b></span></h5> </div> </div> <!-- Header pagina 1 --> <div class="mt-2"> <table class="table table-borderless table-sm"> <thead class="thead-light"> <tr> <th class="border border-dark">L.</th> <th class="border border-dark">C&Oacute;D.</th> <th class="text-center border border-dark w-100">DESCRIPCI&Oacute;N</th> </tr> </thead> <tbody>'); */

$pdf->SetMargins(5, PDF_MARGIN_TOP, 5);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

/* TERMINOS Y CONDICIONES */
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);

$pdf->AddPage();

$html = '<div class="h-100 pages d-flex flex-column">

    <div class="mt-3 container-fluid">
        <b>GARANT&Iacute;AS</b>
        <ul>
            <li>Motor y cuadro el&eacute;ctrico:  2 a&ntilde;os</li>
            <li>Lama de PVC opacas:  2 a&ntilde;os</li>
            <li>Lamas de Policarbonato:  3a&ntilde;os</li>
        </ul>
        La garant&iacute;a <b>incluye:</b>
        <ul class="listaGuiones">
            <li>Esta garant&iacute;a cubre, en general, cualquier defecto de frabricaci&oacute;n.</li>
            <li>Cubre todo el equipo el&eacute;ctrico (motores, buen funcionamiento de los finales de carrera y cuadro),
                con la condici&oacute;n expresa de que el cableado entre el cuadro y el motor haya sido instalado de acuerdo
                con las instrucciones que se proporcionan, y especialmente en lo que se refiere a la secc&oacute;n del cable
                y su longitud</li>
            <li>La garant&iacute;a se har&aacute; efectiva &uacute;nicamente cuando las piezas hayan sido devueltas a f&aacute;brica para su
                examen y cuando, una vez revisadas en f&aacute;brica, se determine que se trata de un defecto o fallo de
                fabricaci&oacute;n</li>
            <li>La garant&iacute;a est&aacute; limitidad a la sustituci&oacute;n de las piezas que sean defectuosas y no incluye los gastos de
                desmontaje y montaje, ni tampoco da&ntilde;os y perjuicios.</li>
        </ul>
        La garant&iacute;a <b>no incluye:</b>
        <ul class="listaGuiones">
            <li>Deteriores debidos al transporte. (ver apartado de transporte)</li>
            <li>Montajes o instalaciones defectuosas o no conformes con nuestro manual de instalaci&oacute;n</li>
            <li>Modificaciones del material sin el consentimiento del fabricante</li>
            <li>Error de conexi&oacute;n o de tensi&oacute;n</li>
            <li>Desgastes debidos a una mala instalaci&oacute;n del eje.</li>
            <li>Desgastes del motor y cuadro provocados por no respetar las reglas de conxi&oacute;n</li>
            <li>Daños debidos a tormentas el&eacute;ctricas.</li>
            <li>PS Cover declian cualquier responsabilidad por los daños f&iacute;sicos o materiales que se pudieran producir
                en el caso de que la cubierta haya sido instalada sin alguno de los elementos que se indican en el
                manual de instalaci&oacute;n.</li>
        </ul>
        <b>RECOMENDACIONES</b>
        <ul class="listaGuiones">
            <li>Cuando la cubierta est&aacute; cerrada es recomendable poner peri&oacute;dicamente en funcionamiento la
                filtraci&oacute;n.</li>
            <li>No dejar nunca las lamas al aire libre sin protecci&oacute;n o sin que est&eacute; en contacto con el agua.</li>
            <li>No caminar nunca sobre la cubierta</li>
            <li>En el caso de piscinas desbordantes, tomar las precauciones necesarias para estar seguro de que la
                piscina no desbordar&aacute; si se produce una tormenta.</li>
            <li>Eliminar de la superficie de la cubierta las hojas y otros residuos ya que, de lo contrario, pueden
                aparecer con rapidez manchas irreversibles en las lamas. Se trata de un proceso biol&oacute;gico que no est&aacute;
                cubierto por nuestra garant&iacute;a.</li>
            <li>Es recomendable instalar una toma de tierra, y es absolutamente imprescindible en aquellas piscinas
                en las que existe un aparato de electr&oacute;lisis salina.</li>
        </ul>
        <b>ACLARACIONES:</b>
        <ul class="listaGuiones">
            <li>La cubierta se calcula con forma rectangular. Los recortes se presupuestar&aacute;n aparte.</li>
            <li>Es necesario dejar instalado, previamente a la colocaci&oacute;n de la cubierta, un tubo corrugado o tubo
                flexible empotrado a la altura del eje del enrollador para pasar por su interior el cable del motor.</li>
            <li>La cubierta tendr&aacute; de anchura 3cm. menos con respecto al ancho de la piscina como margen para
                permitir su correcto deslizamiento.</li>
            <li>Se incluye mando a distancia</li>
            <li>El cuadro el&eacute;ctrico presenta un interruptor de 3 posiciones para utilizar en caso de p&eacute;rdida del
                mando.</li>
            <li>La instalaci&oacute;n de la cubierta no est&aacute; incluida en el precio, pero disponemos de servicio t&eacute;cnico que
                podr&iacute;a realizarla. Consultar presupuesto y disponibilidad en funci&oacute;n de zona geogr&aacute;fica.</li>
            <li>Comunicar cualquier modificaci&oacute;n, ya que puede suponer cambios en el presupuesto.</li>
            <li>La forma de pago es la siguiente: 50% al realizar pedido, 40% antes de la salida de f&aacute;brica de la
                cubierta, resto seg&uacute;n condiciones Cr&eacute;dito y Cauci&oacute;n</li>
        </ul>
    </div>

    <div style="text-align: center; width: 100%">
        <span><b>Aceptaci&oacute;n de presupuesto n&ordm; ' . $codigoPresupuesto . ' y Condiciones Generales:</b></span><br>
        <img class="p-3 img-fluid" style="width:300px;" src="./img/cuadrado.png">
    </div>
</div>';

//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->writeHTML($html, true, false, false, false, '');


/* TERMINOS Y CONDICIONES 2 */

$pdf->AddPage();

$html = '<div class="h-100 pages d-flex flex-column">

    <div class="mt-3 container-fluid">
        <b>PLAZOS</b>
        <ul class="listaGuiones">
            <li>Fabricaci&oacute;n: 1 Semana desde la recepci&oacute;n de la hoja de fabricaci&oacute;n. La producci&oacute;n de la cubierta no
                se iniciar&aacute; hasta que no se reciba la hoja de fabricaci&oacute;n completamente rellena. No se planificar&aacute;, ni
                iniciar&aacute; la producci&oacute;n de ninguna cubierta cuya hoja de fabricaci&oacute;n* est&eacute; incompleta.
                (
                    <i>*Todos los datos que se solicitan en la hoja de fabricaci&oacute;n son necesarios para asegurar la correcta fabricaci&oacute;n
                    de la cubierta, ya que esta se realizar&aacute; siguiendo las medidas exactas recogidas en ese documento, por ello es
                    muy importante no dejar ning&uacute;n campo sin completar. En el caso de piscinas con escaleras integradas es preciso
                    completar tambi&eacute;n el Anexo: medidas escalera.</i>
                )
            </li>
            <li>Entrega: 2 semanas desde el inicio de la producci&oacute;n, para Pen&iacute;nsula y Baleares.</li>
        </ul>
        <b>TRANSPORTE Y ENTREGA</b>
        <ul class="listaGuiones">
            <li>La cubierta ser&aacute; entregada en la direcci&oacute;n que se indica en la hoja de fabricaci&oacute;n por un cami&oacute;n trailer,
                que no cuenta con medios de descarga, y dentro de una caja de embalaje de protecci&oacute;n paletizada.</li>
            <li>El cliente debe asegurarse de que es posible el acceso de un cami&oacute;n de gran volumen hasta la
                direcci&oacute;n que se ha indicado, sin que existan impedimentos tales como cables, &aacute;rboles, v&iacute;as
                demasiado estrechas, etc.</li>
            <li>En el caso de que el acceso de un cami&oacute;n tr&aacute;iler no sea posible, o que no se disponga de los medios
                de descarga necesarios, es preciso comunicarlo con antelaci&oacute;n realizar la entrega en un cami&oacute;n
                especial, con un coste adicional.</li>
            <li>En el transporte NO se incluyen gr&uacute;a, torito, descarga de la mercanc&iacute;a, camiones especiales, 2ª
                entregas por causas no atribuibles a PS Pool, permisos especiales, etc...</li>
            <li>El cliente deber&aacute; tener previstos los medios necesarios para la descarga de la caja y su traslado hasta
                el lugar en que se va a instalar la cubierta.</li>
            <li>En el momento de recepcionar la mercanc&iacute;a hay que asegurarse de que la caja no ha sufrido golpes y
                est&aacute; intacta. Incluso aunque no se observe da&ntilde;o aparente, se deber&aacute; abrir el embalaje y , en caso de
                da&ntilde;os, notificarlo en un plazo no superior a 24 horas. En este caso hay que hacerlo constar en el
                albar&aacute;n de la empresa de transporte, realizar unas fotograf&iacute;as y notificarlo inmediatamente. Si en el
                justificante de entrega no se ha comunicado ning&uacute;n desperfecto, el responsable del da&ntilde;o ser&aacute; el
                receptor de la mercanc&iacute;a. Estas meidas son ajenas a PS Cover y responden a la Ley de Contrato de
                Transporte Terrestre de mercanc&iacute;as.</li>
            <li>PS Cover no correr&aacute; con los gastos de cualquier cambio, retraso o modificaci&oacute;n que se produzca en
                el transporte y entrega de la cubierta y cuyas causas no le sean directamente atribuibles.</li>
        </ul>
        <b>ACLARACIONES ESPEC&Iacute;FICAS PARA CADA MODELO DE CUBIERTA</b>
        <ul>
            <li>TERRA: En el caso de quela coronaci&oacute;n tenga voladizo ser&aacute; necesario realizar un recorte en la
                coronaci&oacute;n de 30 cm para permitir el funcionamiento correcto de la cubierta.<br>
                M&aacute;s detalles consultar FICHA T&Eacute;CNICA CUBIERTA TERRA.</li>
            <li>PACIFIC DECK: Medidas del caj&oacute;n 75 x 80 cm para cubiertas de hasta 15 mts de longitud.<br>
                M&aacute;s detalles consultar FICHA T&Eacute;CNICA PACIFIC DECK.</li>
            <li>PACIFIC TOP: Las medidas del caj&oacute;n deben ser de 80 cm de alto y 77 cm de ancho para
                cubiertas de hasta 15 mts de longitud. <br>
                M&aacute;s detalle consultar FICHA T&Eacute;CNICA PACIFIC TOP.</li>
            <li>PACIFIC CAVE: Las esquinas del extremo de la piscina en el que ir&aacute; ubicado el enrollador deben
                ser a 90&deg; para garantizar la correcta instalaci&oacute;n del enrollador y de las tapas.<br>
                M&aacute;s detalles consultar FICHA T&Eacute;CNICA PACIFIC CAVE,</li>
            <li>PACIFIC DUO: Las medidas del caj&oacute;n ser&aacute;n de 74 x 74 cm + 7 cm de separaci&oacute;n de la pared.<br>
                M&aacute;s detalle: consultar FICHA T&Eacute;CNICA PACIFIC DUO.</li>
        </ul>
    </div>

    <div style="text-align: center; width: 100%">
        <span><b>Aceptaci&oacute;n de presupuesto n&ordm; ' . $codigoPresupuesto . ' y Condiciones Generales:</b></span><br>
        <img class="p-3 img-fluid" style="width:300px;" src="./img/cuadrado.png">
    </div>

</div>';

//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->writeHTML($html, true, false, false, false, '');

ob_clean();

$urlPDF = $_SERVER['DOCUMENT_ROOT'] . "lib/PDFs/Presupuesto_" . $presupuesto . ".pdf";

$pdf->Output($urlPDF, "F"); // guardar en servidor
//$pdf->Output(); // guardar en servidor

echo $urlPDF;

function sanearString($string)
{
    /* if(mb_detect_encoding($string, "UTF-8") != "UTF-8")
    {
        $string = utf8_decode($string);
    } */
    str_replace(chr(0xE2) . chr(0x82) . chr(0xAC), '&euro;', $string);
    $string = str_replace('€', '&euro;', $string);

    $string = utf8_encode($string);
    //$string = htmlentities($string);


    $string = str_replace('>', '&gt;', $string);
    $string = str_replace('<', '&lt;', $string);

    return $string;
}
