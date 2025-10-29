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
        Schema::table('funcionarios', function (Blueprint $table) {

          $table->date('fecha_actualiza_detalle')->date_format('d-m-Y')->nullable()->after('antiguedad_administracion_estado');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('funcionarios', function (Blueprint $table) {

            $table->dropColumn('fecha_actualiza_detalle');

        });
    }
};
