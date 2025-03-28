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
        Schema::create('cargos_escalafon', function (Blueprint $table) {
            $table->id();
            $table->integer('grado');
            $table->unsignedBigInteger('Id_nombresCargos')->nullable();
            $table->integer('asignado');
            $table->timestamps();

            $table->foreign('Id_nombresCargos')->references('id')->on('nombres_cargos');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargos_escalafon');
    }
};
