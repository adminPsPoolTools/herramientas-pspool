<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

$conn = mysqli_connect('localhost', 'limpiafo_config', '5$gMgw(n@qEf', 'limpiafo_YlBn4V');
/* $conn = mysqli_connect('172.26.0.8', 'root', '', 'pscover'); */

$articulo = '17784';
$cliente  = 256; //11406;
$precio   = 697.35;
$proyecto = 50;
$cantidad = 6;

$result = array();
$result['PVP'] = $precio;
$result['PVP_FINAL'] = $precio;
$result['DTO'] = 0;


//print_r(obtenerPVPArticulo($articulo, $cliente, $precio, $cantidad, $conn));
print_r(ver_pvp_tarifas($articulo, $cliente, $proyecto, $cantidad, $precio, $conn));

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

    print_r($pvpTarifa);
    die;

    $tmpPrecio = round((double) $pvpTarifa["PVP"], 2);

    if ($tmpPrecio == -1 || $tmpPrecio == "-1") 
    {
        $tmpPrecio = round((double) $pvpTarifa["PVPPROYECTO"], 2);
    }

    $result['PVP_FINAL'] = $tmpPrecio;

    if (!empty($pvpTarifa["DTO"])) 
    {
        $result['DTO'] = $pvpTarifa["DTO"];
    }
    
    grabarChivato(json_encode($result));
    return $result;
}

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

    $PVP                    = -1;
    $DTO                    = 0;
    $PVPPROYECTO            = 0;
    $cantidad_a_partir_de   = 0;
    $PVP_DE_ORIGEN_TARIFA   = 'N';
    
    $sql = "SELECT tarifa, utilizar_pack, utilizar_siempre_pvp_caja
              from CLIENTES
             where codigo = ".$cliente;

    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_object($res);

    $tarifa                     = $row->tarifa;
    $utilizar_pack              = $row->utilizar_pack;
    $utilizar_siempre_pvp_caja  = $row->utilizar_siempre_pvp_caja;

    if($tarifa > 0)
    {
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

        if ($durante_periodo == 'N')
        {
            if($tarifa_pack == 'S' || $tarifa_caja == 'S')
            {
                $sql = "SELECT UDS_PACK, UNIDADESCAJA FROM ARTICULOS WHERE CODIGO = '$articulo'";

                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_object($res);

                $uds_pack       = $row->UDS_PACK;
                $unidadesCaja   = $row->UNIDADESCAJA;

                if($tarifa_pack == 'S'){ $cantidad_a_partir_de = $uds_pack; }
                if($tarifa_caja == 'S'){ $cantidad_a_partir_de = $uds_caja; }
            }

            if($cantidad_a_partir_de == 0 || ($cantidad_a_partir_de > 0 && $cantidad >= $cantidad_a_partir_de))
            {
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
    if($tarifa == 0)
    {
        /*buscamos el cliente en tarifas clientes*/
        $sql = "SELECT count(cliente) as n_reg 
                  from TARIFASCLIENTES 
                 where TARIFASCLIENTES.cliente = ".$cliente;
                 
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_object($res);

        $n_reg = $row->n_reg;

        if($n_reg > 0)
        {
            $pvp               = $precio;
            $ultimo_pvp_valido = $precio;
            $PVPPROYECTO       = $precio;

            $sql = "SELECT TARIFASCLIENTES.tarifa, TARIFAS.APLICAR_SOLO_PACKS, TARIFAS.APLICAR_SOLO_CAJAS, DURANTE_PERIODO, FECHA_INICIO, FECHA_FIN
                      from TARIFASCLIENTES
                      left join TARIFAS on TARIFAS.CODIGO = TARIFASCLIENTES.TARIFA
                     WHERE TARIFASCLIENTES.cliente = ".$cliente."
                     ORDER BY TARIFASCLIENTES.tarifa";

            $res = mysqli_query($conn, $sql);

            while($row = mysqli_fetch_object($res))
            {
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

                print_r($row);
                echo '<br>';

                $tmp_pvp = $row2->PVP;

                if($tmp_pvp <> -1)
                {

                    if($durante_periodo == 'N')
                    {
                        $cantidad_a_partir_de = 0;

                        if($tarifa_pack == 'S' || $tarifa_caja == 'S')
                        {
                            $sql = "SELECT UDS_PACK, UNIDADESCAJA FROM ARTICULOS WHERE CODIGO = '$articulo'";

                            $res2 = mysqli_query($conn, $sql);
                            $row2 = mysqli_fetch_object($res2);

                            $uds_pack       = $row2->UDS_PACK;
                            $unidadesCaja   = $row2->UNIDADESCAJA;

                            if($tarifa_pack == 'S'){ $cantidad_a_partir_de = $uds_pack; }
                            if($tarifa_caja == 'S'){ $cantidad_a_partir_de = $uds_caja; }
                        }

                        if($cantidad_a_partir_de == 0 || ($cantidad_a_partir_de > 0 && $cantidad >= $cantidad_a_partir_de))
                        {
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

                            if ($result['PVP_DE_ORIGEN_TARIFA'] <> 'S')
                            {
                                $pvp_de_origen_tarifa = $mrowP->PVP_DE_ORIGEN_TARIFA;
                            }
                        }

                        if($pvp <> -1)
                        {
                            $ultimo_pvp_valido = $pvp;
                        }

                        if($pvp == -1)
                        {
                            $pvp = $ultimo_pvp_valido;
                        }
                    }//IF DURANTE_PERIODO
                }
            }//WHILE ROW
        }//IF TARIFAS CLIENTES
    }//IF TARIFA == 0

    /* grabarChivato(json_encode($result)); */
    return $result;
}

function grabarChivato($linea){

    $fichero = "error_log.txt";
  
    try {
     
        $handle = fopen($fichero, "a");/* or die("No se pudo abrir el fichero");*/
    
        fwrite($handle, $linea . "\r\n");
    
        //file_put_contents($fichero, $linea + "\r\n", FILE_APPEND | LOCK_EX);
    
        fclose($handle);
      
    } catch (\Throwable $th) {
      //throw $th;
    }
}
?>