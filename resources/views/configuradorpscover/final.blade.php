<div id="final">
    <div class="dibujo">
        <div id="dibuprecio"><img src="../../../config/img/cubierta.jpg" width="100%"></div>
    </div>

    <div class="formtemp">
        <!-- <h2>¿Quieres enviarlo por email?</h2><br> -->
        <h2>Generar oferta</h2><br>

        <form name="formemail" id="formemail" method="post" action="../../../config/lib/enviar_correo.php"
            target="_blank">

            <input type="hidden" name="TIPO" id="tipoemail" value="4">
            <input type="hidden" name="PRESUPUESTO" id="presuemail">
            <input type="hidden" name="CLIENTE" id="clienteemail">
            <!-- <input type="hidden"	name="HTML"	id="htmlemail"> -->
            <input type="hidden" name="PDF" id="pdfemail">
        </form>

        <div class="mb-20 salto" style="height: 30px;"></div>

        <!-- <button id="enviaremail">Enviar por email</button> -->
        <button id="enviaremail">Recibir email</button>

        <div class="botones">
            <div id="btnvolverFin" class="divsiguiente ocultar"><button class="btnanterior" style="width: 300px;"><img
                        src="../../../config/img/flecha-a.png" align="absmiddle">
                    Volver al inicio</button></div>
            <div id="btnFin" class="divanterior"><button id="btnfinalizarA" class="btnanterior"><img
                        src="../../../config/img/flecha-a.png" align="absmiddle"> Atrás</button></div>
        </div>
    </div>
</div>
