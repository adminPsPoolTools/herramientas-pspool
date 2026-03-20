<?
$dominio = $config_dominio;
$NombreEmpresa = $config_nombre;
$emailNombre = $NombreEmpresa." Info";
if ($config_produccion == 0) {
	$emailinfo = $config_emailpruebas;
} else {
	$emailinfo = $config_email;
}




// Autentificacion
$mail->Host = "localhost";
/*
$mail->Host = "smtp.servidor.es";
$mail->Mailer = "smtp";
$mail->SMTPAuth = true;
$mail->Username = "no-reply.servidor.es";
$mail->Password = "hRu654e";
*/
?>