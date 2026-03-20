<?

/* error_reporting(E_ALL);
ini_set('display_errors', 1); */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$conn = mysqli_connect('localhost', 'limpiafo_config', '5$gMgw(n@qEf', 'limpiafo_YlBn4V');

/* $servidor = $_POST['SERVIDOR'];
$usuario  = $_POST['USUARIO'];
$password = $_POST['PASSWORD'];
$bd       = $_POST['BD']; */

/* $conn = mysqli_connect($servidor, $usuario, $password, $bd); */

$presupuesto = $_POST['PRESUPUESTO'];                   //CÓDIGO DEL PRESUPUESTO
$cliente     = $_POST['CLIENTE'];                       //CÓDIGO DEL CLIENTE


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://zbaquanatur.ps-cover.com/lib/obtenerPDF.php?presupuesto=" . $presupuesto); //URL of the file
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$pdf = curl_exec($ch);
curl_close($ch);

//$pdf ahora es la URL donde está el archivo PDF
//echo $pdf;

//TODO: tengo que sacar el correo del cliente y del comercial y mandar dos emails

$sql = "SELECT C.CORREO AS CORREOCLIENTE, C.ALIAS AS NOMBRE,
               V.CORREO AS CORREOCOMERCIAL, V.NOMBRE AS COMERCIAL
          FROM CLIENTES C
          LEFT JOIN VENDEDORES V ON V.CODIGO = C.VENDEDOR
         WHERE C.NOMBRE_USUARIO = '$cliente'
            OR C.CORREO         = '$cliente'";
/* WHERE C.CODIGO     = $cliente
            OR C.CODIGO_WEB = $cliente"; */

$sqlConflictiva = $sql;
$mres = mysqli_query($conn, $sql) or die("SQL ERROR $sql " . mysqli_error($conn));
$mrow = mysqli_fetch_object($mres);

$correoCliente   = $mrow->CORREOCLIENTE;  //"pablo@gesplanet.com";
$correoComercial = "santi@ps-pool.com"; //$mrow->CORREOCOMERCIAL;
$nombreCliente   = $mrow->NOMBRE;

//VAMOS A OBTENER LOS DATOS Y LOS ENLACES DEL PRESUPUESTO
$sql = "SELECT A.SUBTIPO_MOTOR AS SUBTIPO, A.CODIGO AS MOTOR
          FROM LINPRESU
          LEFT JOIN ARTICULOS A ON A.CODIGO = LINPRESU.ARTICULO
         WHERE LINPRESU.PRESUPUESTO_WEB = $presupuesto
            OR LINPRESU.PRESUPUESTO     = $presupuesto
           AND LINEA = 1"; //YO SE QUE LA PRIMERA LINEA ES LA DEL MOTOR

//echo $sql;
$mres = mysqli_query($conn, $sql) or die("SQL ERROR $sql " . mysqli_error($conn));
$mrow = mysqli_fetch_object($mres);

$modelo = $mrow->SUBTIPO;
$motor  = $mrow->MOTOR;

//UNA VEZ TENGAMOS EL ARTICULO DEL MOTOR, OBTENEMOS LOS LINKS
$anexo               = "";
$documentoCompromiso = "";
$fichaTecnica        = "";
$folletoComercial    = "";
$hoja                = "";
$requisitos          = "";
$videoAnimacion      = "";
$videoCajon          = "";

$sql = "SELECT TIPO, LINK
          FROM LINKS_ARTICULOS
         WHERE ARTICULO = '$motor'";

//echo $sql;
$mres = mysqli_query($conn, $sql) or die("SQL ERROR $sql " . mysqli_error($conn));
while ($mrow = mysqli_fetch_object($mres)) {
    switch ($mrow->TIPO) {
        case 'ANEXO':
            $anexo = $mrow->LINK;
            break;

        case 'DOCUMENTO_COMPROMISO':
            $documentoCompromiso = $mrow->LINK;
            break;

        case 'FICHA_TECNICA':
            $fichaTecnica = $mrow->LINK;
            break;

        case 'FOLLETO_COMERCIAL':
            $folletoComercial = $mrow->LINK;
            break;

        case 'HOJA':
            $hoja = $mrow->LINK;
            break;

        case 'REQUISITOS':
            $requisitos = $mrow->LINK;
            break;

        case 'VIDEO_ANIMACION':
            $videoAnimacion = $mrow->LINK;
            break;

        case 'VIDEO_CAJON':
            $videoCajon = $mrow->LINK;
            break;
    }
}

//AHORA CREAMOS Y ENVIAMOS EL EMAIL
$mail = new PHPMailer(true);

