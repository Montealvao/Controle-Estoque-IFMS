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
    ->name('fornecedores.index');

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