<div id="precioneto">
    <div class="dibujo">
        <div id="dibuprecio"><img src="../../../config/img/precio.jpg" width="100%"></div>
    </div>
    <div class="formtemp">
        <div id="mostrarprecio_neto">
            <h2><img src="../../../config/img/icono-piscina.png"><br>P.N.C</h2>
            <div id="presupuesto" class="hidden"></div>
            <div class="salto" style="height: 5px;"></div>
            {{-- <button id="toggleButton" class="mostrar_neto">Mostrar</button> --}}
        </div>

        <input type="hidden" id="precioest" name="precioest" value="0">
        <div class="salto" style="height: 5px;"></div>
        <div class="peque" id="ivaincl" style="display: none;">Los precios mostrados son estimados y con IVA
            incluido</div>
        <div class="peque" id="atencion" style="display: none;">¡Atención! Precio neto según condiciones acordadas <p
                id="toggleButton" class="peque" style="cursor: pointer; text-decoration: underline;">Mostrar precio</p>
        </div>
        <div class="botones">
            <div class="divsiguiente"><button id="btnprecioNETOS" class="btnsiguiente">Siguiente <img
                        src="../../../config/img/flecha-s.png" align="absmiddle"></button></div>
            <div class="divanterior"><button id="btnprecioNETOA" class="btnanterior"><img
                        src="../../../config/img/flecha-a.png" align="absmiddle"> Atrás</button></div>
        </div>
    </div>
</div>

<script>
    document.getElementById('toggleButton').addEventListener('click', function() {
                var presupuestoDiv = document.getElementById('presupuesto');
                if (presupuestoDiv.classList.contains('hidden')) {
                    presupuestoDiv.classList.remove('hidden');
                    this.textContent = 'Ocultar precio';
                } else {
                    presupuestoDiv.classList.add('hidden');
                    this.textContent = 'Mostrar precio';
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
