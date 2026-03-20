<div id="preciopvp">
    <div class="dibujo">
        <div id="dibuprecio"><img src="../../../config/img/precio.jpg" width="100%"></div>
    </div>
    <div class="formtemp">
        <div id="mostrarprecio">
            <h2><img src="../../../config/img/icono-piscina.png"><br>P.V.P</h2>
            <div id="presupuestoPVP"></div>
            <div class="salto" style="height: 5px;"></div>
            <div class="peque">Los precios mostrados son estimados y con IVA
                incluido
            </div>
        </div>
        <div id="error">
            <b>No se ha podido realizar una estimación de precio<br>por el siguiente error:</b><br>
            <div id="errortxt"></div>
            Pruebe otras opciones o contacte con nuestro departamento especializado para resolver sus
            dudas
        </div>

        <div id="enviando">
            <div id="txt"><img src="../../../config/img/cargando1.gif" width="100" align="absmiddle"><br class="mobile">
                Por favor, no cierre la página</div>
        </div>

        <div class="botones">
            <div class="divsiguiente"><button id="btnprecioPVPS" class="btnsiguiente">Siguiente <img
                        src="../../../config/img/flecha-s.png" align="absmiddle"></button></div>
            <div class="divanterior"><button id="btnprecioPVPA" class="btnanterior"><img
                        src="../../../config/img/flecha-a.png" align="absmiddle"> Atrás</button></div>
        </div>
    </div>
</div>


<script>
    document.getElementById('toggleButton').addEventListener('click', function() {
                var presupuestoDiv = document.getElementById('presupuesto');
                if (presupuestoDiv.classList.contains('hidden')) {
                    presupuestoDiv.classList.remove('hidden');
                    this.textContent = 'Ocultar';
                } else {
                    presupuestoDiv.classList.add('hidden');
                    this.textContent = 'Mostrar';
                }
            });
</script>

<style>
    .mostrar_neto {
        font-size: 35px;
    }

    .hidden {
        display: none;
    }
</style>