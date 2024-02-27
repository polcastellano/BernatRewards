<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categorias_recompensas', function (Blueprint $table) {
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('recompensa_id');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('recompensa_id')->references('id')->on('recompensas')->onDelete('cascade');
            $table->primary(['categoria_id', 'recompensa_id']);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias_recompensas');

    }
};
