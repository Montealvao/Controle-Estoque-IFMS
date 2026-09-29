<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('embalagem', 50);
            $table->integer('qtde_estoque');
            $table->string('codigo_barra', 13)->unique();
            $table->decimal('valor_compra', 20, 2);
            $table->decimal('valor_venda', 20, 2);
            $table->foreignId('categoria_id')->constrained('categorias')->onUpdate('cascade')
                ->onDelete('restrict');
            $table->integer('qtde_minima')->nullable();
            $table->integer('qtde_maxima')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
