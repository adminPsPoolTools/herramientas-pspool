<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home/index');
// })->name('home');

Route::get('/',           [App\Http\Controllers\HomeController::class,      'index'])->name('home');

/* Cloradores */
Route::get('/cloradores',           [App\Http\Controllers\CloradoresController::class,      'index'])->name('cloradores.index');
Route::get('/calcularClorador',     [App\Http\Controllers\CloradoresController::class,      'calcular'])->name('clorador.calculo');

/* Hidraulica */
Route::get('/hidraulica',        [App\Http\Controllers\HidraulicaController::class,      'index'])->name('hidraulica.index');
Route::get('/calcularHidraulica', [App\Http\Controllers\HidraulicaController::class,      'calcular'])->name('hidraulica.calculo');

/* Langelier */
Route::get('/langelier',        [App\Http\Controllers\LangelierController::class,      'index'])->name('langelier.index');
Route::get('/calcularLangelier', [App\Http\Controllers\LangelierController::class,      'calcular'])->name('langelier.calculo');

/* Nophos */
Route::get('/nophos',        [App\Http\Controllers\NophosController::class, 'index'])->name('nophos.index');
Route::get('/calcularNophosSemana', [App\Http\Controllers\NophosController::class, 'calcularSemana'])->name('nophos.calculoSemana');
Route::get('/calcularNophosInicio', [App\Http\Controllers\NophosController::class, 'calcularInicio'])->name('nophos.calculoInicio');

/* Aco */
Route::get('/aco',        [App\Http\Controllers\AcoController::class, 'index'])->name('aco.index');
Route::get('/calcularAco', [App\Http\Controllers\AcoController::class, 'calcular'])->name('aco.calculo');

/* Apf */
Route::get('/apf',        [App\Http\Controllers\ApfController::class, 'index'])->name('apf.index');
Route::get('/calcularApf', [App\Http\Controllers\ApfController::class, 'calcular'])->name('apf.calculo');

/* Activador DaGen */
Route::get('/activador-dagen',        [App\Http\Controllers\ActivadorDagenController::class, 'index'])->name('activador.index');
Route::get('/calcularActivador', [App\Http\Controllers\ActivadorDagenController::class, 'calcular'])->name('activador.calculo');

/* Flow Vis */
Route::get('/flowvis',        [App\Http\Controllers\FlowVisController::class, 'index'])->name('flowvis.index');
Route::get('/calcularFlowvis', [App\Http\Controllers\FlowVisController::class, 'calcular'])->name('flowvis.calculo');


/* Calculo tuberías m/s */
Route::get('/tuberias',        [App\Http\Controllers\CalculoTuberiasController::class,      'index'])->name('tuberias.index');
Route::get('/calcularTuberias', [App\Http\Controllers\CalculoTuberiasController::class,      'calcular'])->name('tuberias.calculo');

/* Calculo inverHero */
Route::get('/inverhero',        [App\Http\Controllers\BombasInverHeroController::class,      'index'])->name('inverhero.index');
Route::get('/calcularInverhero', [App\Http\Controllers\BombasInverHeroController::class,      'calcular'])->name('inverhero.calculo');

/* Calculo Bombas saci */
Route::get('/saci',        [App\Http\Controllers\BombasSaciController::class,      'index'])->name('saci.index');
Route::get('/calcularSaci', [App\Http\Controllers\BombasSaciController::class,      'calcular'])->name('saci.calculo');

/* Calculo AFM */
Route::get('/afm',        [App\Http\Controllers\AfmController::class,      'index'])->name('afm.index');
Route::get('/calcularAfm', [App\Http\Controllers\AfmController::class,      'calcular'])->name('afm.calculo');

/* Calculo PS Linear led */
Route::get('/linearLed',        [App\Http\Controllers\PsLinearLedController::class,      'index'])->name('linearled.index');
Route::get('/calcularLinearLed', [App\Http\Controllers\PsLinearLedController::class,      'calcular'])->name('linearled.calculo');

/* Calculo POOL Linear led */
Route::get('/poolneonled',        [App\Http\Controllers\PoolNeonLedController::class,      'index'])->name('poolneonled.index');
Route::match(['get', 'post'], '/calcularpoolneonled', [App\Http\Controllers\PoolNeonLedController::class,      'calcular'])->name('poolneonled.calculo');

