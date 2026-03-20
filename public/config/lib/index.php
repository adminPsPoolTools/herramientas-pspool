<?php

 

  error_reporting(E_ALL);
  ini_set("display_errors",1);

echo "a conectar...";

    $conn = mysqli_connect('localhost', 'limpiafo_gesp', 'dOz8EgXW$#}0', 'limpiafo_YlBn4V'); 



    $sql = "SELECT MATERIAL FROM ARTICULOS GROUP BY MATERIAL";

    $resMaterial = mysqli_query($conn, $sql) or print("SQL ERROR: $sql");
      
    $sql = "SELECT COLOR FROM ARTICULOS GROUP BY COLOR";

    $resColor = mysqli_query($conn, $sql) or print("SQL ERROR: $sql");

?>
<html>
    <head>
        <meta http-equiv="Content-Language" content="es">
	    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
        <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
	    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <title>Formulario de presupuestos</title>
    </head>
    <body>
        <div class="container">
        
            <div class="m-3 p-3 border bg-light rounded">
                <h3><span class="badge badge-secondary">Presupuesto</span></h3>

                <div class="mt-3">
                    <!--<div class="alert alert-warning" role="alert">
                        <strong>Cuidado!</strong> Para pruebas estoy usando metros en vez de centrimetros
                    </div>-->

                    <div class="form-group mt-2">
                        <label>Medidas piscina</label>
                        <div class="row no-gutters">

                            <div class="input-group col p-2">
                                <input type="text" class="form-control " id="input_ancho_piscina" placeholder="Ancho piscina"/>
                                <div class="input-group-append">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>

                            <div class="input-group col p-2">
                                <input type="text" class="form-control" id="input_largo_piscina"  placeholder="Largo piscina"/>
                                <div class="input-group-append">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label>Medidas escalera</label>
                        <div class="row no-gutters">

                            <div class="input-group col p-2">
                                <input type="text" class="form-control col p-2" id="input_ancho_escalera" placeholder="Ancho escalera"/>
                                <div class="input-group-append">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>

                            <div class="input-group col p-2">
                                <input type="text" class="form-control col p-2" id="input_largo_escalera" placeholder="Largo escalera"/>
                                <div class="input-group-append">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row no-gutters">
                        <div class="col-3">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="escaleraSumergida" name="tipoEscalera" value="S" class="custom-control-input escalera_radio" checked>
                                <label class="custom-control-label" for="escaleraSumergida">Sumergida</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="escaleraCoronacion" name="tipoEscalera" value="C" class="custom-control-input escalera_radio">
                                <label class="custom-control-label" for="escaleraCoronacion">Coronaci&oacute;n</label>
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="input-group col p-2" id="div_profundidad_tapa">
                                <input type="text" class="form-control col p-2" id="input_profundidad_tapa" placeholder="Profundidad Tapa"/>
                                <div class="input-group-append">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-4 p-2">
                            <select id="selectSubtipo" class="custom-select">
                                <option value="DEC" selected>Dec </option>
                                <option value="TOP"         >Top </option>
                                <option value="CAVE"        >Cave</option>
                                <option value="DUO"         >Duo </option>
                            </select>
                        </div>
                    </div>

                    <div class="row no-gutters">

                        <div class="form-group mt-3 col p-2">
                            <label>Posici&oacute;n escalera</label>
                            <select id="selectTipoEscalera" class="custom-select">
                                <option value="F" selected>Fuera</option>
                                <option value="D">Dentro</option>
                            </select>
                        </div>

                        <div class="form-group mt-3 col p-2">
                            <label>Sentido escalera</label>
                            <select id="selectSentidoEscalera" class="custom-select">
                                <option value="S" selected>S</option>
                                <option value="N">N</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-3 custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="conViga">
                        <label class="custom-control-label" for="conViga">Con viga</label>
                    </div>

                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="conTapa">
                        <label class="custom-control-label" for="conTapa">Con tapa</label>
                    </div>

                    <div class="row no-gutters">
                        <div class="form-group mt-3 col p-2">
                            <label>Color L&aacute;mina</label>
                            <select id="colorLamina" class="custom-select">
                                <?php
                                    while($rowC = mysqli_fetch_object($resColor)){
                                        echo '<option value="'.$rowC->COLOR.'">'.$rowC->COLOR.'</option>';
                                    }
                                ?>
                                <!--<option value="Blanco" selected>Blanco</option>
                                <option value="Gris">Gris</option>
                                <option value="Negro">Negro</option>
                                <option value="Vainilla">Vainilla</option>-->
                            </select>
                        </div>

                        <div class="form-group mt-3 col p-2">
                            <label>Material L&aacute;mina</label>
                            <select id="materialLamina" class="custom-select">
                                <?php
                                    while($row = mysqli_fetch_object($resMaterial)){
                                        echo '<option value="'.$row->MATERIAL.'">'.$row->MATERIAL.'</option>';
                                    }
                                ?>
                                <!--<option value="PVC" selected>PVC</option>
                                <option value="Poli">Policarbonato</option>-->
                            </select>
                        </div>
                    </div>

                    <div class="form-group p-2">
                        <label for="input_comentario">Comentario</label>
                        <textarea type="text" class="form-control col p-2" id="input_comentario" placeholder="Comentario..."></textarea>
                    </div>
                   
                    <div class="row no-gutters justify-content-end">
                        <input type="button" id="btn_presupuestos" class="btn btn-outline-dark" value="Ver presupuesto"/>
                    </div>
                </div>

                <div id="div_presupuesto"></div>
            </div>

            <div class="m-3 p-3 border bg-light rounded">
                <h3><span class="badge badge-secondary">Cliente</span></h3>
                <div class="form-group">
                    <!-- $codigoPresupuesto, $codigo, $descripcion, $alias, $direccion, $poblacion, $cif, $provincia, $telefonofijo, 
                                   $telefonomovil, $correo, $password, $pais, $cp, $login -->

                    <div class="row no-gutters justify-content-between mt-2">

                        <div class="form-group">
                            <label>C&oacute;digo presupuesto</label>
                            <input type="text" value="0" class="form-control w-25" id="input_codigo_presupuesto" readonly/>
                        </div>

                        <div class="form-group">
                            <label>C&oacute;digo cliente</label>
                            <input type="text" value="0" class="form-control w-25" id="input_codigo_cliente" readonly/>
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <label>Descripci&oacute;n y &aacute;lias</label>
                        <div class="row no-gutters">

                            <div class="input-group col p-2">
                                <input type="text" class="form-control " id="input_descripcion_cliente" placeholder="Descripci&oacute;n"/>
                            </div>

                            <div class="input-group col p-2">
                                <input type="text" class="form-control" id="input_alias_cliente"  placeholder="&Aacute;lias"/>
                            </div>

                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <label>Direcci&oacute;n</label>
                        <input type="text" class="form-control " id="input_direccion_cliente" placeholder="Direcci&oacute;n"/>
                    </div>

                    <div class="form-group mt-2">
                        <label>Poblaci&oacute;n</label>
                        <input type="text" class="form-control " id="input_poblacion_cliente" placeholder="Poblaci&oacute;n"/>
                    </div>

                    <div class="form-group mt-2">
                        <label>Provincia</label>
                        <input type="text" class="form-control " id="input_provincia_cliente" placeholder="Provincia"/>
                    </div>

                    <div class="form-group mt-2">
                        <label>CIF</label>
                        <input type="text" class="form-control " id="input_cif_cliente" placeholder="Cif"/>
                    </div>

                    <div class="form-group mt-2">
                        <label for="input_correo_cliente">Correo</label>
                        <input type="email" class="form-control " id="input_correo_cliente" placeholder="Correo"/>
                    </div>

                    <div class="form-group mt-2">
                        <label>Password</label>
                        <input type="password" class="form-control" id="input_password_cliente" placeholder="Password"/>
                    </div>

                    <div class="row no-gutters mt-2">
                        <div class="form-group col p-2">
                            <label>Tel&eacute;fono m&oacute;vil</label>
                            <input type="phone" class="form-control " id="input_telefono_movil_cliente" placeholder="Tel&eacute;fono m&oacute;vil"/>
                        </div>

                        <div class="form-group col p-2">
                            <label>Tel&eacute;fono fijo</label>
                            <input type="phone" class="form-control " id="input_telefono_fijo_cliente" placeholder="Tel&eacute;fono fijo"/>
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <label>Pa&iacute;s</label>
                        <input type="text" class="form-control " id="input_pais_cliente" value="España" placeholder="Pais"/>
                    </div>

                    <div class="form-group mt-2">
                        <label>CP</label>
                        <input type="number" class="form-control " id="input_cp_cliente" placeholder="Cp"/>
                    </div>

                    <div class="row no-gutters justify-content-end">
                        <input type="button" id="btn_cliente" class="btn btn-outline-dark" value="Grabar cliente"/>
                    </div>
                </div>

                <div id="div_cliente"></div>
            </div>

        </div>
    </body>
    <script src="./jquery-1.9.1.min.js"></script>
    <script>
        $(document).ready(function(){
            

            $("#btn_presupuestos").click(function(){

                /*$modelo, $tipoEscalera, $sentidoEscalera, $largoEscalera, $anchoEscalera, $anchoPiscina, $largoPiscina, 
                $tipoLamina, $cliente, $conViga, $conTapa, $colorLamina, $descripcion*/
                var url = "./pscover.php?TIPO=1"
                        + "&MODELO="          + $(".escalera_radio:checked").val()
                        + "&SUBTIPO="         + $("#selectSubtipo").val()
                        + "&PROFUNDIDAD_TAPA="+ $("#input_profundidad_tapa").val()
                        + "&TIPOESCALERA="    + $("#selectTipoEscalera").val()
                        + "&SENTIDOESCALERA=" + $("#selectSentidoEscalera").val()
                        + "&LARGOESCALERA="   + $("#input_largo_escalera").val()
                        + "&ANCHOESCALERA="   + $("#input_ancho_escalera").val()
                        + "&ANCHOPISCINA="    + $("#input_ancho_piscina").val()
                        + "&LARGOPISCINA="    + $("#input_largo_piscina").val()
                        + "&TIPOLAMINA="      + $("#materialLamina").val()
                        + "&CONVIGA="         + $("#conViga").is(":checked")
                        + "&CONTAPA="         + $("#conTapa").is(":checked")
                        + "&COLORLAMINA="     + $("#colorLamina").val().replace(/ /gi,"%20").replace("&","y")
                        + "&DESCRIPCION="     + $("#input_comentario").val().replace(/ /gi,"%20").replace("&","y");

                console.log(url);

                $("#div_presupuesto").load(url, function(){
                    $("#input_codigo_presupuesto").val($("#div_presupuesto").data("codigo"));
                });
            });

            $("#btn_cliente").click(function(){

                //$codigoPresupuesto, $codigo, $descripcion, $alias, $direccion, $poblacion, $cif, $provincia, $telefonofijo, 
                //$telefonomovil, $correo, $password, $pais, $cp, $login

                var url = "./pscover.php?TIPO=2"
                    + "&PRESUPUESTO="  + $.trim($("#input_codigo_presupuesto").val())
                    + "&DESCRIPCION="  + $("#input_descripcion_cliente").val().replace(/ /gi,"%20").replace("&","y")
                    + "&ALIAS="        + $("#input_alias_cliente").val().replace(/ /gi,"%20").replace("&","y")
                    + "&DIRECCION="    + $("#input_direccion_cliente").val().replace(/ /gi,"%20").replace("&","y")
                    + "&POBLACION="    + $("#input_poblacion_cliente").val().replace(/ /gi,"%20").replace("&","y")
                    + "&CIF="          + $("#input_cif_cliente").val()
                    + "&PROVINCIA="    + $("#input_provincia_cliente").val().replace(/ /gi,"%20").replace("&","y")
                    + "&TELEFONOFIJO=" + $("#input_telefono_fijo_cliente").val()
                    + "&TELEFONOMOVIL="+ $("#input_telefono_movil_cliente").val()
                    + "&CORREO="       + $("#input_correo_cliente").val()
                    + "&PASSWORD="     + $("#input_password_cliente").val()
                    + "&PAIS="         + $("#input_pais_cliente").val().replace(/ /gi,"%20").replace("&","y") 
                    + "&CP="           + $("#input_cp_cliente").val();


                console.log(url);

                $("#div_cliente").load(url, function(){
                    //$("#input_codigo_cliente").val($("#div_presupuesto").data("codigo"));
                });
            });

            $("#escaleraSumergida").click(function(){
                $("#selectSubtipo").show();
                $("#div_profundidad_tapa").show();
            });

            $("#escaleraCoronacion").click(function(){
                $("#selectSubtipo").hide();
                $("#div_profundidad_tapa").hide();
            });
        });
    </script>
</html>