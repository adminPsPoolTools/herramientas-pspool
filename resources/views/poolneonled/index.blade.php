@extends('layouts.app')

@section('content')
    <x-header-herramientas class="py-5 titulo" background="background-image: url({{ asset('storage/img/home/home.jpg') }})"
        title="Calculadora de tiras led" description="Calcula tu tiras leds de tu piscinas" :user="$user" />

    <div class="container w-full max-w-screen-xl px-3 mx-auto mb-8 sm:px-4 contenido">
        <div class="p-3 mb-0 caja sm:p-5 md:p-8">
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Configurador Pool Neon Led</h2>
                <p class="mt-1 text-sm text-gray-600">Formulario por pasos para ir solicitando datos del proyecto.</p>
            </div>

            <div class="grid grid-cols-2 gap-2 mb-8 text-xs text-center sm:grid-cols-3 lg:grid-cols-6 sm:text-sm"
                id="wizard-indicator">
                <div class="px-3 py-2 font-medium text-white bg-blue-600 rounded" data-indicator-step="1">1. Color</div>
                <div class="px-3 py-2 font-medium text-gray-600 bg-gray-200 rounded" data-indicator-step="2">2. Perfil</div>
                <div class="px-3 py-2 font-medium text-gray-600 bg-gray-200 rounded" data-indicator-step="3">3. Control
                </div>
                <div class="px-3 py-2 font-medium text-gray-600 bg-gray-200 rounded" data-indicator-step="4">4.
                    Transformador</div>
                <div class="px-3 py-2 font-medium text-gray-600 bg-gray-200 rounded" data-indicator-step="5">5. Tiras led
                </div>
                <div class="px-3 py-2 font-medium text-gray-600 bg-gray-200 rounded" data-indicator-step="6">6. Tipo salida
                </div>
            </div>

            <form id="formulario-pool-neon-led" class="space-y-6" action="{{ route('poolneonled.calculo') }}"
                method="POST">
                @csrf
                <section data-step="1" class="wizard-step">
                    <h3 class="mb-3 text-lg font-semibold text-gray-800">Paso 1: Tipo de color</h3>
                    <p class="mb-4 text-sm text-gray-600">Selecciona el tipo de luz principal.</p>
                    <div class="grid gap-3 md:grid-cols-2">
                        <label class="block p-4 border border-gray-300 rounded cursor-pointer hover:border-blue-400">
                            <input type="radio" name="color" value="rgbw" class="mr-2">
                            <span class="font-medium text-gray-800">RGBW</span>
                            <p class="mt-1 text-sm text-gray-600">Color dinamico + blanco.</p>
                        </label>
                        <label class="block p-4 border border-gray-300 rounded cursor-pointer hover:border-blue-400">
                            <input type="radio" name="color" value="blanco" class="mr-2">
                            <span class="font-medium text-gray-800">Blanco</span>
                            <p class="mt-1 text-sm text-gray-600">Iluminacion blanca fija.</p>
                        </label>
                    </div>
                    <p class="mt-2 text-sm text-red-600" id="error-step-1"></p>
                </section>

                <section data-step="2" class="hidden wizard-step">
                    <h3 class="mb-3 text-lg font-semibold text-gray-800">Paso 2: Tipo de perfil</h3>
                    <p class="mb-4 text-sm text-gray-600">Elige el perfil de instalacion de la tira.</p>
                    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                        <label class="block p-4 border border-gray-300 rounded cursor-pointer hover:border-blue-400">
                            <div class="flex items-center mb-3">
                                <input type="radio" name="perfil" value="normal" class="mr-2">
                                <span class="font-medium text-gray-800">Normal</span>
                            </div>
                            <div class="relative">
                                <img src="{{ asset('config/img/PERFIL NORMAL.png') }}" alt="Perfil normal"
                                    class="object-contain w-full h-32 rounded sm:h-36">
                                <button type="button"
                                    class="absolute p-1 bg-white border border-gray-300 rounded-full shadow-sm top-2 right-2 hover:bg-gray-100"
                                    data-zoom-src="{{ asset('config/img/PERFIL NORMAL.png') }}"
                                    data-zoom-title="Perfil normal">
                                    <svg class="w-4 h-4 text-gray-700" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path d="M21 21L16.65 16.65M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </label>
                        <label class="block p-4 border border-gray-300 rounded cursor-pointer hover:border-blue-400">
                            <div class="flex items-center mb-3">
                                <input type="radio" name="perfil" value="con_solapa" class="mr-2">
                                <span class="font-medium text-gray-800">Con solapa</span>
                            </div>
                            <div class="relative">
                                <img src="{{ asset('config/img/PERFIL CON SOLAPA.png') }}" alt="Perfil con solapa"
                                    class="object-contain w-full h-32 rounded sm:h-36">
                                <button type="button"
                                    class="absolute p-1 bg-white border border-gray-300 rounded-full shadow-sm top-2 right-2 hover:bg-gray-100"
                                    data-zoom-src="{{ asset('config/img/PERFIL CON SOLAPA.png') }}"
                                    data-zoom-title="Perfil con solapa">
                                    <svg class="w-4 h-4 text-gray-700" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path d="M21 21L16.65 16.65M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </label>
                        <label class="block p-4 border border-gray-300 rounded cursor-pointer hover:border-blue-400">
                            <div class="flex items-center mb-3">
                                <input type="radio" name="perfil" value="flexible" class="mr-2">
                                <span class="font-medium text-gray-800">Flexible</span>
                            </div>
                            <div class="relative">
                                <img src="{{ asset('config/img/PERFIL FLEXIBLE.png') }}" alt="Perfil flexible"
                                    class="object-contain w-full h-32 rounded sm:h-36">
                                <button type="button"
                                    class="absolute p-1 bg-white border border-gray-300 rounded-full shadow-sm top-2 right-2 hover:bg-gray-100"
                                    data-zoom-src="{{ asset('config/img/PERFIL FLEXIBLE.png') }}"
                                    data-zoom-title="Perfil flexible">
                                    <svg class="w-4 h-4 text-gray-700" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path d="M21 21L16.65 16.65M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </label>
                    </div>
                    <p class="mt-2 text-sm text-red-600" id="error-step-2"></p>
                </section>

                <section data-step="3" class="hidden wizard-step">
                    <h3 class="mb-3 text-lg font-semibold text-gray-800">Paso 3: Tipo de control</h3>
                    <p class="mb-4 text-sm text-gray-600">
                        Elige como quieres controlar las tira led.
                    </p>

                    <div class="grid gap-3 md:grid-cols-2">
                        <label class="block p-4 border border-gray-300 rounded cursor-pointer hover:border-blue-400">
                            <input type="radio" name="mando" value="Mando" class="mr-2">
                            <span class="font-medium text-gray-800">Mando</span>
                        </label>
                        <label class="block p-4 border border-gray-300 rounded cursor-pointer hover:border-blue-400">
                            <input type="radio" name="mando" value="DMX" class="mr-2">
                            <span class="font-medium text-gray-800">DMX</span>
                        </label>
                        <label class="block p-4 border border-gray-300 rounded cursor-pointer hover:border-blue-400">
                            <input type="radio" name="mando" value="KNX" class="mr-2">
                            <span class="font-medium text-gray-800">KNX</span>
                        </label>
                        <label class="block p-4 border border-gray-300 rounded cursor-pointer hover:border-blue-400">
                            <input type="radio" name="mando" value="WIFI" class="mr-2">
                            <span class="font-medium text-gray-800">WIFI</span>
                        </label>

                    </div>
                    <p class="mt-2 text-sm text-red-600" id="error-step-3"></p>
                </section>

                <section data-step="4" class="hidden wizard-step">
                    <h3 class="mb-3 text-lg font-semibold text-gray-800">Paso 4: Transformador</h3>
                    <p class="mb-4 text-sm text-gray-600">Quieres transformador?</p>
                    <div class="grid gap-3 md:grid-cols-2">
                        <label class="block p-4 border border-gray-300 rounded cursor-pointer hover:border-blue-400">
                            <input type="radio" name="transformador" value="si" class="mr-2">
                            <span class="font-medium text-gray-800">Si</span>
                        </label>
                        <label class="block p-4 border border-gray-300 rounded cursor-pointer hover:border-blue-400">
                            <input type="radio" name="transformador" value="no" class="mr-2">
                            <span class="font-medium text-gray-800">No</span>
                        </label>
                    </div>
                    <p class="mt-2 text-sm text-red-600" id="error-step-4"></p>
                </section>

                <section data-step="5" class="hidden wizard-step">
                    <h3 class="mb-3 text-lg font-semibold text-gray-800">Paso 5: Cuantas tiras led quieres?</h3>
                    <p class="mb-3 text-sm text-gray-600">
                        Introduce la longitud de cada tira en metros para calcular automaticamente el tipo de alimentacion.
                    </p>
                    <div class="max-w-xs">
                        <label for="cantidad_tiras" class="block text-sm font-medium text-gray-700">Numero de
                            tiras</label>
                        <input type="number" id="cantidad_tiras" name="cantidad_tiras" min="1" step="1"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md"
                            placeholder="Ejemplo: 2">
                    </div>
                    <p class="mt-2 text-sm text-red-600" id="error-step-5"></p>

                    <div id="contenedor-tiras-longitudes" class="grid gap-3 mt-4"></div>

                    <div id="bloque-complemento-transformador"
                        class="hidden p-3 mt-4 border border-emerald-200 rounded bg-emerald-50 sm:p-4">
                        <h4 class="mb-2 font-semibold text-emerald-900">Seleccion de transformador</h4>
                        <p class="text-xs text-emerald-800 sm:text-sm">
                            Seleccion actual: <span id="codigo-transformador" class="font-semibold break-words">-</span>
                        </p>
                        <p class="mt-2 text-xs text-emerald-800 sm:text-sm">
                            Potencia necesaria: <span id="watts-transformador" class="font-semibold">-</span>
                        </p>
                        <div id="opciones-transformador" class="grid gap-2 mt-3"></div>
                        <p id="mensaje-transformador" class="mt-2 text-[11px] text-emerald-700 sm:text-xs">
                            Completa los metros de las tiras para calcular opciones.
                        </p>
                    </div>

                </section>

                <section data-step="6" class="hidden wizard-step">
                    <h3 class="mb-3 text-lg font-semibold text-gray-800">Paso 6: Tipo de salida</h3>
                    <p class="mb-4 text-sm text-gray-600">Cada tira debe tener su propio tipo de salida.</p>
                    <div id="contenedor-salidas-tiras" class="grid gap-4"></div>
                    <p class="mt-2 text-sm text-red-600" id="error-step-6"></p>
                </section>

                <input type="hidden" id="calculos_tiras_json" name="calculos_tiras_json" value="[]">
                <input type="hidden" id="tipos_salida_tiras_json" name="tipos_salida_tiras_json" value="[]">
                <input type="hidden" id="articulos_base_json" name="articulos_base_json" value="[]">
                <input type="hidden" id="transformadores_seleccionados_json" name="transformadores_seleccionados_json"
                    value="[]">

                <div id="image-zoom-modal" class="fixed inset-0 z-[70] hidden">
                    <div class="absolute inset-0 bg-black/70" data-zoom-close="overlay"></div>
                    <div class="relative flex items-center justify-center w-full h-full p-3 sm:p-6">
                        <div class="relative w-full max-w-3xl p-3 bg-white rounded-lg shadow-xl sm:p-4">
                            <button type="button" id="image-zoom-close"
                                class="absolute p-2 text-gray-700 bg-white border border-gray-300 rounded-full top-2 right-2 hover:bg-gray-100">
                                <span class="sr-only">Cerrar</span>
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                                    aria-hidden="true">
                                    <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                            <p id="image-zoom-title" class="pr-10 text-sm font-semibold text-gray-800 sm:text-base">
                                Vista ampliada
                            </p>
                            <img id="image-zoom-preview" src="" alt="Vista ampliada"
                                class="object-contain w-full h-[60vh] mt-3 rounded bg-gray-50">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-3 pt-2 sm:flex-row sm:items-center sm:justify-between">
                    <button type="button" id="btn-anterior"
                        class="w-full px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded sm:w-auto disabled:opacity-50"
                        disabled>
                        Anterior
                    </button>
                    <div class="grid w-full grid-cols-1 gap-2 sm:flex sm:w-auto">
                        <button type="button" id="btn-siguiente"
                            class="w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded sm:w-auto hover:bg-blue-700">
                            Siguiente
                        </button>
                        <button type="button" id="btn-finalizar"
                            class="hidden w-full px-4 py-2 text-sm font-medium text-white bg-green-600 rounded sm:w-auto hover:bg-green-700">
                            Calcular
                        </button>
                    </div>
                </div>

            </form>

            <section id="seccion-presupuesto" class="hidden p-3 mt-5 border rounded bg-gray-50 sm:p-4">
                <h4 class="mb-2 font-semibold text-gray-800">Presupuesto</h4>
                <p id="presupuesto-error" class="hidden mb-3 text-sm text-red-600"></p>
                <div id="resultado-api-tabla-wrapper" class="hidden overflow-x-auto">
                    <table class="min-w-[640px] w-full text-xs sm:text-sm text-left border border-gray-200 rounded">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-3 py-2 border-b">Ref</th>
                                <th class="px-3 py-2 border-b">Descripcion</th>
                                <th class="px-3 py-2 border-b">Uds</th>
                                <th class="px-3 py-2 border-b">Precio</th>
                                <th class="px-3 py-2 border-b">Total</th>
                            </tr>
                        </thead>
                        <tbody id="resultado-api-tabla-body"></tbody>
                        <tfoot>
                            <tr class="font-semibold bg-gray-100">
                                <td class="px-3 py-2 border-t" colspan="4">Total general</td>
                                <td class="px-3 py-2 border-t" id="resultado-api-total-general">-</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="grid grid-cols-1 gap-2 mt-4 sm:flex sm:flex-wrap">
                    <button type="button" id="btn-presupuesto-atras"
                        class="w-full px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded sm:w-auto hover:bg-gray-300">
                        Atras
                    </button>
                    <button type="button" id="btn-presupuesto-pdf"
                        class="w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded sm:w-auto hover:bg-indigo-700">
                        Imprimir PDF
                    </button>
                </div>
            </section>

            <x-boton-volver :user="$user" />
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const totalSteps = 6;
            let currentStep = 1;

            const form = document.getElementById('formulario-pool-neon-led');
            const btnNext = document.getElementById('btn-siguiente');
            const btnPrev = document.getElementById('btn-anterior');
            const btnFinish = document.getElementById('btn-finalizar');
            const mandoComplementBox = document.getElementById('bloque-complemento-mando');
            const controlComplementTitle = document.getElementById('titulo-complemento-control');
            const controlFixedLabel = document.getElementById('label-control-fijo');
            const controlSecondaryLabel = document.getElementById('label-control-secundario');
            const controlFixedCode = document.getElementById('codigo-control-fijo');
            const controlSecondaryCode = document.getElementById('codigo-control-secundario');
            const transformerComplementBox = document.getElementById('bloque-complemento-transformador');
            const transformerCode = document.getElementById('codigo-transformador');
            const transformerWatts = document.getElementById('watts-transformador');
            const transformerOptionsContainer = document.getElementById('opciones-transformador');
            const transformerMessage = document.getElementById('mensaje-transformador');
            const stripCountInput = document.getElementById('cantidad_tiras');
            const stripLengthsContainer = document.getElementById('contenedor-tiras-longitudes');
            const stripOutputsContainer = document.getElementById('contenedor-salidas-tiras');
            const stripCalcJsonInput = document.getElementById('calculos_tiras_json');
            const stripOutputsJsonInput = document.getElementById('tipos_salida_tiras_json');
            const baseArticlesJsonInput = document.getElementById('articulos_base_json');
            const selectedTransformersJsonInput = document.getElementById('transformadores_seleccionados_json');
            const imageZoomModal = document.getElementById('image-zoom-modal');
            const imageZoomClose = document.getElementById('image-zoom-close');
            const imageZoomPreview = document.getElementById('image-zoom-preview');
            const imageZoomTitle = document.getElementById('image-zoom-title');
            const wizardIndicator = document.getElementById('wizard-indicator');
            const budgetSection = document.getElementById('seccion-presupuesto');
            const budgetError = document.getElementById('presupuesto-error');
            const btnBudgetBack = document.getElementById('btn-presupuesto-atras');
            const btnBudgetPdf = document.getElementById('btn-presupuesto-pdf');
            const apiTableWrapper = document.getElementById('resultado-api-tabla-wrapper');
            const apiTableBody = document.getElementById('resultado-api-tabla-body');
            const apiTotalGeneral = document.getElementById('resultado-api-total-general');
            const outputImageMap = {
                A: "{{ asset('config/img/SALIDA A.png') }}",
                B: "{{ asset('config/img/SALIDA B.png') }}",
                C: "{{ asset('config/img/SALIDA C.png') }}",
                D: "{{ asset('config/img/SALIDA D.png') }}",
                E: "{{ asset('config/img/SALIDA RECTA E.png') }}",
            };
            const noLineBoxSelectors = [
                '#CAJ_G',
                '#CAJ_B',
                '#CAJ_A',
                '#caj_g',
                '#caj_b',
                '#caj_a',
                '.CAJ_G',
                '.CAJ_B',
                '.CAJ_A',
                '.caj_g',
                '.caj_b',
                '.caj_a'
            ];
            const transformerCatalog = [{
                    codigo: '23163',
                    potencia: 10
                },
                {
                    codigo: '22653',
                    potencia: 16
                },
                {
                    codigo: '22192',
                    potencia: 20
                },
                {
                    codigo: '22193',
                    potencia: 35
                },
                {
                    codigo: '22194',
                    potencia: 60
                },
                {
                    codigo: '22190',
                    potencia: 100
                },
                {
                    codigo: '22191',
                    potencia: 150
                },
                {
                    codigo: '22187',
                    potencia: 185
                },
                {
                    codigo: '22188',
                    potencia: 240
                },
                {
                    codigo: '22189',
                    potencia: 320
                },
                {
                    codigo: '22224',
                    potencia: 480
                }
            ];
            let isSubmitting = false;
            let stripCalculatedData = [];

            function hideCajaLinesByCss() {
                const css = `
                    #CAJ_G line, #CAJ_B line, #CAJ_A line,
                    #caj_g line, #caj_b line, #caj_a line,
                    #CAJ_G .linea, #CAJ_B .linea, #CAJ_A .linea,
                    #caj_g .linea, #caj_b .linea, #caj_a .linea,
                    #CAJ_G .line, #CAJ_B .line, #CAJ_A .line,
                    #caj_g .line, #caj_b .line, #caj_a .line,
                    .CAJ_G line, .CAJ_B line, .CAJ_A line,
                    .caj_g line, .caj_b line, .caj_a line,
                    .CAJ_G .linea, .CAJ_B .linea, .CAJ_A .linea,
                    .caj_g .linea, .caj_b .linea, .caj_a .linea,
                    .CAJ_G .line, .CAJ_B .line, .CAJ_A .line,
                    .caj_g .line, .caj_b .line, .caj_a .line {
                        display: none !important;
                        stroke: none !important;
                    }
                `;
                const style = document.createElement('style');
                style.type = 'text/css';
                style.textContent = css;
                document.head.appendChild(style);
            }

            function removeCajaLines() {
                const innerLineSelectors = 'line, .linea, .line, .line-down, .linea-bajada, path.linea, path.line';
                noLineBoxSelectors.forEach((selector) => {
                    document.querySelectorAll(selector).forEach((box) => {
                        box.querySelectorAll(innerLineSelectors).forEach((lineNode) => {
                            lineNode.remove();
                        });
                    });
                });
            }

            function watchCajaLines() {
                if (!document.body || !window.MutationObserver) {
                    return;
                }
                const observer = new MutationObserver(() => {
                    removeCajaLines();
                });
                observer.observe(document.body, {
                    childList: true,
                    subtree: true
                });
            }

            function openImageZoom(src, title) {
                if (!imageZoomModal || !imageZoomPreview) {
                    return;
                }
                imageZoomPreview.src = src || '';
                imageZoomPreview.alt = title || 'Vista ampliada';
                if (imageZoomTitle) {
                    imageZoomTitle.textContent = title || 'Vista ampliada';
                }
                imageZoomModal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }

            function closeImageZoom() {
                if (!imageZoomModal || !imageZoomPreview) {
                    return;
                }
                imageZoomModal.classList.add('hidden');
                imageZoomPreview.src = '';
                document.body.classList.remove('overflow-hidden');
            }

            if (!form || !btnNext || !btnPrev || !btnFinish) {
                return;
            }

            function showStep(step) {
                form.querySelectorAll('.wizard-step').forEach((section) => {
                    const sectionStep = Number(section.getAttribute('data-step'));
                    section.classList.toggle('hidden', sectionStep !== step);
                });

                document.querySelectorAll('[data-indicator-step]').forEach((indicator) => {
                    const indicatorStep = Number(indicator.getAttribute('data-indicator-step'));
                    const isActive = indicatorStep === step;
                    indicator.classList.toggle('bg-blue-600', isActive);
                    indicator.classList.toggle('text-white', isActive);
                    indicator.classList.toggle('bg-gray-200', !isActive);
                    indicator.classList.toggle('text-gray-600', !isActive);
                });

                btnPrev.disabled = step === 1;
                btnNext.classList.toggle('hidden', step === totalSteps);
                btnFinish.classList.toggle('hidden', step !== totalSteps);

                if (step === 6 && stripCountInput) {
                    const total = Number(stripCountInput.value);
                    renderOutputTypeInputs(total);
                }
                removeCajaLines();
            }

            function clearErrors() {
                const errorStep1 = document.getElementById('error-step-1');
                const errorStep2 = document.getElementById('error-step-2');
                const errorStep3 = document.getElementById('error-step-3');
                const errorStep4 = document.getElementById('error-step-4');
                const errorStep5 = document.getElementById('error-step-5');
                const errorStep6 = document.getElementById('error-step-6');
                if (errorStep1) {
                    errorStep1.textContent = '';
                }
                if (errorStep2) {
                    errorStep2.textContent = '';
                }
                if (errorStep3) {
                    errorStep3.textContent = '';
                }
                if (errorStep4) {
                    errorStep4.textContent = '';
                }
                if (errorStep5) {
                    errorStep5.textContent = '';
                }
                if (errorStep6) {
                    errorStep6.textContent = '';
                }
            }

            function validateStep(step) {
                clearErrors();

                if (step === 1) {
                    const color = form.querySelector('input[name="color"]:checked');
                    if (!color) {
                        const error = document.getElementById('error-step-1');
                        if (error) {
                            error.textContent = 'Selecciona un tipo de color para continuar.';
                        }
                        return false;
                    }
                }

                if (step === 2) {
                    const perfil = form.querySelector('input[name="perfil"]:checked');
                    if (!perfil) {
                        const error = document.getElementById('error-step-2');
                        if (error) {
                            error.textContent = 'Selecciona un tipo de perfil para continuar.';
                        }
                        return false;
                    }
                }
                if (step === 3) {
                    const mando = form.querySelector('input[name="mando"]:checked');
                    if (!mando) {
                        const error = document.getElementById('error-step-3');
                        if (error) {
                            error.textContent = 'Selecciona un tipo de mando para continuar.';
                        }
                        return false;
                    }
                }
                if (step === 4) {
                    const transformador = form.querySelector('input[name="transformador"]:checked');
                    if (!transformador) {
                        const error = document.getElementById('error-step-4');
                        if (error) {
                            error.textContent = 'Indica si quieres transformador.';
                        }
                        return false;
                    }
                }
                if (step === 5) {
                    const total = Number(stripCountInput ? stripCountInput.value : 0);
                    if (!Number.isInteger(total) || total < 1) {
                        const error = document.getElementById('error-step-5');
                        if (error) {
                            error.textContent = 'Indica cuantas tiras led quieres (minimo 1).';
                        }
                        return false;
                    }

                    const lengthInputs = stripLengthsContainer ?
                        stripLengthsContainer.querySelectorAll('input[data-tira-length]') : [];
                    const allValid = Array.from(lengthInputs).every((input) => {
                        return input.value !== '' && Number(input.value) > 0;
                    });

                    if (!allValid || lengthInputs.length !== total) {
                        const error = document.getElementById('error-step-5');
                        if (error) {
                            error.textContent = 'Completa la longitud de cada tira (valor mayor que 0).';
                        }
                        return false;
                    }

                    evaluateStripLines();
                    const hasRuleError = stripCalculatedData.some((item) => item.estado === 'error');
                    if (hasRuleError) {
                        const error = document.getElementById('error-step-5');
                        if (error) {
                            error.textContent =
                                'Alguna tira supera el limite permitido para el color seleccionado.';
                        }
                        return false;
                    }
                }
                if (step === 6) {
                    const total = Number(stripCountInput ? stripCountInput.value : 0);
                    const outputSelections = getOutputSelections();
                    if (!Number.isInteger(total) || total < 1) {
                        const error = document.getElementById('error-step-6');
                        if (error) {
                            error.textContent = 'Selecciona el tipo de salida de cada tira para continuar.';
                        }
                        return false;
                    }
                    let allSelected = true;
                    for (let i = 1; i <= total; i += 1) {
                        const stripOutputCount = getStripOutputCount(i);
                        const current = outputSelections[i] || outputSelections[String(i)];
                        if (!current || !current.tipo_salida_izquierda) {
                            allSelected = false;
                            break;
                        }
                        if (stripOutputCount === 2 && !current.tipo_salida_derecha) {
                            allSelected = false;
                            break;
                        }
                    }
                    if (!allSelected) {
                        const error = document.getElementById('error-step-6');
                        if (error) {
                            error.textContent =
                                'Selecciona el tipo de salida (izquierda/derecha cuando aplique) para cada tira.';
                        }
                        return false;
                    }

                    const transformador = form.querySelector('input[name="transformador"]:checked');
                    if (transformador && transformador.value === 'si') {
                        let selectedTransformers = [];
                        if (selectedTransformersJsonInput && selectedTransformersJsonInput.value) {
                            try {
                                const parsed = JSON.parse(selectedTransformersJsonInput.value);
                                selectedTransformers = Array.isArray(parsed) ? parsed : [];
                            } catch (error) {
                                selectedTransformers = [];
                            }
                        }
                        if (selectedTransformers.length === 0) {
                            const error = document.getElementById('error-step-6');
                            if (error) {
                                error.textContent =
                                    'Selecciona una opcion de transformador para continuar.';
                            }
                            return false;
                        }
                    }
                }

                return true;
            }

            function getBaseArticles(color, perfil, mando) {
                const selected = [];

                if (color) {
                    if (color.value === 'rgbw') {
                        selected.push({
                            codigo: '28830',
                            origen: 'color',
                            valor: 'rgbw'
                        });
                    } else if (color.value === 'blanco') {
                        selected.push({
                            codigo: '28831',
                            origen: 'color',
                            valor: 'blanco'
                        });
                    }
                }

                if (perfil) {
                    if (perfil.value === 'normal') {
                        selected.push({
                            codigo: '28832',
                            origen: 'perfil',
                            valor: 'normal'
                        });
                    } else if (perfil.value === 'con_solapa') {
                        selected.push({
                            codigo: '28833',
                            origen: 'perfil',
                            valor: 'con_solapa'
                        });
                    } else if (perfil.value === 'flexible') {
                        selected.push({
                            codigo: '36229',
                            origen: 'perfil',
                            valor: 'flexible'
                        });
                    }
                }

                if (mando && mando.value.toLowerCase() === 'mando') {
                    selected.push({
                        codigo: '28837',
                        origen: 'control',
                        valor: 'mando_fijo'
                    });

                    if (color && color.value === 'rgbw') {
                        selected.push({
                            codigo: '28839',
                            origen: 'control',
                            valor: 'mando_rgbw'
                        });
                    } else if (color && color.value === 'blanco') {
                        selected.push({
                            codigo: '28838',
                            origen: 'control',
                            valor: 'mando_blanco'
                        });
                    }
                } else if (mando && mando.value.toLowerCase() === 'dmx') {
                    selected.push({
                        codigo: '28842',
                        origen: 'control',
                        valor: 'dmx_fijo'
                    });

                    if (color && color.value === 'rgbw') {
                        selected.push({
                            codigo: '28841',
                            origen: 'control',
                            valor: 'dmx_rgbw'
                        });
                    } else if (color && color.value === 'blanco') {
                        selected.push({
                            codigo: '28840',
                            origen: 'control',
                            valor: 'dmx_blanco'
                        });
                    }
                } else if (mando && mando.value.toLowerCase() === 'knx') {
                    selected.push({
                        codigo: '28843',
                        origen: 'control',
                        valor: 'knx_fijo'
                    });
                } else if (mando && mando.value.toLowerCase() === 'wifi') {
                    selected.push({
                        codigo: '28844',
                        origen: 'control',
                        valor: 'wifi_fijo'
                    });
                }

                return selected;
            }

            function updateSummary() {
                const color = form.querySelector('input[name="color"]:checked');
                const perfil = form.querySelector('input[name="perfil"]:checked');
                const mando = form.querySelector('input[name="mando"]:checked');
                const transformador = form.querySelector('input[name="transformador"]:checked');
                const baseArticles = getBaseArticles(color, perfil, mando);
                const cantidadTiras = stripCountInput ? stripCountInput.value : '';
                const outputSelections = getOutputSelections();
                if (baseArticlesJsonInput) {
                    baseArticlesJsonInput.value = JSON.stringify(baseArticles);
                }
                evaluateStripLines();
                updateMandoComplement(color, mando);
                updateTransformadorComplement(color, transformador);
                removeCajaLines();
            }

            function renderStripLengthInputs() {
                if (!stripCountInput || !stripLengthsContainer) {
                    return;
                }

                const total = Number(stripCountInput.value);
                stripLengthsContainer.innerHTML = '';

                if (!Number.isInteger(total) || total < 1) {
                    updateSummary();
                    return;
                }

                for (let i = 1; i <= total; i += 1) {
                    const row = document.createElement('div');
                    row.className = 'w-full max-w-lg';

                    const label = document.createElement('label');
                    label.className = 'block text-sm font-medium text-gray-700';
                    label.setAttribute('for', `longitud_tira_${i}`);
                    label.textContent = `Tira ${i} = longitud`;

                    const input = document.createElement('input');
                    input.type = 'number';
                    input.step = '0.01';
                    input.min = '0.01';
                    input.required = true;
                    input.id = `longitud_tira_${i}`;
                    input.name = `longitud_tira_${i}`;
                    input.setAttribute('data-tira-length', '1');
                    input.placeholder = 'Metros';
                    input.className = 'block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md';

                    const feedback = document.createElement('p');
                    feedback.className = 'mt-1 text-xs text-gray-600';
                    feedback.setAttribute('data-tira-feedback', `${i}`);

                    row.appendChild(label);
                    row.appendChild(input);
                    row.appendChild(feedback);
                    stripLengthsContainer.appendChild(row);
                }

                renderOutputTypeInputs(total);
                updateSummary();
            }

            function renderOutputTypeInputs(total) {
                if (!stripOutputsContainer) {
                    return;
                }

                const previous = getOutputSelections();
                stripOutputsContainer.innerHTML = '';

                if (!Number.isInteger(total) || total < 1) {
                    if (stripOutputsJsonInput) {
                        stripOutputsJsonInput.value = '[]';
                    }
                    return;
                }

                const options = ['A', 'B', 'C', 'D', 'E'];
                for (let i = 1; i <= total; i += 1) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'p-3 bg-white border border-gray-200 rounded-md sm:p-4';
                    const stripOutputCount = getStripOutputCount(i);
                    const stripRealMeters = getStripRealMeters(i);
                    const previousItem = previous[i] || previous[String(i)] || {};

                    const title = document.createElement('p');
                    title.className = 'mb-3 text-sm font-semibold text-gray-800';
                    const realMetersText = stripRealMeters !== null ?
                        ` (longitud real: ${stripRealMeters.toFixed(2)} m)` :
                        '';
                    title.textContent = stripOutputCount === 2 ?
                        `Tira ${i} - Tipo de salida${realMetersText} (izquierda y derecha)` :
                        `Tira ${i} - Tipo de salida${realMetersText}`;
                    wrapper.appendChild(title);

                    const sides = stripOutputCount === 2 ? ['izquierda', 'derecha'] : ['izquierda'];
                    sides.forEach((side) => {
                        const label = document.createElement('label');
                        label.className = 'block mb-2 text-xs font-semibold tracking-wide text-gray-600 uppercase';
                        label.textContent = side === 'izquierda' ? 'Salida izquierda' : 'Salida derecha';
                        wrapper.appendChild(label);

                        const optionsGrid = document.createElement('div');
                        optionsGrid.className = 'grid grid-cols-2 gap-2 mb-3 sm:grid-cols-3 lg:grid-cols-5';

                        options.forEach((option) => {
                            const optionId = `tipo_salida_tira_${i}_${side}_${option}`;
                            const previousValue = side === 'izquierda' ? previousItem.tipo_salida_izquierda : previousItem
                                .tipo_salida_derecha;

                            const optionLabel = document.createElement('label');
                            optionLabel.className = 'block';
                            optionLabel.setAttribute('for', optionId);

                            const radio = document.createElement('input');
                            radio.type = 'radio';
                            radio.id = optionId;
                            radio.name = `tipo_salida_tira_${i}_${side}`;
                            radio.value = option;
                            radio.className = 'sr-only peer';
                            radio.setAttribute('data-tira-output', `${i}`);
                            radio.setAttribute('data-tira-output-side', side);
                            radio.setAttribute('data-tira-output-count', String(stripOutputCount));
                            if (previousValue && previousValue === option) {
                                radio.checked = true;
                            }

                            const card = document.createElement('div');
                            card.className =
                                'relative p-2 bg-white border border-gray-300 rounded-md cursor-pointer transition hover:border-blue-400 peer-checked:border-blue-600 peer-checked:ring-2 peer-checked:ring-blue-200';

                            const img = document.createElement('img');
                            img.src = outputImageMap[option] || '';
                            img.alt = `Salida ${option}`;
                            img.className = 'object-contain w-full h-16 mx-auto';

                            const zoomButton = document.createElement('button');
                            zoomButton.type = 'button';
                            zoomButton.className =
                                'absolute p-1 bg-white border border-gray-300 rounded-full shadow-sm top-1 right-1 hover:bg-gray-100';
                            zoomButton.setAttribute('data-zoom-src', outputImageMap[option] || '');
                            zoomButton.setAttribute('data-zoom-title', `Salida ${option}`);
                            zoomButton.innerHTML =
                                '<svg class="w-4 h-4 text-gray-700" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M21 21L16.65 16.65M19 11C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';

                            const caption = document.createElement('p');
                            caption.className = 'mt-1 text-xs font-semibold text-center text-gray-800';
                            caption.textContent = `Salida ${option}`;

                            card.appendChild(zoomButton);
                            card.appendChild(img);
                            card.appendChild(caption);
                            optionLabel.appendChild(radio);
                            optionLabel.appendChild(card);
                            optionsGrid.appendChild(optionLabel);
                        });

                        wrapper.appendChild(optionsGrid);
                    });

                    stripOutputsContainer.appendChild(wrapper);
                }

                updateOutputSelectionsJson();
            }

            function getStripOutputCount(stripNumber) {
                const found = stripCalculatedData.find((item) => Number(item.tira) === Number(stripNumber));
                const mode = found ? String(found.tipo_alimentacion || '').toLowerCase() : '';
                return mode.includes('2') ? 2 : 1;
            }

            function getStripRealMeters(stripNumber) {
                const found = stripCalculatedData.find((item) => Number(item.tira) === Number(stripNumber));
                if (!found) {
                    return null;
                }
                const meters = Number(found.metros_reales_ajustados ?? found.metros);
                if (!Number.isFinite(meters) || meters <= 0) {
                    return null;
                }
                return Number(meters.toFixed(2));
            }

            function getOutputSelections() {
                if (!stripOutputsContainer) {
                    return {};
                }
                const map = {};
                stripOutputsContainer.querySelectorAll('input[data-tira-output]:checked').forEach((input) => {
                    const stripId = input.getAttribute('data-tira-output');
                    const side = input.getAttribute('data-tira-output-side') || 'izquierda';
                    const outputCount = Number(input.getAttribute('data-tira-output-count') || '1');
                    if (!map[stripId]) {
                        map[stripId] = {
                            numero_salidas: outputCount,
                            tipo_salida_izquierda: null,
                            tipo_salida_derecha: null
                        };
                    }
                    if (side === 'derecha') {
                        map[stripId].tipo_salida_derecha = input.value || null;
                    } else {
                        map[stripId].tipo_salida_izquierda = input.value || null;
                    }
                });
                return map;
            }

            function updateOutputSelectionsJson() {
                if (!stripOutputsJsonInput) {
                    return;
                }
                const outputSelections = getOutputSelections();
                const payload = Object.entries(outputSelections).map(([tira, salida]) => {
                    const numeroSalidas = Number(salida.numero_salidas || 1);
                    const left = salida.tipo_salida_izquierda || null;
                    const right = numeroSalidas === 2 ? (salida.tipo_salida_derecha || null) : null;
                    return {
                        tira: Number(tira),
                        numero_salidas: numeroSalidas,
                        tipo_salida_izquierda: left,
                        tipo_salida_derecha: right,
                        tipo_salida: numeroSalidas === 2 ? (left && right ? `${left}/${right}` : null) : left
                    };
                });
                stripOutputsJsonInput.value = JSON.stringify(payload);
            }

            function evaluateStripLines() {
                if (!stripLengthsContainer) {
                    return;
                }

                const color = form.querySelector('input[name="color"]:checked');
                const mode = color ? color.value : null;
                const divisor = mode === 'rgbw' ? 0.0833 : 0.1;
                const lineInputs = stripLengthsContainer.querySelectorAll('input[data-tira-length]');
                const outputSelections = getOutputSelections();
                const result = [];

                lineInputs.forEach((input, index) => {
                    const tira = index + 1;
                    const metros = Number(input.value);
                    const feedback = stripLengthsContainer.querySelector(`p[data-tira-feedback="${tira}"]`);

                    if (!input.value || Number.isNaN(metros) || metros <= 0 || !mode) {
                        if (feedback) {
                            feedback.textContent = '';
                            feedback.className = 'mt-1 text-xs text-gray-600';
                        }
                        return;
                    }

                    const resultadoDivision = metros / divisor;
                    const segmentos = Math.floor(resultadoDivision - 0.5);
                    const metrosReales = Number((segmentos * divisor).toFixed(2));
                    let tipoSalida = '';
                    let estado = 'ok';
                    let mensaje = '';

                    if (mode === 'rgbw') {
                        if (metrosReales < 8) {
                            tipoSalida = '1 lado';
                            mensaje =
                                `Longitud real: ${metrosReales.toFixed(2)} m -> Tipo de alimentacion: ${tipoSalida}.`;
                        } else if (metrosReales >= 8 && metrosReales < 16) {
                            tipoSalida = '2 lados';
                            mensaje =
                                `Longitud real: ${metrosReales.toFixed(2)} m -> Tipo de alimentacion: ${tipoSalida}.`;
                        } else {
                            estado = 'error';
                            mensaje =
                                `Longitud real: ${metrosReales.toFixed(2)} m -> Error: supera el maximo permitido para RGBW.`;
                        }
                    } else {
                        if (metrosReales < 10) {
                            tipoSalida = '1 lado';
                            mensaje =
                                `Longitud real: ${metrosReales.toFixed(2)} m -> Tipo de alimentacion: ${tipoSalida}.`;
                        } else if (metrosReales >= 10 && metrosReales <= 20) {
                            tipoSalida = '2 lados';
                            mensaje =
                                `Longitud real: ${metrosReales.toFixed(2)} m -> Tipo de alimentacion: ${tipoSalida}.`;
                        } else {
                            estado = 'error';
                            mensaje =
                                `Longitud real: ${metrosReales.toFixed(2)} m -> Error: supera el maximo permitido para BLANCO.`;
                        }
                    }

                    if (feedback) {
                        feedback.textContent = mensaje;
                        feedback.className = estado === 'error' ? 'mt-1 text-xs text-red-600' :
                            'mt-1 text-xs text-emerald-700';
                    }

                    const outputConfig = outputSelections[tira] || outputSelections[String(tira)] || {};
                    const numeroSalidas = String(tipoSalida).includes('2') ? 2 : 1;
                    const salidaIzquierda = outputConfig.tipo_salida_izquierda || null;
                    const salidaDerecha = numeroSalidas === 2 ? (outputConfig.tipo_salida_derecha || null) : null;
                    const salidaTexto = numeroSalidas === 2 ?
                        (salidaIzquierda && salidaDerecha ? `${salidaIzquierda}/${salidaDerecha}` : null) :
                        salidaIzquierda;

                    result.push({
                        tira: tira,
                        metros: metros,
                        divisor: divisor,
                        resultado_division: Number(resultadoDivision.toFixed(2)),
                        segmentos: segmentos,
                        metros_reales_ajustados: metrosReales,
                        tipo_alimentacion: tipoSalida,
                        numero_salidas: numeroSalidas,
                        tipo_salida_izquierda: salidaIzquierda,
                        tipo_salida_derecha: salidaDerecha,
                        tipo_salida: salidaTexto,
                        estado: estado
                    });
                });

                stripCalculatedData = result;
                if (stripCalcJsonInput) {
                    stripCalcJsonInput.value = JSON.stringify(stripCalculatedData);
                }
                updateOutputSelectionsJson();
            }

            function updateMandoComplement(color, mando) {
                if (!mandoComplementBox || !controlComplementTitle || !controlFixedLabel || !controlSecondaryLabel ||
                    !controlFixedCode || !controlSecondaryCode) {
                    return;
                }

                if (!mando || (mando.value !== 'Mando' && mando.value !== 'DMX')) {
                    mandoComplementBox.classList.add('hidden');
                    controlComplementTitle.textContent = 'Complementos obligatorios de control';
                    controlFixedLabel.textContent = 'Articulo base obligatorio:';
                    controlSecondaryLabel.textContent = 'Articulo obligatorio segun color:';
                    controlFixedCode.textContent = '-';
                    controlSecondaryCode.textContent = '-';
                    return;
                }

                if (mando.value === 'Mando') {
                    let emitter = '28839 (RGBW)';
                    if (color && color.value === 'blanco') {
                        emitter = '28838 (BLANCO)';
                    }

                    controlComplementTitle.textContent = 'Complementos obligatorios para MANDO';
                    controlFixedLabel.textContent = 'Controlador obligatorio:';
                    controlSecondaryLabel.textContent = 'Mando emisor obligatorio:';
                    controlFixedCode.textContent = '28837';
                    controlSecondaryCode.textContent = emitter;
                    mandoComplementBox.classList.remove('hidden');
                    return;
                }

                let dmxSecondary = '28841 (RGBW)';
                if (color && color.value === 'blanco') {
                    dmxSecondary = '28840 (BLANCO)';
                }

                controlComplementTitle.textContent = 'Complementos obligatorios para DMX';
                controlFixedLabel.textContent = 'Controlador DMX obligatorio:';
                controlSecondaryLabel.textContent = 'Modulo segun color:';
                controlFixedCode.textContent = '28842';
                controlSecondaryCode.textContent = dmxSecondary;
                mandoComplementBox.classList.remove('hidden');
            }

            function getTransformerOptionSignature(items) {
                return items
                    .slice()
                    .sort((a, b) => String(a.codigo).localeCompare(String(b.codigo)))
                    .map((item) => `${item.codigo}x${item.cantidad}`)
                    .join('|');
            }

            function parseSelectedTransformersFromHidden() {
                if (!selectedTransformersJsonInput || !selectedTransformersJsonInput.value) {
                    return [];
                }
                try {
                    const parsed = JSON.parse(selectedTransformersJsonInput.value);
                    return Array.isArray(parsed) ? parsed : [];
                } catch (error) {
                    return [];
                }
            }

            function setSelectedTransformersInHidden(items) {
                if (!selectedTransformersJsonInput) {
                    return;
                }
                const payload = items.map((item) => ({
                    codigo: String(item.codigo),
                    cantidad: Number(item.cantidad)
                }));
                selectedTransformersJsonInput.value = JSON.stringify(payload);
            }

            function getTotalMetersFromStripData() {
                if (!Array.isArray(stripCalculatedData) || stripCalculatedData.length === 0) {
                    return 0;
                }
                return Number(stripCalculatedData.reduce((sum, item) => {
                    const meters = Number(item.metros_reales_ajustados || item.metros || 0);
                    if (Number.isNaN(meters) || meters <= 0) {
                        return sum;
                    }
                    return sum + meters;
                }, 0).toFixed(2));
            }

            function buildTransformerOptions(requiredWatts) {
                if (!Number.isFinite(requiredWatts) || requiredWatts <= 0) {
                    return [];
                }

                const options = [];
                const oneTransformer = transformerCatalog.find((item) => item.potencia >= requiredWatts);
                if (oneTransformer) {
                    const items = [{
                        codigo: oneTransformer.codigo,
                        potencia: oneTransformer.potencia,
                        cantidad: 1
                    }];
                    const totalPower = oneTransformer.potencia;
                    options.push({
                        label: 'Opcion 1 transformador',
                        signature: getTransformerOptionSignature(items),
                        items: items,
                        totalPower: totalPower,
                        excess: totalPower - requiredWatts
                    });
                }

                const perTransformer = Math.ceil(requiredWatts / 2);
                const twoTransformers = transformerCatalog.find((item) => item.potencia >= perTransformer);
                if (twoTransformers) {
                    const items = [{
                        codigo: twoTransformers.codigo,
                        potencia: twoTransformers.potencia,
                        cantidad: 2
                    }];
                    const totalPower = twoTransformers.potencia * 2;
                    options.push({
                        label: 'Opcion 2 transformadores',
                        signature: getTransformerOptionSignature(items),
                        items: items,
                        totalPower: totalPower,
                        excess: totalPower - requiredWatts
                    });
                }

                const unique = [];
                const seen = new Set();
                options.forEach((option) => {
                    if (!seen.has(option.signature)) {
                        seen.add(option.signature);
                        unique.push(option);
                    }
                });

                return unique;
            }

            function renderTransformerOptions(requiredWatts, preferredSignature) {
                if (!transformerOptionsContainer || !transformerCode || !selectedTransformersJsonInput ||
                    !transformerMessage) {
                    return;
                }

                const options = buildTransformerOptions(requiredWatts);
                transformerOptionsContainer.innerHTML = '';

                if (options.length === 0) {
                    transformerCode.textContent = '-';
                    transformerMessage.textContent =
                        requiredWatts > 0 ?
                        'No hay opcion valida con 1 o 2 transformadores para esta potencia.' :
                        'Completa los metros de las tiras para calcular opciones.';
                    selectedTransformersJsonInput.value = '[]';
                    return;
                }

                let selected = options.find((option) => option.signature === preferredSignature) || options[0];
                const selectOption = (option) => {
                    selected = option;
                    setSelectedTransformersInHidden(option.items);
                    transformerCode.textContent = option.items.map((item) =>
                        `${item.cantidad} x ${item.codigo} (${item.potencia}W)`).join(' + ');
                    transformerMessage.textContent =
                        `Potencia total seleccionada: ${option.totalPower}W (necesarios ${requiredWatts}W).`;
                };

                options.forEach((option) => {
                    const label = document.createElement('label');
                    label.className = 'block w-full p-2 bg-white border border-emerald-200 rounded cursor-pointer sm:p-3';

                    const row = document.createElement('div');
                    row.className = 'flex items-start gap-2';

                    const radio = document.createElement('input');
                    radio.type = 'radio';
                    radio.name = 'opcion_transformador_visual';
                    radio.value = option.signature;
                    radio.className = 'mt-0.5 shrink-0';
                    radio.checked = option.signature === selected.signature;

                    const text = document.createElement('span');
                    text.className = 'text-xs leading-snug text-emerald-900 break-words sm:text-sm';
                    const detail = option.items.map((item) => `${item.cantidad} x ${item.codigo} (${item.potencia}W)`)
                        .join(' + ');
                    const prefix = option.label || 'Opcion';
                    text.textContent =
                        `${prefix}: ${detail} -> ${option.totalPower}W (sobrante ${option.excess}W).`;

                    radio.addEventListener('change', function() {
                        selectOption(option);
                    });

                    row.appendChild(radio);
                    row.appendChild(text);
                    label.appendChild(row);
                    transformerOptionsContainer.appendChild(label);
                });

                selectOption(selected);
            }

            function updateTransformadorComplement(color, transformador) {
                if (!transformerComplementBox || !transformerCode || !transformerWatts || !transformerOptionsContainer ||
                    !transformerMessage || !selectedTransformersJsonInput) {
                    return;
                }

                if (!transformador || transformador.value !== 'si') {
                    transformerComplementBox.classList.add('hidden');
                    transformerCode.textContent = '-';
                    transformerWatts.textContent = '-';
                    transformerMessage.textContent = 'Completa los metros de las tiras para calcular opciones.';
                    transformerOptionsContainer.innerHTML = '';
                    selectedTransformersJsonInput.value = '[]';
                    return;
                }

                const totalMeters = getTotalMetersFromStripData();
                const wattsPerMeter = color && color.value === 'rgbw' ? 17 : 12;
                const requiredWatts = Math.ceil(totalMeters * wattsPerMeter);
                transformerWatts.textContent =
                    `${requiredWatts > 0 ? requiredWatts : 0}W (${totalMeters.toFixed(2)}m x ${wattsPerMeter}W/m)`;

                const selectedItems = parseSelectedTransformersFromHidden();
                const preferredSignature = selectedItems.length > 0 ? getTransformerOptionSignature(selectedItems) : '';
                renderTransformerOptions(requiredWatts, preferredSignature);
                transformerComplementBox.classList.remove('hidden');
            }

            function formatCurrency(value) {
                if (value === null || value === undefined || Number.isNaN(Number(value))) {
                    return '-';
                }
                return `${Number(value).toFixed(2)} EUR`;
            }

            function formatUnits(value) {
                if (value === null || value === undefined || Number.isNaN(Number(value))) {
                    return '-';
                }
                const numeric = Number(value);
                return Number.isInteger(numeric) ? String(numeric) : numeric.toFixed(2);
            }

            function renderResultTable(responseJson) {
                if (!apiTableWrapper || !apiTableBody || !apiTotalGeneral) {
                    return;
                }

                const rows = responseJson && Array.isArray(responseJson.resultado_salida) ? responseJson
                    .resultado_salida : [];
                apiTableBody.innerHTML = '';

                if (rows.length === 0) {
                    apiTableWrapper.classList.add('hidden');
                    apiTotalGeneral.textContent = '-';
                    return;
                }

                rows.forEach((item) => {
                    const tr = document.createElement('tr');
                    tr.className = 'bg-white even:bg-gray-50';

                    const tdRef = document.createElement('td');
                    tdRef.className = 'px-3 py-2 border-t';
                    tdRef.textContent = item.ref || '-';

                    const tdDesc = document.createElement('td');
                    tdDesc.className = 'px-3 py-2 border-t';
                    tdDesc.textContent = item.descripcion || '-';

                    const tdUds = document.createElement('td');
                    tdUds.className = 'px-3 py-2 border-t';
                    tdUds.textContent = formatUnits(item.uds);

                    const tdPrecio = document.createElement('td');
                    tdPrecio.className = 'px-3 py-2 border-t';
                    tdPrecio.textContent = formatCurrency(item.precio);

                    const tdTotal = document.createElement('td');
                    tdTotal.className = 'px-3 py-2 border-t';
                    tdTotal.textContent = formatCurrency(item.total);

                    tr.appendChild(tdRef);
                    tr.appendChild(tdDesc);
                    tr.appendChild(tdUds);
                    tr.appendChild(tdPrecio);
                    tr.appendChild(tdTotal);
                    apiTableBody.appendChild(tr);
                });

                const totalGeneral = responseJson && responseJson.totales_resultado ? responseJson.totales_resultado
                    .total : null;
                apiTotalGeneral.textContent = formatCurrency(totalGeneral);
                apiTableWrapper.classList.remove('hidden');
            }

            function showBudgetSection() {
                if (form) {
                    form.classList.add('hidden');
                }
                if (wizardIndicator) {
                    wizardIndicator.classList.add('hidden');
                }
                if (budgetSection) {
                    budgetSection.classList.remove('hidden');
                }
            }

            function showWizardSection() {
                if (budgetSection) {
                    budgetSection.classList.add('hidden');
                }
                if (form) {
                    form.classList.remove('hidden');
                }
                if (wizardIndicator) {
                    wizardIndicator.classList.remove('hidden');
                }
                currentStep = 6;
                showStep(currentStep);
            }

            function showCalculatingSwal() {
                if (window.Swal) {
                    window.Swal.fire({
                        title: 'Calculando presupuesto',
                        text: 'Espera un momento, estamos calculando el presupuesto.',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showConfirmButton: false,
                        didOpen: () => {
                            window.Swal.showLoading();
                        }
                    });
                }
            }

            function closeCalculatingSwal() {
                if (window.Swal) {
                    window.Swal.close();
                }
            }

            function showErrorSwal(message) {
                if (window.Swal) {
                    window.Swal.fire({
                        icon: 'error',
                        title: 'Fallo en el calculo',
                        text: message
                    });
                    return;
                }
                alert(message);
            }

            function showSuccessSwal() {
                if (window.Swal) {
                    window.Swal.fire({
                        icon: 'success',
                        title: 'Presupuesto calculado',
                        text: 'Calculo completado correctamente. Mostrando resultado.',
                        timer: 1100,
                        showConfirmButton: false
                    });
                }
            }

            async function submitCalculation(showBudgetOnSuccess) {
                if (isSubmitting) {
                    return;
                }
                updateSummary();

                try {
                    isSubmitting = true;
                    btnFinish.disabled = true;
                    btnFinish.classList.add('opacity-50');
                    showCalculatingSwal();

                    const formData = new FormData(form);
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': formData.get('_token'),
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const responseJson = await response.json();
                    if (!response.ok || responseJson.ok === false) {
                        closeCalculatingSwal();
                        const message = responseJson && responseJson.error ? responseJson.error :
                            'No se pudo calcular el presupuesto.';
                        if (budgetError) {
                            budgetError.textContent = message;
                            budgetError.classList.remove('hidden');
                        }
                        renderResultTable(null);
                        showErrorSwal(`${message} (controlador/API)`);
                        return;
                    }

                    if (budgetError) {
                        budgetError.textContent = '';
                        budgetError.classList.add('hidden');
                    }
                    renderResultTable(responseJson);
                    if (showBudgetOnSuccess) {
                        showBudgetSection();
                    }
                    closeCalculatingSwal();
                    showSuccessSwal();
                } catch (error) {
                    closeCalculatingSwal();
                    if (budgetError) {
                        budgetError.textContent = `Error llamando a calcular: ${error.message}`;
                        budgetError.classList.remove('hidden');
                    }
                    renderResultTable(null);
                    showErrorSwal('Error de comunicacion con el controlador/API. Intentalo de nuevo.');
                } finally {
                    isSubmitting = false;
                    btnFinish.disabled = false;
                    btnFinish.classList.remove('opacity-50');
                }
            }

            btnNext.addEventListener('click', function() {
                if (currentStep >= totalSteps) {
                    return;
                }
                if (!validateStep(currentStep)) {
                    return;
                }
                currentStep += 1;
                updateSummary();
                showStep(currentStep);
            });

            btnPrev.addEventListener('click', function() {
                if (currentStep > 1) {
                    currentStep -= 1;
                    showStep(currentStep);
                }
            });

            btnFinish.addEventListener('click', async function() {
                if (!validateStep(currentStep)) {
                    return;
                }
                submitCalculation(true);
            });

            if (btnBudgetBack) {
                btnBudgetBack.addEventListener('click', function() {
                    showWizardSection();
                });
            }

            if (btnBudgetPdf) {
                btnBudgetPdf.addEventListener('click', function() {
                    if (!apiTableWrapper) {
                        return;
                    }

                    const tableHtml = apiTableWrapper.innerHTML;
                    const printWindow = window.open('', '_blank', 'width=1024,height=768');
                    if (!printWindow) {
                        return;
                    }

                    const now = new Date();
                    const dateLabel = now.toLocaleDateString('es-ES');

                    printWindow.document.write(`
                        <html>
                            <head>
                                <title>Presupuesto Pool Neon Led</title>
                                <style>
                                    body { font-family: Arial, sans-serif; margin: 24px; color: #1f2937; }
                                    h1 { font-size: 20px; margin-bottom: 4px; }
                                    p { margin: 0 0 16px; color: #4b5563; font-size: 12px; }
                                    table { width: 100%; border-collapse: collapse; font-size: 12px; }
                                    th, td { border: 1px solid #d1d5db; padding: 8px; text-align: left; }
                                    thead { background: #f3f4f6; }
                                    tfoot td { font-weight: 700; background: #f3f4f6; }
                                </style>
                            </head>
                            <body>
                                <h1>Presupuesto Pool Neon Led</h1>
                                <p>Fecha: ${dateLabel}</p>
                                ${tableHtml}
                            </body>
                        </html>
                    `);
                    printWindow.document.close();
                    printWindow.focus();
                    //printWindow.print();
                });
            }

            form.querySelectorAll(
                    'input[name="color"], input[name="perfil"], input[name="mando"], input[name="transformador"]')
                .forEach((input) => {
                    input.addEventListener('change', updateSummary);
                });
            if (stripCountInput) {
                stripCountInput.addEventListener('input', renderStripLengthInputs);
            }
            if (stripLengthsContainer) {
                stripLengthsContainer.addEventListener('input', updateSummary);
            }
            if (stripOutputsContainer) {
                stripOutputsContainer.addEventListener('change', updateSummary);
            }
            document.addEventListener('click', function(event) {
                const zoomTrigger = event.target.closest('[data-zoom-src]');
                if (zoomTrigger) {
                    event.preventDefault();
                    event.stopPropagation();
                    const src = zoomTrigger.getAttribute('data-zoom-src') || '';
                    const title = zoomTrigger.getAttribute('data-zoom-title') || 'Vista ampliada';
                    if (src) {
                        openImageZoom(src, title);
                    }
                    return;
                }

                const shouldClose = event.target.closest('[data-zoom-close="overlay"]');
                if (shouldClose) {
                    closeImageZoom();
                }
            });
            if (imageZoomClose) {
                imageZoomClose.addEventListener('click', function(event) {
                    event.preventDefault();
                    closeImageZoom();
                });
            }
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeImageZoom();
                }
            });

            hideCajaLinesByCss();
            removeCajaLines();
            watchCajaLines();
            showStep(currentStep);
        });
    </script>
@endsection
