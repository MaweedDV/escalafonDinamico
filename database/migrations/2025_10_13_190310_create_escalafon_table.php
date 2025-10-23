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
        Schema::create('escalafon', function (Blueprint $table) {
            $table->id();
            $table->integer('id_funcionario');
            $table->integer('ano');
            $table->date('periodo_desde');
            $table->date('periodo_hasta');
            $table->integer('posicion');
            $table->integer('id_cargo');
            $table->integer('calificacion');
            $table->integer('lista');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escalafon');
    }
};
