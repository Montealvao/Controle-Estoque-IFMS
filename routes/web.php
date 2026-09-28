<?php

use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ProdutoController;

use Illuminate\Support\Facades\Route;

/* ============================================================
   Autenticação
   ============================================================ */
    //rotas de autenticação
Route::get('/', function () {
    return view('welcome');
});

Route::get('/produtos', [ProdutoController::class, 'index']);


Route::get('/fornecedores', [FornecedorController::class, 'index'])
    ->name('admin.fornecedores.index');

Route::get('/fornecedores/novo', [FornecedorController::class, 'create'])
    ->name('admin.fornecedores.create');

Route::post('/fornecedores', [FornecedorController::class, 'store'])
    ->name('admin.fornecedores.store');

Route::get('/fornecedores/{id}/editar', [FornecedorController::class, 'edit'])
    ->name('admin.fornecedores.edit');

Route::put('/fornecedores/{id}', [FornecedorController::class, 'update'])
    ->name('admin.fornecedores.update');

Route::delete('/fornecedores/{id}', [FornecedorController::class, 'destroy'])
    ->name('admin.fornecedores.destroy');

/* ============================================================
   Área do Administrador
   ============================================================ */
Route::middleware(['auth', 'perfil:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        //rotas admin
    });

/* ============================================================
   Área do Cliente
   ============================================================ */
Route::middleware(['auth', 'perfil:cliente'])
    ->prefix('cliente')
    ->name('cliente.')
    ->group(function () {
        //rotas cliente
    });