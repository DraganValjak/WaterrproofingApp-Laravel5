<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosaomaterijalisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posaomaterijalis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stavke_posla_id')->unsigned();
            $table->string('naziv_materijala');
            $table->string('mjerna_jedinica');
            $table->decimal('cijena_sa_popustom',10,2);
            $table->decimal('potrosnja_mat', 10,2);
            $table->decimal('materijal',10,2);
            $table->decimal('kalkul_sat', 10,2);
            $table->decimal('norma_sat', 10,4);
            $table->decimal('rad', 10,2);
            $table->decimal('cijena_po_jm', 10,2);
            $table->decimal('ucinak_m2_sat', 10,2);
            $table->decimal('minuta', 10,2);
            $table->decimal('troskovi_gradilista', 10,2);
            $table->decimal('kalkulativna_cijena_ukupno', 10,2);
            $table->foreign('stavke_posla_id')->references('id')->on('stavke_poslas')->onDelete('cascade');
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
        Schema::drop('posaomaterijalis');
    }
}
