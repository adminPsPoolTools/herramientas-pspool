<div id="imprimirdiv">
    <div class="dibujo">
        <div id="dibuimprimir"><img src="../../../config/img/cubierta.jpg" width="100%"></div>
    </div>

    <div class="formtemp">
        <h2>¿Necesitas imprimirlo?</h2>
        <form name="formprint" id="formprint" method="post">
            <input type="hidden" name="TIPO" id="tipoprint" value="3">
            <input type="hidden" name="PRESUPUESTO" id="presu">
            <input type="hidden" name="DATOSPRINT" id="datosprint">
            <input type="hidden" id="codpresupuesto" name="codpresupuesto" placeholder="Presupuesto">
        </form>
        <button class="boton-s" id="imprimir">Imprimir</button>
        <div class="salto" style="height: 30px;"></div>
        <div class="salto desktop" style="height: 50px;"></div>
        <h3>Tambien puede encontrar este presupuesto en su área administrativa</h3><br>
        <div class="botones">
            <div class="divsiguiente"><button id="inicio" class="btnsiguiente">Volver al inicio</button></div>
            <div class="divanterior"><button id="btnimprimirA" class="btnanterior"><img
                        src="../../../config/img/flecha-a.png" align="absmiddle"> Atrás</button></div>
        </div>
    </div>
</div>