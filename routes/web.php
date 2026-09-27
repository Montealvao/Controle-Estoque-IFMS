<?php

use App\Http\Controllers\FornecedorController;
use Illuminate\Support\Facades\Route;

/* ============================================================
   Autenticação
   ============================================================ */
    //rotas de autenticação
Route::get('/', function () {
    return view('welcome');
});


Route::get('/fornecedores', [FornecedorController::class, 'index'])
    ->name('admin.fornecedores.index');

Route::get('/fornecedores/novo', [FornecedorController::class, 'create'])
    ->name('admin.fornecedores.create');

Route::post('/fornecedores', [FornecedorController::class, 'store'])
    ->name('admin.fornecedores.store');

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