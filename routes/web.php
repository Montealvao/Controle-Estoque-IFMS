<?php

use App\Http\Controllers\CategoriaController;
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

Route::get('/produtos', [ProdutoController::class, 'index'])
    ->name('produtos.index');

Route::get('/produtos/novo', [ProdutoController::class, 'create'])
    ->name('produtos.novo');

Route::post('/produtos/store', [ProdutoController::class, 'store'])
    ->name('produtos.store');

Route::get('/produtos/{id}/editar', [ProdutoController::class, 'edit'])
    ->name('produtos.edit');

Route::put('/produtos/{id}', [ProdutoController::class, 'update'])
    ->name('produtos.update');

Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy'])
    ->name('produtos.destroy');

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

Route::get('/categorias', [CategoriaController::class, 'index'])
    ->name('categorias.index');

Route::get('/categorias/novo', [CategoriaController::class, 'create'])
    ->name('categorias.create');

Route::post('/categorias', [CategoriaController::class, 'store'])
    ->name('categorias.store');

Route::get('/categorias/edit/{id}', [CategoriaController::class, 'edit'])
    ->name('categorias.edit');

Route::put('/categorias/{id}', [CategoriaController::class, 'update'])
    ->name('categorias.update');

Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])
    ->name('categorias.destroy');
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