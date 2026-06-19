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
         Schema::create('cabecerafuid', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->string('proceso');
            $table->string('formato');
            $table->string('codigo');
            $table->string('version');
            $table->dateTime('fecha');
            $table->string('entidad_remitente');
            $table->string('entidad_productora');
            $table->string('objeto');
            $table->bigInteger('id_seccion')->unsigned();
            $table->bigInteger('id_subseccion')->unsigned();
            $table->bigInteger('id_periodo')->unsigned();
            $table->timestamps();

            $table->foreign('id_periodo')->references('id')->on('periodos')->onDelete('cascade');
            $table->foreign('id_seccion')->references('id')->on('seccion')->onDelete('cascade');
            $table->foreign('id_subseccion')->references('id')->on('subseccion')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
