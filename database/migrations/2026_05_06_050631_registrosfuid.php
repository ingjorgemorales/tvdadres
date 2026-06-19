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
         Schema::create('registrosfuid', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('id_cabecerafuid')->unsigned();
            $table->bigInteger('orden')->unsigned();
            $table->bigInteger('id_serie')->unsigned();
            $table->bigInteger('id_subserie')->unsigned()->nullable();
            $table->string('unidad_documental', 3000);
            $table->dateTime('fecha_inicial');
            $table->dateTime('fecha_final');
            $table->tinyInteger('soporte_fisico');
            $table->tinyInteger('soporte_electronico');
            $table->string('caja');
            $table->string('carpeta');
            $table->string('tomolegajolibro');
            $table->integer('folios');
            $table->bigInteger('codigibarrascaja');
            $table->bigInteger('codigibarrascarpeta');
            $table->string('signatura_topografica');
            $table->string('otro_tipo');
            $table->string('otro_cantidad');
            $table->string('electronico_ubicacion');
            $table->string('electronico_cantidad');
            $table->string('electronico_tamano');
            $table->string('notas', 3000);           
            $table->timestamps();

            $table->foreign('id_cabecerafuid')->references('id')->on('cabecerafuid')->onDelete('cascade');
            $table->foreign('id_serie')->references('id')->on('series')->onDelete('cascade');
            $table->foreign('id_subserie')->references('id')->on('subseries')->onDelete('cascade');
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
