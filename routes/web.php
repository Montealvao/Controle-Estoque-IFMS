<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FornecedorController;
use Illuminate\Support\Facades\Route;

/* ============================================================
   Autenticação
   ============================================================ */
//rotas de autenticação
Route::get('/', [AuthController::class, 'showLogin']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/painel')->name('painel');

/* ============================================================
   Área do Administrador
   ============================================================ */
Route::middleware(['auth', 'perfil:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/fornecedores', [FornecedorController::class, 'index'])
            ->name('fornecedores.index');

        Route::get('/fornecedor/novo', [FornecedorController::class, 'create'])
            ->name('fornecedor.criar');

        Route::post('/fornecedor', [FornecedorController::class, 'store'])
            ->name('fornecedor.gravar');

        Route::get('/fornecedor/editar/{id}', [FornecedorController::class, 'edit'])
            ->name('fornecedor.editar');

        Route::put('/fornecedor/{id}', [FornecedorController::class, 'update'])
            ->name('fornecedor.atualizar');

        Route::delete('/fornecedor/{id}', [FornecedorController::class, 'destroy'])
            ->name('fornecedor.excluir');

        Route::get('/categorias', [CategoriaController::class, 'index'])
            ->name('categorias.index');

        Route::get('/categoria/novo', [CategoriaController::class, 'create'])
            ->name('categoria.criar');

        Route::post('/categoria', [CategoriaController::class, 'store'])
            ->name('categoria.gravar');

        Route::get('/categoria/editar/{id}', [CategoriaController::class, 'edit'])
            ->name('categoria.editar');

        Route::put('/categoria/{id}', [CategoriaController::class, 'update'])
            ->name('categorias.atualizar');

        Route::delete('/categoria/{id}', [CategoriaController::class, 'destroy'])
            ->name('categorias.excluir');
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