try {
    //Server settings
    /*  $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail.gesplanet.com';//"smtp.gmail.com";                     //Set the SMTP server to send through
    //$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    //$mail->Username   = 'pablo@gesplanet.com';                     //SMTP username
    //$mail->Password   = 'secret';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 25;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above */

    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    //$mail->SMTPDebug = SMTP::DEBUG_CONNECTION;                  //Enable verbose debug output
    /* $mail->isSMTP();                                            //Send using SMTP
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication */

    //$mail->Host       = "smtp.serviciodecorreo.es";             //"smtp.gmail.com";                     //Set the SMTP server to send through
    //$mail->Host       = "smtp.ps-pool.com";             //"smtp.gmail.com";                     //Set the SMTP server to send through
    $mail->Host       = "mail.ps-pool.com";             //"smtp.gmail.com";                     //Set the SMTP server to send through
    //$mail->Host       = "smtp.office365.com";             //"smtp.gmail.com";                     //Set the SMTP server to send through
    //$mail->Username   = 'info@ps-pool.com';                    //SMTP username
    //$mail->Username   = 'santi@ps-pool.com';                    //SMTP username
    //$mail->Username   = 'marcelo@ps-pool.com';                    //SMTP username
    $mail->Username   = 'smtpdisp@ps-pool.com';                    //SMTP username
    //$mail->Username   = 'ick631c';                    //SMTP username
    //$mail->Username   = 'vck591c';                    //SMTP username
    //$mail->Password   = 'mv8fJDnFep8C';                         //SMTP password
    //$mail->Password   = 'x55rthjLo4fP';                         //SMTP password
    //$mail->Password   = 'Boh1pxDY';                         //SMTP password
    //$mail->Password   = 'KE9JSOcZl9xW';                         //SMTP password
    $mail->Password   = 'VTLLeb|Sdld^';                         //SMTP password
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    //$mail->Port       = 587;
    $mail->Port       = 465;
    //$mail->Port       = 25;

    //Recipients
    //$mail->setFrom('pablo@gesplanet.com', 'Pablo');
    $mail->setFrom('info@ps-pool.com', utf8_decode('Zona de Baño'));
    $mail->addAddress($correoCliente, $nombreCliente);     //Add a recipient
    $mail->addAddress($correoComercial);               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    if ($pdf && file_exists($pdf)) {
        $mail->addAttachment($pdf);         //Add attachments
    }

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Presupuesto PSCover';
    $mail->Body    = 'Estimado cliente, <br><br>

        <p>Le enviamos la oferta de la cubierta autom&aacute;tica ZB Aquanatur modelo ' . $modelo . ' que nos ha solicitado, as&iacute; como los documentos t&eacute;cnicos necesarios para su realizaci&oacute;n. </p>

        <p style="color:red"><b>Le rogamos que lea atentamente el contenido de este correo electr&oacute;nico hasta el final y que, en caso de que le surja cualquier duda, se ponga en contacto con nosotros.</b></p>

        <p><u>Para poder iniciar el proceso de producci&oacute;n de su cubierta autom&aacute;tica es <b>imprescindible</b> que nos env&iacute;e los siguientes documentos correctamente cumplimentados</u>. EN EL CASO DE QUE FALTE ALGUNO DE ESTOS DOCUMENTOS O QUE LA INFORMACI&Oacute;N SOLICITADA EST&Eacute; INCOMPLETA NO SER&Aacute; POSIBLE INICIAR LA FABRICACI&Oacute;N DE LA CUBIERTA, con la consiguiente demora.</p>

        <ul>
            <li><b>Presupuesto de la cubierta ' . $modelo . '</b> firmado y/o sellado por usted.</li>
            <li><b><a href="' . $hoja . '">Hoja de fabricaci&oacute;n cubierta..</a> cumplimentada EN SU TOTALIDAD</b>(todos y cada uno de los datos que se solicitan en esta hoja son necesarios para que la cubierta se fabrique con las medidas correctas), firmada y/o sellada.</li>
            <li>En el caso de que la piscina tenga escalera exterior ser&aacute; preciso incluir tambi&eacute;n el <a href="' . $anexo . '">anexo Escaleras</a></li>
            <li><b>Pago de la cubierta</b>, seg&uacute;n las condiciones que aparecen reflejadas en la oferta adjunta, al pie de la primera p&aacute;gina</li>
            <li>En el caso de que haya contratado la instalaci&oacute;n de la cubierta con nuestros instaladores necesitaremos tambi&eacute;n el <a href="' . $documentoCompromiso . '"><b>Documento de compromiso de preparaci&oacute;n</b></a> de la instalaci&oacute;n, firmado y/o sellado.</li>
        </ul>

        <p>Todos estos documentos pueden ser descargados desde los enlaces que aparecen en este mismo correo.</p>

        <p>Adem&aacute;s, puede descargar aqu&iacute;, si lo desea: </p>

        <ul>
            <li style="display-style: none">Informaci&oacute;n t&eacute;cnica cubierta ' . $modelo . ': <a href="' . $fichaTecnica . '">ficha t&eacute;cnica;</a><a href="' . $requisitos . '">requisitos previos para la instalaci&oacute;n</a></li>
            <li style="display-style: none">Informaci&oacute;n comercial cubierta ' . $modelo . ': <a href="' . $folletoComercial . '">folleto comercial;</a> <a href="' . $videoAnimacion . '">video animaci&oacute;n ' . $modelo . ';</a></li>
        </ul>

        <p>O hacerlo desde su &aacute;rea de cliente <a href="https://zbaquanatur.ps-cover.com">https://zbaquanatur.ps-cover.com/</a> introduciendo su usuario y contrase&ntilde;a</p>

        <p>Estamos a su disposici&oacute;n para cualquier consulta que desee realizarnos.</p>
    ';

    $mail->send();

    $result = array(
        "OK" => 1
    );
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

    $result = array(
        "OK" => 0,
        "ERROR" => "No se pudo enviar el mensaje " . $mail->ErrorInfo,
        "MAIL" => print_r($mail, true)
    );
}

echo json_encode($result);
