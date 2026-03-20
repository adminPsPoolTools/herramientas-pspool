<?php

use App\Http\Controllers\Admin\BombasController;
use App\Http\Controllers\Admin\CloradoresController;
use App\Http\Controllers\Admin\FiltrosController;
use App\Http\Controllers\Admin\HomeCardsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ModelosBombasController;
use App\Http\Controllers\Admin\ModelosCloradoresController;
use App\Http\Controllers\Admin\ModelosFiltrosController;

Route::get('', [HomeController::class, 'index']);


/** home */
Route::get('HomeCards',                [HomeCardsController::class, 'index'])->name('home.index');
Route::get('EditarHomeCards/{id}',       [HomeCardsController::class, 'edit'])->name('admin.home.edit');
Route::post('ActualizarHomeCards/{id}',  [HomeCardsController::class, 'update'])->name('admin.home.update');
Route::post('GrabarHomeCards',           [HomeCardsController::class, 'store'])->name('admin.home.store');
Route::get('CrearHomeCards',             [HomeCardsController::class, 'create'])->name('admin.home.create');
Route::get('EliminarHomeCards/{id}',     [HomeCardsController::class, 'delete'])->name('admin.home.delete');

/** Cloradores */
Route::get('Cloradores',                [CloradoresController::class, 'index'])->name('admin.cloradores');
Route::get('EditarClorador/{id}',       [CloradoresController::class, 'edit'])->name('admin.cloradores.edit');
Route::post('ActualizarClorador/{id}',  [CloradoresController::class, 'update'])->name('admin.cloradores.update');
Route::post('GrabarClorador',           [CloradoresController::class, 'store'])->name('admin.cloradores.store');
Route::get('CrearClorador',             [CloradoresController::class, 'create'])->name('admin.cloradores.create');
Route::get('EliminarClorador/{id}',     [CloradoresController::class, 'delete'])->name('admin.cloradores.delete');

/** Modelos cloradores */
Route::get('ModelosCloradores',       [ModelosCloradoresController::class, 'index'])->name('admin.modelos.cloradores');
Route::get('EditarModeloClorador/{id}',       [ModelosCloradoresController::class, 'edit'])->name('admin.modelos.edit');
Route::post('ActualizarModeloClorador/{id}',  [ModelosCloradoresController::class, 'update'])->name('admin.modelos.update');
Route::post('GrabarModeloClorador',           [ModelosCloradoresController::class, 'store'])->name('admin.modelos.store');
Route::get('CrearModeloClorador',             [ModelosCloradoresController::class, 'create'])->name('admin.modelos.create');
Route::get('EliminarModeloClorador/{id}',     [ModelosCloradoresController::class, 'delete'])->name('admin.modelos.delete');


/** Filtros */
Route::get('Filtros',                 [FiltrosController::class, 'index'])->name('admin.filtros');
Route::get('EditarFiltro/{id}',       [FiltrosController::class, 'edit'])->name('admin.filtros.edit');
Route::post('ActualizarFiltro/{id}',  [FiltrosController::class, 'update'])->name('admin.filtros.update');
Route::post('GrabarFiltro',           [FiltrosController::class, 'store'])->name('admin.filtros.store');
Route::get('CrearFiltro',             [FiltrosController::class, 'create'])->name('admin.filtros.create');
Route::get('EliminarFiltro/{id}',     [FiltrosController::class, 'delete'])->name('admin.filtros.delete');

/** Modelos filtros */
Route::get('ModelosFiltros',                  [ModelosFiltrosController::class, 'index'])->name('admin.modelos.filtros');
Route::get('EditarModeloFiltro/{id}',         [ModelosFiltrosController::class, 'edit'])->name('admin.modelos.filtros.edit');
Route::post('ActualizarModeloFiltro/{id}',    [ModelosFiltrosController::class, 'update'])->name('admin.modelos.filtros.update');
Route::post('GrabarModeloFiltro',             [ModelosFiltrosController::class, 'store'])->name('admin.modelos.filtros.store');
Route::get('CrearModeloFiltro',               [ModelosFiltrosController::class, 'create'])->name('admin.modelos.filtros.create');
Route::get('EliminarModeloFiltro/{id}',       [ModelosFiltrosController::class, 'delete'])->name('admin.modelos.filtros.delete');

/** Bombas */
Route::get('Bombas',                 [BombasController::class, 'index'])->name('admin.bombas');
Route::get('EditarBomba/{id}',       [BombasController::class, 'edit'])->name('admin.bombas.edit');
Route::post('ActualizarBomba/{id}',  [BombasController::class, 'update'])->name('admin.bombas.update');
Route::post('GrabarBomba',           [BombasController::class, 'store'])->name('admin.bombas.store');
Route::get('CrearBomba',             [BombasController::class, 'create'])->name('admin.bombas.create');
Route::get('EliminarBomba/{id}',     [BombasController::class, 'delete'])->name('admin.bombas.delete');

/** Modelos Bombas */
Route::get('ModelosBombas',                  [ModelosBombasController::class, 'index'])->name('admin.modelos.bombas');
Route::get('EditarModeloBomba/{id}',         [ModelosBombasController::class, 'edit'])->name('admin.modelos.bombas.edit');
Route::post('ActualizarModeloBomba/{id}',    [ModelosBombasController::class, 'update'])->name('admin.modelos.bombas.update');
Route::post('GrabarModeloBomba',             [ModelosBombasController::class, 'store'])->name('admin.modelos.bombas.store');
Route::get('CrearModeloBomba',               [ModelosBombasController::class, 'create'])->name('admin.modelos.bombas.create');
Route::get('EliminarModeloBomba/{id}',       [ModelosBombasController::class, 'delete'])->name('admin.modelos.bombas.delete');