/* Calculo EVA optic */
Route::get('/evaOptic',        [App\Http\Controllers\EvaOpticController::class,      'index'])->name('evaoptic.index');
Route::get('/calcularEvaOptic', [App\Http\Controllers\EvaOpticController::class,      'calcular'])->name('evaoptic.calculo');

/* Calculo Volumen de agua */
Route::get('/volumenAgua',      [App\Http\Controllers\VolumenAguaController::class,     'index'])->name('volumen.index');
Route::get('/calcularVolumen',  [App\Http\Controllers\VolumenAguaController::class,     'calcular'])->name('volumen.calculo');

/* Combis */
Route::get('/combis',        [App\Http\Controllers\CombisController::class,      'index'])->name('combis.index');

/* Jets */
Route::get('/jets',        [App\Http\Controllers\JetsController::class,      'index'])->name('jets.index');

/* Guias rapidas */
Route::get('/guia',         [App\Http\Controllers\GuiasController::class,      'index'])->name('guias.index');

/** Filtros Calplas */
Route::get('/guia-calplas',        [App\Http\Controllers\GuiasController::class,      'guiaCalplas'])->name('guias.filtros.index');
Route::get('/guia-calplas-privada',        [App\Http\Controllers\GuiasController::class,      'guiaPrivada'])->name('guias.filtros.privado');
Route::get('/guia-calplas-publico',        [App\Http\Controllers\GuiasController::class,      'guiaPublico'])->name('guias.filtros.publico');
Route::get('/guia-calplas-alto-rend',        [App\Http\Controllers\GuiasController::class,      'guiaAltoRend'])->name('guias.filtros.alto-rend');

/** Bombas Saci */
Route::get('/guia-bombas-saci',        [App\Http\Controllers\GuiasController::class,      'guiaBombasSaci'])->name('guias.bombas.saci.index');
Route::get('/guia-bombas-saci-privado',        [App\Http\Controllers\GuiasController::class,      'guiaBombasSaciPrivado'])->name('guias.bombas.saci.privado');
Route::get('/guia-bombas-saci-publico',        [App\Http\Controllers\GuiasController::class,      'guiaBombasSaciPublico'])->name('guias.bombas.saci.publico');

/** Cloradores Salinos */
Route::get('/guia-cloradores',        [App\Http\Controllers\GuiasController::class,      'guiaCloradores'])->name('guias.cloradores.index');
Route::get('/guia-cloradores-privado',        [App\Http\Controllers\GuiasController::class,      'guiaCloradoresPrivado'])->name('guias.cloradores.privado');
Route::get('/guia-cloradores-publico',        [App\Http\Controllers\GuiasController::class,      'guiaCloradoresPublico'])->name('guias.cloradores.publico');

/** TopClean */
Route::get('/guia-topclean',        [App\Http\Controllers\GuiasController::class,      'guiaTopclean'])->name('guias.topclean.index');

/* Tips */
Route::get('/tips', [App\Http\Controllers\TipsController::class,      'index'])->name('tips.index');
Route::get('/tips-topclean', [App\Http\Controllers\TipsController::class,      'topclean'])->name('tips.topclean.index');
Route::get('/tips-filtros', [App\Http\Controllers\TipsController::class,      'filtros'])->name('tips.filtros.index');
Route::get('/tips-tratamiento', [App\Http\Controllers\TipsController::class,      'tratamiento'])->name('tips.tratamiento.index');
Route::get('/tips-tratamiento-filtracion', [App\Http\Controllers\TipsController::class,      'tratamientoFiltracion'])->name('tips.tratamiento.filtracion.index');
Route::get('/tips-tratamiento-langelier', [App\Http\Controllers\TipsController::class,      'tratamientoLangelier'])->name('tips.tratamiento.langelier.index');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


/** Redireccion de rutas externas */
Route::get('/redirect', [App\Http\Controllers\RedirigirUrlExternasController::class, 'handleRedirect'])->name('redirect');

/** Redireccion de rutas externas */
Route::get('/pscover', [App\Http\Controllers\ConfiguradorPscover\ConfiguradorPsCoverController::class, 'index'])->name('pscover.index');

use App\Http\Controllers\CsvToExcelController;

Route::get('/upload', function () {
    return view('excel/upload');
});

Route::post('/convert', [CsvToExcelController::class, 'convert'])->name('csv.to.excel');
