<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvidencijaposlovasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidencijaposlovas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mjesto_rada');
            $table->string('narucitelj');
            $table->string('narucitelj_adresa');
            $table->string('narucitelj_oib');
            $table->string('cijena_posla')->default(0);
            $table->boolean('izdata_ponuda')->default(0);
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
        Schema::drop('evidencijaposlovas');
    }
}
