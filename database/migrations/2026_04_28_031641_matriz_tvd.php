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
        Schema::create('matriztvd', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigIncrements('id');
            $table->bigInteger('id_seccion')->unsigned();
            $table->bigInteger('id_subseccion')->unsigned();
            $table->bigInteger('id_serie')->unsigned();
            $table->bigInteger('id_subserie')->unsigned();
            $table->timestamps();

            $table->foreign('id_seccion')->references('id')->on('seccion')->onDelete('cascade');
            $table->foreign('id_subseccion')->references('id')->on('subseccion')->onDelete('cascade');
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
