<?php

ini_set('default_charset', 'utf-8');

/***funcion para conectar a la base de datos**/
function conectar()
{
    global $servidor, $usuario, $password, $bd;

    $bdatos = mysqli_connect($servidor, $usuario, $password, $bd) or die("Error al conectar $servidor, $usuario, $password, $bd | ". mysqli_connect_error());
    
    return $bdatos;
}
function proyecto() 
{
 global $proyecto;
 return $proyecto;
}


//desde que web estamos trabajando
function weborigen() 
{
 global $web;
 return $web;
} 

function fechaFB($fecha)
{ 
  return substr($fecha,3,2) . "/" .  substr($fecha,0,2) . "/" . substr($fecha,6,4);
}

function UltimoDiaMes($elAnio,$elMes) 
{
  return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
}

//datos conexi�n smtp del cliente
function correosmtp()
{
global $servidorsmtp;
global $correo;
global $passwordsmtp;
global $usuariosmtp;
global $autentificado;

return array ($servidorsmtp, $correo, $passwordsmtp, $usuariosmtp, $autentificado);

}

function errorLog($linea){

  $fecha = date("Ymd");
  $fichero = "include/chivatos/chivatos_".$fecha.".txt";

  if(!file_exists("include/chivatos")){
    mkdir("include/chivatos");
  }

  try {
   
    $handle = fopen($fichero, "a");/* or die("No se pudo abrir el fichero");*/

    fwrite($handle, date("H:i:s") . ' - ' . $linea . "\r\n");

    //file_put_contents($fichero, $linea + "\r\n", FILE_APPEND | LOCK_EX);

    fclose($handle);
    
  } catch (\Throwable $th) {
    //throw $th;
  }
}

//codear a HTML
/* function codeToHTML($string){
    //return html_entity_decode(htmlentities($cadena, ENT_QUOTES, ""), ENT_QUOTES | ENT_XML1, 'UTF-8'); Antiguo

    //COMO EL EURO ES UN CARACTER ESPECIAL QUE NO TIENE PORQUE CAMBIARSE AL CAMBIAR EL ENCODING HACEMOS LO SIGUIENTE:

    //$string = mb_convert_encoding($string, "UTF-8", mb_detect_encoding($string, "UTF-8, ISO-8859-1, ISO-8859-15", true)); 
    $string = mb_convert_encoding($string, "HTML-ENTITIES", "ISO-8859-1"); 
    
    //$string = str_replace("ñ","&ntilde", $string);

    //$string = iconv("windows-874","UTF-8", $string);

    return $string;
} */

function converToPlain($text){
  if($text != "" && $text != null){
    $text = preg_replace('"{\*?\\\\.+(;})|\\s?\\\[A-Za-z0-9]+|\\s?{\\s?\\\[A-Za-z0-9‹]+\\s?|\\s?}\\s?"', '', $text);
    //$text = preg_replace('%uFFFD','é',$text);/* Cambiar la é */
  }
  return $text;
}

function formatearHora($hora){
    $hora = substr($hora,0,5);
    return $hora;
}

function formatearFecha($fecha){
  
  if(strpos($fecha,'-') !== false){
    $arrayFecha = explode("-",$fecha);

    $fecha = $arrayFecha[2] ."-".  $arrayFecha[1]  ."-". $arrayFecha[0];
  }
  
  if(strpos($fecha,'/') !== false){
    $arrayFecha = explode("/",$fecha);
    
    $fecha = $arrayFecha[2] ."/".  $arrayFecha[1]  ."/". $arrayFecha[0];
  }
 
  return $fecha;
}

function codeToUTF8($string) {
  return mb_convert_encoding($string, "UTF-8", mb_detect_encoding($string, "UTF-8, ISO-8859-1, ISO-8859-15", true));
}


?> 
