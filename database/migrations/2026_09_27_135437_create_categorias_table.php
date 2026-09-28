<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up()
{
    Schema::create('categorias', function (Blueprint $table) {
        $table->id();
        $table->string('nome')->unique();
        $table->decimal('margem_lucro');
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
