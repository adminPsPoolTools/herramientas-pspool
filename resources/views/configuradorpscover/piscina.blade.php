<div id="piscina">
    <div class="dibujo">
        <div id="dibupiscina"></div>
    </div>
    <div class="formtemp">
        <h2><img src="../../../config/img/icono-piscina.png"><br>Datos de la piscina</h2>
        Para piscinas rectangulares

        <div class="salto" style="height: 30px;"></div>

        <div id="hormigon_fibra">

            <label class="switch">
                <input type="radio" name="acabadoPiscina" id="acabadoPiscina1" value="hormigon" checked>
                <div class="slider round"></div>
            </label>
            <div class="nombrecheck">Hormigón</div>
            <br>

            <label class="switch">
                <input type="radio" name="acabadoPiscina" id="acabadoPiscina1" value="liner">
                <div class="slider round"></div>
            </label>
            <div class="nombrecheck">Liner</div>
            <br>

            <label class="switch">
                <input type="radio" name="acabadoPiscina" id="acabadoPiscina2" value="fibra">
                <div class="slider round"></div>
            </label>
            <div class="nombrecheck">Fibra</div>
        </div>

        <div class="salto" style="height: 30px;"></div>
        <div class="wxh">Ancho (cm)<br><span class="peque">(600 cm Max)</span></div>
        <div class="dato"><input type="number" name="piscina_w" id="piscina_w" value="400" max="600"><span
                id="errorPisW" class="ocultar errorcampo">El ancho sobrepasa el
                límite</span></div>

        <div class="salto" style="height: 20px;"></div>

        <div class="wxh">Largo (cm)<br><span class="peque">(2000 cm Max)</span></div>
        <div class="dato"><input type="number" name="piscina_h" id="piscina_h" value="800" max="2000"><span
                id="errorPisH" class="ocultar errorcampo">El largo sobrepasa el
                límite</span></div>

        <div id="opcion_deltaB" class="ocultar">
            <div class="salto" style="height: 20px;"></div>
            <div class="wxh">Profundidad de la tapa (max. 155 cm)</div>
            <div class="dato"><input type="number" name="tapa_prof" id="tapa_prof" value="20" max="155">
            </div>
        </div>
        <div id="opcion_deltaCD" class="ocultar">
            <div class="salto" style="height: 20px;"></div>
            <div class="wxh">Profundidad de la piscina (max. 200 cm) </div>
            <div class="dato"><input type="number" name="piscina_p" id="piscina_p" value="150" max="200"></div>
        </div>

        <div class="mb-20 salto"></div>
        <div class="botones">
            <div class="divsiguiente"><button id="btnpiscinaS" class="btnsiguiente">Siguiente <img
                        src="../../../config/img/flecha-s.png" align="absmiddle"></button></div>
            <div class="divanterior"><button id="btnpiscinaA" class="btnanterior"><img
                        src="../../../config/img/flecha-a.png" align="absmiddle"> Atrás</button></div>
        </div>
    </div>
</div>
