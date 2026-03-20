
$(document).ready(function () {

    var url = "../config/lib/pscover.php";

    function enviar() {

        $('#enviando').fadeIn('slow');
        $.ajax({
            url: url,
            type: "POST",
            data: $("#formdatos").serialize(),
            dataType: "json",
            cache: false, //Para que el formulario no guarde cache
            beforeSend: function (xhr) {
                //console.log("URL enviada:", url);
                //console.log("Datos enviados:", $("#formdatos").serialize());
            },
            success: function (response) {
                //console.log("Respuesta completa:", response);
                $('#enviando').fadeOut('slow');

                if (response.OK == 1) {

                    $("#codpresupuesto").val(response.CODIGO_PRESUPUESTO);
                    $("#btnprecioS").prop('disabled', false);
                    $('#mostrarprecio').show();
                    $('#error').hide();
                    PRECIO = Intl.NumberFormat('de-DE').format(parseFloat(response.PRECIO).toFixed(2));
                    $('#presupuesto').html(PRECIO + " €");

                } else if (response.OK == 0) {

                    $("#btnprecioS").prop('disabled', true);
                    $('#error').show();
                    $('#mostrarprecio').hide();
                    $('#error #errortxt').html(response.ERROR);

                } else {
                    $("#btnprecioS").prop('disabled', true);
                    alert("Sin respuesta");
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert("Hubo un problema al calcular el precio, y si el problema persiste contacte con nosotros");
                $('#enviando').fadeOut('slow');
                console.error("Detalles del error:");
                console.error("Status HTTP:", jqXHR.status);
                console.error("Texto de estado:", textStatus);
                console.error("Error lanzado:", errorThrown);
                console.error("Respuesta completa del servidor:", jqXHR.responseText);
            }
        });
    };

    $("#imprimir").click(function () {
        $("#presu").val($("#codpresupuesto").val());
        $.ajax({
            url: url,
            type: "POST",
            data: $("#formprint").serialize(),
            dataType: "json",
            cache: false, //Para que el formulario no guarde cache
            success: function (response) {
                $('#enviando').fadeOut('slow');
                if (response.OK == 1) {

                    var customWindow = window.open('', 'PRINT', 'height=auto, width=auto');
                    var html = response.HTML;
                    customWindow.document.write(html);
                    customWindow.document.close();
                    customWindow.focus();
                    customWindow.print();
                    customWindow.close();

                } else if (response.OK == 0) {
                    alert("no");
                } else {
                    $("#btnprecioS").prop('disabled', true);
                    alert("Sin respuesta");
                }
            },
            error: function (request, status, error) {
                //PABLO GESPLANET
                console.log("Request: " + request);
                console.log("Status: " + status);
                console.log("Error: " + error);
                alert("Ha habido un problema en el archivo");
                $('#enviando').fadeOut('slow');
            }
        });
    });

    // $("#enviaremail").click(function() {
    // 	$("#presuemail").val( $("#codpresupuesto").val() );
    // 	$("#clienteemail").val( $("#CLIENTE").val() );

    // 	$.ajax({
    //         url: "{{ asset('config/lib/enviar_correo.php') }}",
    // 		//url: "https://zbaquanatur.ps-cover.com/lib/enviar_correo.php",
    // 		type: "POST",
    // 		data: $("#formemail").serialize(),
    // 		mimeType: "multipart/form-data",
    // 		dataType: "json",
    // 		cache:false, //Para que el formulario no guarde cache
    // 		success: function(response) {

    //             $('#enviando').fadeOut('slow');
    // 			if (response.OK == 1){
    // 				$('#correcto .correcto').html("Email enviado"); $('#correcto').fadeIn('slow'); setTimeout("$('#correcto').fadeOut('slow');", 4000);
    // 				$('#btnFin').hide();
    // 				$('#btnvolverFin').show();
    // 			} else if (response.OK == 0){
    // 				$('#errormail .error').html("<b>Ha habido un error. </b><br>No se ha podido enviar"); $('#errormail').fadeIn('slow'); setTimeout("$('#errormail').fadeOut('slow');", 4000);
    // 				console.log("Response error: " + response.ERROR);
    // 			} else {
    // 				alert ("Sin respuesta");
    // 			}
    // 		},
    // 		error: function(request, status, error) {

    // 			console.log(request);
    // 			console.log("Status: " + status);
    // 			console.log("Error: " + error);
    // 			alert ("Ha habido un problema en el archivo");
    // 			$('#enviando').fadeOut('slow');
    // 		}
    // 	});
    // });

    $("#btnvolverFin").click(function () {
        $("#cubierta").show();
        $("#final").hide();
    });


    /*********** CUBIERTA *************/

    $("#btncubiertaS").prop('disabled', true);

    $("#tipocubierta1").click(function () {
        $("#dibucubierta").html("<img src=\"../../../config/img/sumergida.jpg\" width=\"100%\">");
        $("#delta").show();
        $("#altea").hide();
        $("#acabadocubierta").fadeOut();
        $("#btncubiertaS").prop('disabled', true);
        $("#tipocubierta2").removeClass("activo");
        $(this).addClass("activo");
        $("#tipoCubierta").val("S");
        $("#btncubiertaS").show();
    });

    $("#tipocubierta2").click(function () {
        $("#dibucubierta").html("<img src=\"../../../config/img/coronacion.jpg\" width=\"100%\">");
        $("#altea").show();
        $("#delta").hide();
        $("#acabadocubierta").fadeOut();
        $("#btncubiertaS").prop('disabled', true);
        $("#tipocubierta1").removeClass("activo");
        $(this).addClass("activo");
        $("#tipoCubierta").val("C");
        $("#btncubiertaS").show();
    });

    $("#deltaA").click(function () {
        $("#dibucubierta").html("<img src=\"../../../config/img/modelos/deck.jpg\" width=\"100%\">");
        $("#acabadocubierta").fadeIn();
        $("#opcion_deltaB, #opcion_deltaCD").hide();
        $("#ipe_revestir").hide();
        $("#btncubiertaS").prop('disabled', false);
    });

    $("#deltaB").click(function () {
        $("#dibucubierta").html("<img src=\"../../../config/img/modelos/top.jpg\" width=\"100%\">");
        $("#acabadocubierta").fadeOut();
        $("#opcion_deltaB").show();
        $("#opcion_deltaCD").hide();
        $("#btncubiertaS").prop('disabled', false);
    });

    $("#deltaC").click(function () {
        $("#dibucubierta").html("<img src=\"../../../config/img/modelos/duo.jpg\" width=\"100%\">");
        $("#acabadocubierta").fadeOut();
        $("#opcion_deltaB").hide();
        $("#opcion_deltaCD").show();
        $("#btncubiertaS").prop('disabled', false);
    });

    $("#deltaD").click(function () {
        $("#dibucubierta").html("<img src=\"../../../config/img/modelos/cave.jpg\" width=\"100%\">");
        $("#acabadocubierta").fadeOut();
        $("#opcion_deltaB").hide();
        $("#opcion_deltaCD").show();
        $("#btncubiertaS").prop('disabled', false);
    });

    $("#altea0").click(function () {
        $("#dibucubierta").html("<img src=\"../../../config/img/modelos/terra.jpg\" width=\"100%\">");
        $("#acabadocubierta").fadeOut();
        $("#opcion_deltaB").hide();
        $("#opcion_deltaCD").hide();
        $("#btncubiertaS").prop('disabled', false);
    });

    $("#terra_lite").click(function () {
        $("#dibucubierta").html("<img src=\"../../../config/img/modelos/terra_lite.jpg\" width=\"100%\">");
        $("#acabadocubierta").fadeOut();
        $("#opcion_deltaB").hide();
        $("#opcion_deltaCD").hide();
        $("#btncubiertaS").prop('disabled', false);
    });
    $("#terra_slim").click(function () {
        $("#dibucubierta").html("<img src=\"../../../config/img/modelos/terra_slim.jpg\" width=\"100%\">");
        $("#acabadocubierta").fadeOut();
        $("#opcion_deltaB").hide();
        $("#opcion_deltaCD").hide();
        $("#btncubiertaS").prop('disabled', false);
    });
    $("#terra_solar").click(function () {
        $("#dibucubierta").html("<img src=\"../../../config/img/modelos/terra_solar.jpg\" width=\"100%\">");
        $("#acabadocubierta").fadeOut();
        $("#opcion_deltaB").hide();
        $("#opcion_deltaCD").hide();
        $("#btncubiertaS").prop('disabled', false);
    });

    $("#acabadocubierta1").on('change', function () {
        if ($(this).is(":checked")) {
            // Si acabadocubierta1 está marcado
            $("#acabadocubierta2").prop('checked', false);
            $("#ipe_revestir").hide();
            $("input[name='acabadoTapa']").prop('checked', false);
        } else {
            // Si acabadocubierta1 se desmarca
            $("#acabadocubierta2").prop('checked', false);
            $("#ipe_revestir").hide();
            $("input[name='acabadoTapa']").prop('checked', false);
        }
    });

    $("#acabadocubierta2").on('change', function () {
        if ($(this).is(":checked")) {
            // Si acabadocubierta2 está marcado
            $("#acabadocubierta1").prop('checked', true);
            $("#ipe_revestir").show();
            $("input[name='acabadoTapa']:first").prop('checked', true);
        } else {
            // Si acabadocubierta2 se desmarca
            $("#ipe_revestir").hide();
            $("input[name='acabadoTapa']").prop('checked', false);
        }
    });

    // Botones atrás / siguiente
    $("#btncubiertaS").click(function () {

        $("#deltaltea").val($("input[name='deltaltea']:checked").val());
        $("#conViga").val($("input[name='acabadocubierta1']:checked").val());
        $("#conTapa").val($("input[name='acabadocubierta2']:checked").val());
        $("#cubierta").hide();
        $("#piscina").show();

    });

    /*********** PISCINA *************/

    // Botones atrás / siguiente
    $("#btnpiscinaA").click(function () {
        $("#piscina").hide();
        $("#cubierta").show();
    });

    $("#btnpiscinaS").click(function () {
        piscinaOk = 1;
        if ($("#piscina_w").val() > 600) { piscinaOk = 0; $("#errorPisW").fadeIn(); setTimeout("$('#errorPisW').fadeOut();", 3200); }
        if ($("#piscina_h").val() > 2000) { piscinaOk = 0; $("#errorPisH").fadeIn(); setTimeout("$('#errorPisH').fadeOut();", 3200); }

        if (piscinaOk == 1) {
            $("#anchoPiscina").val($("#piscina_w").val());
            $("#largoPiscina").val($("#piscina_h").val());
            $("#profundidadTapa").val($("#tapa_prof").val());
            $("#profundidadPis").val($("#piscina_p").val());
            $("#piscina").hide(); $("#escalera").show();
            $("#tipoTapa").val($("input[name='acabadoTapa']:checked").val());
            $("#tipoPiscina").val($("input[name='acabadoPiscina']:checked").val());

        }
    });

    /*********** ESCALERA *************/

    darpasoforma = darpasopos = 0;

    $("#btnescaleraS").prop('disabled', true);
    $("#medidasescalera").hide();

    $("#posescaleraD").click(function () {
        $("#posicionEscalera").val("D");
        $("#dibuescalera, #escaleraFC").hide();
        $("#escaleraD").show();
        $(".lugarescalera").removeClass("activo");
        $(this).addClass("activo");
        $("#btnescaleraS").prop('disabled', false);
        $("#medidasescalera").hide();
    });

    $("#posescaleraF").click(function () {
        $("#posicionEscalera").val("F");
        $("#dibuescalera, #escaleraD").hide();
        $("#escaleraF").show();
        $("#posicion1, #posicion2").hide();
        $("#enrollador").show();
        $(".lugarescalera").removeClass("activo");
        $(this).addClass("activo");
        $("#btnescaleraS").prop('disabled', true);
    });

    $("#posescalera15").click(function () {
        $("#medidasescalera").show();
        $("#escaleraF").hide();
    });

    $("#posescalera16").click(function () {
        $("#medidasescalera").show();
        $("#escaleraF").hide();
    });
    $("#posescalera17").click(function () {
        $("#medidasescalera").show();
        $("#escaleraF").hide();
    });

    $(".escaleraromana").click(function () {

        darpasoforma = 1;
        darpasoesc();
    });

    $("#posenrollador1").click(function () {
        $("#enrollador").hide();
        $("#posicion1").show();
    });

    $("#posenrollador1").click(function () {
        $("#enrollador").hide();
        $("#posicion1").show();
    });

    $("#posenrollador2").click(function () {
        $("#enrollador").hide();
        $("#posicion2").show();
    });


    $(".posescalera").click(function () {
        $("#posescalera").val($(this).attr("value"));
        $(".posescalera").removeClass("activo");
        $(this).addClass("activo");

        darpasopos = 1;
        darpasoesc();
    });

    // Botones atrás / siguiente
    $("#btnescaleraA").click(function () {
        $("#escalera").hide();
        $("#piscina").show();

    });
    $("#btnescaleraS").click(function () {
        $("#anchoEscalera").val($("#escalera_w").val());
        $("#largoEscalera").val($("#escalera_h").val());

        escaleraOk = 1;
        if ($("#escalera_w").val() > $("#piscina_w").val()) {
            escaleraOk = 0;
            $("#errorEscW").fadeIn(); setTimeout("$('#errorEscW').fadeOut();", 3200);
            $(".formaescalera").hide(); setTimeout("$('.formaescalera').fadeIn();", 4000);
        }

        var pEscalera = $("#posicionEscalera").val();

        var senEscalera = $("#posescalera").val();

        if (pEscalera == "D" || senEscalera == 12 || senEscalera == 13 || senEscalera == 15 || senEscalera == 16 || senEscalera == 17
            || senEscalera == 21 || senEscalera == 22 || senEscalera == 23 || senEscalera == 24) {
            $("#sentidoEscalera").val("S");
        } else {
            $("#sentidoEscalera").val("N");
        }

        $("#escaleraromana").val($("input[name='escaleraromana']:checked").val());

        if (escaleraOk == 1) {
            $("#escalera").hide();
            $("#lamina").show();
        }
    });

    function darpasoesc() {

        if (darpasopos == 1 && darpasoforma == 1) {
            $("#btnescaleraS").prop('disabled', false);
        } else {
            $("#btnescaleraS").prop('disabled', true);
        }
    }

    /*********** LÁMINAS *************/

    $("#btnlaminaS").prop('disabled', true);

    $("#matlamina1").click(function () {
        $("#dibulamina").html("<img src=\"../../../config/img/laminas/policarbonato.jpg\" width=\"100%\">");
        $("#divpvc").hide();
        $("#divpc").show();
        $(".matlamina").removeClass("activo");
        $(this).addClass("activo");
        $("#tipoLamina").val($(this).attr("value"));
    });

    $("#matlamina2").click(function () {
        $("#dibulamina").html("<img src=\"../../../config/img/laminas/pvc.jpg\" width=\"100%\">");
        $("#divpc").hide(); $("#divpvc").show();
        $(".matlamina").removeClass("activo"); $(this).addClass("activo");
        $("#tipoLamina").val($(this).attr("value"));

    });

    $(".collamina").click(function () {
        $("#btnlaminaS").prop('disabled', false);
        $(".collamina").removeClass("activo");
        $(this).addClass("activo");
        $("#colorLamina").val($(this).attr("value"));
    });


    // Botones atrás / siguiente
    $("#btnlaminaA").click(function () {
        $("#lamina").hide(); $("#escalera").show();
    });

    $("#btnlaminaS").click(function () {

        $("#TIPO").val(1);
        $("#lamina").hide();
        $("#instalacion").show();
        $('#error').hide();

    });

    /*********** INSTALACION *************/

    $("#btninstalacionS").prop('disabled', true);
    $("#btncodigoclienteS").prop('disabled', true);

    inspro = inspre = 0;

    $("#instaExterna").click(function () {
        insta = "ext";
        $("#tipoInsta").val("E");
        $("#propia").hide(); $("#externa").show();
        cinstaE();
    });

    $("#instaPropia").click(function () {
        insta = "prop";
        $("#tipoInsta").val("P");
        $("#externa").hide(); $("#propia").show();
        cinstaP();
    });

    $("#provinciaPre").change(function () {
        if ($(this).val() == 0) { inspro = 0; } else { inspro = 1; }
        cinstaE();
    });

    $("#instaprecio0").on("keyup", function () {
        if ($(this).val().length > 2) { inspre = 1; } else { inspre = 0; }
        cinstaP();
    });

    $("#codclienteV, #codseguridadV").on("keyup", function () {
        codigoSeguridad();
    });

    function cinstaE() {
        $("#btninstalacionS").prop('disabled', false);
    }

    function codigoSeguridad() {
        let codClienteLleno = $("#codclienteV").val().length > 2;
        let codSeguridadLleno = $("#codseguridadV").val().length > 2;

        if (codClienteLleno && codSeguridadLleno) {
            $("#btncodigoclienteS").prop("disabled", false); // Habilita el botón
        } else {
            $("#btncodigoclienteS").prop("disabled", true); // Deshabilita el botón
        }
    }
    function cinstaP() {

        if (inspre == 1) {
            $("#btninstalacionS").prop('disabled', false);
        } else {
            $("#btninstalacionS").prop('disabled', true);
        }
    }

    // Botones atrás / siguiente
    $("#btninstalacionA").click(function () {
        $("#instalacion").hide();
        $("#lamina").show();
    });

    $("#btninstalacionS").click(function () {
        $("#instalacion").hide();
        //$("#cod_cliente").show();
        $("#preciopvp").show();
        $("#CLIENTE").val($("input[name='acabadocubierta2']:checked").val());
        $('#error').hide();
        $("#PVP").val(1);
        // ENVIAMOS DATOS
        enviar();
    });

    /*********** PRECIO PVP *************/


    // Botones atrás / siguiente
    $("#btnprecioPVPA").click(function () {
        $("#instalacion").show();
        $("#preciopvp").hide();
    });

    $("#btnprecioPVPS").click(function () {
        $("#cod_cliente").show();
        $("#preciopvp").hide();
    });


    /*********** CODIGO CLIENTE *************/

    $("#btncodigoclienteA").click(function () {

        $("#preciopvp").show();
        $("#cod_cliente").hide();

    });

    $("#btncodigoclienteS").click(function () {

        $("#instaprecio").val($("#instaprecio0").val());
        $("#provinciaPrecio").val($("#provinciaPre").val());
        $("#cod_cliente").hide();
        $("#codcliente").val($("#codclienteV").val());
        $("#codseguridad").val($("#codseguridadV").val());

        // ENVIAMOS DATOS
        //enviar();

        $("#instalacion").hide();
        $("#precio").show();
        $('#error').hide();

    });

    /*********** PRECIO *************/

    $("#btnprecioS").prop('disabled', true);

    // Botones atrás / siguiente
    $("#btnprecioA").click(function () {

        $("#precio").hide();
        $("#cod_cliente").show();

    });
    $("#btnprecioS").click(function () {
        $("#cod_cliente").hide();
        $("#precio").hide(); $("#cliente0").show();
    });

    /*********** CLIENTE *************/

    $("#btnclienteS").prop('disabled', true);

    crazonsocial = cnombre = ccif = cpassword = cpassword2 = ctelefonofijo = ctelefonomovil = cemail = 0;

    $("#nombre").on("keyup", function () {
        if ($(this).val().length > 1) { cnombre = 1; } else { cnombre = 0; }
        cform();
    });


    function cform() {

        if (cnombre == 1) { $("#comp-nombre img").css('visibility', 'visible'); } else { $("#comp-nombre img").css('visibility', 'hidden'); }
        if (cnombre == 1) {
            $("#btnclienteS").prop('disabled', false);
            //$("#TIPO").val( 2 );
        } else {
            $("#btnclienteS").prop('disabled', true);
        }

    }

    // Botones atrás / siguiente
    $("#btnclienteA").click(function () {

        $("#cliente0").hide(); $("#precio").show();

    });
    $("#btnclienteS").click(function () {
        let datosclientehtml = `
                <table style="border-collapse: collapse; width: 100%;">
                    <tr><td><b>Nombre:</b></td><td>${escapeHtml($("#nombre").val())}</td></tr>
                    <tr><td><b>Email:</b></td><td>${escapeHtml($("#email").val())}</td></tr>
                    <tr><td><b>Dirección:</b></td><td>${escapeHtml($("#direccion").val())}</td></tr>
                    <tr><td><b>Población:</b></td><td>${escapeHtml($("#poblacion").val())}</td></tr>
                    <tr><td><b>Teléfono:</b></td><td>${escapeHtml($("#telefono").val())}</td></tr>
                    <tr><td><b>Provincia:</b></td><td>${escapeHtml($("#provincia").val())}</td></tr>
                    <tr><td><b>CP:</b></td><td>${escapeHtml($("#cp").val())}</td></tr>
                    <tr><td><b>País:</b></td><td>${escapeHtml($("#pais").val())}</td></tr>
                </table>`;

        // Pasar la tabla a los inputs ocultos
        $("#datoscliente").val(datosclientehtml);
        $("#datosprint").val(datosclientehtml);

        // Ocultar y mostrar elementos
        $("#cliente0").hide();
        $("#imprimirdiv").show();


    });

    // Función para evitar problemas con caracteres especiales
    function escapeHtml(text) {
        return text.replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    /*********** IMPRIMIR *************/

    $("#btnimprimirS").prop('disabled', false);

    // Botones atrás / siguiente
    $("#btnimprimirA").click(function () {
        $("#imprimirdiv").hide(); $("#cliente0").show();

    });
    $("#btnimprimirS").click(function () {
        $("#TIPO").val(4);
        $("#imprimirdiv").hide(); $("#final").show();

    });

    /*********** FINAL *************/
    // Botones atrás / siguiente
    $("#btnfinalizarA").click(function () {

        $("#final").hide(); $("#imprimirdiv").show();

    });
});


