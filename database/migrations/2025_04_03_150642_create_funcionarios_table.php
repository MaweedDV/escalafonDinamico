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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('rut', 10)->unique();
            $table->string('nombre', 255);
            $table->string('apellido_paterno', 255);
            $table->string('apellido_materno', 255);
            $table->unsignedBigInteger('id_Cargo')->nullable();
            $table->integer('calificacion');
            $table->integer('lista');
            $table->date('antiguedad_cargo');
            $table->date('antiguedad_grado');
            $table->date('antiguedad_mismo_municipio');
            $table->integer('antiguedad_mismo_municipio_detalle');
            $table->integer('antiguedad_administracion_estado');
            $table->string('educacion_formal');
            $table->enum('estado', ['vigente', 'retirado', 'fallecido']);
            $table->timestamps();

            $table->foreign('id_Cargo')->references('id')->on('cargos_escalafons');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionarios');
    }
};
