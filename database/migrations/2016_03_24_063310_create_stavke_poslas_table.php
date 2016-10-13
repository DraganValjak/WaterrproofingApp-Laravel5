<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStavkePoslasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stavke_poslas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('evidencijaposlova_id')->unsigned();
            $table->integer('broj_stavke')->default(0);
            $table->text('opis_radova');
            $table->decimal('cijena_posla', 10,2);
            $table->decimal('ukupna_cijena', 10,2);
            $table->foreign('evidencijaposlova_id')->references('id')->on('evidencijaposlovas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stavke_poslas');
    }
}
