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
        Schema::create('cabeceraccd', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->string('proceso');
            $table->string('formato');
            $table->string('codigo');
            $table->string('version');
            $table->dateTime('fecha');
            $table->string('entidad_productora');
            $table->string('oficina');
            $table->bigInteger('id_periodo')->unsigned();
            $table->timestamps();

            $table->foreign('id_periodo')->references('id')->on('periodos')->onDelete('cascade');
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
