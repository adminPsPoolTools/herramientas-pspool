<div id="escalera">

    <div class="formtemp">

        <h2><img src="../../../config/img/icono-piscina.png"><br>Datos de la escalera</h2>

        <div class="salto" style="height: 30px;"></div>

        <div class="salto" style="height: 30px;"></div>
        <div class="mb-5">¿Tienes escalera?.</div>

        <label class="switch">
            <input type="radio" class="lugarescalera" name="lugarescalera" id="posescaleraF" value="F">
            <div class="slider round"></div>
        </label>
        <div class="nombrecheck">Sí</div>
        <br>
        <label class="switch">
            <input type="radio" class="lugarescalera" name="lugarescalera" id="posescaleraD" value="D">
            <div class="slider round"></div>
        </label>
        <div class="nombrecheck">No</div>


        <div id="medidasescalera">
            <div class="salto" style="height: 20px;"></div>
            <div class="largoanchoescalera">
                <div class="wxh">Ancho (cm)</div>
                <div class="dato"><input type="number" name="escalera_w" id="escalera_w" value="100"><span
                        id="errorEscW" class="ocultar errorcampo">Ancho superior a la
                        piscina</span></div>

                <div class="salto" style="height: 20px;"></div>

                <div class="wxh">Largo (cm)</div>
                <div class="dato"><input type="number" name="escalera_h" id="escalera_h" value="100">
                </div>
            </div>

            <div class="formaescalera">
                <label class="switch">
                    <input type="radio" class="escaleraromana" name="escaleraromana" id="escRe" value="RECTA">
                    <div class="slider round"></div>
                </label>
                <div class="nombrecheck">Forma recta</div>
                <label class="switch">
                    <input type="radio" class="escaleraromana" name="escaleraromana" id="escRo" value="ROMANA">
                    <div class="slider round"></div>
                </label>
                <div class="nombrecheck">Forma romana</div>
            </div>
        </div>
    </div>

    <div class="dibujo">
        <div id="dibuescalera"><img src="../../../config/img/escalera.png"></div>

        <div id="escaleraD" style="display: none;">
            <img src="../../../config/img/tipos_piscinas/dentro.png">
        </div>

        <div id="escaleraF" style="display: none;">
            <div id="enrollador">
                Elije la posición del <b>enrollador</b>.<br>
                Ten en cuenta que puede estar también al lado opuesto.<br><br>

                <button name="posenrollador1" id="posenrollador1" value="F"><img
                        src="../../../config/img/tipos_piscinas/1-0.png" width="100%"></button>
                <button name="posenrollador2" id="posenrollador2" value="D"><img
                        src="../../../config/img/tipos_piscinas/2-0.png" width="100%"></button>
            </div>

            <div id="posicion1">
                Elije la posición de la <b>escalera</b>.<br>
                Ten en cuenta que es aproximada y puede estar también al lado opuesto.<br><br>
                <button class="posescalera" name="posescalera" id="posescalera15" value="15"><img
                        src="../../../config/img/tipos_piscinas/1-5.png" width="100%"></button>
                <button class="posescalera" name="posescalera" id="posescalera16" value="16"><img
                        src="../../../config/img/tipos_piscinas/1-6.png" width="100%"></button>
                <button class="posescalera" name="posescalera" id="posescalera17" value="17"><img
                        src="../../../config/img/tipos_piscinas/1-7.png" width="100%"></button>
            </div>

            <div id="posicion2">
                Elije la posición de la <b>escalera</b>.<br>
                Ten en cuenta que es aproximada y puede estar también al lado opuesto.<br><br>


                <button class="posescalera" name="posescalera" id="posescalera21" value="21"><img
                        src="../../../config/img/tipos_piscinas/2-1.png" width="100%"></button>
                <button class="posescalera" name="posescalera" id="posescalera22" value="22"><img
                        src="../../../config/img/tipos_piscinas/2-2.png" width="100%"></button>
                <button class="posescalera" name="posescalera" id="posescalera23" value="23"><img
                        src="../../../config/img/tipos_piscinas/2-3.png" width="100%"></button>

            </div>
        </div>
    </div>

    <div class="mb-20 salto"></div>
    <div class="botones btnescalera">
        <div class="divsiguiente"><button id="btnescaleraS" class="btnsiguiente">Siguiente <img
                    src="../../../config/img/flecha-s.png" align="absmiddle"></button></div>
        <div class="divanterior"><button id="btnescaleraA" class="btnanterior"><img
                    src="../../../config/img/flecha-a.png" align="absmiddle"> Atrás</button></div>
    </div>
</div>