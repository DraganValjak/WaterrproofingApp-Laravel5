<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterijalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materijals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('naziv_materijala');
            $table->string('mjerna_jedinica');
            $table->decimal('cijena_materijala_po_jedinici',10,2);
            $table->decimal('rabat',10,2);
            $table->decimal('cijena_sa_popustom',10,2);
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
        Schema::drop('materijals');
    }
}
