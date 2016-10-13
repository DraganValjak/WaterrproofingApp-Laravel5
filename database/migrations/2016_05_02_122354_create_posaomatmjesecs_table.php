<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosaomatmjesecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posaomatmjesecs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('posaomaterijali_id')->unsigned();
            $table->decimal('potrosnja_mat', 10,2);
            $table->foreign('posaomaterijali_id')->references('id')->on('posaomaterijalis')->onDelete('cascade');
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
        Schema::drop('posaomatmjesecs');
    }
}
